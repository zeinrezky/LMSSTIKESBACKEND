<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Session;
use App\Exam;
use Illuminate\Support\Facades\Storage;

class SessionController extends Controller
{
    public function __construct()
    { }
    public function list(Request $request)
    {
        $user = null;
        if ($request->auth)
            $user = $request->auth;
        $course = null;
        if ($request->id_course)
            $course = $request->id_course;
        $tgl = null;
        $month = null;
        $year = null;
        $date = null;
        if ($request->date)
            $tgl = $request->date;
        if ($request->month)
            $month = $request->month;
        if ($request->year)
            $year = $request->year;
        if ($tgl && $month && $year)
            $date = date('Y-m-d', strtotime($year . '-' . $month . '-' . $tgl));
        if ($course || $month || $tgl || $year) {
            $data = [];
            $dSess = Session::select('mapping_materi.*', 't.topic', 't.sub_topic', 'mk.mk_kode')
                ->leftJoin('topic as t', 't.id_topic', '=', 'mapping_materi.id_topic')
                ->leftJoin('pengembang_materi as pm', 'pm.id_pm', '=', 'mapping_materi.id_pm')
                ->leftJoin('matakuliah as mk', 'mk.id_matakuliah', '=', 'pm.id_matakuliah');
            if ($course)
                $dSess->where('mapping_materi.id_pm', $course);
            if ($tgl && $month && $year) {
                $dSess->where('date_start', $date);
            } else {
                if ($month)
                    $dSess->whereRaw('MONTH(date_start) = ' . $month);
                if ($year)
                    $dSess->whereRaw('YEAR(date_start) = ' . $year);
            }
            if($user->role == 'DOSEN'){
                $dSess->leftJoin('mapping_pengajar','mapping_pengajar.id_pm','=','pm.id_pm');
                $dSess->leftJoin('kelas','kelas.id_kelas','=','mapping_pengajar.id_kelas');
                $dSess->where('mapping_pengajar.id_dosen',$user->id_user);
            }
            if($user->role == 'MAHASISWA'){
                //Opsi 1
                $dSess->leftJoin('mapping_kelas','mapping_kelas.id_pm','=','pm.id_pm');
                $dSess->leftJoin('kelas','kelas.id_kelas','=','mapping_kelas.id_kelas');
                $dSess->leftJoin('mahasiswa',function ($join) {
                    $join->on('mahasiswa.id_semester','=','pm.id_semester');
                    $join->on('mahasiswa.id_kelas','=','mapping_kelas.id_kelas');
                });
                //$query->leftJoin('mahasiswa','mahasiswa.id_semester','=','pengembang_materi.id_semester');
                //$query->leftJoin(DB::raw('mapping_kelas as map_kelas'),'map_kelas.id_kelas','=','mahasiswa.id_kelas');
                $dSess->where('mahasiswa.id_mahasiswa',$user->id_user);
                //$query->whereRaw('map_kelas.id_kelas = mahasiswa.id_kelas');
                //Opsi 2
                // $query->select('pengembang_materi.*', 'mk.mk_nama', 'mk.mk_kode', 'ca.ca_item', "mm.type",'kelas.nama as nama_kelas','mm.class');
                // $query->leftJoin('mapping_kelas','mapping_kelas.id_pm','=','pengembang_materi.id_pm');
                // $query->leftJoin('mapping_mahasiswa','mapping_mahasiswa.id_mapping_kelas','=','mapping_kelas.id_map');
                // $query->leftJoin('mahasiswa','mahasiswa.id_mahasiswa','=','mapping_mahasiswa.id_mahasiswa');
                // $query->leftJoin('kelas','kelas.id_kelas','=','mapping_kelas.id_kelas');
                // $query->leftJoin(DB::raw('mapping_kelas as map_kelas'),'map_kelas.id_kelas','=','mahasiswa.id_kelas');
                // $query->where('pengembang_materi.id_semester',$schedule);
                // $query->whereNotNull('mahasiswa.id_mahasiswa');
            }
            $dSess = $dSess->get();
            if (count($dSess) > 0) {
                foreach ($dSess as $sess) {
                    $session = array(
                        'id' => $sess->id_map,
                        'id_course' => $sess->id_pm,
                        // 'name' => $sess->sub_topic,
                        'name' => $sess->topic,
                        'desc' => $sess->sub_topic,
                        'type' => $sess->type,
                        'date_start' => $sess->date_start,
                        'date_end' => $sess->date_end,
                        'time_start' => date('H:i', strtotime($sess->time_start)),
                        'time_end' => date('H:i', strtotime($sess->time_end)),
                        'link' => $sess->link,
                        'class' => $sess->class,
                        'course_code' => $sess->mk_kode
                    );
                    array_push($data, $session);
                }
            }
            $exam = Exam::whereDate('download', '=', $date)->get();
            if (count($exam) > 0) {
                foreach ($exam as $ex) {
                    $session = array(
                        'id' => $ex->id_exam,
                        'id_course' => 26,
                        'name' => $ex->name,
                        'desc' => $ex->desc,
                        'type' => 'EXAM',
                        'date_start' => date('Y-m-d', strtotime($ex->download)),
                        'date_end' => date('Y-m-d', strtotime($ex->deadline)),
                        'time_start' => date('H:i', strtotime($ex->download)),
                        'time_end' => date('H:i', strtotime($ex->deadline)),
                        'link' => $ex->link,
                        'class' => $ex->class,
                        'course_code' => $ex->code,
                    );
                    array_push($data, $session);
                }
            }
            $res = array(
                'status' => true,
                'code' => 200,
                'payload' => $data,
                'msg' => 'Success',
                'date' => $date
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
    function initial($word)
    {
        $words = explode(" ", $word);
        $acronym = "";

        foreach ($words as $w) {
            $acronym .= $w[0];
        }
        return $acronym;
    }
}
