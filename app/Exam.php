<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Exam extends Model
{
  protected $primaryKey = 'id_exam';
  protected $table = 'exam';
  protected $fillable = [
    'id_exam','id_schedule','name','desc','code','class','note','room','location','download','deadline','status'
  ];
}
