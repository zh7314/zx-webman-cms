<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model {

    protected $table = 'platform';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
