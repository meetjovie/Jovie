<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('title');
            $table->text('excerpt');
            $table->string('author');
            $table->string('image_url') -> nullable();
            $table->string('slug') -> unique();
            $table->timestamp('publish_date') -> nullable();
            $table->text('body');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
