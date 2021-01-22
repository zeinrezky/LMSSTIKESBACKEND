<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Campus extends Model
{
  protected $primaryKey = 'id_campus';
  protected $table = 'campus';
  protected $fillable = [
    'id_campus','img','title','content','date','type'
  ];
  public $timestamps = false;
}
