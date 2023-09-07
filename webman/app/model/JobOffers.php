<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class JobOffers extends Model
{

    protected $table = 'job_offers';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    public function getContentAttribute($value)
    {
        return !empty($value) ? htmlspecialchars_decode($value) : '';
    }
}
