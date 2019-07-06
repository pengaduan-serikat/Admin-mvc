<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCasesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('user_cases')) {
      Schema::create('user_cases', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id')->nullable();
        $table->unsignedBigInteger('executor_id')->nullable();
        $table->unsignedBigInteger('case_status_id')->nullable();
        $table->unsignedBigInteger('feedback_id')->nullable();
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('executor_id')->references('id')->on('users');
        $table->foreign('case_status_id')->references('id')->on('case_status');
        $table->foreign('feedback_id')->references('id')->on('feedbacks');
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
    Schema::dropIfExists('user_cases');
  }
}
