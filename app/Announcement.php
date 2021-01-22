<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Announcement extends Model
{
  protected $primaryKey = 'id_announcement';
  protected $table = 'announcement';
  protected $fillable = [
    'id_announcement','img','title','content','date'
  ];
  public $timestamps = false;
}
