<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostVolunteerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_volunteer', function (Blueprint $table) {
            $table->primary(['post_id','volunteer_id']);
            $table->timestamps();

            $table->bigInteger('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->
                on('posts')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('volunteer_id')->unsigned();
            $table->foreign('volunteer_id')->references('id')->
                on('volunteers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_volunteer');
    }
}
