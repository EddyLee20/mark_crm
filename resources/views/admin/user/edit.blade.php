<div class="layui-card-body">
    <form class="layui-form" method="post" action="{{ route("user.update", ['user' => $info->id]) }}" id="layer-form">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">所属机器微信号</label>
            <div class="layui-input-block">
                <input type="text" name="robot" required readonly value="{{ $info->robot }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">微信号</label>
            <div class="layui-input-block">
                <input type="text" name="wxid" required readonly value="{{ $info->wxid }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">微信号</label>
            <div class="layui-input-block">
                <input type="text" name="nickname" required readonly value="{{ $info->nickname }}" class="layui-input">
            </div>
        </div>
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">上级菜单ID</label>--}}
{{--            <div class="layui-input-block">--}}
{{--                <input type="text" name="parent_id" required value="{{ $navigation->parent_id }}"  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">URI</label>--}}
{{--            <div class="layui-input-block">--}}
{{--                <input type="text" name="uri" required value="{{ $navigation->uri }}"  lay-verify="required" placeholder="请输入导航链接" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">Guard</label>--}}
{{--            <div class="layui-input-block">--}}
{{--                <select name="guard_name" lay-verify="required">--}}
{{--                    <option value=""></option>--}}
{{--                    {!! admin_enum_option_string("guard_names", $navigation->guard_name) !!}--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">导航类型</label>--}}
{{--            <div class="layui-input-block">--}}
{{--                <input type="text" name="type" required value="{{ $navigation->type }}"  lay-verify="required" placeholder="请输入导航类型" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">关联权限</label>--}}
{{--            <div class="layui-input-block">--}}
{{--                <input type="text" name="permission_name" required value="{{ $navigation->permission_name }}"  lay-verify="required" placeholder="请输入关联权限" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">icon</label>--}}
{{--            <div class="layui-input-block">--}}
{{--                <input type="text" name="icon" required value="{{ $navigation->icon }}"  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="layui-form-item">--}}
{{--            <label class="layui-form-label">排序</label>--}}
{{--            <div class="layui-input-block">--}}
{{--                <input type="text" name="sequence" required value="{{ $navigation->sequence }}"  lay-verify="required" placeholder="" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
{{--        </div>--}}
    </form>
</div>
