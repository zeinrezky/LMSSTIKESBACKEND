<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Thread extends Model
{
  protected $primaryKey = 'id_thread';
  protected $table = 'thread';
  protected $fillable = [
    'id_thread','id_poster','id_session','id_parent','id_reply_to','title','content','date_post','status','type','quote','role'
  ];
  public $timestamps = false;
  
  public static function validate($validate)
  {
    if(isset($validate['id_thread'])){
      $rule = [
        'title' => 'required',
        'content' => 'required',
      ];
    } else {
      $rule = [
        'id_poster' => 'required',
        'id_session' => 'required',
        'title' => 'required',
        'content' => 'required',
      ];
    }
    $validator = Validator::make($validate, $rule);
    if ($validator->fails()) {
      $errors =  $validator->errors()->all();
      $res = array(
      'status' => false,
      'error' => $errors,
      'msg' => 'Error on Validation'
      );
    } else {
      $res = array(
      'status' => true,
      'msg' => 'Validation Ok'
      );
    }
    return $res;
  }
}
