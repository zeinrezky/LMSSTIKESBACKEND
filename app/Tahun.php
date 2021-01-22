<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Tahun extends Model
{
  protected $primaryKey = 'id_tahun';
  protected $table = 'tahun';
}
