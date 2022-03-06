<script src="./vendor/jQuery/jquery-3.6.0.min.js"></script>
<?php $type = isset($_GET["type"]) ? $_GET["type"] : "" ?>
<div class="top">
    <div>
        <a href="./index.php"><img src="/images/top_logo.jpg" alt=""></a>
        <div class="midden">
            <form method="GET" action="">
                <input type="text" placeholder="请输入你要查找的关键字" class="input" name="text">
                <select name="type">
                    <option value="1" <?php echo $type == 1?"selected":""; ?>>案例搜索
                    </option>
                    <option value="2" <?php echo $type == 2?"selected":""; ?>>方案搜索</option>
                    <option value="3" <?php echo $type == 3?"selected":""; ?>>产品搜索</option>
                    <option value="4"  <?php echo $type == 4?"selected":""; ?>>新闻搜索</option>
                </select>
                <input type="submit" class="search_btn" value="">
            </form>
        </div>
        <div class="tel">
            <div>全国服务热线:</div>
            <div><a href="tel:4008-399-227">4008-399-227</a></div>
        </div>
    </div>
    <!--导航开始-->
    <div class="nav">
        <ul class="clearFix">
            <li><a href="./index.php">网站首页<br><span>HOME</span></a>
            </li>
            <li>
                <a href="./aboutUs.php">关于战石<br><span>ABOUT US</span></a>
                <?php echo showList($db, "aboutUs.php", 3) ?>
                <!--                <ul>-->
                <!--                    <li><a href="">公司简介</a></li>-->
                <!--                    <li><a href="">企业文化</a></li>-->
                <!--                    <li><a href="">荣誉资质</a></li>-->
                <!--                </ul>-->
            </li>
            <li><a href="./caseCenter.php">案例中心<br><span>CASE CENTER</span></a>
                <?php echo showList($db, "caseCenter.php", 12); ?>
            </li>
            <li><a href="./solution.php">解决方案<br><span>SOLUTION</span></a>
                <?php echo showList($db, "solution.php", 23); ?>
            </li>
            <li><a href="./product.php">产品中心<br><span>PRODUCT</span></a>
                <?php echo showList($db, "product.php", 4); ?>
            </li>
            <li><a href="./new.php">新闻资讯<br><span>NEWS</span></a>
                <?php echo showList($db, "new.php", 2); ?>
            </li>
            <li><a href="./contactUs.php">联系我们<br><span>CONTACT US</span></a></li>
            <li><a href="./message.php">在线留言<br><span>MESSAGE</span></a></li>
        </ul>
    </div>
</div>
<script>
    $(function () {
        $("div.nav>ul>li").hover(
            function () {
                $(this).children("ul").stop().animate({opacity: 1}, 1000)
            },
            function () {
                $(this).children("ul").stop().animate({opacity: 0}, 1000)
            }
        );
        $("div.top>div>div.midden>form>input[type='submit']").click(function () {
                // alert($(this).val(););
                let text = $("div.top>div>div.midden>form>input[type='text']").val();
                if (text == "") {
                    alert("关键字不能为空");
                    // history.back();
                    return false;
                } else {
                    let a = $("div.top>div>div.midden>form>select").val();
                    if (a == 1) {
                        $(this).parent().attr("action", "./caseCenter.php");
                    } else if (a == 2) {
                        $(this).parent().attr("action", "./solution.php");
                    } else if (a == 3) {
                        $(this).parent().attr("action", "./product.php");
                    } else if (a == 4) {
                        $(this).parent().attr("action", "./new.php");
                    }
                }

            }
        )


    })
</script>

