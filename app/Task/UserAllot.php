<?php


namespace App\Task;


use App\Constant\SysConstant;
use App\Models\User\User;
use App\Models\Wx\WxGroup;
use App\Models\Wx\WxRobot;
use App\Service\OutApi\YaotiService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class UserAllot
{
    public function averageAllotByFivePolt()
    {
        $five = YaotiService::getWxRobot(YaotiService::FIVE_POLT);
        $new = YaotiService::getWxRobot(YaotiService::NEW_2021);
        $wxRobot = array_merge($new, $five);
        if(empty($wxRobot)) return;

        $wxGroups = WxGroup::query()->where('yaoti_id', '>', 0)->pluck('group_id','yaoti_id')->all();
        $userList = User::query()->whereIn('robot', $wxRobot)->get();
        foreach ($userList as $item){
            $groupId = 0;
            if ($item->phone){
                $yaotiId = YaotiService::queryYaotiUserGroup($item->phone);
                $groupId = $yaotiId && isset($wxGroups[$yaotiId]) ? $wxGroups[$yaotiId] : 0;
            }
            if (!$groupId){
                $robot = WxRobot::query()->where('wxid', $item->robot)->select(['group_id'])->first();
                if ($robot && $robot->group_id) $groupId = $robot->group_id;
            }
            if (!$groupId){
                // 暂时无法找到群的用户 分给组长
                $chief = SysConstant::NO_GROUP_CHIEF;
                $groupId = $chief[random_int(0, 2)];
            }

            //修改用户归属
            User::query()->where('id', $item->id)->update(['group_id' => $groupId, 'assign_time' => time()]);
            // 修改消息的归属
//            $this->get_repository('WxMessage')->update_groupid_by_userid($v['id'], $groupId);
//            // 修改订单的归属
//            $this->get_repository('BzOrder')->update_groupid_by_umuid($v['id'], $groupId, true);
        }
    }
}
