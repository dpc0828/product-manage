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
<!--头部logo、用户信息、导航栏end-->
<div class="col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-offset-0">
    <link href="/css/user/user.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <div id="shop-details" class="padding-2">
        <h4 class="text-center">商品详细信息</h4>
        <form id="details-form" class="layui-form" action="javascript:;">
            <div class="layui-form-item">
                <label class="layui-form-label">掌柜号</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php if(!empty($info)){echo  $info['manager'];} ?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">店铺名</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php if(!empty($info)){echo  $info['shop_name'];} ?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品链接</label>
                <div class="layui-input-block">
                    <a target="_blank" href="<?php if(!empty($info)){echo  $info['product_link'];} ?>">
                        <?php if(!empty($info)){echo  $info['product_link'];} ?>
                    </a>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品标题</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php if(!empty($info)){echo  $info['product_title'];} ?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品简称</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php if(!empty($info)){echo  $info['product_shortname'];} ?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品ID</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php if(!empty($info)){echo  $info['product_id'];} ?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">PC商品主图</label>
                <div class="layui-input-block">
                    <img width="350" src="<?php if(!empty($info)){echo  \app\utils\Utils::fullImageUrl($info['index_image']);} ?>" alt="PC端商品主图" />
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

