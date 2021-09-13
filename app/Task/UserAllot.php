<?php


namespace App\Task;


use App\Constant\SysConstant;
use App\Logic\User\UserAllotLogic;
use App\Models\Admin\AdminUser;
use App\Models\User\User;
use App\Models\Wx\WxGroup;
use App\Models\Wx\WxRobot;
use App\Service\OutApi\YaotiService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UserAllot
{
    /**
     * 新接口用户分配
     */
    public function averageAllotByFivePolt()
    {
        try {
            $five = YaotiService::getWxRobot(YaotiService::FIVE_POLT);
            $new = YaotiService::getWxRobot(YaotiService::NEW_2021);
            $wxRobot = array_merge($new, $five);
            if (empty($wxRobot)) return;

            $wxGroups = WxGroup::query()->where('yaoti_id', '>', 0)->pluck('group_id', 'yaoti_id')->all();
            $userList = User::query()->whereIn('robot', $wxRobot)->get();
            $assign_time = [];
            foreach ($userList as $item) {
                $groupId = 0;
                if ($item->phone) {
                    $yaotiId = YaotiService::queryYaotiUserGroup($item->phone);
                    $groupId = $yaotiId && isset($wxGroups[$yaotiId]) ? $wxGroups[$yaotiId] : 0;
                }
                if (!$groupId) {
                    $robot = WxRobot::query()->where('wxid', $item->robot)->select(['group_id'])->first();
                    if ($robot && $robot->group_id) $groupId = $robot->group_id;
                }
                if (!$groupId) {
                    // 暂时无法找到群的用户 分给组长
                    $chief = SysConstant::NO_GROUP_CHIEF;
                    $groupId = $chief[random_int(0, 2)];
                }

                //执行分配
                $allot = UserAllotLogic::allotUser($item['id'], $groupId, $item['group_id'], 'allot:fivepolt');
                if ($allot) $assign_time[$groupId] = intval(microtime(true) * 1000);
            }

            //更新分配时间
            if ($assign_time) {
                AdminUser::saveAssignTime($assign_time);
            }

            echo date("Y-m-d H:i:s") . " averageAllotByFivePolt done \r\n";
        }catch (\Exception $e){
            Log::channel('error')->info($e->getMessage());
        }
    }
}
