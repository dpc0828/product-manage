
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
<!--头部logo、用户信息、导航栏-->

<?php echo Yii::$app->view->renderFile('@app/views/layouts/nav.php') . PHP_EOL; ?>

<div class="col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-offset-0">
    <link href="/css/task/task.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <div id="box">
        <i id="tag" class="hide">repair</i>
        <div class="layui-tab layui-tab-brief" lay-filter="task-state">
            <ul class="layui-tab-title">
                <li lay-id = "release" data-state = "" class="layui-this">发布任务</li>
                <li lay-id = "wait" data-state = "0">待接任务</li>
                <li lay-id = "received" data-state = "1">已接任务</li>
<!--                <li lay-id = "evaluate" data-state = "4">评价管理</li>-->
<!--                <li lay-id = "additional" data-state = "4">追评管理</li>-->
<!--                <li lay-id = "logistics" data-state = "5">物流管理</li>-->
                <li lay-id = "failure" data-state = "5">无效任务</li>
<!--                <li lay-id="faqs" data-state="5">-->
<!--                    淘宝问大家-->
<!--                </li>-->
            </ul>
        </div>
        <div id="wait_search" class="search_box hide">
            <form data-target = "wait" id="wait" class="layui-form search_form" lay-filter="search_form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="tasktype">
                                <option value="">任务分类</option>
                                <option value="1">销量任务</option>
                                <option value="5">预约任务</option>
                                <option value="7">猜你喜欢</option>
                                <option value="8">多链接任务</option>
                                <option value="10">标签任务</option>
                                <option value="11">微淘任务</option>
                                <option value="13">提前购</option>
                            </select>
                        </div>
                        <div class="layui-input-inline select_box">
                            <select name="state">
                                <option value="">任务状态</option>
                                <option value="1">显示</option>
                                <option value="2">隐藏</option>
                            </select>
                        </div>
                        <div class="layui-input-inline select_box">
                            <select name="key">
                                <option value="shopname">店铺名称</option>
                                <option value="commodity_id">商品ID</option>
                                <option value="keyword">关键词</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value"  placeholder="输入相关信息搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="time">
                                <option value="issuetime">发布时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="start" class="layui-input" autocomplete="off" id="campOn_start">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="end" class="layui-input" autocomplete="off" id="campOn_end">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="received_search" class="search_box hide">
            <form data-target = "received" id="received" class="layui-form search_form" lay-filter="search_form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="tasktype">
                                <option value="">任务分类</option>
                                <option value="1">销量任务</option>
                                <option value="5">预约任务</option>
                                <option value="7">猜你喜欢</option>
                                <option value="8">多链接任务</option>
                                <option value="10">标签任务</option>
                                <option value="11">微淘任务</option>
                                <option value="13">提前购</option>
                            </select>
                        </div>
<!--                        <div class="layui-input-inline select_box">-->
<!--                            <select name="takeGoodsState">-->
<!--                                <option value="">提醒收货状态</option>-->
<!--                                <option value="0">未提醒</option>-->
<!--                                <option value="1">已提醒，待收货</option>-->
<!--                                <option value="2">已确认收货</option>-->
<!--                            </select>-->
<!--                        </div>-->
<!--                        <div class="layui-input-inline select_box">-->
<!--                            <select name="state">-->
<!--                                <option value="">任务状态</option>-->
<!--                                <option value="0">进行中</option>-->
<!--                                <option value="1">待付款</option>-->
<!--                                <option value="4">已完成</option>-->
<!--                                <option value="5">待评价</option>-->
<!--                                <option value="7">已评价</option>-->
<!--                                <option value="3">超时未付款</option>-->
<!--                            </select>-->
<!--                        </div>-->
                        <div class="layui-input-inline select_box">
                            <select name="key">
                                <option value="tasksn">任务编号</option>
<!--                                <option value="ordersn">订单编号</option>-->
                                <option value="shopname">店铺名称</option>
<!--                                <option value="wangwang">买号名称</option>-->
                                <option value="commodity_id">商品ID</option>
                                <option value="keyword">关键词</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value"  placeholder="输入相关信息搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="time">
                                <option value="issuetime">发布时间</option>
                                <option value="catchertime">接手时间</option>
                                <option value="paytime">支付时间</option>
                                <option value="orders_interval">下单时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="start" class="layui-input" autocomplete="off" id="start">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="end" class="layui-input" autocomplete="off" id="end">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
<!--                        <button class="layui-btn layui-btn-radius layui-btn-primary" style="display: inline-block;" onclick="derivereceivedList();return false;">导&nbsp;出</button>-->
                    </div>
                </div>
            </form>
<!--            <div class="air_command monitoring _tips" data-tipmsg="实时监控是否有新订单，有则响铃提醒">-->
<!--                <form class="layui-form">-->
<!--                    <div class="layui-form-item" style="margin-bottom: 0; padding-right: 1rem;">-->
<!--                        <label class="layui-form-label">-->
<!--                            <i class="layui-icon layui-icon-chart"></i>-->
<!--                            实时监控-->
<!--                        </label>-->
<!--                        <div class="layui-input-block">-->
<!--                            <input type="checkbox" name="monitoring" lay-skin="switch" lay-text="开|关">-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
<!--            </div>-->
        </div>
        <div id="evaluate_search" class="search_box hide">
            <form data-target = "evaluate" id="evaluate" class="layui-form" lay-filter="search_form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="state">
                                <option value="">评价状态</option>
                                <option value="0">等待评价</option>
                                <option value="1">已评价，待商家审核</option>
                                <option value="2">完成评价</option>
                                <option value="3">已取消评价</option>
                            </select>
                        </div>
                        <div class="layui-input-inline select_box">
                            <select name="key">
                                <option value="tasksn">任务编号</option>
                                <option value="ordersn">订单编号</option>
                                <option value="shopname">店铺名称</option>
                                <option value="wangwang">买号名称</option>
                                <option value="commodity_id">商品ID</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value"  placeholder="输入相关信息搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="time">
                                <option value="paytime">支付时间</option>
                                <option value="catchertime">接手时间</option>
                                <option value="issuetime">发布时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="start" class="layui-input" autocomplete="off" id="ev-start">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="end" class="layui-input" autocomplete="off" id="ev-end">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="additional_search" class="search_box hide">
            <form data-target = "additional" id="additional" class="layui-form" lay-filter="search_form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="state">
                                <option value="">追评状态</option>
                                <option value="0">等待追评</option>
                                <option value="1">已追评，待商家审核</option>
                                <option value="2">完成追评</option>
                                <option value="3">已取消追评</option>
                            </select>
                        </div>
                        <div class="layui-input-inline select_box">
                            <select name="key">
                                <option value="tasksn">任务编号</option>
                                <option value="ordersn">订单编号</option>
                                <option value="shopname">店铺名称</option>
                                <option value="wangwang">买号名称</option>
                                <option value="commodity_id">商品ID</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value"  placeholder="输入相关信息搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="time">
                                <option value="paytime">支付时间</option>
                                <option value="catchertime">接手时间</option>
                                <option value="issuetime">发布时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="start" class="layui-input" autocomplete="off" id="aev-start">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="end" class="layui-input" autocomplete="off" id="aev-end">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="failure_search" class="search_box hide">
            <form data-target = "failure" id="failure" class="layui-form search_form" lay-filter="search_form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="tasktype">
                                <option value="">任务分类</option>
                                <option value="1">销量任务</option>
                                <option value="5">预约任务</option>
                                <option value="7">猜你喜欢</option>
                                <option value="8">多链接任务</option>
                                <option value="10">标签任务</option>
                                <option value="11">微淘任务</option>
                            </select>
                        </div>
                        <div class="layui-input-inline select_box">
                            <select name="key">
                                <option value="shopname">店铺名称</option>
                                <option value="commodity_id">商品ID</option>
                                <option value="keyword">关键词</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value"  placeholder="输入相关信息搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="time">
                                <option value="issuetime">发布时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="start" class="layui-input" autocomplete="off" id="f-start">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="end" class="layui-input" autocomplete="off" id="f-end">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="logistics_search" class="search_box hide">
            <form data-target = "logistics" id="logistics" class="layui-form" lay-filter="search_form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="state">
                                <option value="">发货状态</option>
                                <option value="0">待发货</option>
                                <option value="1">已生成电子面单，等待回填</option>
                                <option value="2">已发货</option>
                                <option value="3">快递已签收，等待用户确认收货</option>
                                <option value="4">用户已确认收货</option>
                                <option value="5">管理员取消收货提醒</option>
                                <option value="6">用户已拒收</option>
                                <option value="7">商家已发货或订单关闭</option>
                                <option value="8">取消发货</option>
                            </select>
                        </div>
                        <div class="layui-input-inline select_box">
                            <select name="key">
                                <option value="tasksn">任务编号</option>
                                <option value="l.ordersn">订单编号</option>
                                <option value="shopname">店铺名称</option>
                                <option value="wangwang">买号名称</option>
                                <option value="commodity_id">商品ID</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value"  placeholder="输入相关信息搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="time">
                                <option value="paytime">支付时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="start" class="layui-input" autocomplete="off" id="wl-start">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="end" class="layui-input" autocomplete="off" id="wl-end">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="FAQs_search" class="search_box hide">
            <form data-target="FAQs" id="FAQs" class="layui-form search_form" lay-filter="search_form">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="status">
                                <option value="">问答状态</option>
                                <option value="0">邀请我答复</option>
                                <option value="1">等待用户回答</option>
                                <option value="2">问答完成</option>
                                <option value="3">已取消</option>
                                <option value="4">已过有效回答时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline select_box">
                            <select name="key">
                                <option value="shopname">店铺名称</option>
                                <option value="p.commodity_id">商品ID</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value"  placeholder="输入相关信息搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-input-inline select_box">
                            <select name="time">
                                <option value="addtime">提问时间</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="start" class="layui-input" autocomplete="off" id="FAQs_start">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="end" class="layui-input" autocomplete="off" id="FAQs_end">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
                    </div>
                </div>
            </form>
        </div>
        <div id="task_lists" class="layui-tab-content"></div>
    </div>
    <script src="/js/task/task.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>  	</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

