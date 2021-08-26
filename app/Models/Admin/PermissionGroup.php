<?php

namespace App\Models\Admin;


use App\Models\Model;

class PermissionGroup extends Model
{
    protected $guarded = ['id'];

    public function permission()
    {
        return $this->hasMany('App\Models\Admin\Permission', 'pg_id');
    }
}
