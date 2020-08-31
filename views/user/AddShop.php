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
        <blockquote class="layui-elem-quote">
            <p>【 温馨提示 】</p>
            <p>1、快递是真实寄出的，发的是礼品。</p>
            <p>
                <strong>2、为了保障安全性，请把所选仓库的详细地址添加到淘宝后台的地址库！</strong>
            </p>
        </blockquote>
        <div class=""">
        <form id="binding-shop"  class="layui-form search_form" action="javascript:;" method="post" lay-filter="binding-shop">
            <div class="layui-card">
                <div class="layui-card-header">基本信息</div>
                <div class="layui-card-body">
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">店铺类型</label>
                        <div class="layui-input-block">
                            <input type="radio" name="type" class="layui-input" value="0" title="淘宝" checked="checked">
                            <input type="radio" name="type" class="layui-input" value="1" title="天猫">
                            <input type="radio" name="type" class="layui-input" value="3" title="阿里巴巴">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">掌柜号</label>
                        <div class="layui-input-block">
                            <input type="text" name="manager" placeholder="请输入掌柜号" autocomplete="off" class="layui-input width-30">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">店铺名</label>
                        <div class="layui-input-block">
                            <input type="text" name="shopname" placeholder="请输入店铺名" autocomplete="off" class="layui-input width-30">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">所属类目</label>
                        <div class="layui-input-block width-30">
                            <select name="category" lay-verify="required" class="layui-input">
                                <option value="">请选择店铺所属类目</option>
                                <option value="潮流女装">潮流女装</option>
                                <option value="时尚男装">时尚男装</option>
                                <option value="鞋子箱包">鞋子箱包</option>
                                <option value="数码家电">数码家电</option>
                                <option value="美食特产">美食特产</option>
                                <option value="居家日用">居家日用</option>
                                <option value="母婴用品">母婴用品</option>
                                <option value="珠宝配饰">珠宝配饰</option>
                                <option value="家装家纺">家装家纺</option>
                                <option value="住宅家具">住宅家具</option>
                                <option value="车品车饰">车品车饰</option>
                                <option value="运动户外">运动户外</option>
                                <option value="家庭保健">家庭保健</option>
                                <option value="中老年用">中老年用</option>
                                <option value="护肤彩妆">护肤彩妆</option>
                                <option value="百货食品">百货食品</option>
                                <option value="其它类目">其它类目</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">店铺性质</label>
                        <div class="layui-input-block width-30">
                            <select name="their" lay-verify="required" class="layui-input">
                                <option value=""></option>
                                <option value="0">个人</option>
                                <option value="1">公司</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-card">
                <div class="layui-card-header">发货信息（<strong>此信息只用于平台发货使用。不用平台发货的，不用在意此项，随意填一个信息即可。</strong>）</div>
                <div class="layui-card-body">
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">寄件人姓名</label>
                        <div class="layui-input-block">
                            <input type="text" name="consigner"  placeholder="请输入寄件人的姓名" autocomplete="off" class="layui-input width-30">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">手机号码</label>
                        <div class="layui-input-block">
                            <input type="text" name="mobile"  placeholder="请输入寄件人的手机号码" autocomplete="off" class="layui-input width-30">
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">选择仓库</label>
                        <div class="layui-input-block">
                            <input
                                type="radio"
                                name="wh_id"
                                value="5"
                                title="申通快递 - 发洗衣粉 - 广州仓"
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
                </div>
                <div class="layui-card-header layui-word-aux">
                    【 关于平台发货 】平台发的是礼品，是真实寄出的。发货地址是指定的仓库地址。
                </div>
            </div>
            <div class="layui-card">
                <div class="layui-card-header">上传截图</div>
                <div class="layui-card-body">
                    <div class="layui-form-item">
                        <label class="layui-form-label _required">
                            <span>生意参谋</span>
                            <p align="center"><a href="javascript:;" onclick="window.open(args.sampleGraph.staffTmp)"><small>查看示例图</small></a></p>
                        </label>
                        <div class="layui-input-block case">
                            <input width="2px" name="staff" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" id="submit-binding" onclick="submitBinding()">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
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
    layui.use('form', function(){
        form = layui.form;
        form.val("binding-shop", {
            'type': '',
            'manager': '',
            'shopname': '',
            'their': '',
            'category': '',
            'consigner': '',
            'mobile': '',
            'address': '',
            'group_pwd': '',
        })
        pca.init('select[name=P1]', 'select[name=C1]', 'select[name=A1]', '', '', '');
    });
</script>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

