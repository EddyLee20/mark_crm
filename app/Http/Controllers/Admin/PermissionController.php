<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use App\Http\Requests\Permission\CreateOrUpdateRequest;

class PermissionController extends AdminController
{
    /**
     * @author
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $permissions =tap(Permission::latest(), function ($query) {
            $query->where(request_intersect([
                'name', 'guard_name', 'pg_id'
            ]));
        })->with('group')->paginate($request->get('limit'));

        return view("admin.permission.index",compact("permissions"));
    }

    /**
     * @author
     * @param $id
     * @return PermissionResource
     */
    public function show($id)
    {
        return new PermissionResource(Permission::query()->findOrFail($id));
    }

    public function create()
    {
        return view("admin.permission.create");
    }

    /**
     * @author
     * @param CreateOrUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateOrUpdateRequest $request)
    {
        $attributes = $request->only([
            'pg_id', 'name', 'guard_name', 'display_name', 'sequence', 'description'
        ]);

        Permission::create($attributes);

        return $this->success();
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        return view("admin.permission.edit", compact("permission"));
    }

    /**
     * @author
     * @param CreateOrUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateOrUpdateRequest $request, $id)
    {
        $permission = Permission::query()->findOrFail($id);

        $attributes = $request->only([
            'pg_id', 'name', 'guard_name', 'display_name', 'sequence', 'description'
        ]);

        $isset = Permission::query()
            ->where(['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']])
            ->where('id', '!=', $id)
            ->count();

        if ($isset) {
            throw PermissionAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        $permission->update($attributes);

        return $this->success();
    }

    /**
     * @author
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        permission::query()->findOrFail($id)->delete();

        return $this->success();
    }
}
