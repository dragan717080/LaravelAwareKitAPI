<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unique('id');
            $table->string('name');
            $table->json('comms');
            $table->timestamps();

            $table->foreignUuid('parent_service_id')->nullable()->references('id')->on('services')->onDelete('set null');
            $table->foreignUuid('owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
