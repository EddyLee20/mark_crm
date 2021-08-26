<?php

namespace App\Models\User;

use App\Models\Model;

class User extends Model
{
    protected $table = 'user';

    protected $fillable = ['realname','mobile','group_id','remark','gender','is_deleted','status'];
}
