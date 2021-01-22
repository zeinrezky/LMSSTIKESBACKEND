<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Attendance;
use App\Tahun;
use Illuminate\Support\Facades\Storage;

class AttendanceController extends Controller
{
	public function __construct()
	{

	}
	public function list(Request $request){
    $user = null;
    if($request->auth)
      $user = $request->auth;
    if($request->id_schedule)
      $schedule = $request->id_schedule;
    if($schedule){
      $data = array(
        array(
          'id' => 1,
          'id_schedule' => $schedule,
          'course_name' => 'Bahasa Indonesia',
          'course_desc' => 'Bahasa Indonesia Course description here',
          'course_code' => 'COMP6048',
          'course_type' => 'LEC',
          'course_class' => 'LAB',
          'max_absence' => 0,
          'total_session' => 11,
          'session_done' => 2,
          'total_absence' => 0,
          'attendance' => 50 
        ),
        array(
          'id' => 2,
          'id_schedule' => $schedule,
          'course_name' => 'Keperawatan Medikal Bedah II ',
          'course_desc' => 'Keperawatan Medikal Bedah II  Course description here',
          'course_code' => 'COMP6049',
          'course_type' => 'EXM',
          'course_class' => 'A2',
          'max_absence' => 0,
          'total_session' => 11,
          'session_done' => 2,
          'total_absence' => 0,
          'attendance' => 50 
        ),
      );
      $tahun = Tahun::find($schedule);
      $data = Attendance::where('id_mahasiswa',$user->id_user)
                          ->where('pm.id_semester',$tahun->semester)
                          ->select('attendance.attendance','attendance.total_absence','attendance.session_done','attendance.total_session','attendance.max_absence','attendance.id_attendance as id','mk.mk_nama as course_name','mk.mk_kode as course_code','ca.keterangan as course_desc','ca.ca_item as course_class','pm.id_semester as id_schedule')
                          ->leftJoin('pengembang_materi as pm','pm.id_matakuliah','attendance.id_course')
                          ->leftJoin('mapping_materi as mm','mm.id_pm','pm.id_pm')
                          ->leftJoin('course_attribute as ca','ca.id_pm','pm.id_pm')
                          ->leftJoin('matakuliah as mk','mk.id_matakuliah','attendance.id_course')
                          ->groupBy('id_course')
                          ->get();
      foreach($data as $d){
        if(!$d->course_class)
          $d->course_class = '-';
        if(!$d->course_desc)
          $d->course_desc = '-';
        $d->course_type = ($d->course_class) ? $this->initial($d->course_class) : '-';
      }
      $res = array(
        'status' => true,
        'code' => 200,
        'payload' => $data,
        'msg' => 'Success'
      );
    } else {
      $res = array(
        'status' => false,
        'code' => 401,
        'msg' => 'Please provide required parameter'
      );
    }
    return response()->json($res, 200);
  }
  function initial($word){
    $words = explode(" ", $word);
    $acronym = "";

    foreach ($words as $w) {
      $acronym .= $w[0];
    }
    return $acronym;
  }
}
