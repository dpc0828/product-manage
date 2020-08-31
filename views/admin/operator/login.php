<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <?php echo \app\utils\Utils::getCsrfMeta(); ?>
        <?php $_static_version = \app\utils\Utils::version(); ?>
        <title><?php echo \app\utils\Utils::webSiteTitle(); ?></title>
		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="/admin/static/plugin/css/bootstrap.min.css?v=<?php echo $_static_version; ?>" />
		<link rel="stylesheet" href="/admin/static/plugin/font-awesome/4.5.0/css/font-awesome.min.css?v=<?php echo $_static_version; ?>" />
		<!-- text fonts -->
		<link rel="stylesheet" href="/admin/static/plugin/css/fonts.googleapis.com.css?v=<?php echo $_static_version; ?>" />
		<!-- ace styles -->
		<link rel="stylesheet" href="/admin/static/plugin/css/ace.min.css?v=<?php echo $_static_version; ?>" />
		<!--[if lte IE 9]>
			<link rel="stylesheet" href="/admin/static/plugin/css/ace-part2.min.css?v=<?php echo $_static_version; ?>" />
		<![endif]-->
		<link rel="stylesheet" href="/admin/static/plugin/css/ace-rtl.min.css?v=<?php echo $_static_version; ?>" />
		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="/admin/static/plugin/css/ace-ie.min.css?v=<?php echo $_static_version; ?>" />
		<![endif]-->
		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
		<!--[if lte IE 8]>
		<script src="/admin/static/plugin/js/html5shiv.min.js?v=<?php echo $_static_version; ?>"></script>
		<script src="/admin/static/plugin/js/respond.min.js?v=<?php echo $_static_version; ?>"></script>
		<![endif]-->
	</head>
	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="space-6"></div>
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												请登录
											</h4>
											<div class="space-6"></div>
											<form class="form-horizontal" autocomplete="off" id="validation-form" novalidate="novalidate" method="post" action="">

												<div class="space-4"></div>
												<div class="form-group">
													<div class="">
														<div class="clearfix">
															<input type="text" name="username" id="username" aria-required="true" aria-invalid="true"  class="form-control" placeholder="用户名" />
														</div>
													</div>
												</div>

												<div class="space-4"></div>
												<div class="form-group">
													<div class="">
														<div class="clearfix">
															<input type="password" id="password" name="password" aria-required="true" aria-invalid="true"  class="form-control" placeholder="密码" />
														</div>
													</div>
												</div>

												<fieldset>
													<div class="space"></div>
													<div class="clearfix">
														<button type="submit" class="width-35 pull-right btn btn-sm btn-primary j-dpc-form-submit">
															<i class="ace-icon fa fa-key"></i>
															<span class="bigger-110">登录</span>
														</button>
													</div>
													<div class="space-4"></div>
												</fieldset>
											</form>
											<div class="space-6"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- basic scripts -->
		<!--[if !IE]> -->
		<script src="/admin/static/plugin/js/jquery-2.1.4.min.js?v=<?php echo $_static_version; ?>"></script>
		<!-- <![endif]-->
		<!--[if IE]>
		<script src="/admin/static/plugin/js/jquery-1.11.3.min.js?v=<?php echo $_static_version; ?>"></script>
		<![endif]-->		
	    <script src="/admin/static/plugin/js/jquery.validate.min.js?v=<?php echo $_static_version; ?>"></script>
	    <script src="/admin/static/plugin/layer/layer/layer.js?v=<?php echo $_static_version; ?>"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) {
				document.write("<script src='/admin/static/plugin/js/jquery.mobile.custom.min.js?v=<?php echo $_static_version; ?>'>"+"<"+"/script>");
			}
		</script>
	    <script type="text/javascript">
			jQuery(function($) {
				$('#validation-form').validate({
					errorElement: 'div',
					errorClass: 'help-block',
					focusInvalid: false,
					ignore: "",
					rules: {
						username: {
							required: true,
						},
						password: {
							required: true,
						}
					},
					messages: {
						username: {
							required: "&nbsp;&nbsp;请输入用户名",
						},
						password: {
							required: "&nbsp;&nbsp;请输入密码",
						}
					},
					highlight: function (e) {
						$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
					},
					success: function (e) {
						$(e).closest('.form-group').removeClass('has-error');
						$(e).remove();
					},
					submitHandler: function (form) {
						$(".j-dpc-form-submit").attr('disabled', true);
						var param = {};
						param['username'] = $("#username").val();
						param['password'] = $("#password").val();
						g.func.ajaxPost("/admin/operator/login", param, function(res){
							if (res.code && res.code == 200) {
								g.func.success(res.msg, function(){
									window.location.href = "/admin/index/index";
								}, 2);
							} else {
								g.func.tips(res.msg);
								return false;
							}
						}, function() {
							$(".j-dpc-form-submit").attr('disabled', false);
							return false;
						});
						return false;
					},
					invalidHandler: function (form) {

					}
				});
			});
	    </script>	    
	    <script src="/admin/static/js/common.js?v=<?php echo $_static_version; ?>"></script>
	</body>
</html>
