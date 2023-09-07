<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class AdminPermission extends Model {

    protected $table = 'admin_permission';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
