<?php

namespace App\Models\Admin;


class Permission extends \Spatie\Permission\Models\Permission
{
    public function group()
    {
        return $this->belongsTo(PermissionGroup::class, 'pg_id');
    }
}
