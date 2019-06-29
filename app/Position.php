<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    // Table name
    protected $table = 'positions';
    // Primary key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = true;
}
