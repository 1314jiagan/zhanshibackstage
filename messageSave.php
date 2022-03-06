<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$name = $_POST["name"];
$tel = $_POST["tel"];
$qq = $_POST["qq"];
$email = $_POST["email"];
$title = $_POST["title"];
$content = $_POST["content"];
$time = time();
//echo $picName;
//die();
$sql = "insert into message set name= '{$name}',
                             tel = '{$tel}',
                             qq = '{$qq}',
                             title = '{$title}',
                             content = '{$content}',
                             time = '{$time}',
                             email = '{$email}'";
//echo $sql;
//die();
$db=conn();
$num=$db->exec($sql);
if ($num){
    echo "<script>alert('留言成功');location.href='message.php';</script>";
}else{
    echo "<script>alert('留言失败');history.back();</script>";
}


