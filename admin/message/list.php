<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
$db = conn();
$name = isset($_GET["name"]) ? $_GET["name"] : "";
$qq = isset($_GET["qq"]) ? $_GET["qq"] : "";
$where="";
if($name){
    $where .= "and name like '%{$name}%' ";
}
if ($qq){
    $where .= "and qq = '{$qq}' ";
}
if ($where) {
    $where = "where" . substr($where, 3);
}
$sql = "select count(*) as total from message {$where} ";
$res = query($db,$sql,false);
$total = $res["total"];
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$limit = isset($_GET["limit"]) ? $_GET["limit"] : 5;
$start = ($page - 1) * $limit;
$sql = "select * from message {$where} order by id desc limit {$start},{$limit}";
$res = query($db,$sql,true);
$data=["code"=>0,"msg"=>"","data"=>$res,"count"=>$total];
echo json_encode($data);



