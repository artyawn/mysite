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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('sender');
            $table->string('worker');
            $table->date('date');
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('group_id')->nullable();
            $table->index('group_id','task_group_idx');
            $table->foreign('group_id','group_task_fk')->on('groups')->references('id');

            $table->unsignedBigInteger('worker_id');
            $table->index('worker_id','task_worker_idx');
            $table->foreign('worker_id','worker_task_fk')->on('users')->references('id');


            $table->unsignedBigInteger('sender_id');
            $table->index('sender_id','task_sender_idx');
            $table->foreign('sender_id','task_sender_fk')->on('users')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
