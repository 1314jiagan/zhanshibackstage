<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>战石科技</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$db = conn();
$sql = "select * from sysset order by id asc";
$res = query($db, $sql, false);
//print_r($res);
$name = $res["name"];
$contactPhone = $res["contactphone"];
$phone = $res["phone"];
$people = $res["phone"];
$qq = $res["qq"];
$email = $res["email"];
$address = $res["address"];
?>
<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="contactUs_banner"></div>
    <!-- banner结束 -->
    <div class="same_m clearFix">
        <div class="same_l">
            <h3>C<p>ontact us <br><span>联系我们</span></p></h3>
            <ul>
                <li><a href="./contactUs.php">联系我们</a></li>
            </ul>
        </div>
        <div class="same_r">
            <h2>联系我们<span>您的位置：<a href="">首页</a> >联系我们 </span></h2>
            <div class="contactUs_list">
                <h3>联系我们</h3>
                <div class="contactUs_content">
                    <li>公司名称：<?php echo $name;?></li>
                    <li>服务热线：<?php echo $contactPhone;?></li>
                    <li>业务经理：<?php echo $people;?></li>
                    <li>技术支持：<?php echo $phone;?></li>
                    <li>联系邮箱：<?php echo $email;?></li>
                    <li>QQ：<?php echo $qq;?></li>
                    <div class="address">公司地址：<?php echo $address;?></div>
                    <?php include "map.html" ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>


</body>
</html>





