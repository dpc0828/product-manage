	<div class="page-content">
		<div class="page-header">
			<h1>
				权限管理
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					添加管理角色
				</small>
			</h1>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<form class="form-horizontal" autocomplete="off" id="validation-form" novalidate="novalidate" method="post" action="">
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 角色名称 </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" name="name"  id="name"  placeholder="角色名称" aria-required="true" aria-invalid="true" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 角色描述 </label>
						<div class="col-sm-9">
							<div class="clearfix">
								<input type="text" name="remark" id="remark" placeholder="角色描述" class="col-xs-10 col-sm-5" />
							</div>
						</div>
					</div>


					<div class="space-4"></div>
					<div class="form-group">
						<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 状态 </label>
						<div class="col-sm-9">
							<div class="radio">
								<label>   
									<input name="status" checked="checked" value="1" type="radio" class="ace status" />
									<span class="lbl"> 启用</span>
								</label>
							</div>
							<div class="radio">
								<label>
									<input name="status"  value="2" type="radio" class="ace status" />
									<span class="lbl"> 禁用</span>
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
					name: {
						required: true,
					}
				},
				messages: {
					name: {
						required: "&nbsp;&nbsp;角色名称.",
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
					param['name'] = $("#name").val();
					param['remark'] = $("#remark").val();
					param['status'] = $(".status:checked").val();
					g.func.ajaxPost("/admin/operator/add-role", param , function(res){
						if (res.code && res.code == 200) {
							g.func.success(res.msg, function(){
								window.location.href = "/admin/operator/role";
							}, 2);
						} else {
							g.func.tips(res.msg);
							$(".j-dpc-form-submit").attr('disabled', false);
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