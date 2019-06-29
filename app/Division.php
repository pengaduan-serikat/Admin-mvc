<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
  // Table name
  protected $table = 'divisions';
  // Primary key
  public $primaryKey = 'id';
  // Timestamps
  public $timestamps = true;
}
