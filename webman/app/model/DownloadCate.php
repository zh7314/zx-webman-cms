<?php 
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class DownloadCate extends Model {

    protected $table = 'download_cate';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

}
