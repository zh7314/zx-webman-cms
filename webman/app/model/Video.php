<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $table = 'video';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    public function video_cate()
    {
        return $this->hasOne(\app\model\VideoCate::class, 'id', 'video_cate_id');
    }

    public function getIntroduceAttribute($value)
    {
        return !empty($value) ? htmlspecialchars_decode($value) : '';
    }
}
