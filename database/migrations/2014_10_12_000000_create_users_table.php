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
            $table->id();
        
            $table->integer('usergroup');
            $table->string('code', 10)->unique('code');
            $table->integer('parentid')->nullable();
            $table->string('name', 50);
            $table->string('login', 50);
            $table->string('email', 50);
            $table->integer('mobile');
            $table->integer('vendorid')->index('vendorid');
            $table->longText('password');
            $table->text('kycdata');
            $table->boolean('status');
            $table->dateTime('dtcr');
            $table->integer('crby')->index('crby');
            $table->dateTime('dtlm');
            $table->integer('lmby')->index('lmby');
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
