<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            // php artisan make:migration create_product_category_table
            // php artisan make:migration add_status_to_product_category
            //php artisan migrate -> up();
            //khi chay php artisan migrate thi se vao database->migrations chay cac file co trong day
            $table->id(); // Tu tao PK khoa chinh voi auto increment
            $table->string('name',255)->nullable(); // string la char 255
            $table->timestamps(); //tu tao ra created_at va updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //php artisan migrate:rollback -> down(); lui ve 1 phien ban trc do, co the de step = 2,3 de lui ve 2,3 phien ban
        Schema::dropIfExists('product_categories');
    }
};
