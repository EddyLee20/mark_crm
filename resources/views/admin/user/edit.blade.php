<div class="layui-card-body">
    <form class="layui-form" method="post" action="{{ route("user.update", ['user' => $info->id]) }}" id="layer-form">
        @csrf
        <div class="layui-form-item">
            <label class="layui-form-label">机器微信号</label>
            <div class="layui-input-block">
                <input type="text" name="robot" disabled value="{{ $info->robot }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">微信号</label>
            <div class="layui-input-block">
                <input type="text" name="wxid" disabled value="{{ $info->wxid }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">微信昵称</label>
            <div class="layui-input-block">
                <input type="text" name="nickname" disabled value="{{ $info->nickname }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-block">
                <input type="text" name="mobile" value="{{ $info->mobile }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">真实姓名</label>
            <div class="layui-input-block">
                <input type="text" name="realname" value="{{ $info->realname }}" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-block">
                <input type="radio" name="gender" value="1" title="男" {{ $info->gender == 1 ? "checked" : '' }}>
                <input type="radio" name="gender" value="2" title="女" {{ $info->gender == 2 ? "checked" : '' }}>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">所属帐号</label>
            <div class="layui-input-block">
                <select name="group_id" lay-verify="required">
                    <option value="0" selected>未分配客服</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-block">
                <select name="city" lay-verify="required">
                    @foreach ($status as $k=>$v)
                        <option value="{{ $k }}" {{ $info->status == $k ? "selected" : ''}}>{{ $v }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">被删除状态</label>
            <div class="layui-input-block">
                <input type="radio" name="is_deleted" value="0" title="未删除" {{ $info->gender == 0 ? "checked" : '' }}>
                <input type="radio" name="is_deleted" value="1" title="已删除" {{ $info->gender == 1 ? "checked" : '' }}>
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <textarea name="remark" placeholder="请输入内容" class="layui-textarea">{{ $info->remark }}</textarea>
            </div>
        </div>
    </form>
</div>
