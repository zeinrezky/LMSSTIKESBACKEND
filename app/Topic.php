<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Validator;

class Topic extends Model
{
  protected $primaryKey = 'id_topic';
  protected $table = 'topic';
}
