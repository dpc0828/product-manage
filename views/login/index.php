<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <?php echo \app\utils\Utils::getCsrfMeta(); ?>
        <title><?php echo \app\utils\Utils::webSiteTitle(); ?></title>
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
        <script src="/js/common/jquery.min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
        <script src="/js/common/layer/layui.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
        <script src="/js/common/common.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
        <link rel="stylesheet" href="/css/login.css?v=<?php echo \app\utils\Utils::version(); ?>">
    </head>
    <body>
        <div class="col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-offset-0">
            <div class="cont">
                <div class="demo">
                    <div class="login">
                        <div id="logo">
                            <img src="/images/logo.png?v=<?php echo \app\utils\Utils::version(); ?>" width="98em"/>
                        </div>
                        <div class="login__form">
                            <div class="login__row">
                                <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                                    <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                                </svg>
                                <input type="text" name="mc-username" class="login__input name" placeholder="欢迎登陆,请输入手机号"/>
                            </div>
                            <div class="login__row">
                                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                                    <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                                </svg>
                                <input type="password" name="pwd" class="login__input pass" placeholder="密码"/>
                            </div>
                            <button type="button" class="login__submit">登&nbsp;&nbsp;陆</button>
                            <p class="login__signup">忘记密码? &nbsp;<a href="/login/findpwd" style="text-decoration: none">去找回</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <script src="/js/common/login.js" type="text/javascript"></script>
            <script>
                $(function(){
                    if (typeof(Tools) == 'undefined' || typeof(dialog) == 'undefined') {
                        $.getScript("/js/common/common.js?v=<?php echo \app\utils\Utils::version(); ?>");
                    }
                    if (typeof(layer) == 'undefined') {
                        layui.use('layer', () => {
                            layer = layui.layer;
                        });
                    }
                });
            </script>
        </div>
        <script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    </body>
</html>

