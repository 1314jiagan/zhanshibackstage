<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>添加类别</title>
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
	$parentid = isset($_GET["parentid"])?$_GET["parentid"]:0; //得到要添加类别的父类ID, 如果没有得到, 表示一级类别, 父类默认为0;
?>
	<div id="lists">
    		<form action="sort_add_save.php" method="post">
            	<ul>
                	<li>类别名称: <input type="text" name="sortname" id="sortname" class="mInput" maxlength="25" /></li>
                    <li>排　　序: <input type="text" name="orders" id="orders" class="sInput" maxlength="5" value="1"  onkeyup="this.value=this.value.replace(/\D/g,'')"/></li>
                    <li>
                    	<input type="hidden" name="parentid" value="<?php echo $parentid;?>" />
                    	<input type="button" value="添加类别" id="btn"/>
                    </li>
                </ul>
            </form>
    </div>
</body>
</html>