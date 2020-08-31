<?php $_static_version = \app\utils\Utils::version(); ?>
<link rel="stylesheet" href="/admin/static/plugin/css/bootstrap.min.css?v=<?php echo $_static_version; ?>" />
<link rel="stylesheet" href="/admin/static/plugin/font-awesome/4.5.0/css/font-awesome.min.css?v=<?php echo $_static_version; ?>" />
<link rel="stylesheet" href="/admin/static/plugin/css/fonts.googleapis.com.css?v=<?php echo $_static_version; ?>" />
<!-- ace styles -->
<link rel="stylesheet" href="/admin/static/plugin/css/ace.min.css?v=<?php echo $_static_version; ?>" class="ace-main-stylesheet" id="main-ace-style" />
<!--[if lte IE 9]>
<link rel="stylesheet" href="/admin/static/plugin/css/ace-part2.min.css?v=<?php echo $_static_version; ?>" class="ace-main-stylesheet" />
<![endif]-->
<link rel="stylesheet" href="/admin/static/plugin/css/ace-skins.min.css?v=<?php echo $_static_version; ?>" />
<link rel="stylesheet" href="/admin/static/plugin/css/ace-rtl.min.css?v=<?php echo $_static_version; ?>" />
<!--[if lte IE 9]>
    <link rel="stylesheet" href="/admin/static/plugin/css/ace-ie.min.css?v=<?php echo $_static_version; ?>" />
<![endif]-->
<div class="col-sm-12">
    <div class="well">
        <h4 class="green smaller lighter">任务基本信息</h4>
        <p>任务分类：<?php echo \app\utils\ProductReleaseUtils::taskType($task['task_type']); ?></p>
        <p>任务终端：<?php echo \app\utils\ProductReleaseUtils::flowType_Browser($flow['flow_type']); ?></p>
        <p>流量入口：<?php echo \app\utils\ProductReleaseUtils::flowType($flow['flow_type']); ?></p>
        <p>产品设置：「型号：<?php echo $task_product['sku'] ?>」= <?php echo $task_product['price'] ?> * <?php echo $task_product['buy_quantity'] ?></p>
        <p>费用相关：佣金（<?php echo $task_product['commission']; ?> 元 / 单）</p>
        <p>任务备注：<?php echo $task['remark']; ?></p>
        <p>买号常购类目：<?php echo $task['usually_cate']; ?></p>
        <?php if(!empty($task['remark'])) { ?>
            <p>任务备注：<?php echo $task['remark']; ?></p>
        <?php } ?>

        <?php if(!empty($task['task_waring'])) { ?>
            <p><span class="badge badge-yellow">任务确认前提醒</span>：<?php echo $task['task_waring']; ?></p>
        <?php } ?>
    </div>

    <div class="well">
        <h4 class="green smaller lighter">任务时间</h4>
        <p>发布时间：<?php echo $task['create_time']; ?></p>
        <p>
            发布类型：<?php echo \app\utils\ProductReleaseUtils::release_type($release['release_type']); ?>
        </p>
        <?php if($release['release_type'] == 3) { ?>
            <p>关键词：<?php echo $flow['target_keyword']; ?></p>
        <?php } ?>
        <p>开始<?php echo $release['release_type'] == 2 ? '平均' : ''; ?>发布时间：<?php echo $release['start_time']; ?></p>
        <p>结束<?php echo $release['release_type'] == 2 ? '平均' : ''; ?>发布时间：<?php echo $release['end_time']; ?></p>
        <p>失效时间：<?php echo $release['timeout_time']; ?></p>

        <?php if($task['state'] == 12) { ?>
            <p>失效原因：<?php echo $task['cancel_remark']; ?></p>
        <?php } ?>
    </div>

    <div class="well">
        <h4 class="green smaller lighter">商品搜索</h4>
        <p>搜索关键词：<?php echo $flow['target_keyword']; ?></p>
        <p>搜索来路：<?php echo \app\utils\ProductReleaseUtils::flowType_Browser($flow['flow_type']); ?></p>
        <p>条件筛选-发货城市：<?php echo $flow['sendaddress']; ?></p>
        <p>条件筛选-价格区间：<?php echo $flow['price_min']; ?> - <?php echo $flow['price_max']; ?></p>
        <p>条件筛选-排序方式：综合</p>
        <p>条件筛选-其它：<?php echo $flow['other']; ?></p>
    </div>

    <div class="well">
        <h4 class="green smaller lighter">目标客户</h4>
        <p>搜索关键词：<?php echo $flow['target_keyword']; ?></p>
        <p>搜索来路：<?php echo \app\utils\ProductReleaseUtils::flowType_Browser($flow['flow_type']); ?></p>
        <p>条件筛选-发货城市：<?php echo $flow['sendaddress']; ?></p>
        <p>条件筛选-价格区间：<?php echo $flow['price_min']; ?> - <?php echo $flow['price_max']; ?></p>
        <p>条件筛选-排序方式：综合</p>
        <p>条件筛选-其它：<?php echo $flow['other']; ?></p>
    </div>


    <div class="well">
        <h4 class="green smaller lighter">购买行为</h4>
        <?php
            $buy_setting = \app\utils\ProductReleaseUtils::buyerSetting($product['buy_setting']);
            if(!empty($buy_setting)) {
                foreach ($buy_setting as $buy_li) {
        ?>
                    <p><?php echo $buy_li; ?></p>
        <?php }} ?>
    </div>

    <div class="well">
        <h4 class="green smaller lighter">目标客户</h4>
        <?php
        $cus_setting = \app\utils\ProductReleaseUtils::customerSetting($product['customer_setting']);
        if(!empty($cus_setting)) {
            foreach ($cus_setting as $cus_li) {
                ?>
                <p><?php echo $cus_li; ?></p>
            <?php }} ?>
    </div>

    <?php if(!empty($addvalue)) { ?>
    <div class="well">
        <h4 class="green smaller lighter">流量任务
        </h4>
        <p>收藏商品： 比例:<?php echo $addvalue['collect_pro_percent'] * 100; ?>%&nbsp;&nbsp;&nbsp;&nbsp;数量<?php echo $addvalue['collect_pro_quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;佣金<?php echo $addvalue['collect_pro_fee']; ?></p>
        <p>推荐商品：比例:<?php echo $addvalue['recommend_pro_percent'] * 100; ?>%&nbsp;&nbsp;&nbsp;&nbsp;数量<?php echo $addvalue['recommend_pro_quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;佣金<?php echo $addvalue['recommend_pro_fee']; ?></p>
        <p>关注店铺：比例:<?php echo $addvalue['collect_shop_percent'] * 100; ?>%&nbsp;&nbsp;&nbsp;&nbsp;数量<?php echo $addvalue['collect_shop_quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;佣金<?php echo $addvalue['collect_shop_fee']; ?></p>
        <p>加入购物车：比例:<?php echo $addvalue['add_cart_percent'] * 100; ?>%&nbsp;&nbsp;&nbsp;&nbsp;数量<?php echo $addvalue['add_cart_quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;佣金<?php echo $addvalue['add_cart_fee']; ?></p>
        <p>旺旺咨询：比例:<?php echo $addvalue['chat_percent'] * 100; ?>%&nbsp;&nbsp;&nbsp;&nbsp;数量<?php echo $addvalue['chat_quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;佣金<?php echo $addvalue['chat_fee']; ?></p>
        <p>领优惠券：比例:<?php echo $addvalue['coupon_percent'] * 100; ?>%&nbsp;&nbsp;&nbsp;&nbsp;数量<?php echo $addvalue['coupon_quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;佣金<?php echo $addvalue['coupon_fee']; ?></p>
        <p>淘宝问大家：比例:<?php echo $addvalue['ask_percent'] * 100; ?>%&nbsp;&nbsp;&nbsp;&nbsp;数量<?php echo $addvalue['ask_quantity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;佣金<?php echo $addvalue['ask_fee']; ?></p>
        <?php if(!empty($addvalue['question_1'])) { ?>
            <p>问题：<?php echo $addvalue['question_1']; ?></p>
        <?php } ?>
        <?php if(!empty($addvalue['question_2'])) { ?>
            <p>问题：<?php echo $addvalue['question_2']; ?></p>
        <?php } ?>
        <?php if(!empty($addvalue['question_3'])) { ?>
            <p>问题：<?php echo $addvalue['question_3']; ?></p>
        <?php } ?>
        <?php if(!empty($addvalue['question_4'])) { ?>
            <p>问题：<?php echo $addvalue['question_4']; ?></p>
        <?php } ?>
        <?php if(!empty($addvalue['question_5'])) { ?>
            <p>问题：<?php echo $addvalue['question_5']; ?></p>
        <?php } ?>
    </div>
    <?php } ?>


    <div class="well">
        <h4 class="green smaller lighter">商品信息
        </h4>
        <p>归属店铺：<?php echo $shop['shop_name']; ?></p>
        <p>商品标题：<?php echo $product['product_title']; ?></p>
        <p>商品ID：<?php echo $product['product_id']; ?></p>
        <p>商品链接：<a target="_blank" href="<?php echo $product['product_link']; ?>"><?php echo $product['product_link']; ?></a></p>
        <br />
        <p>主图：<img src="<?php echo \app\utils\Utils::fullImageUrl($product['index_image']); ?>" width="300" alt="获取主图失败..."/></p>
        <?php if(!empty($product['app_index_image'])) { ?>
            <p>APP主图：<img src="<?php echo \app\utils\Utils::fullImageUrl($product['app_index_image']); ?>" width="300" alt="获取主图失败..."/></p>
        <?php } ?>

        <?php if(!empty($product['qrcode'])) { ?>
            <p>二维码：<img src="<?php echo \app\utils\Utils::fullImageUrl($product['qrcode']); ?>" width="300" alt="获取主图失败..."/></p>
        <?php } ?>
    </div>
</div>

