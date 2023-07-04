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
            'pictures',
            function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->text('desc')->nullable();
                $table->unsignedBigInteger('size');
                $table->integer('width');
                $table->integer('height');
                $table->string('orginal_name');
                $table->string('hash_name');
                $table->string('mime_type');
                $table->foreignId('creator_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pictures');
    }
};
