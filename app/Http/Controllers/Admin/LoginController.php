<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends AdminController
{
    public function loginShowForm()
    {
        return view("admin.login");
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $credentials['status'] = 1;

        if (Auth::guard("admin")->attempt($credentials)) {
            return $this->success("登录成功");
        }

        return $this->fail('账号或密码有误');
    }

    public function logout()
    {
        Auth::guard("admin")->logout();

        return redirect()->route("admin.login-show-form");
    }
}
