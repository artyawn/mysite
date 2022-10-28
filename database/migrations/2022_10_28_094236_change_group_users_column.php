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
        Schema::table('group_users', function (Blueprint $table) {

            $table->dropForeign('group_user_group_fk');
            $table->foreign('group_id','group_user_group_fk')->on('groups')->references('id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('group_users', function (Blueprint $table) {
            $table->dropForeign('group_user_group_fk');
            $table->foreign('group_id','group_user_group_fk')->on('groups')->references('id');

        });
    }
};
