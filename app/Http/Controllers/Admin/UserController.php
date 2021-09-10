<?php

namespace App\Http\Controllers\Admin;

use App\Constant\UserConstant;
use App\Http\Requests\Validate\UserRequest;
use App\Models\User\User;
use App\Service\OutApi\YaotiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class UserController extends AdminController
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $userStatus = UserConstant::USER_STATUS;
        $map = request_intersect(['wxid', 'phone']);
        array_push($map, ['status','>=', 0]);

        $list = User::query()->where($map)->paginate($request->get("limit"));
        foreach ($list as $item){
            $item->status_name = $userStatus[$item->status];
        }

        return view("admin.user.index", compact('list'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $info = User::find($id);
        $status = UserConstant::USER_STATUS;
        return view("admin.user.edit", compact('info', 'status'));
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UserRequest $request, $id)
    {
        $info = User::query()->findOrFail($id);

        $info->update($request->toArray());

        return $this->success();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $info = User::query()->findOrFail($id);

        $info->update(['status'=>-1]);

        return $this->success();
    }
}
