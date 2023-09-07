<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    protected $table = 'file';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
