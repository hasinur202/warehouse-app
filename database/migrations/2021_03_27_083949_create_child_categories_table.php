<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses')->onDelete('cascade');
            $table->foreignId('main_category_id')->nullable()->constrained('main_categories')->onDelete('cascade');
            $table->foreignId('sub_category_id')->nullable()->constrained('sub_categories')->onDelete('cascade');
            $table->string('category_name');
            $table->string('slug');
            $table->string('icon');
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
        Schema::dropIfExists('child_categories');
    }
}
