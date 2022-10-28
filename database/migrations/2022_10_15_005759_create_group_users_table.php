<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('user_id');

            $table->index('group_id','group_user_group_idx');
            $table->index('user_id','group_user_user_idx');

            $table->foreign('group_id','group_user_group_fk')->on('groups')->references('id');
            $table->foreign('user_id','group_user_user_fk')->on('users')->references('id')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_users');
    }
};
