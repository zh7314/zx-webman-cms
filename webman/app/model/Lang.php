<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model {

    protected $table = 'lang';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
