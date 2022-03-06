<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$name = $_POST["name"];
$realName = $_POST["realName"];
$time = $_POST["time"];
//echo $time;
//die();
$password = $_POST["password"];
$password = encryption($password);
//if (empty($name)) {
//    echo "<script>alert('用户名不能为空');history.back();</script>";
//    exit();//die();
//}
//if (empty($password)) {
//    echo "<script>alert('用户名密码不能为空');history.back();</script>";
//    exit();//die();
//}
$sql = "select * from user where name='{$name}' order by id asc";
$db = conn();
$res = query($db,$sql,true);
if ($res) {
    $data=["code"=>1,"msg"=>"注册失败，用户名重复，请更换用户名"];
    echo json_encode($data);
    exit();
}
//echo $picName;
//die();
$sql = "insert into user set name= '{$name}',
                            realname = '{$realName}',
                            password = '{$password}',
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

