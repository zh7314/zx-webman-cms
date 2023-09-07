<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{

    protected $table = 'download';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    public function download_cate()
    {
        return $this->hasOne(\app\model\DownloadCate::class, 'id', 'download_cate_id');
    }

    public function getIntroductionAttribute($value)
    {
        return !empty($value) ? htmlspecialchars_decode($value) : '';
    }
}
