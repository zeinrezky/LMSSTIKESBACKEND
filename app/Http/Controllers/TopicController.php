<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Session;
use App\Topic;
use App\Media;
use Illuminate\Support\Facades\Storage;

class TopicController extends Controller
{
	public function __construct()
	{

	}
	public function list(Request $request){
    $user = null;
    if($request->auth)
      $user = $request->auth;
    $session = $request->id_session;
    if($session){
      $data = array(
        array(
          'id' => 1,
          'id_session' => $session,
          'name' => 'Introduction Array',
          'subtitle' => 'Main Material',
          'desc' => 'Introduction Array Topic description here',
          'attachment' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf',
          'link' => 'https://www.youtube.com/watch?v=pDSz3sWnPRw'
        ),
        array(
          'id' => 2,
          'id_session' => $session,
          'name' => 'Accessing Array',
          'subtitle' => 'Sub Topic',
          'desc' => 'Accessing Array Topic description here',
          'attachment' => 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'
        ),
        array(
          'id' => 3,
          'id_session' => $session,
          'name' => 'Numeric Data Type',
          'subtitle' => 'Supporting Material',
          'desc' => 'Numeric Data Type Topic description here',
          'link' => 'https://www.youtube.com/watch?v=pDSz3sWnPRw'
        )
      );
      $data = [];
      $sess = Session::find($session);
      $topic = Topic::where('id_topic',$sess->id_topic)->get();
      foreach($topic as $top){
        $media = Media::select('mapping_media.*','mm.keterangan','mm.jns_media','mm.file_media')
                ->where('id_topic',$top->id_topic)
                ->leftJoin('media_materi as mm','mm.id_media','mapping_media.id_media')
                ->get();
        $dtTop = array(
          'id' => $top->id_topic,
          'id_session' => $session,
          'name' => $top->topic,
          'subtitle' => $top->sub_topic,
          'desc' => $top->topic.'-'.$top->sub_topic,
          'lecturer_notes' => $top->reviewer_commen
        );
        foreach($media as $m){
          if($m->jns_media == 'LINK')
            $dtTop['link'] = $m->url_media;
          if($m->jns_media == 'UPLOAD')
            $dtTop['attachment'] = $m->file_media;
        }
        array_push($data,$dtTop);
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
}
