<?php

namespace App\Models\Admin;

use App\Models\Model;

class Navigation extends Model
{
    protected $table = 'navigation';

    protected $fillable = ['parent_id', 'name', 'icon', 'uri', 'is_link', 'guard_name', 'type', 'permission_name', 'sequence'];
}
