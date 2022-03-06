<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$id = $_POST["id"];
$name = $_POST["name"];
$content = $_POST["content"];
$number = $_POST["number"];
$sort = $_POST["sort"];
$picName = $_POST["picName"];
$oldName =isset($_POST["oldName"])?($_POST["oldName"]):"";
if ($oldName && $picName){
    $filePaths=urldecode($oldName);//解码post传过来的变量
    $img_url=($_SERVER)["DOCUMENT_ROOT"] ."/upload/";//网站根目录路径
    unlink($img_url.$filePaths);//
}
$pic=$oldName;
if ($picName){
    $pic=$picName;
}
$time = time();
$sql = "update projectcase set name='{$name}',
                             content ='{$content}',
                             number ='{$number}',
                             sort ='{$sort}',
                              pic = '{$pic}',
                             time = '{$time}' where id = '{$id}'";
$db=conn();
$num=$db->exec($sql);
if ($num){
    $data=["code"=>0,"msg"=>""];
    echo json_encode($data);
}else{
    $data=["code"=>1,"msg"=>"更新失败"];
    echo json_encode($data);
}

