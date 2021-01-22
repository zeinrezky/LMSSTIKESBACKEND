<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Whatson extends Model
{
  protected $primaryKey = 'id_whatson';
  protected $table = 'whatson';
  protected $fillable = [
    'id_whatson','img','title','content','date'
  ];
  public $timestamps = false;
}
