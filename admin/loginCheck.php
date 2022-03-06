<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$name = $_POST["name"];
//echo $name;
//die();
$password = $_POST["password"];
//if (empty($name)){
//    $data = ["code"=>1,"msg"=>"用户名不能为空"];
//    exit();
//}
//if (empty($password)){
//    $data = ["code"=>1,"msg"=>"密码不能为空"];
//    exit();
//}
$password = encryption($password);
$sql = "select * from user where name = '{$name}'";
$db = conn();
$res = query($db,$sql,false);
if ($res){
  if ($res["password"]===$password){
//      session_save_path("./session");
      session_start();//启动session
      $_SESSION["name"]=$name;
//      echo  $_SESSION["name"];
      $data = ["code"=>0,"msg"=>"登录成功"];
      echo json_encode($data);
  }else{
      $data = ["code"=>1,"msg"=>"密码错误"];
      echo json_encode($data);
      exit();
  }
}else{
    $data = ["code"=>1,"msg"=>"用户名错误"];
    echo json_encode($data);
}
