
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

<!--头部logo、用户信息、导航栏end-->
<div class="col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-offset-0">
    <link href="/css/user/user.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <div id="box" class="layui-row">
        <div id="left" class="layui-col-md2">
            <ul id="sidenav">
                <li data-anchor = "basics-info" class="active_li">基本资料</li>
<!--                <li data-anchor = "assistant-manage">小助理</li>-->
                <li data-anchor = "shop-manage">店铺管理</li>
                <li data-anchor = "product-manage">商品管理</li>
<!--                <li data-anchor = "invite-friends">邀请好友</li>-->
            </ul>
        </div>
        <div id="right" class="layui-col-md10"></div>
    </div>
    <script src="/js/user/user.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>  	</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

