<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Score extends Model
{
  protected $primaryKey = 'id_score';
  protected $table = 'score';
  protected $fillable = [
    'id_score','id_course','id_mahasiswa','final_exam','assignment','forum_discussion','vc_attendance','quiz','final_score','grade'
  ];
  public $timestamps = false;
}
