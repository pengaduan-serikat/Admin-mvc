<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('positions')) {
      Schema::create('users', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('access_type_id')->nullable();
        $table->unsignedBigInteger('division_id')->nullable();
        $table->unsignedBigInteger('position_id')->nullable();
        $table->foreign('access_type_id')->references('id')->on('access_types');
        $table->foreign('division_id')->references('id')->on('divisions');
        $table->foreign('position_id')->references('id')->on('positions');
        $table->string('email')->unique();
        $table->string('username')->unique();
        $table->string('password');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('profile_pic')->nullable();
        $table->string('NIK');
        $table->timestamps();
      });
    }
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
