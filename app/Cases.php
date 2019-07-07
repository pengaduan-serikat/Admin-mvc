<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cases extends Model
{
  // Table name
  protected $table = 'cases';
  // Primary key
  public $primaryKey = 'id';
  // Timestamps
  public $timestamps = true;
}
