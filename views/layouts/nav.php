<div class="demo">
    <div class="bar-container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-default navbar-mobile bootsnav">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <h1 id="banner_logo" style="margin-right: 2rem;">
                            <a href="/">
                                <img width="123.9rem" src="/images/login.png?v=<?php echo \app\utils\Utils::version(); ?>">
                            </a>
                        </h1>
                        <div class="layui-col-md3 hide" id="bar_notice">
                            <p class="bg-warning padding-2">
                                <i class="layui-icon layui-icon-notice"></i>
                                充值支付宝：`
                            </p>
                        </div>
                        <div id="nav_content">
                            <ul class="nav navbar-nav" data-in="fadeInDown" data-out="fadeOutUp">
                                <li><a href="/">首页</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">任务管理</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/task/index?tag=repair&r=0#state=release">发布任务</a></li>
                                        <li><a href="/task/index?r=1#state=wait">待接任务</a></li>
                                        <li><a href="/task/index?r=2#state=received">已接任务</a></li>
<!--                                        <li><a href="/task/index?r=3#state=evaluate">评价管理</a></li>-->
<!--                                        <li><a href="/task/index?r=4#state=additional">追评管理</a></li>-->
<!--                                        <li><a href="/task/index?tag=repair#state=logistics">物流管理</a></li>-->
                                        <li><a href="/task/index?r=6#state=failure">无效任务</a></li>
<!--                                        <li><a href="/task/index?r=7#state=faqs">淘宝问大家</a></li>-->
                                    </ul>
                                </li>
<!--                                <li class="dropdown">-->
<!--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">资金管理</a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li><a href="/finance/capitalManagement?r=1#anchor=RechargeManage">账号充值</a></li>-->
<!--                                        <li><a href="/finance/capitalManagement?r=2#anchor=transferManage">转账管理</a></li>-->
<!--                                        <li><a href="/finance/capitalManagement?r=3#anchor=capitalManage">资金管理</a></li>-->
<!--                                        <li><a href="/finance/capitalManagement?r=4#anchor=orderCollectInfos">订单信息</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">会员中心</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="/user/ucenter?r=0#anchor=basics-info">基本资料</a></li>
<!--                                        <li><a href="/user/ucenter?r=1#anchor=assistant-manage">小助理</a></li>-->
                                        <li><a href="/user/ucenter?r=2#anchor=shop-manage">店铺管理</a></li>
                                        <li><a href="/user/ucenter?r=3#anchor=product-manage">商品管理</a></li>
<!--                                        <li><a href="/user/ucenter?r=4#anchor=invite-friends">邀请好友</a></li>-->
                                    </ul>
                                </li>
<!--                                <li class="dropdown">-->
<!--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">流量任务</a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li><a href="/task/flowTaskManagement?tag=flow#state=release">发布任务</a></li>-->
<!--                                        <li><a href="/task/flowTaskManagement?r=1#state=campOnFlow">待接任务</a></li>-->
<!--                                        <li><a href="/task/flowTaskManagement?r=2#state=receivedListFlow">已接任务</a></li>-->
<!--                                        <li><a href="/task/flowTaskManagement?r=3#state=failureFlow">无效任务</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                                <li class="dropdown">-->
<!--                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">工单</a>-->
<!--                                    <ul class="dropdown-menu">-->
<!--                                        <li><a href="/workOrder/workOrderManagement?r=0#anchor=punishments">普通工单列表</a></li>-->
<!--                                        <li><a href="/workOrder/workOrderManagement?r=1#anchor=compensate">赔付工单列表</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
                            </ul>
                            <div class="shury_1">
                                <div class="hy_state">
                                    <span>
                                        <a href="/user/ucenter#anchor=basics-info">
                                            <img width="50%" src="/images/boy.png?v=<?php echo \app\utils\Utils::version(); ?>">
                                        </a>
                                    </span>
                                    <span>
                                        <b id="username">
                                            <?php echo yii::$app->params['login_mobile'] ?>&nbsp;&nbsp;
                                            <a href="/login/logout" class="layui-btn layui-btn-xs layui-btn-danger">退出</a>
                                        </b>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>