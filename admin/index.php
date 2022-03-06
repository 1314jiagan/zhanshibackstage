

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>江西战石光电后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/vendor/dist/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/vendor/dist/layuiadmin/style/admin.css" media="all">
</head>
<body class="layui-layout-body">
<?php
include ($_SERVER)["DOCUMENT_ROOT"] . "/admin/fun.php";
login();
?>

<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layadmin-flexible" lay-unselect>
                    <a href="javascript:;" layadmin-event="flexible" title="侧边伸缩">
                        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="../index.php" target="_blank" title="前台">
                        <i class="layui-icon layui-icon-website"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" layadmin-event="refresh" title="刷新">
                        <i class="layui-icon layui-icon-refresh-3"></i>
                    </a>
                </li>

            </ul>
            <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">

<!--                <li class="layui-nav-item" lay-unselect>-->
<!--                    <a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">-->
<!--                        <i class="layui-icon layui-icon-notice"></i>-->
<!---->
<!--                        <!-- 如果有新消息，则显示小圆点 -->-->
<!--                        <span class="layui-badge-dot"></span>-->
<!--                    </a>-->
<!--                </li>-->
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="theme">
                        <i class="layui-icon layui-icon-theme"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="fullscreen">
                        <i class="layui-icon layui-icon-screen-full"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;">
                        <cite>tester</cite>
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a lay-href="user/password.php">修改密码</a></dd>
                        <hr>
                        <dd style="text-align: center;"><a href="javascript:;" id="loginout">退出</a></dd>
                    </dl>
                </li>

                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="about"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
                <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
                    <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
            </ul>
        </div>

        <!-- 侧边菜单 -->
        <div class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo" lay-href="home/console.html">
                    <span>战石后台</span>
                </div>

                <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu">
                    <li data-name="home" class="layui-nav-item layui-nav-itemed">
                        <a href="javascript:;" lay-tips="主页" lay-direction="2">
                            <i class="layui-icon layui-icon-home"></i>
                            <cite>主页</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd data-name="console" class="layui-this">
                                <a lay-href="home/console.html">控制台</a>
                            </dd>
                        </dl>
                    </li>
                    <li data-name="component" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="aboutus" lay-direction="2">
                            <i class="layui-icon layui-icon-component"></i>
                            <cite>关于战石</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd data-name="button">
                                <a lay-href="aboutus/index.php">about us列表</a>
                            </dd>
                        </dl>
                    </li>
                    <li data-name="template" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="news" lay-direction="2">
                            <i class="layui-icon layui-icon-template"></i>
                            <cite>新闻资讯</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd><a lay-href="news/index.php">news列表</a></dd>
                        </dl>
                    </li>
                    <li data-name="app" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="product" lay-direction="2">
                            <i class="layui-icon layui-icon-app"></i>
                            <cite>产品中心</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a lay-href="product/index.php">product列表</a>
                            </dd>
                        </dl>
                    </li>
                    <li data-name="senior" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="projectcase" lay-direction="2">
                            <i class="layui-icon layui-icon-senior"></i>
                            <cite>工程案例</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a lay-href="projectcase/index.php">projectcase列表</a>
                            </dd>
                        </dl>
                    </li>
                    <li data-name="water" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="solution" lay-direction="2">
                            <i class="layui-icon layui-icon-water"></i>
                            <cite>解决方案</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a lay-href="solution/index.php">solution列表</a>
                            </dd>
                        </dl>
                    </li>
                    <li data-name="user" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="user" lay-direction="2">
                            <i class="layui-icon layui-icon-user"></i>
                            <cite>用户表</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd>
                                <a lay-href="user/index.php">网站用户</a>
                            </dd>
                        </dl>
                    </li>
                    <li data-name="set" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="System Project Setting" lay-direction="2">
                            <i class="layui-icon layui-icon-set"></i>
                            <cite>系统项目设置</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd class="layui-nav-itemed">
                                <a lay-href="systemProjectSetting/index.php">系统项目设置</a>
                            </dd>
                        </dl>
                    </li>

                    <li data-name="about" class="layui-nav-item">
                        <a href="javascript:;" lay-tips="A message table" lay-direction="2">
                            <i class="layui-icon layui-icon-about"></i>
                            <cite>留言表</cite>
                        </a>
                        <dl class="layui-nav-child">
                            <dd class="layui-nav-itemed">
                                <a lay-href="message/index.php">留言表</a>
                            </dd>
                        </dl>
                    </li>

                    <li data-name="get" class="layui-nav-item">
                        <a href="javascript:;" layadmin-event="about" lay-tips="授权" lay-direction="2">
                            <i class="layui-icon layui-icon-auz"></i>
                            <cite>关于</cite>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- 页面标签 -->
        <div class="layadmin-pagetabs" id="LAY_app_tabs">
            <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-down">
                <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;"></a>
                        <dl class="layui-nav-child layui-anim-fadein">
                            <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                            <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                            <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                <ul class="layui-tab-title" id="LAY_app_tabsheader">
                    <li lay-id="home/console.html" lay-attr="home/console.html" class="layui-this"><i class="layui-icon layui-icon-home"></i></li>
                </ul>
            </div>
        </div>


        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-show">
                <iframe src="home/console.html" frameborder="0" class="layadmin-iframe"></iframe>
            </div>
        </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>

<script src="/vendor/dist/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/vendor/dist/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use('index',function () {
        var $ = layui.$;
        $("#loginout").on("click", function() {
            layer.confirm('您确定退出吗？', function() {
                $.ajax({
                    url: "./loginout.php",
                    dataType: "json",
                    success: function(res) {
                        if (res.code == 0) {
                            layer.msg("退出成功", {
                                icon: 1,
                                time: 2000
                            }, function() {
                                location.href = "./login.php";
                            })
                        }
                    }
                })
            });
        })

    });

</script>

<!-- 百度统计 -->
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?d214947968792b839fd669a4decaaffc";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</body>
</html>



