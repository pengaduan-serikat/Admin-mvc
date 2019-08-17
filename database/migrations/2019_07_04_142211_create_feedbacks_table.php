<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('feedbacks')) {
      Schema::create('feedbacks', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('case_id');
        $table->unsignedBigInteger('case_status_id');
        $table->foreign('case_id')->references('id')->on('cases');
        $table->foreign('case_status_id')->references('id')->on('case_status');
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
    Schema::dropIfExists('feedbacks');
  }
}
