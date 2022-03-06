<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$name = $_POST["name"];
$content = $_POST["content"];
$number = $_POST["number"];
$sort = $_POST["sort"];
$time = time();
$sql = "insert into news set name='{$name}',
                             content ='{$content}',
                             number ='{$number}',
                             sort ='{$sort}',
                             time = '{$time}'";
$db=conn();
$num=$db->exec($sql);
if ($num){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"添加失败"];
    echo json_encode($data);
}


