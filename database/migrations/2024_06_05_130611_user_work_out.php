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
        Schema::create("user_workOut", function (Blueprint $table) {
            $table->ulid("idUser_workOut");
            $table->index("user_id");
            $table->index("workOut_id");
            $table->foreignUlid("user_id")->references("idUser")->on("users")->onDelete('cascade')->onUpdate('cascade');
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
        //
    }
};
