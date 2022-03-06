<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$id = $_GET["id"];
$sql = "delete from aboutus where id = {$id}";
$db = conn();
$num = $db->exec($sql);
if ($num==1){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"删除失败"];
    echo json_encode($data);
}