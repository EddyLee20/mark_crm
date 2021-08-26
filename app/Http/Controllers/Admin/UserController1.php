<?php


namespace App\Http\Controllers\Admin;


use App\Constant\UserConstant;
use App\Http\Requests\Validate\UserRequest;
use App\Models\Admin\AdminUser;
use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Permission\Traits\HasRoles;

class UserController1 extends AdminController
{
    use HasRoles;

    public function index(Request $request)
    {
        $userStatus = UserConstant::USER_STATUS;
        $list = User::query()->where(request_intersect(['wxid', 'mobile']))->paginate($request->get("limit"));
        foreach ($list as $item){
            $item->status_name = $userStatus[$item->status];
        }

        return view("admin.user.index", compact('list'));
    }

    public function edit(User $info)
    {
        var_dump($info->id);exit;
        return view("admin.user.edit", compact('info'));
    }

    public function update(UserRequest $request, User $info)
    {
//        $data = $request->only([
//            'username', 'mobile', 'nickname', 'password', 'status', 'group_id', 'intro'
//        ]);
//
//        if ($request->filled('password')) {
//            $data['password'] = bcrypt($request->password);
//        }
//        $data = [];

//        $info->fill($data);
//        $info->save();

        return $this->success();
    }
}
