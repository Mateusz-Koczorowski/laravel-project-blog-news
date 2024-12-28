<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamp('release_date')->nullable();
            $table->text('free_content')->nullable();
            $table->text('premium_content')->nullable();
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->string('image_file_name')->nullable();
            $table->string('alt_text')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
}