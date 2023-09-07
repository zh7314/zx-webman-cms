<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model {

    protected $table = 'seo';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
