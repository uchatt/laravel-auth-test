<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('mem_id')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(0);
            $table->boolean('verification_status')->default(0);
            $table->integer('club_role_id')->unsigned()->default(3);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('club_role_id')
                ->references('id')
                ->on('settings_club_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
