<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>类别显示列表</title>
<style>
*{padding:0; margin:0;}
ul,li{ list-style:none;}
a{ text-decoration:none;}
#lists{ margin:30px auto; width:800px; border:1px solid #CCC; padding:10px;}
#lists table{ width:800px; border:1px solid #ccc; border-collapse:collapse;}
#lists table tr{ height:30px;}
#lists table tr th{ text-align:center; }
#lists table tr td{border:dotted 1px #c7c7c7; padding-left:15px; }
</style>
</head>

<body>
<?php
	require("fun.php");
	$db = conndb();
	$parentid = isset($_GET["parentid"])?$_GET["parentid"]:0;
	$result=get_Children_Class($parentid,$db);
	$str = "";
	if($result){
		foreach($result as $row){
			$str .= "<tr> \n";
			$str .= "	<td>".$row["id"]."</td>\n";
			$str .= "	<td>".$row["space"].$row["sortname"]."</td>\n";
			$str .= "	<td>
			<a href='sort_add.php?parentid=".$row["id"]."'>添加</a>&nbsp;
	  	    <a href='sort_edit.php?sortid=".$row["id"]."'>修改</a>&nbsp;
	        <a href='sort_del.php?sortid=".$row["id"]."' onClick='return confirm(\"确定要删除吗?\");'>删除</a>
	  			     </td\n>";
			$str .= "</tr>\n";
		}
	}
?>
	<div id="lists">
            <table cellpadding="0" cellspacing="0">
            	<tr style="border-bottom:1px solid #ccc;">
                	<th colspan="3" style="text-align:left; padding-left:15px; height:30px;"><a href="sort_add.php">添加一级分类>></a></th>
                </tr>
            	<tr>
                	<th style="width:60px;">ID号</th>
                    <th>类别名称</th>
                    <th style="width:220px;">操作</th>
                </tr>
                <?php echo $str;?>
            </table>
    </div>
</body>
</html>