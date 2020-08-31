	<div class="page-content">
		<div class="page-header">
			<h1>
				管理员管理
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					添加管理员管理
				</small>
			</h1>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" autocomplete="off" id="validation-form" novalidate="novalidate" method="post" action="">
					<div class="space-4"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 登录用户名 </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" name="username" value="<?php echo $info['username']; ?>" id="username" aria-required="true" aria-invalid="true" placeholder="登录用户名" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>

					<div class="space-4"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 姓名 </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" name="title" id="title" value="<?php echo $info['title']; ?>" aria-required="true" aria-invalid="true"  placeholder="姓名" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>

					<div class="space-4"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 密码 </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="password" id="password" name="password" placeholder="密码" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>

					<div class="space-4"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 确认密码 </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="password" id="confirm_password" name="confirm_password" placeholder="确认密码" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-2"> 角色 </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<div class="col-xs-12 col-sm-9">
									<select style="height: 250px;" class="multiselect" id="role-id" name="role[]" multiple="">
										<option <?php echo empty($info['role']) ? 'selected' : ''; ?> value="">无角色</option>
										<?php echo $role ?? ''; ?>
						            </select>
					        	</div>
							</div>
						</div>
					</div>


					<div class="space-4"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 用户状态 </label>
						<div class="col-sm-9">
							<div class="radio">
								<label>   
									<input name="state" value="1" <?php echo $info['state'] == 1 ? 'checked="checked"' : ''; ?> type="radio" class="ace state" />
									<span class="lbl"> 启用</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="state" value="0" <?php echo $info['state'] == 0 ? 'checked="checked"' : ''; ?> type="radio" class="ace state" />
									<span class="lbl"> 禁用</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="state" value="-1" <?php echo $info['state'] == -1 ? 'checked="checked"' : ''; ?> type="radio" class="ace state" />
									<span class="lbl"> 删除</span>
								</label>
							</div>
						</div>
					</div>
					
					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info j-dpc-form-submit" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								提交
							</button>
							&nbsp; &nbsp; &nbsp;
							<button class="btn" type="reset">
								<i class="ace-icon fa fa-undo bigger-110"></i>
								重置
							</button>
						</div>
					</div>
					<div class="hr hr-24"></div>
				</form>
			</div>
		</div>
	</div>
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
					title: {
						required: true,
					}
				},
				messages: {
					username: {
						required: "&nbsp;&nbsp;请填写登录用户名.",
					},
					title : {
						required:"&nbsp;&nbsp;请填写姓名.",
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
					param['title'] = $("#title").val();
					param['password'] = $("#password").val();
					param['confirm_password'] = $("#confirm_password").val();
					param['state'] = $(".state:checked").val();
					param['role'] = $("#role-id").val();
					g.func.ajaxPost("/admin/operator/edit?id=<?php echo $info['id']; ?>", param , function(res){
						if (res.code && res.code == 200) {
							g.func.success(res.msg, function(){
								window.location.href = "/admin/operator/index";
							}, 2);
						} else {
							$(".j-dpc-form-submit").attr('disabled', false);
							g.func.tips(res.msg);
						}
					}, function() {
						$(".j-dpc-form-submit").attr('disabled', false);
					});
					return false;
				},
				invalidHandler: function (form) {

				}
			});
		});
	</script>