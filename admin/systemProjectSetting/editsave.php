<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$id = $_POST["id"];
$name = $_POST["name"];
$contactphone = $_POST["contactphone"];
$phone = $_POST["phone"];
$people = $_POST["people"];
$qq = $_POST["qq"];
$email = $_POST["email"];
$address = $_POST["address"];


$sql = "update sysset set name= '{$name}',
                             contactphone = '{$contactphone}',
                             phone = '{$phone}',
                             people = '{$people}',
                             qq = '{$qq}',
                             address = '{$address}',
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


