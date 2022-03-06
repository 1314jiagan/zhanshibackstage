

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layuiAdmin 网站用户</title>
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
?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">名字</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" placeholder="请输入" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">类别</label>
                    <div class="layui-input-block">
                        <?php echo select_trees(23,$db,0,"sort");?>
                    </div>
                </div>
                <div class="layui-inline">
                    <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-user-front-search">
                        <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="layui-card-body">
            <div style="padding-bottom: 10px;">
                <button class="layui-btn layuiadmin-btn-useradmin" data-type="delAll">删除</button>
                <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">添加</button>
            </div>

            <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>
            <script type="text/html" id="imgTpl">
                <img style="display: inline-block; width: 50%; height: 100%;" src= {{ d.avatar }}>
            </script>
            <script type="text/html" id="table-useradmin-webuser">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="look"><i class="layui-icon layui-icon-search"></i>查看图片</a>
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del"><i class="layui-icon layui-icon-delete"></i>删除</a>
            </script>
        </div>
    </div>
</div>

<script src="/vendor/dist/layuiadmin/layui/layui.js"></script>
<script src="/vendor/date.js"></script>
<script>
    layui.config({
        base: '/vendor/dist/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'useradmin', 'table'], function(){
        var $ = layui.$
            ,form = layui.form
            ,table = layui.table;

        //监听搜索
        form.on('submit(LAY-user-front-search)', function(data){
            var field = data.field;
            // console.log(field);
            //执行重载
            table.reload('LAY-user-manage', {
                where: field
            });
        });
        //表格
        table.render({
            elem: '#LAY-user-manage'
            ,url: './list.php'
            ,height: 400
            ,cols: [[
                {type:'checkbox', fixed: 'left'}
                ,{field:'id',title: 'id', sort: true, fixed: 'left'}
                ,{field:'name',title: '名字',fixed: 'left'}
                ,{field:'sortname',title: '类别',fixed: 'left'}
                ,{field:'number',title: '浏览次数',fixed: 'left',sort: true}
                ,{field:'time',title: '发布时间',fixed: 'left',templet:function (res) {
                        return new Date(res.time * 1000).format("yyyy-MM-dd hh:mm:ss");
                    },width:170,sort: true}
                ,{field:'content',title: '内容',fixed: 'left'}
                ,{field:'pic',title: '图片',fixed: 'left',width:170,
                    templet: function (res) {
                        if (res.pic != "" && res.pic != null) {
                            return "<img src='/upload/" + res.pic + "'>";
                        } else {
                            return "无图";
                        }
                    },}
                ,{title:'操作',align:'center', fixed: 'right',width:260, toolbar: '#table-useradmin-webuser'}
            ]]
            ,page: true
            ,limit: 5
            ,limits: [5, 10, 15]
        });
        //事件
        var active = {
            delAll: function(){
                var checkStatus = table.checkStatus('LAY-user-manage')
                    ,data = checkStatus.data; //得到选中的数据
                if(data.length === 0){
                    return layer.alert('请选择数据', {
                        icon: 0,
                        skin: 'layer-ext-demo' ,
                        title:'提示'//见：扩展说明
                    })
                }
                layer.prompt({
                    formType: 1
                    ,title: '敏感操作，请输入密码'
                }, function(value, index){
                    layer.close(index);
                    if (value==1){
                        layer.confirm("确定删除这"+data.length+"行吗？",function(){
                            // console.log(data);
                            // console.log(data[0]);
                            var arr=[];
                            for(x in data){
                                arr.push(data[x].id);
                            }
                            var ids = arr.join(",");
                            $.ajax({
                                url:"./dels.php?id="+ids,
                                dataType:"json",
                                success:function (res) {
                                    if (res.code==0){
                                        layer.msg("删除成功",{time:1000,icon:1},function () {
                                            location.href="./index.php";
                                        })
                                    }else{
                                        layer.msg(res.msg,{icon:2});
                                    }
                                }
                            })
                        })
                    }else {
                        layer.msg("密码错误，删除失败",{time:1000,icon:2},function () {
                            location.href="./index.php";
                        })
                    }
                });
            }
            ,add: function(){
                layer.open({
                    type:2,content:"./add.php",area:["90%","90%"]
                });
            }
        };

        $('.layui-btn.layuiadmin-btn-useradmin').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });
        //监听行工具栏
        table.on('tool(LAY-user-manage)', function(obj){
            var data = obj.data;
            if(obj.event === 'del'){
                layer.prompt({
                    formType: 1
                    ,title: '敏感操作，请输入密码'
                }, function(value, index){
                    layer.close(index);
                    if (value==1){
                        layer.confirm("确定删除这行吗？",function(){
                            // console.log(data);
                            // console.log(data[0]);
                            $.ajax({
                                url: "./del.php?id="+data.id,
                                dataType:"json",
                                success:function (res) {
                                    if (res.code==0){
                                        layer.msg("删除成功",{time:1000,icon:1},function () {
                                                location.href="./index.php";
                                            }
                                        )
                                    }else{
                                        lay.msg(res.msg,{icon:2});
                                    }
                                }
                            })
                        })
                    }else {
                        layer.msg("密码错误，删除失败",{time:1000,icon:2},function () {
                            location.href="./index.php";
                        })
                    }
                });
            } else if(obj.event === 'edit'){
                layer.open({type:2,content:"./edit.php?id="+data.id,area:["90%","90%"]});
            }else if(obj.event === 'look'){
                // console.log(data.pic);
                layer.open({type:2,content:"/upload/"+data.pic,area:["90%","100%"],title:'查看图片',anim:4});

            }
        });
    });
</script>
</body>
</html>


