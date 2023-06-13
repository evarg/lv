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
        Schema::create(
            'countries',
            function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('code_alpha_2', 2);
                $table->string('code_alpha_3', 3);
                $table->unsignedInteger('code_numeric');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
