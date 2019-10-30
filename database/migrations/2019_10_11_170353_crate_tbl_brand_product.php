<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateTblBrandProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_brand', function (Blueprint $table) {
            

            $table->Increments('brand_id');
            $table->string('brand_name');
            $table->text('brand_desc');
            
            // integer kiểu ẩn hiện 
            $table->integer('brand_status');
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
        Schema::dropIfExists('tbl_brand');
    }
}
