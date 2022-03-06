<?php
function conn()
{
    $db = new PDO("mysql:host=localhost;dbname=zhanshi", "root", "root");
    return $db;
}

/*
	查询函数
	1. $db: 连接数据库
	2. $sql: 查询语句
	3. $erwei: true[返回二维数组], false:返回一维数组
*/
function query($db, $sql, $erwei = true)
{
    $query = $db->query($sql);
    $query->setFetchMode(PDO::FETCH_ASSOC);
    if ($erwei) {
        return $query->fetchall();
    }
    return $query->fetch();
}

function dump($arr)
{
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function getExt($filename)
{
    $arr = explode(".", $filename);
    $max = count($arr) - 1;
    return $arr[$max];
}

//function changetime($time) {
//    return new Date($time * 1000).format("yyyy-MM-dd hh:mm:ss");
//}
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
function get_Children_Class($parentid = 0, &$db, &$arr = array(), $space = "", $level = 0, $childResult = "")
{
    /*第一次循环需要查询到一级类别信息, 递归时将直接获得判断有没有时查询到的信息*/
    if (empty($childResult)) {
        $sql = "SELECT * FROM sortclass WHERE parentid=$parentid order by orders asc";
        $childResult = query($db, $sql, true);
    }
    if ($childResult) {
        foreach ($childResult as $row) {
            if ($level == 0) $row["space"] = $space;
            elseif ($level == 1) $row["space"] = $space = "　　|---->";
            else $row["space"] = $space;
            $arr[] = $row;
            /*查询子类*/
            $parentid = $row["id"];
            $sql = "SELECT * FROM sortclass WHERE parentid=$parentid order by orders asc";
            $childResult = query($db, $sql, true);
            if ($childResult) {
                get_Children_Class($parentid, $db, $arr, "　　|" . $space, $level + 1, $childResult);
            }
            /*有子类就添加到$arr数组中*/
        }
    }
    return $arr;
}

/*
	作用: 显示无限分类select下拉列表
	$parentid:  下拉此父类下别的类别
	$currentid:  当前选中的类别ID  edit和editsave页面使用的ID值,无则选择0
    &$db:避免重复引入数组所以加&。
    $selectname  add添加页面   edit编辑页面使用的name=？？？;
*/
function select_trees($parentid = 0, &$db, $currentid = 0, $selectname = "sortid")
{
    $str = "";
    $result = get_Children_Class($parentid, $db);
    if ($result) {
        $str .= "<select name='$selectname'>\n <option value=''>请选择类别</option>\n";
        foreach ($result as $row) {
            $checked = ($currentid == $row["id"]) ? "selected" : "";
            if ($checked) $str .= "	<option value='" . $row["id"] . "' style='background-color: #E20A0A; color:#fff'  $checked>" . $row["space"] . $row["sortname"] . "</option> \n";
            else $str .= "	<option value='" . $row["id"] . "'>" . $row["space"] . $row["sortname"] . "</option> \n";
        }
        $str .= "</select>\n";
    }
    return $str;
}

function getSortName($db, $sort)
{
    $q = $db->query("select * from sortclass where id = {$sort}");
    $rs = $q->fetch();
    $sortname = $rs["sortname"];
    return $sortname;
}

function showList($db, $linkAddress, $parentid)
{
    $sort = isset($_GET['sort']) ? $_GET['sort'] : "";
    $child_res = get_Children_Class($parentid, $db, $arr);
    if (!empty($child_res)) {
        $child_str = '';
        $child_str .= "<ul>";
        foreach ($child_res as $child_v) {
            $css = $sort == $child_v['id'] ? 'class="active"' : '';
            $child_str .= "<li>";
            $child_str .= "<a href='{$linkAddress}?sort={$child_v['id']}' {$css}>{$child_v['sortname']}</a>";
            $child_str .= "</li>";
        }
        $child_str .= "</ul>";
        return $child_str;
    }
}

/*
 * 打乱密码
 */
function encryption($userpwd)
{
    $str = sha1($userpwd);
    $str = substr($str, 3, 8);
    $str = sha1($str);
    $str = md5($str);
    return $str;
}

/*
 *登录
 * */
function login()
{
    session_start();
    if (!isset($_SESSION["name"])) {
        echo "<script>alert('请登录');location.href='./login.php';</script>";
        exit();
    }
}

function pageList($page, $pages, $sort)
{
    $currentPage = $page;
    $css = $currentPage == $page ? 'class="active"' : '';
    $str = "";
    if ($page <= 1) {
        $privious_page = 1;
    } else {
        $privious_page = $page - 1;
    }
    if ($page >= $pages) {
        $next_page = $page;
    } else {
        $next_page = $page + 1;
    }
    if ($page > 1) {
        $str .= "<a href='?sort={$sort}&&page=1'>首页</a>";
        $str .= "<a href='?sort={$sort}&&page={$privious_page}'>上一页</a>";
    }
    if ($pages == 1) {
    } else {
        for ($i = 1; $i <= $pages; $i++) {
            if ($currentPage == $i) {
                $str .= "<a href='?sort={$sort}&&page={$i}' {$css}>{$i}</a>";
            } else {
                $str .= "<a href='?sort={$sort}&&page={$i}'>{$i}</a>";
            }
        }
    }
    if ($page < $pages) {
        $str .= "<a href='?sort={$sort}&&page={$next_page}'>下一页</a>";
        $str .= "<a href='?sort={$sort}&&page={$pages}'>尾页</a>";
    }
    return $str;
    echo $str;
}

