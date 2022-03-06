<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$id = $_POST["id"];
$name = $_POST["name"];
$content = $_POST["content"];
$number = $_POST["number"];
$sort = $_POST["sort"];
$time = time();
$sql = "update news set name='{$name}',
                             content ='{$content}',
                             number ='{$number}',
                             sort ='{$sort}',
                             time = '{$time}' where id = '{$id}'";
$db=conn();
$num=$db->exec($sql);
if ($num){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"更新失败"];
    echo json_encode($data);
}