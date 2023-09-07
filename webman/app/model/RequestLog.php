<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model {

    protected $table = 'request_log';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
