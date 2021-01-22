<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Media extends Model
{
  protected $primaryKey = 'id_map';
  protected $table = 'mapping_media';
}
