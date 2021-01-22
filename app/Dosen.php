<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Dosen extends Model
{
  protected $primaryKey = 'id_dosen';
  protected $table = 'dosen';
}
