<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class BannerCate extends Model {

    protected $table = 'banner_cate';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
