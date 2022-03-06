<?php
	require("fun.php");
	
	$sortname = $_POST["sortname"];
	$orders   = $_POST["orders"];
	$sortid   = $_POST["sortid"];
	$parentid   = $_POST["parentid"];
	$db = conndb(); //连接数据库
	
	/*判断在该父ID下是否已经存在相同的类别名称 begin*/
	$sql = "select sortname from sortclass where parentid=$parentid and sortname='$sortname' and id<>$sortid";
	
	$result = query($db,$sql,false);
	if($result){echo "<script>alert('类别已经存在,请更换类别名称');history.back();</script>";die();}
	/*判断在该父ID下是否已经存在相同的类别名称 end*/
	
	/*更新新类别添加到表中*/
	$sql = "update sortclass set
										sortname = '$sortname',
										orders   = $orders
										where id = $sortid
				";
	
	$count = $db->exec($sql);
	if($count){
		//更新排序
		upate_orders($parentid,$orders,$sortid,$db);
		echo "<script>alert('修改成功');location.href='index.php';</script>";
	}
	
	function upate_orders($parentid,$orders,$id,$db){
		$sql = "select id from sortclass where parentid = $parentid and orders=$orders";
		$result = query($db,$sql,false);
		if($result){
			$db->exec("update sortclass set orders=orders+1 where parentid=$parentid and orders>=$orders and id<>$id");
		}
	
	}
?>