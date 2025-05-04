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


        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Using UUID as primary key
            $table->uuid('chat_id')->index();
            $table->uuid('sender_id')->index();
            $table->uuid('receiver_id')->index();

            $table->text('message');
            $table->timestamp('read_at')->nullable();

            // Foreign keys
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
