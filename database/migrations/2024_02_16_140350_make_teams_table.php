<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->json('comms');
            $table->timestamps();

            $table->foreignUuid('owner_id')->references('id')->on('users');
            $table->foreignUuid('org_id')->references('id')->on('orgs')->onDelete('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('team_id')->nullable()->references('id')->on('teams');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('team_id');
        });
    }
};
