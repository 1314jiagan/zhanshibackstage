<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
login();
$name = $_SESSION["name"];
$password = $_POST["password"];
$password = encryption($password);
//die();
$rePassWord= $_POST["repassword"];
//echo $rePassWord;
//die();
$rePassWord = encryption($rePassWord);
//echo $rePassWord;
//die();
$oldPassword=$_POST["oldPassword"];
$oldPassword = encryption($oldPassword);
$db=conn();
$sql = "select * from user where name ='{$name}'";
$res =query($db,$sql,false);
//echo $res["password"];
//die();
if ($res["password"]!=$oldPassword){
    $data=["code"=>1,"msg"=>"旧密码输入不对"];
    echo json_encode($data);
}elseif ($password===$res["password"]){
    $data=["code"=>1,"msg"=>"新密码不能与旧密码重复"];
    echo json_encode($data);
}else{
    $sql = "update user set password ='{$password}' where name = '{$name}'";
    $num = $db->exec($sql);
    $data = ["code"=>0, "msg"=>"更改成功"];
    echo json_encode($data);
}