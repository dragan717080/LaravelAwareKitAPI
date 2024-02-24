<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up(): void
    {
        Schema::create('orgs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type');
            $table->timestamps();

            $table->foreignUuid('creator_id')->references('id')->on('users');
        });

        /**
         * Related entities are only used within context of this table
         * so they don't need timestamps
         */
        Schema::create('contacts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('email');

            $table->foreignUuid('org_id')->constrained()->onDelete('cascade');
        });

        Schema::create('phones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('contact_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('countryCode');
            $table->unsignedBigInteger('number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('phones');
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('orgs');
    }
};
