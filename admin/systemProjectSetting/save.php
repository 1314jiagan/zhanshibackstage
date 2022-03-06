<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$name = $_POST["name"];
$contactphone = $_POST["contactphone"];
$phone = $_POST["phone"];
$people = $_POST["people"];
$qq = $_POST["qq"];
$email = $_POST["email"];
$address = $_POST["address"];
//echo $picName;
//die();
$sql = "insert into sysset set name= '{$name}',
                             contactphone = '{$contactphone}',
                             phone = '{$phone}',
                             people = '{$people}',
                             qq = '{$qq}',
                             address = '{$address}',
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

