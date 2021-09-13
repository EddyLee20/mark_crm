<?php


namespace App\Logic\User;


use App\Models\Order\BzOrder;
use App\Models\User\User;
use App\Models\User\userAllotLog;
use App\Models\Wx\WxMessage;
use Illuminate\Support\Facades\Log;

class UserAllotLogic
{
    public static function allotUser(int $userId, int $newGroupId, int $oldGroupId=0, string $action=''): bool
    {
        try {
            //修改用户归属
            User::query()->where('id', $userId)->update(['group_id' => $newGroupId, 'assign_time' => time()]);
            // 修改消息的归属
            $map = [
                ['user_id', '=', $userId],
                ['group_id', '=', 0],
            ];
            WxMessage::query()->where($map)->update(['group_id'=>$newGroupId]);
            // 修改订单的归属
            BzOrder::query()->where($map)->update(['group_id'=>$newGroupId]);
            //记录分配日志
            userAllotLog::addLog($oldGroupId, $newGroupId, $userId, $action);

            return true;
        } catch (\Exception $e){
            Log::channel('error')->info($e->getMessage());
            return false;
        }

    }
}
