<div class="page-toolbar">
    <div class="page-filter fr">
        <form class="layui-form layui-form-pane" action="{:url()}" method="get" id="hisi-table-search">
            <div class="layui-form-item">
                <label class="layui-form-label">搜索</label>
                <div class="layui-input-inline">
                    <input type="text" name="keyword" lay-verify="required" placeholder="输入关键词，按回车搜索" class="layui-input">
                </div>
            </div>
        </form>
    </div>
    <div class="layui-btn-group fl">
        <a href="{:url('addStudent')}" class="layui-btn layui-btn-primary layui-icon layui-icon-add-circle-fine">&nbsp;添加</a>
        <a data-href="{:url('delStudent')}" class="layui-btn layui-btn-primary j-page-btns confirm layui-icon layui-icon-close red">&nbsp;删除</a>
    </div>
</div>
<table id="dataTable"></table>
{include file="block/layui" /}
<script type="text/html" id="statusTpl">
    <input type="checkbox" name="status" value="{{ d.status }}" lay-skin="switch" lay-filter="switchStatus" lay-text="正常|关闭" {{ d.status == 1 ? 'checked' : '' }} data-href="{:url('status')}?table=admin_user&id={{ d.id }}">
</script>
<script type="text/html" title="操作按钮模板" id="buttonTpl">
    <a href="{:url('showStudent')}?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-normal">查看</a>
    <a href="{:url('editStudent')}?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-normal">修改</a>
    <a href="{:url('delStudent')}?id={{ d.id }}" class="layui-btn layui-btn-xs layui-btn-danger j-tr-del">删除</a>
</script>
<script type="text/javascript">
    layui.use(['table'], function() {
        var table = layui.table;
        table.render({
            elem: '#dataTable'
            ,url: '{:url()}' //数据接口
            ,page: true //开启分页
            ,limit: 20
            ,text: {
                none : '暂无相关数据'
            }
            ,cols: [[ //表头
                {type:'checkbox'}
                ,{field: 'school_id', title: '学校', templet:function(d){
                    return d.school.title;
                }}
                ,{field: 'teacher_name', title: '教师'}
                ,{field: 'username', title: '学生'}
                ,{field: 'sex', title: '性别',templet:function(d){
                    if(d.sex == 0){
                        return "男";
                    }
                    return "女";
                }}
                ,{field: 'grade', title: '年级'}
                ,{field: 'class', width: 150, title: '班级'}
                ,{title: '操作', templet: '#buttonTpl'}
            ]]
        });
    });
</script>
