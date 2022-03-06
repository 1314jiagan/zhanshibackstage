<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>修改类别</title>
<style>
*{padding:0; margin:0;}
body{font-size:14px;}
.sInput{width:50px;}
.mInput{ width:180px;}
ul,li{ list-style:none;}
#lists{ margin:30px auto; width:500px; border:1px solid #CCC; padding:10px;}
#lists ul>li{ padding:5px 15px; height:30px; line-height:30px;}

</style>
<script src="jquery-1.8.3.min.js"></script>
<script>
$(function(e){
	$("#btn").click(function(e) {
        var sortname = $("#sortname").val();
		var orders = $("#orders").val();
		if(sortname==""){alert("类别名称不能为空");$("#sortname").focus(); return false;}
		$("form").submit();
    });
})
</script>
</head>
<body>
<?php
	$sortid = isset($_GET["sortid"])?$_GET["sortid"]:0;
	if($sortid==0)echo "<script>alert('参数传递错误');history.back();</script>";
	require("fun.php");
	$db = conndb();
	$sql = "select * from sortclass where id=$sortid";
	$row = query($db,$sql,false);
    $select_trees = select_trees($parentid=0,$db,$currentid=40,$selectname="sortid");
?>
	<div id="lists">
    		<form action="sort_edit_save.php" method="post">
            	<ul>
                    <li>
                        所属父类:

                    </li>
                	<li>类别名称: <input type="text" name="sortname" id="sortname" class="mInput" maxlength="25"  value="<?php echo $row["sortname"]?>"/></li>
                    <li>排　　序: <input type="text" name="orders" id="orders" class="sInput" maxlength="5" value="<?php echo $row["orders"]?>""  onkeyup="this.value=this.value.replace(/\D/g,'')"/></li>
                    <li>
                    
                    	<input type="hidden" name="sortid" value="<?php echo $sortid;?>" />
                        <input type="hidden" name="parentid" value="<?php echo $row["parentid"];?>" />
                    	<input type="button" value="修改类别" id="btn"/>
                    </li>
                </ul>
            </form>
    </div>
</body>
</html>