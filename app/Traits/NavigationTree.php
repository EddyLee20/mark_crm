<?php

namespace App\Traits;


use App\Models\Admin\Navigation;
use Illuminate\Support\Facades\Auth;

trait NavigationTree
{
    /**
     * @param string $guardName
     * @param string $type
     * @return array
     */
    protected function permissionNavigationTree($guardName = 'admin', $type = 'admin')
    {
        $userPermissions = Auth::guard($guardName)->user()->getAllPermissions()->pluck('name');
        $items = Navigation::query()
            ->where('guard_name', $guardName)
            ->where("type", $type)
            ->orderBy('sequence')
            ->get()
            ->filter(function ($item) use ($userPermissions) {
                return !$item->permission_name || $userPermissions->contains($item->permission_name);
            });

        return make_tree($items->toArray());
    }

    /**
     * @param string $type
     * @return array
     */
    protected function navigationTree($type = 'admin')
    {
        $items = Navigation::query()
            ->where("type", $type)
            ->orderBy('sequence', 'desc')
            ->get();

        return make_tree($items->toArray());
    }
}
