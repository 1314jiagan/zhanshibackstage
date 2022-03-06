

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
$db=conn();
$sorts = select_trees($parentid=3,$db,0,$selectname="sort");
?>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">

        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header">添加</div>
                <div class="layui-card-body">
                    <form class="layui-form" action="" lay-filter="component-form-element">
                        <div class="layui-row layui-col-space10 layui-form-item">
                            <div class="layui-col-lg6">
                                <label class="layui-form-label">名称：</label>
                                <div class="layui-input-inline">
                                    <input type="text" name="name" lay-verify="required" placeholder="" autocomplete="off" class="layui-input">
                                </div>
                            </div>
                        </div>
                        <div class="layui-form-item layui-col-space10">
                            <label class="layui-form-label">类别：</label>
                            <div class="layui-input-inline">
                                <!--                                <select name="sort" lay-filter="class">-->
                                <!--                                    <option value=""></option>-->
                                <!--                                    <option value="公司新闻">公司新闻</option>-->
                                <!--                                    <option value="行业动态">行业动态</option>-->
                                <!--                                    <option value="产品知识">产品知识</option>-->
                                <!--                                </select>-->
                                <?php echo $sorts;?>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">内容：</label>
                            <div class="layui-input-block">
                                <!-- 配置文件 -->
                                <script type="text/javascript" src="/vendor/editor/ueditor-1.4.3.3/ueditor.config.js"></script>
                                <!-- 编辑器源码文件 -->
                                <script type="text/javascript" src="/vendor/editor/ueditor-1.4.3.3/ueditor.all.min.js"></script>
                                <!-- 加载编辑器的容器 -->
                                <script id="container" name="content" type="text/plain" style="width: 700px;height:300px;"></script>
                                <!-- 实例化编辑器 -->
                                <script type="text/javascript" >
                                    var ue = UE.getEditor('container',{zIndex:100});
                                </script>
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
            ,form = layui.form;
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