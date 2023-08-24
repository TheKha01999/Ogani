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
        // php artisan make:migration add_status_to_product_category
        //php artisan migrate:refresh
        Schema::table('product_category', function (Blueprint $table) {
            $table->boolean('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_category', function (Blueprint $table) {
            //
        });
    }
};
