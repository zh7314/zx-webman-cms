<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class AdminLog extends Model {

    protected $table = 'admin_log';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
