<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('cases')) {
      Schema::create('cases', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('executor_id')->nullable();
        // $table->unsignedBigInteger('case_status_id');
        // $table->unsignedBigInteger('feedback_id')->nullable();
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('executor_id')->references('id')->on('users');
        // $table->foreign('case_status_id')->references('id')->on('case_status');
        // $table->foreign('feedback_id')->references('id')->on('feedbacks');
        $table->string('title', 50);
        $table->longText('description');
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
    Schema::dropIfExists('cases');
  }
}
