<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Campus;
use Illuminate\Support\Facades\Storage;

class CampusController extends Controller
{
	public function __construct()
	{

  }
  public function list(Request $request){
    $type = 'DIR';
    $offset = 0;
    $page = 1;
    $perPage = 10;
    $sortDir = 'ASC';
    $sortBy = 'id';
    $search = null;
    $total = 0;
    $totalPage = 1;

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
    if ($request->type) {
      $type = $request->type;
    }
    if ($page > 1) {
      $offset = ($page - 1) * $perPage;
    }

    $listData = Campus::orderBy($sortBy, $sortDir);
    if ($perPage != '~') {
      $listData->skip($offset)->take($perPage);
    }

    $listData->where('type',$type);

    if ($search != null) {
      $listData->where('title', 'LIKE', '%'.$search.'%')
              ->orWhere('content', 'LIKE', '%'.$search.'%');
    }

    $listData = $listData->get();
    if ($search) {
      $total = Campus::where('title', 'LIKE', '%'.$search.'%')
                          ->orWhere('content', 'LIKE', '%'.$search.'%')
                          ->count();
    } else {
      $total = Campus::all()->count();
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
    return response()->json($res, 200);
  }
	public function detail(Request $request){
    $id = $request->id;
    if($id) {
      $data = Campus::find($id);
      if($data){
        $res = array(
          'status' => true,
          'code' => 200,
          'payload' => $data,
          'msg' => 'Success'
        );
      } else {
        $res = array(
          'status' => false,
          'code' => 404,
          'msg' => 'Not Found'
        );
      }
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
