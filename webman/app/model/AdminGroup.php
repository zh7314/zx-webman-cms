<?php

namespace app\model;

use Illuminate\Database\Eloquent\Model;

class AdminGroup extends Model
{

    protected $table = 'admin_group';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $timestamps = false;

    public function getPermissionIdsAttribute($value)
    {
        return !empty($value) ? explode(',', $value) : [];
    }

    public function setPermissionIdsAttribute($value)
    {
        $this->attributes['permission_ids'] = !empty($value) ? implode(',', $value) : '';
    }
}
