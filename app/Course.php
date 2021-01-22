<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Course extends Model
{
  protected $primaryKey = 'id_ca';
  protected $table = 'course_attribute';
}
