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
        Schema::create('product_category', function (Blueprint $table) {
            // php artisan make:migration create_product_category_table
            // php artisan make:migration add_status_to_product_category
            //khi chay php artisan migrate thi se vao database->migrations chay cac file co trong day
            $table->id(); // Tu tao PK khoa chinh voi auto increment
            $table->string('name',255); // string la char 255
            $table->timestamps(); //tu tao ra created_at va updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category');
    }
};
