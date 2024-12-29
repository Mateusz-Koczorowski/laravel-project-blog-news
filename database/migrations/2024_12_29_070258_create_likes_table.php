<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLikesTable extends Migration
{
    public function up()
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('article_id')->constrained('articles')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'article_id']); // Jeden użytkownik może dodać tylko jeden lajk do jednego artykułu
        });
    }

    public function down()
    {
        Schema::dropIfExists('likes');
    }
}