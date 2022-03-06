<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>战石科技</title>
    <link rel="stylesheet" href="index.css">
    <script src="vendor/jQuery/jquery-3.6.0.min.js"></script>
</head>
<body>
<script src="vendor/layer-v3.5.1/layer/layer.js"></script>
<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$db = conn();
?>
<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="message_banner"></div>
    <!-- banner结束 -->
    <div class="same_m clearFix">
        <div class="same_l">
            <h3>M<p> essage<br><span>在线留言</span></p></h3>
            <ul>
                <li><a href="./message.php">在线留言</a></li>
            </ul>
        </div>
        <div class="same_r">
            <h2>在线留言<span>您的位置：<a href="">首页</a> >在线留言 </span></h2>
            <form class="message_list" method="post" action="messageSave.php">
                <h3>您的详细信息:</h3>
                <ul class="clearFix first">
                    <li><input type="text" placeholder="你的名字" name="name"><span></span></li>
                    <li><input type="text" placeholder="联系电话" name="tel"><span></span></li>
                    <li><input type="text" placeholder="电子邮件" name="email"></li>
                    <li><input type="text" placeholder="qq" name="qq"></li>
                </ul>
                <h3>您的留言内容:</h3>
                <ul class="content">
                    <li class="title"><input type="text" placeholder="留言标题" name="title"></li>
                    <li class="content"><input type="text" placeholder="留言内容" name="content"></li>
                </ul>
                <ul class="submit">
                    <li class="submit"><input type="submit" value="提交"></li>
                </ul>
            </form>
        </div>
    </div>
</div>
<div class=" color"></div>
<?php include "bottom.php" ?>
<script>
    $(function () {
        $("input[value='提交']").click(function (data) {
            let name = $("input[name='name']").val();
            if (name == '') {
                layer.msg('名字不能为空',{time:1000,icon:0});
                $("input[name='name']").focus(); //聚焦
                return false;
            }
            let tel = $("input[name='tel']").val();
            if (tel == '') {
                layer.msg('电话不能为空',{time:1000,icon:0});
                $("input[name='tel']").focus(); //聚焦
                return false;
            } else {
                let phone = /^1[3|4|5|7|8]\d{9}$/;
                if (phone.test(tel) == false) {
                    layer.msg('电话格式不正确',{time:1000,icon:0});
                    $("input[name='tel']").focus(); //聚焦
                    return false;
                }
            }
            let e = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
            let email = $("input[name='email']").val();
            if (e.test(email) == false) {
                layer.msg('邮箱格式错误',{time:1000,icon:0});
                $("input[name='email']").focus(); //聚焦
                return false;
            }
            let title = $("input[name='title']").val();
            // alert(title);
            if (title == '') {
                layer.msg('标题不能为空',{time:1000,icon:0});
                $("input[name='title']").focus();
                return false;
            }
            let content = $("input[name='content']").val();
            if (content == '') {
                layer.msg('内容不能为空',{time:1000,icon:0});
                $("input[name='content']").focus();
                return false;
            }
        })
    })
</script>

</body>
</html>






