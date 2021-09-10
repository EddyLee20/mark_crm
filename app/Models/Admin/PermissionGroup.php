<?php

namespace App\Models\Admin;


use App\Models\Model;

class PermissionGroup extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $guarded = ['id'];

    public function permission()
    {
        return $this->hasMany('App\Models\Admin\Permission', 'pg_id');
    }
}
