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
        Schema::create("workOut", function (Blueprint $table) {
            $table->ulid("idWorkOut")->primary();
            $table->string("name");
            $table->string("description")->nullable();
            $table->string("image")->nullable();
            $table->string("video")->nullable();
            $table->string("muscle")->nullable();
            $table->string("equipment")->nullable();
            $table->string("difficulty")->nullable();
            $table->string("duration")->nullable();
            $table->string("calories")->nullable();
            $table->string("weight")->nullable();
            $table->string("repetition")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("workOut");
    }
};
