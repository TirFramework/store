<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tax_class_id')->unsigned()->nullable();
            $table->string('slug')->unique();
            $table->decimal('price', 18, 4)->unsigned();
            $table->boolean('call_for_price')->default(0)->nullable();
            $table->decimal('special_price', 18, 4)->unsigned()->nullable();
            $table->date('special_price_start')->nullable();
            $table->date('special_price_end')->nullable();
            $table->decimal('selling_price', 18, 4)->unsigned()->nullable();
            $table->string('sku')->nullable();
            $table->string('image')->nullable();
            $table->boolean('manage_stock');
            $table->integer('qty')->nullable();
            $table->boolean('in_stock');
            $table->integer('viewed')->unsigned()->default(0);
            $table->boolean('is_active');
            $table->datetime('new_from')->nullable();
            $table->datetime('new_to')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set Null');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('set Null');


        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('products');

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

    }
}
