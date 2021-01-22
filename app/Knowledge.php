<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Knowledge extends Model
{
  protected $primaryKey = 'id_knowledge';
  protected $table = 'knowledge';
  protected $fillable = [
    'id_knowledge','img','title','content','date'
  ];
  public $timestamps = false;
}
