<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Pm extends Model
{
  protected $primaryKey = 'id_pm';
  protected $table = 'pengembang_materi';
}
