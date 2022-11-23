<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Course;
use App\Pm;
use App\Tahun;
use App\Semester;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    { }
    public function list(Request $request)
    {
        $user = null;
        if ($request->auth)
            $user = $request->auth;
        if ($request->id_schedule)
            $schedule = $request->id_schedule;
        if ($schedule) {
            $tahun = Semester::find($schedule);
            $query = Pm::where('pengembang_materi.id_semester', $schedule)
                ->leftJoin('matakuliah as mk', 'mk.id_matakuliah', 'pengembang_materi.id_matakuliah')
                ->leftJoin('mapping_materi as mm', 'mm.id_pm', 'pengembang_materi.id_pm')
                ->leftJoin('course_attribute as ca', 'ca.id_ca', 'mm.id_ca')
                ->leftJoin('pm_assign','pm_assign.id_pm','=','pengembang_materi.id_pm')
                ->groupBy('pengembang_materi.id_pm');
            if($user->role == 'DOSEN'){
                $query->select('pengembang_materi.*', 'mk.mk_nama', 'mk.mk_kode', 'ca.ca_item', "mm.type",'kelas.nama as nama_kelas','mm.class');
                $query->leftJoin('mapping_pengajar','mapping_pengajar.id_pm','=','pengembang_materi.id_pm');
                $query->leftJoin('kelas','kelas.id_kelas','=','mapping_pengajar.id_kelas');
                $query->where('mapping_pengajar.id_dosen',$user->id_user);
                $query->whereNotNull('kelas.id_kelas');
            }
            if($user->role == 'MAHASISWA'){
                //Opsi 1
                $query->select('pengembang_materi.*', 'mk.mk_nama', 'mk.mk_kode', 'ca.ca_item', "mm.type",'kelas.nama as nama_kelas','mm.class');
                $query->leftJoin('mapping_kelas','mapping_kelas.id_pm','=','pengembang_materi.id_pm');
                $query->leftJoin('kelas','kelas.id_kelas','=','mapping_kelas.id_kelas');
                $query->leftJoin('mahasiswa',function ($join) {
                    $join->on('mahasiswa.id_semester','=','pengembang_materi.id_semester');
                    $join->on('mahasiswa.id_kelas','=','mapping_kelas.id_kelas');
                });
                //$query->leftJoin('mahasiswa','mahasiswa.id_semester','=','pengembang_materi.id_semester');
                //$query->leftJoin(DB::raw('mapping_kelas as map_kelas'),'map_kelas.id_kelas','=','mahasiswa.id_kelas');
                $query->where('mahasiswa.id_semester',$schedule);
                $query->where('mahasiswa.id_mahasiswa',$user->id_user);
                //$query->whereNotNull('mahasiswa.id_kelas');
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
            $pm = $query->get();
            $data = [];
            foreach ($pm as $rPm) {
                $course = array(
                    'id' => $rPm->id_pm,
                    'id_schedule' => $schedule,
                    'name' => $rPm->mk_nama,
                    'desc' => $rPm->nama_kelas?$tahun->nama_semester . ' / '.$rPm->nama_kelas .' / '. $rPm->mk_kode . ' - ' . $rPm->mk_nama:$tahun->nama_semester . ' ' . $rPm->mk_kode . ' - ' . $rPm->mk_nama,
                    'code' => $rPm->mk_kode,
                    // 'type' => ($rPm->ca_item) ? $rPm->ca_item : '-',
                    // 'class' => ($rPm->ca_item) ? $this->initial($rPm->ca_item) : '-'
                    'type' => $rPm->type?$rPm->type:'-',
                    'class' => $rPm->class?$rPm->class:'-'
                );
                array_push($data, $course);
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
