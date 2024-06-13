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
        Schema::create("trainingType", function (Blueprint $table) {
            $table->ulid("idTrainingType")->primary();
            $table->string("name");
            $table->string("description");
            $table->index("user_id");
            $table->foreignUlid("user_id")->references("idUser")->on("users")->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainingType');
    }
};
