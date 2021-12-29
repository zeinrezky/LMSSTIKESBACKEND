<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Knowledge;
use App\Whatson;
use App\Campus;
use App\Announcement;

class HomeController extends Controller
{
    public function __construct()
    { }
    public function index(Request $request)
    {
        $knowledge_limit = 5;
        $whatson_limit = 5;
        $campus_directory_limit = 5;
        $campus_about_limit = 5;

        if ($request->knowledge)
            $knowledge_limit = $request->knowledge;
        if ($request->whatson)
            $whatson_limit = $request->whatson;
        if ($request->campus_directory)
            $campus_directory_limit = $request->campus_directory;
        if ($request->campus_about)
            $campus_about_limit = $request->campus_about;

        $knowledge = Knowledge::limit($knowledge_limit)->get();
        $whatson = Whatson::limit($whatson_limit)->orderBy("id_whatson", "desc")->get();
        $campus_dir = Campus::limit($campus_directory_limit)->where('type', 'DIR')->get();
        $campus_about = Campus::limit($campus_about_limit)->where('type', 'ABOUT')->get();
        $announcement = Announcement::where('status', 'ACTIVE')->get();
        $profile = $request->auth;

        $payload = array(
            'announcement' => $announcement,
            'campus_about' => $campus_about,
            'campus_directory' => $campus_dir,
            'knowledge' => $knowledge,
            'profile' => $request->auth,
            'whatson' => $whatson
        );
        $res = array(
            'status' => true,
            'code' => 200,
            'payload' => $payload,
            'msg' => 'Success'
        );
        return response()->json($res, 200);
    }
}
