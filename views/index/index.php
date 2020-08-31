
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title><?php echo \app\utils\Utils::webSiteTitle(); ?></title>
    <?php echo \app\utils\Utils::getCsrfMeta(); ?>
    <script src="/js/common/jquery.min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/layer/layui.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/common.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link href="/css/layui/layui.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/common.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/bootsnav.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/bootstrap.min.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <head>
<body>

<?php echo Yii::$app->view->renderFile('@app/views/layouts/nav.php') . PHP_EOL; ?>

<!--头部logo、用户信息、导航栏end-->
<div class="col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-offset-0">
    <link href="/css/index/index.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <form action="javascript:;" enctype="multipart/form-data" id="fm"  method="post">
        <div id="banner">
            <div class="ban_1100">
                <div class="banneright" id="take_console">
                    <div class="ban_tab">
                        <span class="tack1 cur">关于我的</span>
                    </div>
                    <div class="task_one tabContant" id="request">
                        <ul id="about-me">
                            <li>愉快合作第<span class="theme-font">&nbsp;<?php echo \app\utils\Utils::registerDays($info['create_time'])?></span>&nbsp;天</li>
<!--                            <li>账户存款：<span class="theme-font">&nbsp;707.38</span>&nbsp;元</li>-->
                            <li>状态：<span class="theme-font">正常</span></li>
                            <li>绑定店铺：<span class="theme-font"><?php echo $total_shop; ?></span>&nbsp;个</li>
                            <li>
                                今日任务（已接 / 可接）：
                                <span class="theme-font">
                                <?php echo $wait; ?></span> / <span class="theme-font"><?php echo $recived; ?></span>
<!--                                &nbsp;<span class="layui-word-aux">&</span>&nbsp;-->
<!--                                <a href="javascript:;" onclick="taskStatistics()"><i class="layui-icon">&#xe62c;</i> 统计</a>-->
                            </li>
                            <li>隐藏任务数：<span class="theme-font"><?php echo $hide; ?></span>&nbsp;个</li>
<!--                            <li id="overdueTip">小助理店铺近3天过期数：<span class="theme-font">0</span>&nbsp;个</li>-->
<!--                            <li>任务状态（全局）：<span class="theme-font" id="ShowStatus">显示任务</span>&nbsp;&nbsp;<a href="javascript:;" onclick="cutShowStatus(0, this);">切换</a></li>-->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="padding-2"></div>
    <div class="footer">
        <div class="line"></div>
        <div class="w1280">
<!--            <div class="youshi">-->
<!--                <ul>-->
<!--                    <li><a><i class="icon iconfont icon-zuanshi"></i>账户存款&nbsp;<span class="layui-badge">707.38</span></a></li>-->
<!--                    <li><a href="/finance/capitalManagement#anchor=transferManage"><i class="icon iconfont icon-zuanshi"></i>等待转账&nbsp;<span class="layui-badge">0</span></a></li>-->
<!--                    <li><a href="/finance/capitalManagement#anchor=transferManage"><i class="icon iconfont icon-zuanshi"></i>未到账反馈&nbsp;<span class="layui-badge">0</span></a></li>-->
<!--                    <li><a href="/user/memberManagement#anchor=assistantManage"><i class="icon iconfont icon-zuanshi"></i>昨日订单标记&nbsp;<span class="layui-badge">0</span></a></li>-->
<!--                </ul>-->
<!--            </div>-->
            <div class="middle">
                <div class="about">
                    <ul>
                        <li>
                            <h4>关于</h4>
                            <p><a href="#">意见反馈</a></p>
                        </li>
                        <li>
                            <h4>我的</h4>
                            <p><a href="/user/ucenter#anchor=basics-info">基本资料</a></p>
<!--                            <p><a href="/user/memberManagement#anchor=inviteFriends">邀请好友</a></p>-->
                        </li>
                        <li>
                        </li>
                        <li>
                            <h4>工单处理</h4>
<!--                            <p><a href="/workOrder/workOrderManagement#anchor=punishments">我的工单</a></p>-->
                        </li>
                    </ul>
                </div>

                <?php foreach(yii::$app->params['serviceQq'] as $service) { ?>
                    <div class="contact">
                        <i class="layui-icon layui-icon-login-qq"></i>
                        <p class="qq">
                            <span>
                                <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $service['qq']; ?>&site=&menu=yes" target="_blank">
                                    <?php echo $service['title']; ?>：<?php echo $service['qq']; ?>
                                </a>
                            </span>
                        </p>
                        <p><?php echo $service['time']; ?></p>
                    </div>
                <?php } ?>
            </div>
            <div class="copyright">
                <?php echo yii::$app->params['copyright']; ?>
            </div>
        </div>
    </div>
    <script src="/js/index/index.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script type="text/javascript">
        var $matter = '';
        if ($matter != '')
        {
            matterTips($matter);
        }
        SHOW_CPM_NOTICE = 1;
    </script>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

