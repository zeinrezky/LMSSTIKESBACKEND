<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Mahasiswa extends Model
{
  protected $primaryKey = 'id_mahasiswa';
  protected $table = 'mahasiswa';
  protected $fillable = [
    'id_mahasiswa','NIM','nama','password','kelamin','tmp_lahir','tgl_lahir','telepon','hp','email','alamat','kode_pos','negara','propinsi','kota'
  ];
}
