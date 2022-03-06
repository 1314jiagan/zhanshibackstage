<?php
session_start();
session_destroy();
//echo "<script>alert('安全退出');location.href='./login.php';</script>";
$data = ["code"=>0,"msg"=>"安全退出"];
echo json_encode($data);
