

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
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-form layui-card-header layuiadmin-card-header-auto">
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">用户名：</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">真实名字：</label>
                    <div class="layui-input-block">
                        <input type="text" name="realName" placeholder="请输入真实姓名" autocomplete="off" class="layui-input">
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
                <button class="layui-btn layuiadmin-btn-useradmin" data-type="add">注册</button>
            </div>

            <table id="LAY-user-manage" lay-filter="LAY-user-manage"></table>
            <script type="text/html" id="imgTpl">
                <img style="display: inline-block; width: 50%; height: 100%;" src= {{ d.avatar }}>
            </script>
            <script type="text/html" id="table-useradmin-webuser">
                <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"><i class="layui-icon layui-icon-edit"></i>更改信息</a>
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
            ,table = layui.table
            ,laydate = layui.laydate;

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
                ,{field:'name',title: '用户名',fixed: 'left'}
                ,{field:'password',title: '密码',fixed: 'left'}
                ,{field:'realname',title: '真实姓名',fixed: 'left'}
                ,{field:'time',title: '发布时间',fixed: 'left',width:170,sort: true}
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



