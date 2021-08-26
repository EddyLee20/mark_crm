<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUser\CreateOrUpdateRequest;
use App\Models\Admin\AdminUser;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class AdminUserController extends AdminController
{
    use HasRoles;
    /**
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $adminUsers = AdminUser::query()->where(request_intersect(['username', 'mobile']))->paginate($request->get("limit"));

        return view("admin.admin_user.index", compact('adminUsers'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view("admin.admin_user.create");
    }

    /**
     * @param CreateOrUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOrUpdateRequest $request)
    {
        $data = $request->only([
            'username', 'mobile', 'nickname', 'password', 'status', 'group_id', 'intro'
        ]);
        $data['password'] = bcrypt($data['password']);
        $data['aid'] = Auth::id();

        AdminUser::create($data);

        return $this->success();
    }

    /**
     * @param AdminUser $adminUser
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(AdminUser $adminUser)
    {
        return view("admin.admin_user.edit", compact('adminUser'));
    }

    /**
     * @author
     * @param CreateOrUpdateRequest $request
     * @param AdminUser $adminUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateOrUpdateRequest $request, AdminUser $adminUser)
    {
        $data = $request->only([
            'username', 'mobile', 'nickname', 'password', 'status', 'group_id', 'intro'
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $adminUser->fill($data);
        $adminUser->save();

        return $this->success();
    }

    /**
     * @author
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $adminUser = AdminUser::query()->findOrFail($id);

        $adminUser->delete();

        return $this->success();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function assignRolesForm($id)
    {
        $adminUser = AdminUser::query()->findOrFail($id);
        $roles = Role::query()->where("guard_name", "admin")->get();
        $userRoles = $adminUser->getRoleNames();

        return view("admin.admin_user.assign_role", compact("roles", "adminUser", "userRoles"));
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignRoles(Request $request, $id)
    {
        AdminUser::query()->findOrFail($id)->syncRoles($request->input('roles', []));

        return $this->success();
    }
}
