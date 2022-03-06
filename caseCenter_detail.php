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
$sql = "select * from projectcase where id = {$id}";
$res = query($db, $sql, false);
//print_r($res);
$sort = $res["sort"];
$name = $res["name"];
$content = $res["content"];
$pic = $res["pic"] ? "<img src = '/upload/{$res["pic"]}'alt='图片不存在'>" : "";
if ($sort) {
    $sql = "select b.sortname from projectcase as a left join sortclass as b on {$sort}=b.id order by b.id asc";
    $res = query($db, $sql, false);
    $sortname = $res["sortname"];
} else {
    $sortname = "案例中心";
}

?>

<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="caseCenter_banner"></div>
    <!-- banner结束 -->
    <div class="same_m clearFix">
        <div class="same_l">
            <h3>C<p>ase center <br><span>案例中心</span></p></h3>
            <!--            <div>-->
            <!--                <li><a href="">高清小间距</a></li>-->
            <!--                <li><a href="">体育行业LED</a></li>-->
            <!--                <li><a href="">城市综合体LED</a></li>-->
            <!--                <li><a href="">照明系列</a></li>-->
            <!--            </div>-->
            <?php echo showList($db, "caseCenter.php", 12) ?>
        </div>
        <div class="same_r">
            <h2> <?php echo $sortname; ?><span>您的位置：<a href="">首页</a> >案例中心 </span></h2>
            <div class="list">
                <div class="caseCenter_detail clearFix">
                    <h6><?php echo $name; ?></h6>
                    <?php echo $pic; ?>
                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>
</body>
</html>



