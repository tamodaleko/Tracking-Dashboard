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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('company_id');
            $table->string('sp_id');
            $table->string('code');
            $table->string('name');
            $table->string('url');
            $table->string('image');
            $table->float('buying_price')->default(0);
            $table->float('selling_price');
            $table->integer('qty_warehouse');
            $table->integer('qty_sending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
