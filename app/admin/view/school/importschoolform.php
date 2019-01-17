<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm" enctype="multipart/form-data">
<div class="layui-tab-item layui-show layui-form-pane">

    <div class="layui-form-item">
        <label class="layui-form-label">请导入学校excel</label>
        <div class="layui-input-inline">
            <input type="file" class="layui-input field-excelfile" name="excelfile"  placeholder="请上传文件">
        </div>
    </div>

</div>

<div class="layui-form-item">
    <div class="layui-input-block">
        <input type="hidden" class="field-id" name="id">
        <button type="submit" class="layui-btn layui-btn-normal" lay-submit="" lay-filter="formSubmit">提交</button>
        <a href="{:url('index')}" class="layui-btn layui-btn-primary ml10"><i class="aicon ai-fanhui"></i>返回</a>
    </div>
</div>
</form>
{include file="block/layui" /}
<script>
var formData = {:json_encode($data_info)};
layui.use(['form'], function() {
    var $ = layui.jquery, form = layui.form;
    /* 有BUG 待完善*/
    form.on('checkbox(roleAuth)', function(data) {
        var child = $(data.elem).parent('dt').siblings('dd').find('input');
        /* 自动选中父节点 */
        var check_parent = function (id) {
            var self = $('.role-list-form input[value="'+id+'"]');
            var pid = self.attr('data-pid') || '';
            self.prop('checked', true);
            if (pid == '') {
                return false;
            }
            check_parent(pid);
        };
        /* 自动选中子节点 */
        child.each(function(index, item) {
            item.checked = data.elem.checked;
        });
        check_parent($(data.elem).attr('data-pid'));
        form.render('checkbox');
    });

    /* 权限赋值 */
    if (formData) {
        for(var i in formData['auth']) {
            $('.role-list-form input[value="'+formData['auth'][i]+'"]').prop('checked', true);
        }
        form.render('checkbox');
    }
});
</script>
<script src="__ADMIN_JS__/footer.js"></script>