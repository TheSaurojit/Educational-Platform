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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('title')->nullable();
            $table->longText('body')->nullable();
            $table->longText('image')->nullable();

            $table->uuid('user_id');

            //foreign
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Indexes for performance
            $table->index('user_id');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
