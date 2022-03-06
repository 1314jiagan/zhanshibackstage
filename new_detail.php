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
$sql = "update news set number = number + 1 where id = {$id}";
//echo $sql;
$db->exec($sql);
$sql = "select * from news where id = {$id}";
$res = query($db, $sql, false);
//print_r($res);
$sort = $res["sort"];
$name = $res["name"];
$number = $res["number"];
$content = $res["content"];
$time = date("Y-m-d H:m:s", $res["time"]);
if ($sort) {
    $sql = "select b.sortname from news as a left join sortclass as b on {$sort}=b.id order by b.id asc";
    $res = query($db, $sql, false);
    $sortname = $res["sortname"];
} else {
    $sortname = "产品中心";
}
$previous_sql = "select * from news where id<{$id} and sort = {$sort} order by id desc limit 1";
$previous_res = query($db, $previous_sql, false);
//print_r($previous_res);
$next_sql = "select * from news where  id>{$id} and sort = {$sort} order by id asc limit 1";
$next_res=query($db,$next_sql,false);
//print_r($next_res);
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
            <h2> <?php echo $sortname; ?><span>您的位置：<a href="">首页</a> >新闻资讯 </span></h2>
            <div class="newList">
                <h1><?php echo $name; ?></h1>
                <h6>浏览次数:<?php echo $number; ?>　　发布日期:<?php echo $time; ?></h6>
                <?php echo $content; ?>
                <div></div>
                <?php
                if (empty($previous_res)){?>
                    <h5><span>上一篇:</span>没有了</h5><?php
                }
                else{?>
                    <h5><span>上一篇:</span><a href="./new_detail.php?id=<?php echo $previous_res["id"]?>"><?php echo $previous_res["name"]?></a></h5><?php
                }
                if (empty($next_res)){?>
                    <h5><span>下一篇:</span>没有了</h5><?php
                }else{?>
                    <h5><span>下一篇:</span><a href="./new_detail.php?id=<?php echo $next_res["id"]?>"><?php echo $next_res["name"]?></a></h5><?php
                }
                ?>
<!--                <h5><span>上一篇:</span><a href="">高清小间距亮相中国国际光电博览会</a></h5>-->
<!--                <h5><span>下一篇:</span><a href="">没有了</a></h5>-->
            </div>
        </div>
    </div>
</div>
<div class="color"></div>
<?php include "bottom.php" ?>


</body>
</html>




