<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => '\App\Http\Controllers\Admin', 'middleware' => ['web'], 'prefix' => 'admin'], function () {
    Route::get("login", "LoginController@loginShowForm")->name("admin.login-show-form");
    Route::post("login", "LoginController@login")->name("admin.login")->middleware('throttle:20,1');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get("/{name?}", "IndexController@index")->where('name', '[admin|content]+')->name("admin.index");
        Route::get("logout", "LoginController@logout")->name("admin.logout");
        Route::get("change-password", "ChangePasswordController@changePasswordForm")->name("admin.change-password-form");
        Route::patch("change-password", "ChangePasswordController@changePassword")->name("admin.change-password");
    });

    Route::middleware(['auth:admin','admin.permission'])->group(function () {
        //系统管理
        Route::resource('/admin/role', 'RoleController');
        Route::resource('/admin/permission', 'PermissionController');
        Route::resource('/admin/admin-user', 'AdminUserController');
        Route::resource('/admin/permission-group', 'PermissionGroupController');
        Route::resource('/admin/navigation', 'NavigationController');
        Route::get('/admin/admin-user/{id}/assign-roles', 'AdminUserController@assignRolesForm')->name('admin-user.assign-roles-form');
        Route::put('/admin/admin-user/{id}/assign-roles', 'AdminUserController@assignRoles')->name('admin-user.assign-roles');
        Route::get('/admin/role/{id}/assign-permissions', 'RoleController@assignPermissionsForm')->name('role.assign-permissions-form');
        Route::put('/admin/role/{id}/assign-permissions', 'RoleController@assignPermissions')->name('role.assign-permissions');

        //内容管理
        Route::resource('/content/user', 'UserController');
    });
});


