<?php
 /*
	连接数据库函数
*/

function conndb(){
	$dsn = "mysql:host=localhost;dbname=zhanshi";
	$db = new PDO($dsn, 'root', 'root'); 
	$db->exec("SET names 'utf8'");
	return $db;
}

/*
	查询函数
	1. $db: 连接数据库
	2. $sql: 查询语句
	3. $erwei: true[返回二维数组], false:返回一维数组
*/
function query($db,$sql,$erwei=true){
	$result = "";
	$query = $db->query($sql);
	$query->setFetchMode(PDO::FETCH_ASSOC);
	if($erwei){
		$result = $query->fetchAll();
	}
	else{
		$result = $query->fetch();
	}
	return $result;
}
/*
	
	作用：显示类别信息
	函数名:get_Children_Class() 
	$parentid: 要显示此ID下及子孙所有类别信息
	&$db:   连接数据库
	&$arr:  存储的数组
	$space:  间隔符号
	$childResult: 直属子类
	$level: 判断当前是第几级, 默认0,表示第一级
	author: carl  from: http://www.ncyteng.com

*/
function get_Children_Class($parentid=0,&$db,&$arr=array(),$space="",$level=0,$childResult=""){
	/*第一次循环需要查询到一级类别信息, 递归时将直接获得判断有没有时查询到的信息*/
	if(empty($childResult)){
		$sql = "SELECT * FROM sortclass WHERE parentid=$parentid order by orders asc";
		$childResult = query($db,$sql,true);
	}
	if($childResult){
		foreach($childResult as $row){
			if($level==0)$row["space"]=$space;
			elseif($level==1)$row["space"]=$space="　　|---->";
			else $row["space"] = $space;
			$arr[] = $row;
			/*查询子类*/
			$parentid = $row["id"];
			$sql = "SELECT * FROM sortclass WHERE parentid=$parentid order by orders asc";
			$childResult = query($db,$sql,true);
			if($childResult)
				{
					get_Children_Class($parentid,$db,$arr,"　　|".$space,$level+1,$childResult);
				}
			/*有子类就添加到$arr数组中*/
			
		}
	}
	return $arr;
}
/*
	作用: 显示无限分类select下拉列表
	$parentid:  下拉此父类下别的类别
	$currentid:  当前选中的类别ID
*/
function select_trees($parentid=0,&$db,$currentid=0,$selectname="sortid"){
	$str = "";
	$result = get_Children_Class($parentid,$db);
	if($result){
	  $str .= "<select name='$selectname'>\n";
	  foreach($result as $row){
		$checked = ($currentid==$row["id"])?"selected":"";
		if($checked) $str .= "	<option value='".$row["id"]."' style='background-color: #E20A0A; color:#fff'  $checked>".$row["space"].$row["sortname"]."</option> \n";
		else $str .= "	<option value='".$row["id"]."'>".$row["space"].$row["sortname"]."</option> \n";  
	  }
	  $str .= "</select>\n";
	}
	return $str;
}

 /**
 * 打印函数
 */

function dump($arr)
{
	echo "<pre>";
	print_r($arr);
	echo "</pre>";
}


?>