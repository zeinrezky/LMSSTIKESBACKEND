<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Semester extends Model
{
  protected $primaryKey = 'id_semester';
  protected $table = 'semester';
}
