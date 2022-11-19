<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Exam;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
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
      $query = Exam::select('exam.*')->where('id_schedule',$schedule);
      if($user->role == 'DOSEN'){
        $query->leftJoin('pengembang_materi','pengembang_materi.id_pm','=','exam.id_pm');
        $query->leftJoin('mapping_pengajar','mapping_pengajar.id_pm','=','pengembang_materi.id_pm');
        $query->leftJoin('kelas','kelas.id_kelas','=','mapping_pengajar.id_kelas');
        $query->where('mapping_pengajar.id_dosen',$user->id_user);
      }
      if($user->role == 'MAHASISWA'){
        $query->leftJoin('pengembang_materi','pengembang_materi.id_pm','=','exam.id_pm');
        $query->leftJoin('mapping_kelas','mapping_kelas.id_pm','=','pengembang_materi.id_pm');
        $query->leftJoin('kelas','kelas.id_kelas','=','mapping_kelas.id_kelas');
        $query->leftJoin('mahasiswa',function ($join) {
            $join->on('mahasiswa.id_semester','=','pengembang_materi.id_semester');
            $join->on('mahasiswa.id_kelas','=','mapping_kelas.id_kelas');
        });
        $query->where('mahasiswa.id_mahasiswa',$user->id_user);
      }
      $data = $query->get();
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
}
