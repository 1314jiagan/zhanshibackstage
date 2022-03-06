

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>表单元素</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/vendor/dist/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/vendor/dist/layuiadmin/style/admin.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">

        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">添加</div>
                <div class="layui-card-body">
                    <form class="layui-form" action="" lay-filter="component-form-element">

                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">用户名：</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" lay-verify="required|name" placeholder="" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>

                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">密码：</label>
                                <div class="layui-input-inline">
                                    <input type="password" name="password" lay-verify="required|pass" placeholder="" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>

                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">真实姓名：</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="realName" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">时间：</label>
                                <div class="layui-input-inline">
                                    <input type="text" class="layui-input" id="test-laydate-normal-cn" placeholder="yyyy-MM-dd" name="time">
                                </div>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="component-form-element">立即提交</button>
                                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/dist/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/vendor/dist/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form'], function(){
        var $ = layui.$
            ,form = layui.form
            ,laydate = layui.laydate;
        laydate.render({
            elem: '#test-laydate-normal-cn'
            ,type: 'datetime'
        });
        form.verify({
           name: function(value, item){ //value：表单的值、item：表单的DOM对象
                if(!new RegExp("^[a-zA-Z0-9_\u4e00-\u9fa5\\s·]+$").test(value)){
                    return '用户名不能有特殊字符';
                }
                if(/(^\_)|(\__)|(\_+$)/.test(value)){
                    return '用户名首尾不能出现下划线\'_\'';
                }
                if(/^\d+\d+\d$/.test(value)){
                    return '用户名不能全为数字';
                }
                //如果不想自动弹出默认提示框，可以直接返回 true，这时你可以通过其他任意方式提示（v2.5.7 新增）
                if(value === '傻逼'){
                    return '用户名不能为敏感词汇';
                }
            }

            //我们既支持上述函数式的方式，也支持下述数组的形式
            //数组的两个值分别代表：[正则匹配、匹配不符时的提示文字]
            ,pass: [
                /^[\S]{6,12}$/
                ,'密码必须6到12位，且不能出现空格'
            ]
        });
        form.on('submit(component-form-element)', function(data){
            // layer.msg(data.field);
            //  console.log(data.field);
            // var data=JSON.stringify(data.field);
            $.ajax({
                url:"./save.php",
                type:"POST",
                //name=111
                data:data.field,//{name:'111'}
                dataType:"json",
                success:function (res) {
                    if (res.code==0){
                        layer.msg("添加成功",{time:1000,icon:1},function () {
                            parent.location.href="./index.php";
                        })
                    }else{
                        layer.msg(res.msg,{icon:2})
                    }
                }
            })
            return false;
        });
    });
</script>
</body>
</html>

