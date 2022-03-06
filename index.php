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
$sql = "select count(*) as total from solution order by id asc";
$res = query($db, $sql, false);
//print_r($res);
//die();
$total = $res["total"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = isset($_GET["limit"]) ? $_GET["limit"] : 8;
$start = ($page - 1) * $limit;
$sql = "select * from solution order by id asc limit {$start},{$limit}";
//echo $sql ;
//die();
$res = query($db, $sql);
//print_r($res);
$str = "";
foreach ($res as $key=>$v) {
    $id =$v["id"];
    $name = $v["name"];
    $str .= " <li><a href=\"./solution_detail.php?id={$id}\">•  {$name}</a></li>";
}
$sql = "select * from aboutus where sort = 7 order by id asc";
//echo $sql;
//die();
$res = query($db, $sql);
foreach ($res as $key=>$v){
    $aboutUs_content = $v["content"];
}
$sql = "select * from sysset order by id asc";
$res = query($db, $sql, false);
//print_r($res);
$phone = $res["phone"];
$qq = $res["qq"];
$email = $res["email"];
$address = $res["address"];
$sql = "select count(*) as total from projectcase order by id asc";
$res = query($db, $sql, false);
//print_r($res);
//die();
$total = $res["total"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = isset($_GET["limit"]) ? $_GET["limit"] : 4;
$start = ($page - 1) * $limit;
$sql = "select * from projectcase order by id asc limit {$start},{$limit}";
//echo $sql ;
//die();
//echo $sql ;
$res = query($db, $sql);
//print_r($res);
$caseCenter_str = "";
foreach ($res as $key=>$v) {
    $id = $v["id"];
    $name =$v["name"];
    $pic = $v["pic"] ? "<img src = '/upload/{$v["pic"]}'alt='图片不存在'>" : "";
    $caseCenter_str .= "
                <li style=\"font-size: 0\">
                    <a href=\"./caseCenter_detail.php?id={$id}\">
                         {$pic}<span>{$name}</span>
                    </a>
                </li>";
}

$sql = "select count(*) as total from news order by id asc";
$res = query($db, $sql, false);
//print_r($res);
//die();
$total = $res["total"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = isset($_GET["limit"]) ? $_GET["limit"] : 6;
$start = ($page - 1) * $limit;
$sql = "select * from news where sort = 11 order by id asc limit {$start},{$limit}";
//echo $sql;
$res = query($db, $sql);
$news = "";
foreach ($res as $v) {
    $id = $v["id"];
    $name = $v["name"];
    $news .="<li><a href=\"new_detail.php?id={$id}\">•  {$name}</a></li>";
}
$sql = "select * from news where sort = 10 order by id asc limit {$start},{$limit}";
//echo $sql;
$res = query($db, $sql);
$industry = "";
foreach ($res as $v) {
    $id = $v["id"];
    $name = $v["name"];
    $industry .="<li><a href=\"new_detail.php?id={$id}\">•  {$name}</a></li>";
}
$sql = "select * from news where sort = 19 order by id asc limit {$start},{$limit}";
//echo $sql;
$res = query($db, $sql);
$product = "";
foreach ($res as $v) {
    $id = $v["id"];
    $name = $v["name"];
    $product.="<li><a href=\"new_detail.php?id={$id}\">•  {$name}</a></li>";
}
?>
<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="banner">
        <?php include "banner.html"?>
    </div>
    <!-- banner结束 -->
    <div class="first clearFix">
        <div class="first_left">
            <div class="solution_top">
                解决方案
                <a href="./solution.php">MORE+</a>
            </div>
            <div class="solution_bottom">
                <ul>
                    <?php echo $str;?>
                </ul>
            </div>
        </div>
        <div class="aboutUs">
            <div class="aboutUs_top special clearFix">
                <div>ABOUT US <span>关于我们</span></div>
                <a href="./aboutUs.php?sort=7">MORE+</a>
            </div>
            <div class="aboutUs_bottom">
                <div class="pic"><img src="images/aboutus.jpg" alt=""></div>
                <div class="content"><?php echo $aboutUs_content;?>
                </div>
            </div>
        </div>
        <div class="contactUs">
            <div class="contactUs_top special clearFix">
                <div>CONTACT US<span>联系我们</span></div>
            </div>
            <div class="contactUs_bottom">
                <div class="pic"><img src="images/contactUs.jpg" alt=""></div>
                <div class="content">
                    <span>QQ：<?php echo $qq;?></span>
                    <span>业务经理：<?php echo $phone;?></span>
                    <span>联系邮箱：<?php echo $email;?></span>
                    <span>地址：<?php echo $address;?></span>
                </div>
            </div>
        </div>
    </div>
    <div class="second clearFix">
        <div class="caseCenter_top special clearFix">
            <div>CASE CENTER <span>案例中心</span></div>
            <a href="./caseCenter.php">MORE+</a>
        </div>
        <div class="content">
            <ul>
                <?php echo $caseCenter_str; ?>
            </ul>
        </div>
    </div>
    <div class="third clearFix">
        <div class="same">
            <div class="special clearFix">
                <div>NEWS<span>公司新闻</span></div>
                <a href="./new.php?sort=11">MORE+</a>
            </div>
            <div class="content">
                <ul>
                    <?php echo $news?>
                </ul>
            </div>
        </div>

        <div class="same">
            <div class="special clearFix">
                <div>INDUSTRY<span>行业动态</span></div>
                <a href="./new.php?sort=10">MORE+</a>
            </div>
            <div class="content">
                <ul>
                    <?php echo $industry?>
                </ul>
            </div>
        </div>

        <div class="same">
            <div class="special clearFix">
                <div>PRODUCT<span>产品知识</span></div>
                <a href="./new.php?sort=19">MORE+</a>
            </div>
            <div class="content">
                <ul>
                    <?php echo $product?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>
</body>
</html>
