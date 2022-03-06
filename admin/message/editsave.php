<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
//print_r($_POST);
//die();
$id = $_POST["id"];
$name = $_POST["name"];
$tel = $_POST["tel"];
$qq = $_POST["qq"];
$email = $_POST["email"];
$title = $_POST["title"];
$content = $_POST["content"];
$time = time();

$sql = "update message set name= '{$name}',
                             tel = '{$tel}',
                             title = '{$title}',
                             content = '{$content}',
                             qq = '{$qq}',
                             time = '{$time}',
                             email = '{$email}' where id = '{$id}'";
$db=conn();
$num=$db->exec($sql);
if ($num){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"更新失败"];
    echo json_encode($data);
}



