<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {

    protected $table = 'config';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
