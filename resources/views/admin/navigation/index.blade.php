
@extends("admin.layouts.admin")

@section("breadcrumb")
    <div class="admin-breadcrumb">
         <span class="layui-breadcrumb">
            <a href="{{ route("permission-group.index") }}">导航菜单</a>
        </span>
    </div>
@endsection
@section("content")
    <div class="layui-card-body ">
        <form class="layui-form layui-col-space5" id="search-form">
{{--            <div class="layui-inline layui-show-xs-block">--}}
{{--                <input type="text" name="type"  placeholder="请输入导航类型" value="{{ request("type") }}" autocomplete="off" class="layui-input">--}}
{{--            </div>--}}
            <div class="layui-inline layui-show-xs-block">
              <select name="type">
                <option value="">请选择分类</option>
                {!! type_option_string("nav_types", request("type")) !!}
              </select>
            </div>
            <div class="layui-inline layui-show-xs-block">
              <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </div>
            <div class="layui-inline layui-show-xs-block">
                @if(admin_user_can("navigation.create"))
                    <a class="layui-btn" onclick="admin.openLayerForm('{{ route("navigation.create") }}', '添加', 'POST', '700px', '500px')"><i class="layui-icon"></i>添加</a>
                @endif
            </div>
        </form>
    </div>
    <div class="layui-card-body ">
        <table class="layui-table layui-form"  id="tree-table" lay-size="sm"></table>
    </div>
@endsection

@section("script")
    <script>
      layui.use(['form', 'table', 'treeTable'], function(){
        var table = layui.table;
        var form = layui.form;
        table.init("table-hide");

        var treeTable = layui.treeTable;
        treeTable.render({
          elem: '#tree-table',
          data: {!! $navigation !!},
          icon_key: 'name',
          parent_key: "parent_id",
          end: function(e){
            form.render();
          },
          cols: [
            {
              key: 'id',
              title: 'ID',
            },
            {
              key: 'name',
              title: '名称',
              template: function(item){
                if(item.level == 0){
                  return '<span style="color:red;">'+item.name+'</span>';
                }else if(item.level == 1){
                  return '<span style="color:green;">'+item.name+'</span>';
                }else if(item.level == 2){
                  return '<span style="color:#aaa;">'+item.name+'</span>';
                }
              }
            },
            {
              key: 'parent_id',
              title: '父级ID',
            },
            {
              key: 'uri',
              title: 'URI',
            },
            {
              key: 'permission_name',
              title: '关联权限',
              template: function (item) {
                return item.permission_name ? item.permission_name : '';
              }
            },
            {
              key: 'type_name',
              title: '菜单分类',
              align: 'center',
            },
            {
              key: 'guard_name',
              title: '权限守卫',
              align: 'center',
            },
            {
              key: 'sequence',
              title: '排序',
              align: 'center',
            },
            {
              title: '操作',
              align: 'center',
              template: function(item){
                return '@if(admin_user_can("navigation.edit"))<a class="layui-btn layui-btn-xs" lay-filter="edit">编辑</a>@endif' +
                    '@if(admin_user_can("navigation.destroy"))<a class="layui-btn layui-btn-xs layui-btn-danger" lay-filter="delete">删除</a>@endif';
              }
            }
          ]
        });

        treeTable.on('tree(delete)', function (data) {
          admin.tableDataDelete("/admin/admin/navigation/" + data.item.id, data, true);
        });

        treeTable.on('tree(edit)', function (data) {
          admin.openLayerForm("/admin/admin/navigation/" + data.item.id + "/edit", "编辑", 'PATCH', '700px', '500px');
        });
      });
    </script>
@endsection
