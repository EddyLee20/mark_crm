<div class="layui-card-body ">
    <form class="layui-form" method="post" action="{{ route("admin-user.update", ['admin_user' => $adminUser->id]) }}" id="layer-form">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="username" required value="{{ $adminUser->username }}"  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input input-small">
            </div>
        </div>
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">密码框</label>--}}
{{--            <div class="layui-input-inline">--}}
{{--                <input type="password" name="password"  placeholder="请输入密码" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--            <div class="layui-form-mid layui-word-aux">不少于八位</div>--}}
{{--        </div>--}}
        <div class="layui-form-item">
            <label class="layui-form-label">用户昵称</label>
            <div class="layui-input-block">
                <input type="text" name="nickname" required value="{{ $adminUser->nickname }}"  lay-verify="required" placeholder="请输入用户昵称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input type="text" name="mobile" required value="{{ $adminUser->mobile }}"  lay-verify="required" placeholder="请输入手机号" autocomplete="off" class="layui-input input-small">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">部门角色</label>
            <div class="layui-input-block">
                <input type="text" name="group_id" required value="{{ $adminUser->group_id }}"  lay-verify="group_id" placeholder="部门角色" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用" {{ $adminUser->status == 1 ? "checked" : '' }}>
                <input type="radio" name="status" value="0" title="禁用" {{ $adminUser->status == 0 ? "checked" : '' }}>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">用户简介</label>
            <div class="layui-input-block">
                <textarea name="intro" placeholder="请输入内容" class="layui-textarea">{{ $adminUser->intro }}</textarea>
            </div>
        </div>
    </form>
</div>
