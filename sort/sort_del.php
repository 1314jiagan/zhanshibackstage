<?php
	require("fun.php");
	
	$db = conndb(); //连接数据库
	$sortid = isset($_GET["sortid"])?$_GET["sortid"]:0;
	if($sortid){
		$sql = "select sortname from sortclass where parentid=$sortid";
		$result = query($db,$sql,false);
		if($result){echo "<script>alert('该类别下有子类,不能删除');history.back();</script>";die();}
		
		$sql = "delete from sortclass where id=$sortid";
		$count = $db -> exec($sql);
		if($count)echo "<script>alert('删除成功');location.href='index.php';</script>";
	}
	else{
			echo "<script>alert('参数传递错误');history.back();</script>";
		}
?>