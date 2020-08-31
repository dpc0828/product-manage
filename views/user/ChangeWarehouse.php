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
    <div class="padding-2">
        <blockquote class="layui-elem-quote layui-quote-nm suspend_shadow">
            <p>【 温馨提醒 】</p>
            <p>1、快递是真实发货的，不是空包。</p>
            <p>
                <strong>2、为了保障安全性，请把所选仓库的详细地址添加到淘宝后台的地址库！</strong>
            </p>
        </blockquote>
        <div class="narrow_2">
            <form class="layui-form search_form" id="wh_form" action="javascript:;" method="post">
                <input type="hidden" name="tag" value="<?php if(!empty($info)) { echo  $info['id'];} ?>" />
                <div class="layui-form-item">
                    <label class="layui-form-label">掌柜号</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux"><span><?php if(!empty($info)) { echo  $info['manager'];} ?></span></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">店铺名</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux"><span><?php if(!empty($info)) { echo  $info['shop_name'];} ?></span></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label _required">寄件人姓名</label>
                    <div class="layui-input-block">
                        <input type="text" name="consigner" value="<?php if(!empty($info)) { echo  $info['sender_name'];} ?>"  placeholder="请输入寄件人的姓名" autocomplete="off" class="layui-input width-30">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label _required">手机号码</label>
                    <div class="layui-input-block">
                        <input type="text" name="mobile" value="<?php if(!empty($info)) { echo  $info['send_phone'];} ?>" placeholder="请输入寄件人的手机号码" autocomplete="off" class="layui-input width-30">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">选择仓库</label>
                    <div class="layui-input-block">
                        <input
                            type="radio"
                            name="wh_id"
                            value="5"
                            checked
                            title="申通快递 - 洗衣粉 - 广州"
                        />
                        <p class="layui-word-aux">
                            <small>
                                <span>仓库地址：广东省广州市白云区广从三路</span>
                                &nbsp;&nbsp;
                                <a
                                    href="javascript:;"
                                    onclick="Tools.copyContent('广东省广州市白云区广从三路')"
                                >复制</a>
                            </small>
                        </p>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <?php if(!empty($info)) { ?>
                        <button class="layui-btn" onclick="submitWh();">立即提交</button>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/common/jquery.form.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/user/user.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>  	</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

