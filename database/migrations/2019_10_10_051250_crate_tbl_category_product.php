<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateTblCategoryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('btl_catgory_product', function (Blueprint $table) {
            $table->Increments('category_id');
            $table->string('category_name');
            $table->text('category_desc');
            
            // integer kiểu ẩn hiện 
            $table->integer('category_status');
            // Nó sẽ lấy ngày hiện tại bạn tạo csld 
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
        Schema::dropIfExists('btl_catgory_product');
    }
}
