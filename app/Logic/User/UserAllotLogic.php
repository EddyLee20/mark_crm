<?php


namespace App\Logic\User;


use App\Models\User\User;
use App\Models\Wx\WxMessage;
use Illuminate\Support\Facades\Log;

class UserAllotLogic
{
    public static function allotUser(int $userId, int $groupId): bool
    {
        try {
            //修改用户归属
            User::query()->where('id', $userId)->update(['group_id' => $groupId, 'assign_time' => time()]);
            // 修改消息的归属
            WxMessage::query()->where([
                ['user_id', '=', $userId],
                ['group_id', '=', 0],
            ])->update(['group_id'=>$groupId]);
            // 修改订单的归属

                //            $this->get_repository('WxMessage')->update_groupid_by_userid($v['id'], $groupId);
//
//            $this->get_repository('BzOrder')->update_groupid_by_umuid($v['id'], $groupId, true);
        } catch (\Exception $e){
            Log::channel('error')->info($e->getMessage());
            return false;
        }

    }
}
