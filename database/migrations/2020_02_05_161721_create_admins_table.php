<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username',100);
            $table->string('password',200);
            $table->enum('type',['admin', 'sub-admin'])->default('admin');
            $table->tinyInteger('product_all_access')->default(0);
            $table->tinyInteger('product_create_access')->default(0);
            $table->tinyInteger('product_edit_access')->default(0);
            $table->tinyInteger('product_view_access')->default(0);
            $table->tinyInteger('product_delete_access')->default(0);
            $table->tinyInteger('product_status_access')->default(0);
            $table->tinyInteger('category_access')->default(0);
            $table->tinyInteger('order_access')->default(0);
            $table->tinyInteger('coupon_access')->default(0);
            $table->tinyInteger('status');
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
        Schema::dropIfExists('admins');
    }
}
