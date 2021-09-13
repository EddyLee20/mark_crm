<?php

namespace App\Http\Controllers\Admin;

use App\Constant\SysConstant;
use App\Http\Requests\Navigation\CreateOrUpdateRequest;
use App\Models\Admin\Navigation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class NavigationController extends AdminController
{

    public function index()
    {
        $where = request_intersect(['type', 'guard_name']);
        if (!isset($where['guard_name']) || !$where['guard_name']) {
            $where['guard_name'] = 'admin';
        }
        $nav_types = Arr::pluck(config('admin.nav_types'), 'name', 'key');

        $navigateArr = Navigation::query()
            ->where($where)
            ->orderBy('sequence')
            ->get()
            ->toArray();
        $navigateArr = array_map(function ($item) use ($nav_types){
            $item['type_name'] = $nav_types[$item['type']] ?? '';
            return $item;
        }, $navigateArr);
        $navigation = json_encode($navigateArr);

        return view("admin.navigation.index", compact("navigation"));
    }

    public function create()
    {
        $nav_icon = SysConstant::NAV_ICON;
        return view("admin.navigation.create", compact('nav_icon'));
    }

    public function store(CreateOrUpdateRequest $request)
    {
        Navigation::create($request->all());

        return $this->success();
    }

    public function edit(Navigation $navigation)
    {
        $nav_icon = SysConstant::NAV_ICON;
        return view("admin.navigation.edit", compact("navigation", 'nav_icon'));
    }

    /**
     * @param CreateOrUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CreateOrUpdateRequest $request, $id)
    {
        $navigation = Navigation::query()->findOrFail($id);

        $navigation->update($request->toArray());

        return $this->success();
    }

    public function show($id)
    {

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $navigation = Navigation::query()->findOrFail($id);

        if (Navigation::query()->where('parent_id', $navigation->id)->count()) {
            return $this->unprocesableEtity([
                'parent_id' => 'Please delete the subnavigation first.'
            ]);
        }

        $navigation->delete();

        return $this->success();
    }
}
