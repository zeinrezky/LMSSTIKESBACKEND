<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Course;
use App\Pm;
use App\Tahun;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
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
      $tahun = Tahun::find($schedule);
      // $pm = Pm::select('pengembang_materi.*','mk.mk_nama','mk.mk_kode','ca.ca_item')
      //         ->where('id_semester',$tahun->semester)
      //         ->leftJoin('matakuliah as mk','mk.id_matakuliah','pengembang_materi.id_matakuliah')
      //         ->leftJoin('mapping_materi as mm','mm.id_pm','pengembang_materi.id_pm')
      //         ->leftJoin('course_attribute as ca','ca.id_ca','mm.id_ca')
      //         ->groupBy('pengembang_materi.id_pm')
      //         ->get();

      $tahun = Tahun::find($schedule);
      $pm = Pm::select('pengembang_materi.*','mk.mk_nama','mk.mk_kode','ca.ca_item')
              ->where('id_semester',$schedule)
              ->leftJoin('matakuliah as mk','mk.id_matakuliah','pengembang_materi.id_matakuliah')
              ->leftJoin('mapping_materi as mm','mm.id_pm','pengembang_materi.id_pm')
              ->leftJoin('course_attribute as ca','ca.id_ca','mm.id_ca')
              ->groupBy('pengembang_materi.id_pm')
              ->get();

      $all = Pm::select('pengembang_materi.*','mk.mk_nama','mk.mk_kode','ca.ca_item')
              ->where('id_semester',$schedule)
              ->leftJoin('matakuliah as mk','mk.id_matakuliah','pengembang_materi.id_matakuliah')
              ->leftJoin('mapping_materi as mm','mm.id_pm','pengembang_materi.id_pm')
              ->leftJoin('course_attribute as ca','ca.id_ca','mm.id_ca')
              // ->groupBy('pengembang_materi.id_pm')
              ->get();

      $pm2 = Pm::select('pengembang_materi.*','mk.mk_nama','mk.mk_kode','ca.ca_item')
              ->where('id_semester',$tahun->id_tahun)
              ->leftJoin('matakuliah as mk','mk.id_matakuliah','pengembang_materi.id_matakuliah')
              ->leftJoin('mapping_materi as mm','mm.id_pm','pengembang_materi.id_pm')
              ->leftJoin('course_attribute as ca','ca.id_ca','mm.id_ca')
              ->groupBy('pengembang_materi.id_pm')
              ->get();

      $all2 = Pm::select('pengembang_materi.*','mk.mk_nama','mk.mk_kode','ca.ca_item')
              ->where('id_semester',$tahun->id_tahun)
              ->leftJoin('matakuliah as mk','mk.id_matakuliah','pengembang_materi.id_matakuliah')
              ->leftJoin('mapping_materi as mm','mm.id_pm','pengembang_materi.id_pm')
              ->leftJoin('course_attribute as ca','ca.id_ca','mm.id_ca')
              // ->groupBy('pengembang_materi.id_pm')
              ->get();

      $allBanget = Pm::get();

      return response()->json([ 'testing',
                                'tahun' => $tahun, 
                                'tahunId' => $tahun->id_tahun, 
                                'schedule' => $schedule , 
                                'pm' => $pm, 
                                'all' => $all, 
                                'pm2' => $pm2, 
                                'all2' => $all2,
                                'allBanget' => $allBanget,
                              ], 200);
      $data = [];
      foreach($pm as $rPm){
        $course = array(
          'id' => $rPm->id_pm,
          'id_schedule' => $schedule,
          'name' => $rPm->mk_nama,
          'desc' => 'Semester '.$tahun->semester.'/'.$rPm->mk_kode.' - '.$rPm->mk_nama,
          'code' => $rPm->mk_kode,
          'type' => ($rPm->ca_item) ? $rPm->ca_item : '-',
          'class' => ($rPm->ca_item) ? $this->initial($rPm->ca_item) : '-'
        );
        array_push($data,$course);
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
