<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
//print_r($_POST);
$name = $_POST["name"];
$sort = $_POST["sort"];
//echo $name;
//die();
$content = $_POST["content"];
$sql="insert into aboutus set name='{$name}',
                                sort ='{$sort}',
                                content='{$content}'";
$db = conn();
$num = $db->exec($sql);
if ($num){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"添加失败"];
    echo json_encode($data);
}

