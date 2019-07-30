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
        $table->foreign('case_id')->references('id')->on('cases');
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
