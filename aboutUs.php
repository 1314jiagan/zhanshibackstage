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
$sort = isset($_GET["sort"]) ? $_GET["sort"] : "";
$where = "";
if ($sort) {
    $where .= "and sort = {$sort} ";
}
if ($where) {
    $where = "where" . substr($where, 3);
}
$sql = "select * from aboutus {$where} order by id asc";
$res = query($db, $sql);
foreach ($res as $key=>$v){
    $content = $v["content"];

}
if ($sort) {
    $sql = "select b.sortname from projectcase as a left join sortclass as b on {$sort}=b.id order by b.id asc";
    $res = query($db, $sql,false);
    $sortname = $res["sortname"];
} else {
    $sortname = "关于战石";
}

?>
<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="aboutUs_banner"></div>
    <!-- banner结束 -->
    <div class="same_m clearFix">
        <div class="same_l">
            <h3>A<p>bout us <br><span>关于我们</span></p></h3>
            <!--            <div>-->
            <!--                <li><a href="">公司简介</a></li>-->
            <!--                <li><a href="">企业文化</a></li>-->
            <!--                <li><a href="">服务项目</a></li>-->
            <!--                <li><a href="">人才招聘</a></li>-->
            <!--            </div>-->
            <?php echo showList($db, "aboutUs.php", 3) ?>
        </div>
        <div class="same_r">
            <h2><?php echo $sortname; ?><span>您的位置：<a href="./index.php">首页</a> >关于我们</span></h2>
            <div class="content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>
</body>
</html>

