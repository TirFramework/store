<?php


namespace Tir\Store\Product\Controllers;


use Illuminate\Routing\Controller;
use Tir\Setting\Facades\Stg;
use Tir\Store\Category\Entities\Category;
use Tir\Store\Product\Entities\Product;
use Tir\Store\Product\Filters\ProductFilter;
use Tir\Store\Product\Middleware\SetProductSortOption;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(SetProductSortOption::class)->only('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Product $model
     * @param ProductFilter $productFilter
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Product $model, ProductFilter $productFilter)
    {
        $productIds = [];
        $this->checkCategoryExist(request()->input('category'));

        if (request()->has('query')) {
            $model = $model->search(request('query'));
            $productIds = $model->keys();
        }


        $query = $model->filter($productFilter);

        if (request()->has('category')) {
            //TODO: Check resetOrders Macro in  Tir\Store\Support\Providers\EloquentMacroServiceProvider
            //$productIds = (clone $query)->select('products.id')->resetOrders()->pluck('id');

            $productIds = (clone $query)->select('products.id')->resetOrders()->pluck('id');
        }
        if (request()->has('brands')) {
             $query->whereIn('brand_id',request('brands'));
        }

        $products = $query->paginate(request('perPage', 15))
            ->appends(request()->except('filtered'));

        if (request()->wantsJson()) {
            return response()->json($products);
        }

       // event(new ShowingProductList($products));

        return view(config('crud.front-template').'::public.products.index', compact('products', 'productIds'));
    }


    /**
     * @param $slug string
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($slug)
    {
        $product = Product::findBySlug($slug);
        $relatedProducts = $product->relatedProducts()->forCard()->get();
        $upSellProducts = $product->upSellProducts()->forCard()->get();
        $reviews = $this->getReviews($product);

        if (Stg::get('reviews_enabled')) {
            $product->load('reviews:product_id,rating');
        }
        //TODO: check event
       // event(new ProductViewed($product));

        return view(config('crud.front-template').'::public.products.show', compact('product','relatedProducts', 'upSellProducts', 'reviews'));
    }

    /**
     * Get reviews for the given product.
     *
     * @param \Tir\Store\Product\Entities\Product $product
     * @return \Illuminate\Support\Collection
     */
    private function getReviews($product)
    {
        if (! Stg::get('reviews_enabled')) {
            return collect();
        }

        return $product->reviews()->paginate(15, ['*'], 'reviews');
    }

    private function checkCategoryExist($slug)
    {
        Category::where('slug',$slug)->firstOrFail();
    }

}