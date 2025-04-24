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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id'); // UUID instead 
            $table->string('profile_image')->nullable(); // URL or path to profile image
            $table->text('address')->nullable(); // User's address
            $table->json('mathematical_interests')->nullable(); // Array of 1 to 5 interests
            $table->text('achievements')->nullable(); // User's achievements
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->boolean('is_mathematician')->default(false);
            $table->timestamps();


            //foreign id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //index
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
