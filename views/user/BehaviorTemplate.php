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
        <table class="layui-table" lay-skin="line">
            <thead>
            <tr class="col_name">
                <th>ID</th>
                <th>模板名</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($list)) { ?>
                <?php foreach ($list as $li) { ?>
                    <tr>
                        <td>
                            <?php echo $li['id']; ?>
                        </td>
                        <td>
                            <?php echo $li['template_name']; ?>
                        </td>
                        <td>
                            <?php echo $li['create_time']; ?>
                        </td>
                        <td>
                            <div class="layui-btn-group">
                                <button
                                    type="button"
                                    class="layui-btn layui-btn-sm"
                                    onclick="handleTemplate.previewTemplate(<?php echo $li['id']; ?>, 1, '<?php echo $li['template_name']; ?>')"
                                >预览</button>
                                <button
                                    type="button"
                                    class="layui-btn layui-btn-sm"
                                    onclick="handleTemplate.useTemplate(<?php echo $li['id']; ?>, 1)"
                                >应用</button>
                                <button
                                    type="button"
                                    class="layui-btn layui-btn-sm"
                                    onclick="handleTemplate.modifyTemplate(<?php echo $li['id']; ?>, 1, '<?php echo $li['template_name']; ?>')"
                                >修改</button>
                                <button
                                    type="button"
                                    class="layui-btn layui-btn-sm"
                                    onclick="handleTemplate.delTemplate(<?php echo $li['id']; ?>, 1)"
                                >删除</button>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            <?php } ?>
            </tbody>
            <tfoot>
            <strong>
                <a href="javascript:;" onclick="handleTemplate.addTemplate(1)">
                    【 点击新增 】
                </a>
            </strong>
            <tfoot>
    </div>
    <script src="/js/user/user.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>

