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
            $table->string("description");
            $table->string("image");
            $table->string("video");
            $table->string("muscle");
            $table->string("equipment");
            $table->string("difficulty");
            $table->string("duration");
            $table->string("calories");
            $table->string("weight");
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
