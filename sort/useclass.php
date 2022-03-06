<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>调用类别</title>
<style>
*{padding:0; margin:0;}
body{font-size:14px;}
select{height:35px;}
.sInput{width:50px;}
.mInput{ width:180px;}
ul,li{ list-style:none;}
#lists{ margin:30px auto; width:500px; border:1px solid #CCC; padding:10px;}
#lists ul>li{ padding:5px 15px; height:30px; line-height:30px;}
.red {
  background-color: #E20A0A;
  color: #ffffff;
}
</style>
</head>

<body>
<?php
	require("fun.php");
	$db = conndb();
	$select_trees = select_trees($parentid=0,$db,$currentid=40,$selectname="sortid");
	
?>
<div id="lists">
    		<form>
            	<ul>
                	<li>选择类别:
                    	<?php echo $select_trees;?>
                    
                    </li>
                </ul>
            </form>
    </div>
</body>
</html>