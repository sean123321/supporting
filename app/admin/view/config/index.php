<div class="page-toolbar">
    <div class="layui-btn-group fl">
        <a href="{:url('add?group='.input('param.group'))}" class="layui-btn layui-btn-primary layui-icon layui-icon-add-circle-fine">&nbsp;添加</a>
        <a data-href="{:url('status?table=admin_config&val=1')}" class="layui-btn layui-btn-primary j-page-btns layui-icon layui-icon-play" data-table="dataTable">&nbsp;启用</a>
        <a data-href="{:url('status?table=admin_config&val=0')}" class="layui-btn layui-btn-primary j-page-btns layui-icon layui-icon-pause" data-table="dataTable">&nbsp;禁用</a>
        <a data-href="{:url('del')}" class="layui-btn layui-btn-primary j-page-btns confirm layui-icon layui-icon-close red">&nbsp;删除</a>
    </div>
</div>
<table id="dataTable"></table>
{include file="block/layui" /}
<script type="text/html" title="状态模板" id="statusTpl">
    <input type="checkbox" name="status" value="{{ d.status }}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" {{ d.status == 1 ? 'checked' : '' }} data-href="{:url('status')}?table=admin_config&id={{ d.id }}">
</script>

<script type="text/html" title="排序模板" id="sortTpl">
    <input type="text" class="layui-input j-ajax-input input-sort" onkeyup="value=value.replace(/[^\d]/g,'')" value="{{ d.sort }}" data-value="{{ d.sort }}" data-href="{:url('sort')}?table=admin_config&id={{ d.id }}">
</script>

<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="{:url('edit')}?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-normal">修改</a>
    <a href="{:url('del')}?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-danger j-tr-del">删除</a>
</script>
<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table, formType = {:json_encode(form_type())};
        table.render({
            elem: '#dataTable'
            ,url: '{:url('?group='.input('param.group'))}' //数据接口
            ,page: true //开启分页
            ,limit: 20
            ,text: {
                none : '暂无相关数据'
            }
            ,cols: [[ //表头
                {type:'checkbox'}
                ,{field: 'name', title: '标识', width: 300}
                ,{field: 'title', title: '标题', width: 260}
                ,{field: 'type', title: '类型', width: 100}
                ,{field: 'sort', title: '排序', width: 80, templet: '#sortTpl'}
                ,{field: 'status', title: '状态', width: 100, templet: '#statusTpl'}
                ,{title: '操作', width: 120, templet: '#buttonTpl'}
            ]]
        });
    });
</script>