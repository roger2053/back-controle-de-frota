<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->integer('profile_id')->unsigned()->nullable();
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->string('name');
            $table->string('crm')->nullable();
            $table->string('tarm')->nullable();
            $table->string('service_base')->nullable();
            $table->string('contact')->nullable();
            $table->boolean('is_whatsapp')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->longText('token');
            $table->timestamps();
            $table->softDeletes();
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
