<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Thread;
use Illuminate\Support\Facades\Storage;

class ThreadController extends Controller
{
	public function __construct()
	{

	}
	public function list(Request $request){
    $offset = 0;
    $page = 1;
    $perPage = 10;
    $sortDir = 'DESC';
    $sortBy = 'id_thread';
    $search = null;
    $total = 0;
    $totalPage = 1;
    $session = $request->id_session;
    if($session){
      if ($request->page) {
        $page = $request->page;
      }
      if ($request->perPage) {
        $perPage = $request->perPage;
      }
      if ($request->sortDir) {
        $sortDir = $request->sortDir;
      }
      if ($request->sortBy) {
        $sortBy = $request->sortBy;
      }
      if ($request->search) {
        $search = $request->search;
      }
      if ($page > 1) {
        $offset = ($page - 1) * $perPage;
      }

      $listData = Thread::orderBy($sortBy, $sortDir);
      if ($perPage != '~') {
        $listData->skip($offset)->take($perPage);
      }
      if ($search != null) {
        $listData->where('title', 'LIKE', '%'.$search.'%')
                ->orWhere('content', 'LIKE', '%'.$search.'%');
      }
      $listData->where('id_session',$session);
      $listData->select('thread.*');
      $listData->leftJoin('mahasiswa','mahasiswa.id_mahasiswa','=','thread.id_poster');
      $listData->leftJoin('dosen','dosen.id_dosen','=','thread.id_poster');
     // $listData->selectRaw('IF(thread.id_poster = 1,"Dosen","Mahasiswa") as poster_name');
      $listData->selectRaw('IF(dosen.id_dosen is null, mahasiswa.nama,dosen.nama) as poster_name');
      //$listData->selectRaw('IF(thread.id_poster = 1,"Dosen","Mahasiswa") as role');
      $listData->selectRaw('IF(thread.id_poster = 1,"https://lh3.googleusercontent.com/proxy/A5SANYdv6NATLj-ddkvvV0xkm_-4dqgOoD_9ipcOQCu6ME1n1RGXPYF0Qgdu5u_UyfXoROyKsHn4HBx0xnp1VXveqwFYBDM","https://icons-for-free.com/iconfiles/png/512/business+costume+male+man+office+user+icon-1320196264882354682.png") as img');
      $listData = $listData->get();
      if ($search) {
        $total = Thread::where('id_session',$session)
                            ->where('title', 'LIKE', '%'.$search.'%')
                            ->orWhere('content', 'LIKE', '%'.$search.'%')
                            ->count();
      } else {
        $total = Thread::where('id_session',$session)->count();
      }

      if ($perPage != '~') {
        $totalPage = ceil($total / $perPage);
      }
      $res = array(
        'status' => true,
        'code' => 200,
        'payload' => array(
          'data' => $listData,
          'page' => $page,
          'perPage' => $perPage,
          'sortDir' => $sortDir,
          'sortBy' => $sortBy,
          'search' => $search,
          'total' => $total,
          'totalPage' => $totalPage,
        ),
        'msg' => 'Success'
      );
    } else {
      $res = array(
        'status' => false,
        'code' => 401,
        'msg' => 'Please fill id_session parameter'
      );
    }
    return response()->json($res, 200);
  }
  public function create(Request $request){
    $dataCreate = $request->all();
    $user = $request->auth;
    $dataCreate['date_post'] = date('Y-m-d H:i:s');
    if($user->role == 'DOSEN'){
      $dataCreate['role'] = 'dosen';
    }
    else{
      $dataCreate['role'] = 'mahasiswa';
    }
    $validate = Thread::validate($dataCreate);
    if ($validate['status']) {
      try {
        $dc = Thread::create($dataCreate);
        $res = array(
          'status' => true,
          'msg' => 'Data Successfully Saved',
          'payload' => $dataCreate
        );
      } catch (Exception $e) {
        $res = array(
          'status' => false,
          'code' => 500,
          'msg' => 'Failed to Save Data'
        );
      }
    } else {
      $res = $validate;
      $res['data'] = $dataCreate;
    }
    return response()->json($res, 200);
  }
  public function update(Request $request){
    $updateData = Thread::where('id_thread',$request->id_thread)->first();
    if($request->title)
      $updateData->title = $request->title;
    if($request->content)
      $updateData->content = $request->content;
    if($request->quote)
      $updateData->quote = $request->quote;
    if($request->status)
      $updateData->status = $request->status;
    $validate = Thread::validate($request->all());
    if ($validate['status']) {
      try {
        $updateData->save();
        $res = array(
          'status' => true,
          'code' => 200,
          'msg' => 'Data Successfully Saved'
        );
      } catch (Exception $e) {
        $res = array(
          'status' => false,
          'code' => 500,
          'msg' => 'Failed to Save Data'
        );
      }
    } else {
      $res = array(
        'status' => false,
        'code' => 500,
        'msg' => 'Validation Error'
      );
    }
    return response()->json($res, 200);
  }
  public function delete(Request $request)
  {
    if ($request->id) {
      $delData = Thread::find($request->id);
      try {
        $delData->delete();
        $res = array(
          'status' => true,
          'code' => 200,
          'msg' => 'Data successfully deleted'
        );
      } catch (Exception $e) {
        $res = array(
          'status' => false,
          'code' => 500,
          'msg' => 'Failed to delete Data'
        );
      }
    } else {
      $res = array(
        'status' => false,
        'code' => 404,
        'msg' => 'No data selected'
      );
    }
    return response()->json($res, 200);
  }
}
