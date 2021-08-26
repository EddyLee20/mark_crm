<?php

namespace App\ViewComposers;


use App\Traits\NavigationTree;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class AdminComposer
{
    use NavigationTree;

    public function compose(View $view)
    {
        $path = explode('/', Request::path());
        $type = $path[1] ?? 'admin';
        $view->with("navigation", $this->permissionNavigationTree('admin', $type));
    }
}
