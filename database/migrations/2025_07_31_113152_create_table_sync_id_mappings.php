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
        Schema::create('sync_id_mappings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id');
            $table->string('model_name'); // e.g., 'orders', 'items', 'payments'
            $table->unsignedBigInteger('local_id');
            $table->unsignedBigInteger('cloud_id')->nullable();
            $table->enum('direction', ['upload', 'download']);
            $table->timestamp('updated_at_local')->nullable();
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();

            $table->unique(['restaurant_id', 'model_name', 'local_id', 'direction'], 'unique_sync_entry');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_id_mappings');
    }
};
