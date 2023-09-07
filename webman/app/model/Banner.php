<?php
namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model {

    protected $table = 'banner';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    public function banner_cate()
    {
        return $this->hasOne(\app\model\BannerCate::class, 'id', 'banner_cate_id');
    }
}
