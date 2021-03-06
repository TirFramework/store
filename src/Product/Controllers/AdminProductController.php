<?php

namespace Tir\Store\Product\Controllers;

use Illuminate\Http\Request;
use Tir\Crud\Controllers\CrudController;
use Tir\Store\Attribute\Entities\ProductAttributeValue;
use Tir\Store\Product\Entities\Product;


class AdminProductController extends CrudController
{
    protected $model = Product::Class;


    public function saveAdditional(Request $request, $item)
    {
        $product = $item;
        $this->deleteProductAttributes($product);
        $this->createProductAttributes($product);


        $this->deleteProductadditionalImages($product);
        $this->createProductadditionalImages($product);
    }


    /**
     * Delete all product attributes associated with the given product.
     *
     * @param Product $product
     * @return void
     */
    private function deleteProductAttributes($product)
    {
        $product->attributes()->delete();
    }

    /**
     * Create product attributes for the given product.
     *
     * @param Product $product
     * @return void
     */
    private function createProductAttributes($product)
    {
        $productAttributeValues = [];

        foreach (request('attributes', []) as $attribute) {
            if (isset($attribute['values'])) {
                $productAttribute = $product->attributes()->create([
                    'attribute_id' => $attribute['attribute_id'],
                ]);

                foreach ($attribute['values'] as $valueId) {
                    $productAttributeValues[] = [
                        'product_attribute_id' => $productAttribute->id,
                        'attribute_value_id'   => $valueId,
                    ];
                }

            }
        }

        $this->createProductAttributeValues($productAttributeValues);
    }

    /**
     * Create the given product attribute values.
     *
     * @param array $productAttributeValues
     * @return void
     */
    private function createProductAttributeValues($productAttributeValues)
    {
        ProductAttributeValue::insert($productAttributeValues);
    }


    /**
     * Delete all product additionalImages associated with the given product.
     *
     * @param Product $product
     * @return void
     */
    private function deleteProductadditionalImages($product)
    {
        $product->additionalImages()->delete();
    }


    /**
     * Create product additionalImages for the given product.
     *
     * @param Product $product
     * @return void
     */
    private function createProductadditionalImages($product)
    {

        foreach (request('additionalImages') as $image) {
            if (isset($image)) {
                $productadditionalImages = $product->additionalImages()->create([
                    'url' => $image,
                ]);
            }

        }
    }


}
