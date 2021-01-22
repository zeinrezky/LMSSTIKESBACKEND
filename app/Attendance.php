<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Attendance extends Model
{
  protected $primaryKey = 'id_attendance';
  protected $table = 'attendance';
  protected $fillable = [
    'id_attendance','id_course','id_mahasiswa','max_absence','total_session','session_done','total_absence','final_score','attendace'
  ];
  public $timestamps = false;
}
