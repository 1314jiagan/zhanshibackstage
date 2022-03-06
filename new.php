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
<!--<script src="/vendor/date.js"></script>-->
<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$db = conn();
$sort = isset($_GET["sort"]) ? $_GET["sort"] : "";
$text = isset($_GET["text"]) ? $_GET["text"] : "";;
$where = "";
if ($sort) {
    $where .= "and sort = {$sort} ";
}
if ($text) {
    $where .= "and name like '%{$text}%' ";
}
if ($where) {
    $where = "where" . substr($where, 3);
}
$sql = "select count(*) as total from news {$where} order by id asc";
$res = query($db, $sql, false);
//print_r($res);
//die();
$total = $res["total"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = isset($_GET["limit"]) ? $_GET["limit"] : 8;
$start = ($page - 1) * $limit;
$pages = ceil($total/$limit);
//echo $pages;

//$sql = "select a.*,b.sortname from projectcase as a left join sortclass as b on a.sort=b.id {$where} order by a.id desc limit {$start},{$limit}";
$sql = "select * from news {$where} order by id asc limit {$start},{$limit}";
//echo $sql ;
$res = query($db, $sql);
//print_r($res);
$str = "";
foreach ($res as $key => $v) {
    $id =$v["id"];
    $name = $v["name"];
//    $time = $v["time"];
    $time = date("Y-m-d", $v["time"]);
    $str .= "    <div class='newList_detail clearFix'>
                    <a href=\"./new_detail.php?id={$id}\">{$name}</a><span>{$time}</span>
                </div>";
}
if ($sort) {
    $sql = "select b.sortname from news as a left join sortclass as b on {$sort}=b.id order by b.id asc";
    $res = query($db, $sql,false);
    $sortname = $res["sortname"];
} else {
    $sortname = "新闻资讯";
}
?>
<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="new_banner"></div>
    <!-- banner结束 -->
    <div class="same_m clearFix">
        <div class="same_l">
            <h3>N<p>ews <br><span>新闻资讯</span></p></h3>
            <?php echo showList($db, "new.php", 2) ?>
        </div>
        <div class="same_r">
            <h2><?php echo $sortname;?><span>您的位置：<a href="">首页</a> >新闻资讯 </span></h2>
            <div class="list">
<!--                <div class="newList_detail clearFix">-->
<!--                    <a href="">科技人员常州凤凰谷新一轮维护圆满结束</a><span>2017-04-10</span>-->
<!--                </div>-->
                <?php echo $str;?>
                <div class="page">
                      <?php echo pageList($page,$pages,$sort) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>


</body>
</html>



