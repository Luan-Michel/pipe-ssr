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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('organism_id');
            $table->unsignedBigInteger('genome_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('organism_id')->references('id')->on('organisms');
            $table->foreign('genome_id')->references('id')->on('genomes');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
