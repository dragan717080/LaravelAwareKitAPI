<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            // If needed can use method whereJsonContains to query json
            $table->json('comms');
            $table->timestamps();

            $table->foreignUuid('owner_id')->references('id')->on('users');
            $table->foreignUuid('pfl_id')->references('id')->on('pfl');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
