<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$picName = '';
if (isset($_FILES["pic"]) && $_FILES["pic"]["error"] == 0) {
    $fileName = $_FILES["pic"]["name"];
//    var_dump($fileName);
    $fileInfo = pathinfo($fileName);
//    var_dump($fileInfo);
    $extension = $fileInfo["extension"];
//    if (!in_array($extension, ["jpg", "png", "jpeg", "gif"])) {
//        echo "<script>alert('只允许上传图片');history.back()</script>";
//        die();
//    }
    $picName .= time() . rand(10, 10000) . "." . $extension;
//var_dump($_SERVER);
    move_uploaded_file($_FILES["pic"]["tmp_name"], $_SERVER["DOCUMENT_ROOT"] . "/upload/{$picName}");
}
$data =["code"=>0,"picName"=>$picName];
echo json_encode($data);





