<?php

namespace App\Http\Controllers;

use Validator;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\Mahasiswa;
use App\Dosen;

class AuthController extends Controller
{
  private $request;

  public function __construct(Request $request)
  {
    $this->request = $request;
  }

  protected function jwt($user)
  {
    $payload = [
      'iss' => "joombaapi-jwt", // Issuer of the token
      'sub' => $user, // Subject of the token
      'iat' => time(), // Time when JWT was issued.
      'exp' => time() + 7*24*60*60 // Expiration time
    ];
    
    return JWT::encode($payload, env('JWT_SECRET'));
  }

  public function auth(Request $request) {
    $username = $request->username;
    $password = $request->password;
    $pass = false;
    if($username && $password){
      $mahasiswa = Mahasiswa::where('NIM',$username)->first();
      $dosen = Dosen::where('NIP',$username)->first();
      if($mahasiswa || $dosen){
        if($mahasiswa){
          $user = array(
            'id_user' => $mahasiswa->id_mahasiswa,
            'username' => $mahasiswa->NIM,
            'name' => $mahasiswa->nama,
            'img' => $mahasiswa->img,
            'user_code' => 'mhs'.$mahasiswa->NIM,
            'role' => 'MAHASISWA',
            'gpa' => $mahasiswa->gpa
          );
          if($password == $mahasiswa->password){
            $pass = true;
          }
        } else {
          $user = array(
            'id_user' => $dosen->id_dosen,
            'username' => $dosen->NIP,
            'name' => $dosen->nama,
            'img' => 'http://192.168.1.11:8001/storage/contents/'.$dosen->foto,
            'user_code' => 'dsn'.$dosen->NIP,
            'role' => 'DOSEN'
          );
          if($password == $dosen->password_plain || $password == $dosen->NIP){
            $pass = true;
          }
        }
        $user['token'] = $this->jwt($user);
        if($pass){
          $res = array(
            'status' => true,
            'code' => 200,
            'payload' => $user,
            'msg' => 'Login success'
          );
        } else {
          $res = array(
            'status' => false,
            'code' => 401,
            'msg' => 'Username and password combination is wrong'
          );
        }
      } else {
        $res = array(
          'status' => false,
          'code' => 404,
          'msg' => 'Account not found'
        );
      }
    } else {
      $res = array(
        'status' => false,
        'code' => 500,
        'msg' => 'Username and Password required'
      );
    }
    return response()->json($res, 200);
  }
}
