<?php


namespace App\Models\User;


use App\Models\Model;

class userAllotLog extends Model
{
    protected $table = 'user_allot_log';

    protected $guarded = [];

    /**
     * 写入分配记录
     * @param int $oldGroupId
     * @param int $newGroupId
     * @param int $userId
     * @param string $action
     * @return bool
     */
    public static function addLog(int $oldGroupId, int $newGroupId, int $userId, string $action): bool
    {
        $data = [
            'old_group_id' => $oldGroupId,
            'new_group_id' => $newGroupId,
            'user_id' => $userId,
            'action' => addslashes($action),
        ];

        return self::query()->insert($data);
    }
}
