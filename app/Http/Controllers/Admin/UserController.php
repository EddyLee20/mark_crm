<?php

namespace App\Http\Controllers\Admin;

use App\Constant\UserConstant;
use App\Http\Controllers\Controller;
use App\Models\User\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $userStatus = UserConstant::USER_STATUS;
        $list = User::query()->where(request_intersect(['wxid', 'mobile']))->paginate($request->get("limit"));
        foreach ($list as $item){
            $item->status_name = $userStatus[$item->status];
        }

        return view("admin.user.index", compact('list'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $info = User::find($id);
        return view("admin.user.edit", compact('info'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
