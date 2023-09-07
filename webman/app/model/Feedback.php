<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model {

    protected $table = 'feedback';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
