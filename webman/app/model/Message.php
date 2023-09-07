<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'message';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
