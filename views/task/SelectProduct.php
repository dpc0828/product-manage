<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title><?php echo \app\utils\Utils::webSiteTitle(); ?></title>
    <?php echo \app\utils\Utils::getCsrfMeta(); ?>
    <script src="/js/common/jquery.min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/layer/layui.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/common.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link href="/css/layui/layui.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/common.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/bootsnav.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/bootstrap.min.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link id="layuicss-layer" rel="stylesheet" href="/js/common/layer/css/modules/layer/default/layer.css?v=<?php echo \app\utils\Utils::version(); ?>" media="all">
    <link id="layuicss-laydate" rel="stylesheet" href="/js/common/layer/css/modules/laydate/default/laydate.css?v=<?php echo \app\utils\Utils::version(); ?>" media="all">
    <head>
<body>
<!--头部logo、用户信息、导航栏end-->
<div class="col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-offset-0">
    <link href="/css/task/release.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <div class="padding-2">
        <div id="search_box" class="text-center">
            <form id="search_form" class="layui-form" action="/task/select-product?type=<?php echo $type; ?>&tag=<?php echo $tag; ?>" lay-filter="search_form">
                <input type="hidden" name="tag" value="<?php echo $tag; ?>" />
                <input type="hidden" name="type" value="<?php echo $type; ?>" />
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <div class="layui-form-mid">选择店铺</div>
                        <div class="layui-input-inline select_box">
                            <select name="sid" lay-verify="required">
                                <option value="">选择商品所属店铺</option>
                                <?php if(!empty($shop)) { ?>
                                    <?php foreach ($shop as $shop_li) { ?>
                                        <option <?php if($sid == $shop_li['id']) { echo  "selected";} ?> value="<?php echo $shop_li['id']; ?>"><?php echo $shop_li['shop_name']; ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <div class="layui-form-mid">商品信息</div>
                        <div class="layui-input-inline select_box">
                            <select name="key" lay-verify="required">
                                <option <?php if($key == 'commodity_id') { echo  "selected";} ?> value="commodity_id">商品ID</option>
                                <option <?php if($key == 'commodity_abbreviation') { echo  "selected";} ?> value="commodity_abbreviation">商品名称</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="search_value" value="<?php echo $search_value; ?>" placeholder="输入相关信息以匹配搜索" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn layui-btn-radius layui-btn-primary" lay-submit lay-filter="search_form" style="display: inline-block;">搜&nbsp;索</button>
                    </div>
                </div>
            </form>
        </div>
        <form class="layui-form" action="javascript:;" lay-filter="select_form">
            <div id="task_lists" class="layui-tab-content">
                <table class="layui-table" lay-size="lg">
                    <colgroup>
                        <col width="119">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                    <tr>
                        <th id="tipObj">选择商品</th>
                        <th>店铺名</th>
                        <th>简称</th>
                        <th>主图</th>
                        <th>商品ID</th>
                        <th>商品标题</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($list)) { ?>
                        <?php foreach ($list as $p) {?>
                            <tr align="center">
                                <td class="layui-form" lay-filter="selPro">
                                    <input <?php if($type == 1) { ?> type="checkbox" name="pro[]" lay-skin="primary" <?php } else { ?> type="radio" name="pro" <?php } ?> value="51100" title="" >
                                </td>
                                <td id="shopname"><?php echo $p['shopname']; ?></td>
                                <td id="abbreviation"><?php echo $p['commodity_abbreviation']; ?></td>
                                <td id="master_image" onclick="dialog.showImg('<?php echo \app\utils\Utils::fullImageUrl($p['commodity_image']); ?>', '' +
                                        '<?php echo $p['commodity_title']; ?>')"><img src="<?php echo \app\utils\Utils::fullImageUrl($p['commodity_image']); ?>" width="80%" alt="找不到商品主图..." /></td>
                                <td id="commodity_id"><?php echo $p['commodity_id'];?></td>
                                <td id="title"><?php echo $p['commodity_title']; ?></td>
                                <td id="url" class="hide"><?php echo $p['product_link']; ?></td>
                                <td id="img" class="hide"><?php echo \app\utils\Utils::fullImageUrl($p['commodity_image']); ?></td>
                                <td id="pid" class="hide"><?php echo $p['id']; ?></td>
                                <td id="sid" class="hide"><?php echo $p['shop_id']; ?></td>
                            </tr>
                        <?php } ?>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div>
<!--                <div class="layui-form-mid layui-word-aux">-->
<!--                    &nbsp;&nbsp;&nbsp;<i class="layui-icon layui-icon-tips _tips" data-tipmsg="如果您需要，系统将根据您选择的商品，从您以前发布过的任务当中，帮您筛查出最多设置（即：设置次数最多） / 最近设置（即：最近一次设置）的一个关键词、价格、快递费、拍下件数、备注等信息，并填到对应的栏里，轻松发布任务~"></i>&nbsp;帮我预填充一些数据？-->
<!--                </div>-->
<!--                <input type="radio" name="helpMe" value="0" title="不需要" lay-filter="helpMe" checked>-->
<!--                <input type="radio" name="helpMe" value="1" title="最多设置" lay-filter="helpMe">-->
<!--                <input type="radio" name="helpMe" value="2" title="最近设置" lay-filter="helpMe">-->
            </div>
        </form>
        <div id="reserved"></div>
    </div>
    <div class="btn-box" id="selProBox">
        <button class="ayui-btn layui-btn-radius layui-btn-primary type-btn" onclick="sureSelect(<?php echo $type; ?>)">确定选择</button>
    </div>
    <script src="/js/task/release.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script>
        layui.use('form', function(){
            var form = layui.form,
                helpMe = localStorage.getItem("select_helpMe_value");
            if (helpMe != null)
            {
                form.val("select_form", {
                    'helpMe': helpMe,
                })
            }
            form.render();
        });
        dialog.tips("如果您在淘宝后台更新了商品主图，记得去商品管理同步更新哦~", "#tipObj", 0, 1);
    </script>  	</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

