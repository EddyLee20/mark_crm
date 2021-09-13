<?php

namespace App\Models\Admin;


use App\Traits\Common;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;

class AdminUser extends Authenticatable
{
    use  Notifiable, HasRoles, Common;

    protected $guard_name = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'phone', 'nickname', 'password', 'status', 'aid', 'group_id', 'intro'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 批量更新分配时间
     * @param array $data
     * @return bool
     */
    public static function saveAssignTime(array $data): bool
    {
        $sql = self::updateBatch($data, 'sys_admin_users', 'id', 'assgin_time');
        $res = DB::update($sql);
        return $res ? true : false;
    }
}
