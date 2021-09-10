
@extends("admin.layouts.admin")

@section("breadcrumb")
    <div class="admin-breadcrumb">
         <span class="layui-breadcrumb">
            <a href="{{ route("user.index") }}">用户列表</a>
        </span>
    </div>
@endsection
@section("content")
    <div class="layui-card-body ">
        <form class="layui-form layui-col-space5" id="search-form">
            <div class="layui-inline layui-show-xs-block">
                <input type="text" name="wxid"  placeholder="请输微信号" value="{{ request("wxid") }}" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-inline layui-show-xs-block">
                <input type="text" name="mobile"  placeholder="请输手机号" value="{{ request("mobile") }}" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-inline layui-show-xs-block">
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </div>
        </form>
    </div>
    <div class="layui-card-body ">
        <table  lay-filter="table-hide" style="display: none" lay-data="{height:'full-310', cellMinWidth: 80,toolbar: '#toolbar', limit: {{ $list->perPage() }} }">
            <thead>
            <tr>
                <th lay-data="{field:'id'}">ID</th>
                <th lay-data="{field:'wxid'}">微信号</th>
                <th lay-data="{field:'nickname'}">用户呢称</th>
                <th lay-data="{field:'mobile'}">手机号</th>
                <th lay-data="{field:'tag'}">标签</th>
                <th lay-data="{field:'group_name'}">所属经理</th>
                <th lay-data="{field:'status'}">状态</th>
                <th lay-data="{field:'is_deleted'}">被删除状态</th>
                <th lay-data="{field:'remark'}">备注</th>
                <th lay-data="{field:'create_time'}">创建时间</th>
                <th lay-data="{field:'modify', fixed: 'right', width:200, align:'center'}">操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($list as $item)
                <tr>
                    <td>{{ $item->id  }}</td>
                    <td>{{ $item->wxid }}</td>
                    <td>{{ $item->nickname }}</td>
                    <td>{{ $item->mobile }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ $item->status_name }}</td>
                    <td>{{ $item->is_deleted == 1 ? '已删除' : '未删除' }}</td>
                    <td></td>
                    <td>{{ $item->create_time }}</td>
                    <td>
                        @if(admin_user_can("user.edit"))
                            <a class="layui-btn layui-btn-xs"
                                onclick="admin.openLayerForm('{{ route("user.edit", ['user' => $item->id]) }}', '编辑', 'PATCH', '600px', '550px')">编辑</a>
                        @endif
                        @if(admin_user_can("user.destroy"))
                                <a class="layui-btn layui-btn-xs layui-btn-danger"
                                   onclick="admin.tableDataDelete('{{ route("user.destroy", ['user' => $item->id]) }}', this)">删除</a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div id="page"></div>
    </div>
@endsection

@section("script")
    <script>
      layui.use(['form', 'table'], function(){

        var table = layui.table;
        table.init("table-hide");

        table.on("tool(table-hide)", function(obj) {
          console.log(obj);
            switch (obj.event) {
              case 'edit':
                console.log(obj.data);
                break;
              case 'delete':
                console.log(obj.data);
                break;
            }
        });

        admin.paginate("{{ $list->total() }}", "{{ $list->currentPage() }}","{{ $list->perPage() }}");
      });
    </script>
@endsection
