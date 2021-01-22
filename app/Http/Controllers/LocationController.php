<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Location;
use Illuminate\Support\Facades\Storage;

class LocationController extends Controller
{
	public function __construct()
	{

	}
	public function list(Request $request)
  {
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
    if ($page > 1) {
      $offset = ($page - 1) * $perPage;
    }

    $listData = Location::orderBy($sortBy, $sortDir);
    if ($perPage != '~') {
      $listData->skip($offset)->take($perPage);
    }
    if ($search != null) {
      $listData->where('name', 'LIKE', '%'.$search.'%');
    }

    $listData = $listData->get();
    if ($search) {
      $total = Location::where('name', 'LIKE', '%'.$search.'%')->count();
    } else {
      $total = Location::all()->count();
    }

    if ($perPage != '~') {
      $totalPage = ceil($total / $perPage);
    }
    $res = array(
      'status' => true,
      'data' => $listData,
      'page' => $page,
      'perPage' => $perPage,
      'sortDir' => $sortDir,
      'sortBy' => $sortBy,
      'search' => $search,
      'total' => $total,
      'totalPage' => $totalPage,
      'msg' => 'List data available'
    );
    return response()->json($res, 200);
  }
  public function get(Request $request)
  {
    if ($request->id) {
      $getData = Location::find($request->id);
      $res = array(
        'status' => true,
        'data' => $getData,
        'msg' => 'Data available'
      );
    } else {
      $res = array(
        'status' => false,
        'msg' => 'No data selected'
      );
    }
    return response()->json($res, 200);
  }
  public function create(Request $request)
  {
    $dataCreate = $request->all();
    $validate = Location::validate($dataCreate);
    if ($validate['status']) {
      try {
        $dc = Location::create($dataCreate);
        $res = array(
          'status' => true,
          'msg' => 'Data Successfully Saved',
          'data' => $dataCreate
        );
      } catch (Exception $e) {
        $res = array(
          'status' => false,
          'msg' => 'Failed to Save Data',
          'data' => $dataCreate
        );
      }
    } else {
      $res = $validate;
      $res['data'] = $dataCreate;
    }
    return response()->json($res, 200);
  }
  public function update(Request $request)
  {
    $updateData = Location::find($request->id);
    $updateData->name = $request->name;
    $updateData->address = $request->address;
    $updateData->type = $request->type;
    $updateData->coordinate = $request->coordinate;
    $validate = Location::validate($request->all());
    if ($validate['status']) {
      try {
        $updateData->save();
        $res = array(
          'status' => true,
          'msg' => 'Data Successfully Saved'
        );
      } catch (Exception $e) {
        $res = array(
          'status' => false,
          'msg' => 'Failed to Save Data'
        );
      }
    } else {
      $res = $validate;
    }
    return response()->json($res, 200);
  }
  public function delete(Request $request)
  {
    if ($request->id) {
      $delData = Location::find($request->id);
      try {
        $delData->delete();
        $res = array(
          'status' => true,
          'msg' => 'Data successfully deleted'
        );
      } catch (Exception $e) {
        $res = array(
          'status' => false,
          'msg' => 'Failed to delete Data'
        );
      }
    } else {
      $res = array(
        'status' => false,
        'msg' => 'No data selected'
      );
    }
    return response()->json($res, 200);
  }
}
