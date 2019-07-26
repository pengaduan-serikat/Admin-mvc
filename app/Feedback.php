<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
  // Table name
  protected $table = 'feedbacks';
  // Primary key
  public $primaryKey = 'id';
  // Timestamps
  public $timestamps = true;
}
