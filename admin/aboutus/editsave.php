<?php

include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
//print_r($_POST);
$name = $_POST["name"];
$id = $_POST["id"];
$sort = $_POST["sort"];
$content = $_POST["content"];
$sql = "update aboutus set name='{$name}',
                                sort ='{$sort}',
                                content='{$content}' where id = '{$id}'";
$db = conn();
$num = $db->exec($sql);
if ($num){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"更新失败"];
    echo json_encode($data);
}


