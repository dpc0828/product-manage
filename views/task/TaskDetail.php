<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title><?php echo \app\utils\Utils::webSiteTitle(); ?></title>
    <?php echo \app\utils\Utils::getCsrfMeta(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <script src="/js/common/jquery.min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/layer/layui.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/common.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <link href="/css/common/upload/dropify.min.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <link href="/css/task/task.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <link href="/css/layui/layui.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div style="padding: 1em;">
    <fieldset class="layui-elem-field">
        <legend><span class="layui-badge layui-bg-blue">任务基本信息</span></legend>
        <div class="layui-field-box">
            <p>任务分类：<?php echo \app\utils\ProductReleaseUtils::taskType($task['task_type']); ?></p>
            <p>任务终端：<?php echo \app\utils\ProductReleaseUtils::flowType_Browser($flow['flow_type']); ?></p>
            <p>流量入口：<?php echo \app\utils\ProductReleaseUtils::flowType($flow['flow_type']); ?></p>
            产品设置：<!--<span class="layui-badge"></span>-->「型号：<?php echo $task_product['sku'] ?>」= <?php echo $task_product['price'] ?> * <?php echo $task_product['buy_quantity'] ?>
<!--            <span class="layui-badge layui-bg-orange">副</span>「型号：默认」= 278 * 1-->
            <p>费用相关：佣金（<?php echo $task_product['commission']; ?> 元 / 单）</p>
            <p>任务备注：<?php echo $task['remark']; ?>
            </p>
            <p>买号常购类目：<?php echo $task['usually_cate']; ?></p>
            <!--标签任务详情-->
        </div>
    </fieldset>
</div>
<div style="padding: 1em;">
    <fieldset class="layui-elem-field">
        <legend><span class="layui-badge layui-bg-blue">任务时间</span></legend>
        <?php if(!empty($release)) {foreach ($release as $re){ ?>
            <div class="layui-field-box">
                <p>发布时间：<?php echo $task['create_time']; ?></p>
                <p>
                    发布类型：<?php echo \app\utils\ProductReleaseUtils::release_type($re['release_type']); ?>
                </p>
                <?php if($re['release_type'] == 3) { ?>
                    <p>关键词：<?php echo $flow['target_keyword']; ?></p>
                <?php } ?>
                <p>开始<?php echo $re['release_type'] == 2 ? '平均' : ''; ?>发布时间：<?php echo $re['start_time']; ?></p>
                <p>结束<?php echo $re['release_type'] == 2 ? '平均' : ''; ?>发布时间：<?php echo $re['end_time']; ?></p>
                <p>失效时间：<?php echo $re['timeout_time']; ?></p>
            </div>
            <br />
        <?php }} ?>
    </fieldset>
</div>
<div style="padding: 1em;">
    <fieldset class="layui-elem-field">
        <legend><span class="layui-badge layui-bg-blue">商品搜索</span></legend>
        <div class="layui-field-box">
            <p>搜索关键词：<?php echo $flow['target_keyword']; ?></p>
            <p>搜索来路：<?php echo \app\utils\ProductReleaseUtils::flowType_Browser($flow['flow_type']); ?></p>
            <p>条件筛选-发货城市：<?php echo $flow['sendaddress']; ?></p>
            <p>条件筛选-价格区间：<?php echo $flow['price_min']; ?> - <?php echo $flow['price_max']; ?></p>
            <p>条件筛选-排序方式：综合</p>
            <p>条件筛选-其它：<?php echo $flow['other']; ?></p>
        </div>
    </fieldset>
</div>
<div style="padding: 1em;">
    <fieldset class="layui-elem-field">
        <legend><span class="layui-badge layui-bg-blue">商品信息</span></legend>
        <div class="layui-field-box">
            <p>归属店铺：<?php echo $shop['shop_name']; ?></p>
            <p>商品标题：<?php echo $product['product_title']; ?></p>
            <p>商品ID：<?php echo $product['product_id']; ?></p>
            <p>商品链接：<a target="_blank" href="<?php echo $product['product_link']; ?>"><?php echo $product['product_link']; ?></a></p>
            <br />
            <p>主图：<img src="<?php echo \app\utils\Utils::fullImageUrl($product['index_image']); ?>" width="300" alt="获取主图失败..."/></p>
        </div>
    </fieldset>
</div>
<!--<div style="padding: 1em;">-->
<!--    <fieldset class="layui-elem-field">-->
<!--        <legend><span class="layui-badge layui-bg-blue">副宝贝信息1</span></legend>-->
<!--        <div class="layui-field-box">-->
<!--            <p>归属店铺：喀秋莎手工定制女鞋</p>-->
<!--            <p>商品标题：2020年秋冬季新款复古平底绑带短靴女英伦风方头厚底真皮马丁靴潮</p>-->
<!--            <p>商品ID：624151988830</p>-->
<!--            <p>商品链接：<a target="_blank" href="https://item.taobao.com/item.htm?spm=a2oq0.12575281.0.0.51811debHKdlpM&ft=t&id=624151988830">https://item.taobao.com/item.htm?spm=a2oq0.12575281.0.0.51811debHKdlpM&ft=t&id=624151988830</a></p>-->
<!--            <br />-->
<!--            <p>主图：<img src="/images/product/2020/08/8c08322777c4ccae47ea2f05a98ba887S24187.jpg" width="300" alt="获取主图失败..."/></p>-->
<!--        </div>-->
<!--    </fieldset>-->
<!--</div>-->

</body>
</html>