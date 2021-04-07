<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('cascade');
            $table->foreignId('main_category_id')->nullable()->constrained('main_categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('cascade');
            $table->foreignId('child_category_id')->nullable()->constrained('child_categories')->onDelete('cascade');
            $table->foreignId('shipping_id')->nullable()->constrained('shipping_classes')->onDelete('cascade');
            $table->foreignId('measerement_id')->nullable()->constrained('measurement_types')->onDelete('cascade');
            $table->string('product_barcode');
            $table->string('product_sku');
            $table->string('product_name');
            $table->string('slug');
            $table->string('feature_image');
            $table->string('product_type');
            $table->string('condition');
            $table->string('shipp_duration');
            $table->text('description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
