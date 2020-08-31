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
    <link href="/css/user/user.css" rel="stylesheet" type="text/css">
    <div class="padding-2">
        <blockquote class="layui-elem-quote layui-quote-nm suspend_shadow">
            <p>【设置须知】</p>
            <p>1、请合理设置百分比，把买手的购买行为轨迹打散，提高做单的安全性。</p>
        </blockquote>
        <br />
        <form class="layui-form narrow_2" id="behavior" action="javascript:;" lay-filter="behavior">
            <input type="hidden" name="tag" value="" />
            <div class="layui-form-item" id="set_sex">
                <div class="layui-inline">
                    <div class="layui-input-inline">收藏店铺</div>
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="number" name="bookmark" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <div class="layui-form-item" id="set_sex">
                <div class="layui-inline">
                    <div class="layui-input-inline">收藏商品</div>
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="number" name="c_goods" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <div class="layui-form-item" id="set_sex">
                <div class="layui-inline">
                    <div class="layui-input-inline">加入购物车</div>
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="number" name="add_car" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <div class="layui-form-item" id="set_sex">
                <div class="layui-inline">
                    <div class="layui-input-inline">拍前咨询</div>
                </div>
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="number" name="talk" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <div class="layui-form-item" id="set_sex">
                <div class="layui-inline">
                    <div class="layui-input-inline">货比N家</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">不货比</label>
                    <div class="layui-input-inline">
                        <input type="number" name="compare[not]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">货比一家</label>
                    <div class="layui-input-inline">
                        <input type="number" name="compare[com1]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">货比两家</label>
                    <div class="layui-input-inline">
                        <input type="number" name="compare[com2]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">货比三家</label>
                    <div class="layui-input-inline">
                        <input type="number" name="compare[com3]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <div class="layui-form-item" id="set_sex">
                <div class="layui-inline">
                    <div class="layui-input-inline">浏览深度</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">不浏览</label>
                    <div class="layui-input-inline">
                        <input type="number" name="browse[net]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">店内一款</label>
                    <div class="layui-input-inline">
                        <input type="number" name="browse[shop1]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">店内两款</label>
                    <div class="layui-input-inline">
                        <input type="number" name="browse[shop2]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">店内三款</label>
                    <div class="layui-input-inline">
                        <input type="number" name="browse[shop3]" oninput="Tools.clearNaN(this)" autocomplete="off" class="layui-input Sex">
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <hr />
        </form>
    </div>
    <script src="/js/user/user.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script>
        <?php if(!empty($info)) { ?>
        layui.use('form', function(){
            var form = layui.form;
            form.val("behavior", {
                //性别
                "bookmark": "<?php if(!empty($info['shop_collection_percent'])) { echo $info['shop_collection_percent'] * 100;}  ?>",
                "c_goods": "<?php if(!empty($info['product_collection_percent'])) { echo $info['product_collection_percent'] * 100;}  ?>",
                "add_car": "<?php if(!empty($info['add_cart_percent'])) { echo $info['add_cart_percent'] * 100;}  ?>",
                "talk": "<?php if(!empty($info['chat_percent'])) { echo $info['chat_percent'] * 100;}  ?>",

                "compare[not]": "<?php if(!empty($info['product_contrast_percent_0'])) { echo $info['product_contrast_percent_0'] * 100;}  ?>",
                "compare[com1]": "<?php if(!empty($info['product_contrast_percent_1'])) { echo $info['product_contrast_percent_1'] * 100;}  ?>",
                "compare[com2]": "<?php if(!empty($info['product_contrast_percent_2'])) { echo $info['product_contrast_percent_2'] * 100;}  ?>",
                "compare[com3]": "<?php if(!empty($info['product_contrast_percent_3'])) { echo $info['product_contrast_percent_3'] * 100;}  ?>",

                "browse[net]": "<?php if(!empty($info['scan_percent_0'])) { echo $info['scan_percent_0'] * 100;}  ?>",
                "browse[shop1]": "<?php if(!empty($info['scan_percent_1'])) { echo $info['scan_percent_1'] * 100;}  ?>",
                "browse[shop2]": "<?php if(!empty($info['scan_percent_2'])) { echo $info['scan_percent_2'] * 100;}  ?>",
                "browse[shop3]": "<?php if(!empty($info['scan_percent_3'])) { echo $info['scan_percent_3'] * 100;}  ?>",
            });
            form.render();
        });
        <?php } ?>
        $('#behavior').find('input').prop('readonly', true);
    </script>  	</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

