<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Tahun;

class ScheduleController extends Controller
{
	public function __construct()
	{

	}
	public function list(Request $request){
    $user = null;
    if($request->auth)
      $user = $request->auth;
    $data = array(
      array(
        'id' => 1,
        'name' => '2019 Compact Semester',
        'desc' => 'Schedule Compact description here'
      ),
      array(
        'id' => 2,
        'name' => '2020 Even Semester',
        'desc' => 'Schedule Even description here'
      )
    );
    $dataTahun = Tahun::get();
    $schedule = [];
    foreach($dataTahun as $dt){
      $dtTahun = rtrim($dt->tahun, $dt->semester);
      $sc = array(
        'id' => $dt->id_tahun,
        'name' => $dtTahun.' Semester '.@$dt->semester_huruf,
        'desc' => $dt->nama,
        'status' => $dt->proses_buka
      );
      array_push($schedule,$sc);
    }
    $res = array(
      'status' => true,
      'code' => 200,
      'payload' => $schedule,
      'msg' => 'Success'
    );
    return response()->json($res, 200);
  }
}
