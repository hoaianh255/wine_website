<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('commenter_id');
            $table->string('commenter_type')->nullable();
            $table->index(["commenter_id", "commenter_type"]);

            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();

            $table->string("commentable_type");
            $table->unsignedBigInteger("commentable_id");
            $table->index(["commentable_type", "commentable_id"]);

            $table->text('comment');

            $table->boolean('approved')->default(true);

            $table->unsignedBigInteger('child_id')->nullable();
            $table->foreign('child_id')->references('id')->on('comments')->onDelete('cascade');

			$table->softDeletes();
            $table->timestamps();
          $table->foreign('commenter_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('commentable_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
