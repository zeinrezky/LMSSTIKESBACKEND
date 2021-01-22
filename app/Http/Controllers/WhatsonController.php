<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Whatson;
use Illuminate\Support\Facades\Storage;

class WhatsonController extends Controller
{
	public function __construct()
	{

  }
  public function list(Request $request){
    $offset = 0;
    $page = 1;
    $perPage = 10;
    $sortDir = 'ASC';
    $sortBy = 'id_whatson';
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
    if ($page > 1) {
      $offset = ($page - 1) * $perPage;
    }

    $listData = WhatsOn::orderBy($sortBy, $sortDir);
    if ($perPage != '~') {
      $listData->skip($offset)->take($perPage);
    }
    if ($search != null) {
      $listData->where('title', 'LIKE', '%'.$search.'%')
              ->orWhere('content', 'LIKE', '%'.$search.'%');
    }

    $listData = $listData->get();
    if ($search) {
      $total = WhatsOn::where('title', 'LIKE', '%'.$search.'%')
                          ->orWhere('content', 'LIKE', '%'.$search.'%')
                          ->count();
    } else {
      $total = WhatsOn::all()->count();
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
      $data = Whatson::find($id);
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
