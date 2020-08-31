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
    <link href="/css/common/upload/dropify.min.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <style>
        body {background-color: #F2F2F2;}
    </style>
    <div class="padding-2">
        <div class=""">
        <form id="binding-shop"  class="layui-form search_form" action="javascript:;" method="post" lay-filter="binding-shop">
            <div>
                <hr>
                <blockquote class="layui-elem-quote">
                    如需发布【 提前购 】任务（新玩法，上架前就把销量提上去），请上传淘宝加群二维码以及进群密码
                </blockquote>
                <br>
                <div class="layui-form-item">
                    <label class="layui-form-label">
                        <span>加群二维码（选填）</span>
                    </label>
                    <div class="layui-input-block case">
                        <input width="2px" name="qrcode" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                        <input type="hidden" value="0" name="del_state">
                    </div>
                    <br>
                    <p class="AddOrdertime layui-word-aux" style="margin-left: 3.9rem;">
                        获取淘宝加群二维码，请登录：<a href="http://liao.taobao.com" target="_blank">liao.taobao.com</a>。
                        <a
                            href="javascript:;"
                            onclick="window.open(args.sampleGraph.GroupGrCodeTmp)"
                        >登录后如何获取？</a>
                    </p>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">进群密码<br>（选填）</label>
                    <div class="layui-input-block">
                        <input type="text" name="group_pwd" placeholder="如果进群需要密码，请设置，否则买家无法加群完成任务" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <hr>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <?php if(!empty($info)) { ?>
                    <button class="layui-btn" id="submit-binding" onclick="submitChangeQrcode(<?php echo $info['id']; ?>)">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="/js/common/dropify.min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
<script src="/js/common/jquery.form.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
<script src="/js/user/citys.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
<script src="/js/user/user.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $('input[name=staff]').dropify();
    var qrcode_obj = $('input[name=qrcode]').dropify();
    //当删除无线主图之类的，为清空数据做准备
    qrcode_obj.on('dropify.afterClear',
        function(event, element) {
            $("input[name=del_state]").val(1);
        });

    <?php if(!empty($info)) { ?>
    layui.use('form', function(){
        form = layui.form;
        form.val("binding-shop", {
            'type': '<?php echo $info["shop_type"]; ?>',
            'manager': '<?php echo $info["manager"]; ?>',
            'shopname': '<?php echo $info["shop_name"]; ?>',
            'their': '<?php echo $info["shop_nature"]; ?>',
            'category': '<?php echo $info["shop_cate"]; ?>',
            'consigner': '<?php echo $info["sender_name"]; ?>',
            'mobile': '<?php echo $info["send_phone"]; ?>',
            'address': '广东省广州市白云区广从三路',
            'group_pwd': '',
        })
        pca.init('select[name=P1]', 'select[name=C1]', 'select[name=A1]', '四川', '成都', '新都区');
    });
    <?php } ?>
</script>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

