<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    public function getAdminGroupIdsAttribute($value)
    {
        return !empty($value) ? explode(',', $value) : [];
    }

    public function setAdminGroupIdsAttribute($value)
    {
        $this->attributes['admin_group_ids'] = !empty($value) ? implode(',', $value) : '';
    }
}
