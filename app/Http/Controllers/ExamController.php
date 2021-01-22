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
      $data = Exam::where('id_schedule',$schedule)->get();
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
