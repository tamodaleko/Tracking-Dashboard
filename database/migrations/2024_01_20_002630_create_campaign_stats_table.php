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
        Schema::create('campaign_stats', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('campaign_id');
            $table->integer('reach');
            $table->integer('impressions');
            $table->float('spend');
            $table->float('spend_rsd');
            $table->float('cpc');
            $table->integer('clicks');
            $table->integer('conversions');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaign_stats');
    }
};
