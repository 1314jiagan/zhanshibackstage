<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$id = $_GET["id"];
$sql = "delete from message where id = {$id}";
$db = conn();
$num =$db->exec($sql);
if ($num){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"删除失败"];
    echo json_encode($data);
}


