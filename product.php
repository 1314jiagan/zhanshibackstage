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
$text =isset($_GET["text"]) ? $_GET["text"] : "";;
$where = "";
if ($sort) {
    $where .= "and sort = {$sort} ";
}
if ($text){
    $where .= "and name like '%{$text}%' ";
}
if ($where) {
    $where = "where" . substr($where, 3);
}
$sql = "select count(*) as total from product {$where} order by id asc";
$res = query($db, $sql, false);
//print_r($res);
//die();
$total = $res["total"];
//echo $total;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = isset($_GET["limit"]) ? $_GET["limit"] : 12;
$start = ($page - 1) * $limit;
$pages = ceil($total/$limit);
//echo $start;

//$sql = "select a.*,b.sortname from projectcase as a left join sortclass as b on a.sort=b.id {$where} order by a.id desc limit {$start},{$limit}";
$sql = "select * from product {$where} order by id asc limit {$start},{$limit}";
//echo $sql ;
$res = query($db, $sql);
//print_r($res);
$str = "";
foreach ($res as $key => $v) {
    $id =$v["id"];
    $name = $v["name"];
    $content = $v["content"];
    $pic = $v["pic"] ? "<img src = '/upload/{$v["pic"]}'alt='图片不存在'>" : "";
    $str .= "<li><a href=\"./product_detail.php?id={$id}\">{$pic}<br>{$name}</a></li>";
}
if ($sort) {
    $sql = "select b.sortname from product as a left join sortclass as b on {$sort}=b.id order by b.id asc";
    $res = query($db, $sql,false);
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
            <h2> <?php echo $sortname;?><span>您的位置：<a href="">首页</a> >产品中心 </span></h2>
            <div class="list">
                <ul class="clearFix">
                    <?php echo $str;?>
                </ul>
                <div class="page">
<!--                    <a href="">1</a>-->
<!--                    <a href="">1</a>-->
<!--                    <a href="">下一页</a>-->
                    <?php echo pageList($page,$pages,$sort);?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>
</body>
</html>



