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
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"添加失败"];
    echo json_encode($data);
}


