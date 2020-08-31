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
            填写商品信息
        </blockquote>
        <div>
            <form id="add-pro" class="layui-form search_form" action="javascript:;" method="post" lay-filter="handle-pro"  enctype="multipart/form-data">
                <input type="hidden" name="tag" value=""/>
                <div class="layui-card">
                    <div class="layui-card-header">商品基本信息</div>
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <label class="layui-form-label _required">店铺</label>
                            <div class="layui-input-block" style="width: 15em;">
                                <select name="manager" class="layui-input">
                                    <option value="">选择商品所属店铺</option>
                                    <?php if(!empty($shop)) { ?>
                                        <?php foreach ($shop as $shop_li) { ?>
                                            <option value="<?php echo $shop_li['id']; ?>"><?php echo $shop_li['shop_name']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <!--不使用小助理功能-->
                        <div class="layui-form-item">
                            <label class="layui-form-label _required">商品链接</label>
                            <div class="layui-input-block">
                                <input type="text" name="link"  placeholder="请输入商品链接" autocomplete="off" class="layui-input input-link">
                                <button class="layui-btn layui-btn-primary" onclick="getProductDetailsByUrl(this)" style="width: 13rem;">获取商品详情</button>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label _required">商品标题</label>
                            <div class="layui-input-block">
                                <input type="text" name="headline"  placeholder="请输入商品标题" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label _required">商品ID</label>
                            <div class="layui-input-block">
                                <input type="text" name="pid" onkeyup="Tools.clearNaN(this)"  placeholder="请输入商品ID" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item" id="unUserHelperPic">
                            <label class="layui-form-label _required">商品主图</label>
                            <div class="layui-input-block case">
                                <input width="2px" name="master" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                                <!--根据URL获取商品详情的时候，记录主图URL-->
                                <input type="hidden" name="masterHide" value=""  class="layui-input"/>
                            </div>
                        </div>
                        <!--使用小助理功能-->
                    </div>
                </div>

                <div class="layui-card">
                    <div class="layui-card-header">商品自定义信息</div>
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <label class="layui-form-label _required">商品简称</label>
                            <div class="layui-input-block">
                                <input type="text" name="abbreviation"  placeholder="请输入商品简称" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label _required">商品重量（kg）</label>
                            <div class="layui-input-block">
                                <input type="text" name="weight" onkeyup="Tools.clearNaN(this, true)"  placeholder="请输入商品重量，单位kg，范围0.05kg - 40kg" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item hide">
                            <label class="layui-form-label _tips" data-tipmsg="数值越大，商品越靠前">
                                排序
                                <i class="layui-icon layui-icon-tips"></i>
                            </label>
                            <div class="layui-input-block">
                                <input class="layui-input" type="tel" name="sort_val" onkeyup="Tools.clearNaN(this, true)" placeholder="数值越大，发布任务选择商品的时候越靠前" autocomplete="off" max="32767" maxlength="5">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="layui-card">
                    <div class="layui-card-header">目标客户、购买行为设置</div>
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <label class="layui-form-label">目标客户</label>
                            <?php if(empty($cus_temp)) { ?>
                                <div class="layui-form-mid layui-word-aux">
                                    <strong><i class="layui-icon">&#xe664;</i> 暂时还没有模板。请先去【 目标客户 】保存一个新模板吧（非必选）</strong>
                                </div>
                            <?php } else { ?>
                                <div class="layui-input-block" style="width: 15em;">
                                    <select name="template_target" class="layui-input">
                                        <option value="">选择一个模板（非必选）</option>
                                        <?php foreach ($cus_temp as $cus_temp_li) { ?>
                                            <option value="<?php echo $cus_temp_li['id']; ?>"><?php echo $cus_temp_li['template_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">购买行为</label>

                            <?php if(empty($beh_temp)) { ?>
                                <div class="layui-form-mid layui-word-aux">
                                    <strong><i class="layui-icon">&#xe664;</i> 暂时还没有模板。请先去【 购买行为 】保存一个新模板吧（非必选）</strong>
                                </div>

                            <?php } else { ?>
                                <div class="layui-input-block" style="width: 15em;">
                                    <select name="template_behavior" class="layui-input">
                                        <option value="">选择一个模板（非必选）</option>
                                        <?php foreach ($beh_temp as $beh_temp_li) { ?>
                                            <option value="<?php echo $beh_temp_li['id']; ?>"><?php echo $beh_temp_li['template_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="layui-card">
                    <div class="layui-card-header">商品图片信息（选填）</div>
                    <div class="layui-card-body">
                        <div class="layui-form-item">
                            <label class="layui-form-label _tips" data-tipmsg="若手机端显示的主图不一样，请上传无线主图。不上传则默认显示商品主图">APP主图&nbsp;<i class="layui-icon layui-icon-tips"></i></label>
                            <div class="layui-input-block case">
                                <input type="hidden" name="_wireless" value="" />
                                <input width="2px" name="wireless" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label _tips" data-tipmsg="如需要发布淘宝APP二维码任务，请上传该商品的二维码">二维码&nbsp;<i class="layui-icon layui-icon-tips"></i></label>
                            <div class="layui-input-block case">
                                <input type="hidden" name="_qrcode" value="" />
                                <input width="2px" name="qrcode" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label _tips" data-tipmsg="发布直通车任务，系统将从商品主图、直通车主图当中随机展示一张给用户">直通车图&nbsp;<i class="layui-icon layui-icon-tips"></i></label>
                            <div class="layui-input-block case">
                                <input type="hidden" name="_train_1" value="" />
                                <input width="2px" name="train_1" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                            </div>
                            <br />
                            <div class="layui-input-block case">
                                <input type="hidden" name="_train_2" value="" />
                                <input width="2px" name="train_2" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                            </div>
                            <br />
                            <div class="layui-input-block case">
                                <input type="hidden" name="_train_3" value="" />
                                <input width="2px" name="train_3" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                            </div>
                            <br />
                            <div class="layui-input-block case">
                                <input type="hidden" name="_train_4" value="" />
                                <input width="2px" name="train_4" type="file" class="auth_img layui-input" id="input-file-events" data-default-file="" data-allowed-file-extensions="jpg png jpeg gif">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" id="save-add" onclick="submitAdd(1, 0)">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="/js/common/dropify.min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/jquery.form.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/user/user.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script type="text/javascript">
        var dropifyObj = $('input[type=file]').dropify();
        //当删除无线主图之类的，为清空数据做准备
        dropifyObj.on('dropify.afterClear',
            function(event, element) {
                var theName = $(element.input).attr("name");
                $("input[name=_" + theName + "]").val("");
            });
        layui.use('form', function(){
            form = layui.form;
            form.val("handle-pro", {
                manager: '',
                pid: '',
                link: '',
                headline: '',
                abbreviation: '',
                weight: '',
                sort_val: '',
            });

        });
    </script>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

