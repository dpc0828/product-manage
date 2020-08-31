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
        <form id="details-form" class="layui-form" action="javascript:;">
            <div class="layui-form-item">
                <label class="layui-form-label">店铺类型</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux">
                        <span>
                            <?php
                            if($info['shop_type'] == 1) {
                                echo '天猫';
                            } elseif ($info['shop_type'] == 3) {
                                echo '阿里巴巴';
                            } else {
                                echo '淘宝';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">掌柜号</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php echo $info['manager'];?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">店铺名</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php echo $info['shop_name'];?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">店铺性质</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux">
                        <span>
                            <?php
                            if($info['shop_nature'] == 1) {
                                echo '公司';
                            } else {
                                echo '个人';
                            }
                            ?>
                        </span>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">类目</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php echo $info['shop_cate'];?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发货人</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php echo $info['sender_name'];?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发货人号码</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span><?php echo $info['send_phone'];?></span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发货省市区</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span>四川  成都 新都区</span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">发货详细地址</label>
                <div class="layui-input-block">
                    <div class="layui-form-mid layui-word-aux"><span>成都国际美博城1楼1179-1180、1200、1209号</span></div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">店铺截图</label>
                <div class="layui-input-block">
                    <img src="<?php echo \app\utils\Utils::fullImageUrl($info['business_consultan']);?>" width="300" alt="生意参谋截图"  />
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

