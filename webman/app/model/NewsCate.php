<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class NewsCate extends Model {

    protected $table = 'news_cate';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
