<div class="layui-card-body ">
    <form class="layui-form" method="post" action="{{ route("admin-user.store") }}" id="layer-form">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">用户名</label>
            <div class="layui-input-block">
                <input type="text" name="username" required value="{{ old("username") }}"  lay-verify="required" placeholder="请输入用户名" autocomplete="off" class="layui-input input-small">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">不少于八位</div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">用户昵称</label>
            <div class="layui-input-block">
                <input type="text" name="nickname" required value="{{ old("nickname") }}"  lay-verify="required" placeholder="请输入用户昵称" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input type="text" name="mobile" required value="{{ old("mobile") }}"  lay-verify="required" placeholder="请输入手机号" autocomplete="off" class="layui-input input-small">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">部门角色</label>
            <div class="layui-input-block">
                <input type="text" name="group_id" required value="{{ old("group_id") }}"  lay-verify="group_id" placeholder="部门角色" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <input type="radio" name="status" value="1" title="启用" checked>
                <input type="radio" name="status" value="0" title="禁用">
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">用户简介</label>
            <div class="layui-input-block">
                <textarea name="intro" placeholder="请输入内容" class="layui-textarea"></textarea>
            </div>
        </div>
    </form>
</div>
