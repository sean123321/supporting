<form class="layui-form layui-form-pane" action="{:url()}" method="post" id="editForm">
<div class="layui-tab-item layui-show layui-form-pane">
    <div class="layui-form-item">
        <label class="layui-form-label">所在学校</label>
        <div class="layui-input-inline">
            <select name="school_id" class="field-shool_id" type="select" disabled>
                {$role_option}
            </select>
        </div>
        <label class="layui-form-label">学期</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-year" name="year" lay-verify="required" autocomplete="off" placeholder="年" style="width:100%">

        </div>
        <div class="layui-input-inline" style="width: 90px">
            <input disabled type="text" class="layui-input field-semester" name="semester" lay-verify="required" autocomplete="off" placeholder="学期" style="width:100%">
        </div>
        <label class="layui-form-label">教师姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-teacher_name" name="teacher_name" lay-verify="required" autocomplete="off" placeholder="请输入教师姓名">
        </div>
        <label class="layui-form-label">教师电话</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-teacher_tel" name="teacher_tel" lay-verify="required" autocomplete="off" placeholder="请输入教师电话">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">政治面貌</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-identity" name="identity" lay-verify="required" autocomplete="off" placeholder="请输入政治面貌">
        </div>
        <label class="layui-form-label">学生姓名</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-username" name="username" lay-verify="required" autocomplete="off" placeholder="学生姓名">
        </div>
        <label class="layui-form-label">性别</label>
        <div class="layui-input-inline">
            <select name="sex" class="field-sex" type="select" disabled>
                <option value="0">男</option>
                <option value="1">女</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-ages" name="ages" lay-verify="required" autocomplete="off" placeholder="年龄">
        </div>
        <label class="layui-form-label">年级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-grade" name="grade" lay-verify="required" autocomplete="off" placeholder="年级">
        </div>
        <label class="layui-form-label">班级</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-class" name="class" lay-verify="required" autocomplete="off" placeholder="请输入班级">
        </div>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 135px">学生家庭情况</label>
    </div>
    <div class="layui-form-item" >
    {volist name="listImg" id="vo"}
        {if condition="$vo.model eq 'home_img'"}
        <div class="layui-input-inline" style="width: 300px;">
            <label class="layui-form-label" style="width:300px;height:300px"><a href="{$vo.url}" target="_blank"><img src="{$vo.url}"></a></label>
        </div>
        {/if}
    {/volist}
    </div>
    {volist name="student_link" id="vo"}
    <div class="layui-form-item studenthomelink">
        <input type="hidden" value="{$vo.id}" name="ids[]">
        <label class="layui-form-label">姓名</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-name" name="name[]" lay-verify="required" autocomplete="off" placeholder="姓名" value="{$vo.name}">
        </div>
        <label class="layui-form-label">亲属关系</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-homerelation" name="homerelation[]" lay-verify="required" autocomplete="off" placeholder="亲属关系" value="{$vo.homerelation}">
        </div>
        <label class="layui-form-label">年龄</label>
        <div class="layui-input-inline" style="width:90px">
            <input disabled type="text" class="layui-input field-birthday" name="age[]" lay-verify="required" autocomplete="off" placeholder="年龄" value="{$vo.age}">
        </div>
        <label class="layui-form-label">工作单位、务工务农地点
            或家庭所在地</label>
        <div class="layui-input-inline">
            <input disabled type="text" class="layui-input field-workaddress" name="workaddress[]" lay-verify="required" autocomplete="off" placeholder="务工务农地点
或家庭所在地" value="{$vo.workaddress}">
        </div>
        <label class="layui-form-label">联系电话</label>
        <div class="layui-input-inline" style="width:100px">
            <input disabled type="text" class="layui-input field-mobile" name="mobile[]" lay-verify="required" autocomplete="off" placeholder="联系电话" value="{$vo.mobile}">
        </div>

    </div>
    {/volist}
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 230px">学生思想行为表现和学业情况</label>
    </div>
    <div class="layui-form-item" >
        {volist name="listImg" id="vo"}
        {if condition="$vo.model eq 'student_img'"}
        <div class="layui-input-inline" style="width: 300px;">
            <label class="layui-form-label" style="width:300px;height:300px"><a href="{$vo.url}" target="_blank"><img src="{$vo.url}"></a></label>
        </div>
        {/if}
        {/volist}
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="imageandbehave" class="layui-textarea field-imageandbehave"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶计划</label>
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpplan" class="layui-textarea field-helpplan"></textarea>
    </div>
    <div class="layui-form-item" >
        <label class="layui-form-label" style="width: 200px">帮扶工作记录</label>
    </div>
    <div class="layui-form-item" >
        {volist name="listImg" id="vo"}
        {if condition="$vo.model eq 'img'"}
        <div class="layui-input-inline" style="width: 300px;">
            <label class="layui-form-label" style="width:300px;height:300px"><a href="{$vo.url}" target="_blank"><img src="{$vo.url}"></a></label>
        </div>
        {/if}
        {/volist}
    </div>
    <div class="layui-form-item" >
        <textarea disabled placeholder="请输入内容" name="helpworkmessage" class="layui-textarea field-helpworkmessage"></textarea>
    </div>
    <!--<div class="layui-form-item">
        <label class="layui-form-label">状&nbsp;&nbsp;&nbsp;&nbsp;态</label>
        <div class="layui-input-inline">
            <input type="radio" class="field-status" name="status" value="1" title="启用" checked>
            <input type="radio" class="field-status" name="status" value="0" title="禁用">
        </div>
    </div>-->
</div>

<div class="layui-form-item" style="display:none">
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
layui.use(['jquery'], function() {
    var $ = layui.jquery, input = '';
    $(document).on('click','.layui-btn-normal',function(){
        var studentHomeLinkHtml = $(this).parent('.studenthomelink').html();
        var studentHomeLink = "<div class='layui-form-item studenthomelink'>"+studentHomeLinkHtml+"</div>";
        $(this).parent('.studenthomelink').after(studentHomeLink);
    })

    $(document).on('click','.layui-btn-danger',function(){
        if($(".studenthomelink").size()>1)
            $(this).parent('.studenthomelink').remove();
    })

})
</script>
<script src="__ADMIN_JS__/footer.js"></script>