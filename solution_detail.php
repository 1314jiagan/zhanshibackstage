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
$sql = "select * from solution where id = {$id}";
$res = query($db, $sql, false);
//print_r($res);
$sort = $res["sort"];
$name = $res["name"];
$content = $res["content"];
$pic = $res["pic"] ? "<img src = '/upload/{$res["pic"]}'alt='图片不存在'>" : "";
if ($sort) {
    $sql = "select b.sortname from solution as a left join sortclass as b on {$sort}=b.id order by b.id asc";
    $res = query($db, $sql, false);
    $sortname = $res["sortname"];
} else {
    $sortname = "解决方案";
}
?>
<!--top_top开始-->
<?php include "top.php" ?>
<!--导航结束-->
<div class="background">
    <!--top_top结束-->
    <!-- banner开始 -->
    <div class="solution_banner"></div>
    <!-- banner结束 -->
    <div class="same_m clearFix">
        <div class="same_l">
            <h3>S<p>olution <br><span>解决方案</span></p></h3>
            <?php echo showList($db, "solution.php", 23) ?>
        </div>
        <div class="same_r">
            <h2>交通监控LED高清显示方案<span>您的位置：<a href="">首页</a> >解决方案 </span></h2>
            <div class="list">
                <div class="solution_detail clearFix">
<!--                    <img src="images/caseCenter_list1.jpg" alt="">-->
                    <?php echo $pic;?>
                   <div class="title"><?php echo $name;?></div>
                    <li>
                        <?php echo $content;?>
                    </li>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>


</body>
</html>




