<?php
	require("fun.php");
	
	$sortname = $_POST["sortname"];
	$orders   = $_POST["orders"];
	$parentid = $_POST["parentid"];
	$db = conndb(); //连接数据库
	
	/*判断在该父ID下是否已经存在相同的类别名称 begin*/
	$sql = "select sortname from sortclass where parentid=$parentid and sortname='$sortname'";
	
	$result = query($db,$sql,false);
	if($result){echo "<script>alert('类别已经存在,请更换类别名称');history.back();</script>";die();}
	/*判断在该父ID下是否已经存在相同的类别名称 end*/
	
	if($parentid){
		//非一级类别
		//得到父级的level, sortpath
		$sql = "select level,sortpath from sortclass where id=$parentid";
		$result = query($db,$sql,true);
		if($result){
				$level = $result[0]["level"] + 1;
				$sortpath = $result[0]["sortpath"];
			}
		else{echo "<script>alert('父类不存在');history.back();</script>";die();}
		}
	else{
		//一级类别添加
		 	$level = 0;	//层级为0;
			$sortpath = "0,";
		}
	/*将新类别添加到表中*/
	$sql = "insert into sortclass set
										sortname = '$sortname',
										parentid = $parentid,
										level    = $level,
										orders   = $orders
				";
	$count = $db->exec($sql);
	if($count){
		$lastid = $db->lastInsertId(); //刚刚插入数据的ID
		$sortpath = $sortpath.$lastid.","; //路径为在原来的基础上链接 当前ID,还有","
		//更新类别路径
		$sql = "update sortclass set sortpath = '$sortpath' where id = $lastid";
		$db->exec($sql);
		//更新排序
		upate_orders($parentid,$orders,$lastid,$db);
		echo "<script>alert('添加类别成功');location.href='index.php';</script>";
	}
	
	function upate_orders($parentid,$orders,$id,$db){
		$sql = "select id from sortclass where parentid = $parentid and orders=$orders";
		$result = query($db,$sql,false);
		if($result){
			$db->exec("update sortclass set orders=orders+1 where parentid=$parentid and orders>=$orders and id<>$id");
		}
	
	}
?>