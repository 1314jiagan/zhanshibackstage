


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
<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$id = $_GET["id"];
$sql="select * from user where id = {$id}";
$db = conn();
$res = query($db,$sql,false);


////得到文件保存路径
//$dir= str_replace("/","\\",$_SERVER['DOCUMENT_ROOT']);
//$img_url = $dir."\\"."upload/\\".$pic;
////执行删除函数
//unlink(iconv("UTF-8","gb2312",$img_url));//转换编码 删除带中文的图片
?>

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">

        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">编辑</div>
                <div class="layui-card-body">
                    <form class="layui-form" action="" lay-filter="component-form-element">

                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">用户名：</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="<?php echo $res["name"]?>">
                                </div>
                            </div>
                        </div>

                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">密码：</label>
                                <div class="layui-input-inline">
                                    <input type="password" name="password" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>

                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">真实姓名：</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="realName" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="<?php echo $res["realname"]?>">
                                </div>
                            </div>
                        </div>


                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">时间：</label>
                                <div class="layui-input-inline">
                                    <input type="text" class="layui-input" id="test-laydate-normal-cn" placeholder="yyyy-MM-dd" name="time" value="<?php echo $res["time"]?>">
                                </div>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input type="hidden" name="id" value="<?php echo $res["id"];?>">
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

        form.on('submit(component-form-element)', function(data){
            $.ajax({
                url:"./editsave.php",
                type:"POST",
                //name=111
                data:data.field,//{name:'111'}
                dataType:"json",
                success:function (res) {
                    console.log(res)
                    if (res.code==0){
                        layer.msg("保存成功",{time:1000,icon:1},function () {
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



