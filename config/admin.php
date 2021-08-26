<?php

return [

    'navigation_type' => [
        'admin' => '后台系统'
    ],

    'guard_names' => [
        'admin' => '后台管理员',
    ],

    'nav_types' => [
        ['key'=>'admin', 'name'=>'系统管理', 'url'=>'/admin/admin'],
        ['key'=>'content', 'name'=>'内容管理', 'url'=>'/admin/content'],
    ],

    'system_name' => env("ADMIN_SYSTEM_NAME", "MarkCrm后台管理系统"),
];
