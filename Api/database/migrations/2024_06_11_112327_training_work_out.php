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
        Schema::create("trainingWorkOut", function (Blueprint $table) {
            $table->ulid("idTrainingWorkOut")->primary();
            $table->index("trainingType_id");
            $table->foreignUlid("trainingType_id")->references("idTrainingType")->on("trainingType")->onDelete('cascade')->onUpdate('cascade');
            $table->index("workOut_id");
            $table->foreignUlid("workOut_id")->references("idWorkOut")->on("workOut")->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainingWorkOut');
    }
};
