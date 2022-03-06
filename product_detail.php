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
$id = $_GET["id"];
$sql = "select * from product where id = {$id}";
$res = query($db, $sql, false);
//print_r($res);
$sort = $res["sort"];
$name = $res["name"];
$content = $res["content"];
$pic = $res["pic"] ? "<img src = '/upload/{$res["pic"]}'alt='图片不存在'>" : "";
if ($sort) {
    $sql = "select b.sortname from product as a left join sortclass as b on {$sort}=b.id order by b.id asc";
    $res = query($db, $sql, false);
    $sortname = $res["sortname"];
} else {
    $sortname = "产品中心";
}
?>
<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="product_banner"></div>
    <!-- banner结束 -->
    <div class="same_m clearFix">
        <div class="same_l">
            <h3>P<p>roduct <br><span>产品中心</span></p></h3>
            <?php echo showList($db, "product.php", 4) ?>
        </div>
        <div class="same_r">
            <h2><?php echo $sortname?><span>您的位置：<a href="">首页</a> >产品中心 </span></h2>
            <div class="product_list">
                <h3 class="product_title"><?php echo $name?></h3>
               <div class="img"><?php echo $pic?></div>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>


</body>
</html>




