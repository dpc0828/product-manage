<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <?php $_static_version = \app\utils\Utils::version(); ?>
    <?php echo \app\utils\Utils::getCsrfMeta(); ?>
    <title><?php echo \app\utils\Utils::webSiteTitle(); ?></title>
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="/admin/static/plugin/css/bootstrap.min.css?v=<?php echo $_static_version; ?>" />
    <link rel="stylesheet" href="/admin/static/plugin/font-awesome/4.5.0/css/font-awesome.min.css?v=<?php echo $_static_version; ?>" />
    <!-- page specific plugin styles -->
    
    <!-- text fonts -->
    <link rel="stylesheet" href="/admin/static/plugin/css/fonts.googleapis.com.css?v=<?php echo $_static_version; ?>" />
    <!-- ace styles -->
    <link rel="stylesheet" href="/admin/static/plugin/css/ace.min.css?v=<?php echo $_static_version; ?>" class="ace-main-stylesheet" id="main-ace-style" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/admin/static/plugin/css/ace-part2.min.css?v=<?php echo $_static_version; ?>" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="/admin/static/plugin/css/ace-skins.min.css?v=<?php echo $_static_version; ?>" />
    <link rel="stylesheet" href="/admin/static/plugin/css/ace-rtl.min.css?v=<?php echo $_static_version; ?>" />
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="/admin/static/plugin/css/ace-ie.min.css?v=<?php echo $_static_version; ?>" />
    <![endif]-->
    <!-- inline styles related to this page -->
    <!-- ace settings handler -->
    <script src="/admin/static/plugin/js/ace-extra.min.js?v=<?php echo $_static_version; ?>"></script>
    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
    <!--[if lte IE 8]>
    <script src="/admin/static/plugin/js/html5shiv.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/respond.min.js?v=<?php echo $_static_version; ?>"></script>
    <![endif]-->
    <script src="/admin/static/plugin/plupload/js/plupload.full.min.js?v=<?php echo $_static_version; ?>"></script>
    <!-- basic scripts -->
    <!--[if !IE]> -->
    <script src="/admin/static/plugin/js/jquery-2.1.4.min.js?v=<?php echo $_static_version; ?>"></script>
    <!-- <![endif]-->
    <!--[if IE]>
        <script src="/admin/static/plugin/js/jquery-1.11.3.min.js?v=<?php echo $_static_version; ?>"></script>
    <![endif]-->
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) {
            document.write("<script src='/static/plugin/js/jquery.mobile.custom.min.js?v=<?php echo $_static_version; ?>'>"+"<"+"/script>");
        }
    </script>
    <script src="/admin/static/plugin/js/bootstrap.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/jquery.validate.min.js?v=<?php echo $_static_version; ?>"></script>
    <!-- page specific plugin scripts -->
    <!--[if lte IE 8]>
        <script src="/static/plugin/js/excanvas.min.js?v=<?php echo $_static_version; ?>"></script>
    <![endif]-->
    <script src="/admin/static/plugin/js/jquery-ui.custom.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/jquery.ui.touch-punch.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/jquery.easypiechart.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/jquery.sparkline.index.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/jquery.flot.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/jquery.flot.pie.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/jquery.flot.resize.min.js?v=<?php echo $_static_version; ?>"></script>
    <!-- ace scripts -->
    <script src="/admin/static/plugin/js/ace-elements.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/js/ace.min.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/layer/layer/layer.js?v=<?php echo $_static_version; ?>"></script>
    <script src="/admin/static/plugin/DatePicker/WdatePicker.js?v=<?php echo $_static_version; ?>"></script>
</head>
<body class="no-skin">
    <div id="navbar" class="navbar navbar-default ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <div class="navbar-header pull-left">
                <a href="/admin/index/index" class="navbar-brand">
                    <small>
                        <i class="fa fa-laptop"></i>
                        管理后台
                    </small>
                </a>
            </div>
            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
                            <img class="nav-user-photo" src="/admin/static/img/avater.jpg" alt="Jason's Photo" />
                            <span class="user-info">
                                <small>欢迎,</small>
                                <?php echo yii::$app->params['op_user_name']; ?>
                            </span>
                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>
                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li>
                                <a href="/admin/operator/edit?id=<?php echo yii::$app->params['op_user_id']; ?>">
                                    <i class="ace-icon fa fa-cog"></i>
                                    账户设置
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="/admin/operator/loginout">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    退出登录
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {

            }
        </script>
        <div id="sidebar" class="sidebar responsive ace-save-state">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('sidebar')
                } catch (e) {

                }
            </script>

            <?php echo Yii::$app->view->renderFile('@app/views/admin/layout/menu.php') . PHP_EOL; ?>

            <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
            </div>
        </div>
        <div class="main-content">
            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="/admin/index/index">首页</a>
                        </li>
                        <li class="active">控制台</li>
                    </ul>
                </div> 
                <?php echo $content . PHP_EOL; ?>
            </div>
        </div>
        <div class="footer">
            <div class="footer-inner">
                <div class="footer-content">

                </div>
            </div>
        </div>
        <a href="javascript:;" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>
    <script src="/admin/static/js/common.js?v=<?php echo $_static_version; ?>"></script>
</body>
</html>