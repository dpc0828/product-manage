	<div class="page-content">
		<div class="page-header">
			<h1>
				权限管理
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					添加菜单
				</small>
			</h1>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-12">
						<?php
							$status = isset($info['status'])?$info['status']:'';
							$type = isset($info['type'])?$info['type']:'';
						?>
						<form class="form-horizontal" autocomplete="off" id="validation-form" novalidate="novalidate" method="post" action="">
							<div class="col-sm-12">
								<div class="form-group">
									<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 上级 </label>
									<div class="col-sm-9">
										<div class="clearfix">
											<select name="parent_id" id="parent_id">
												<option value="0"> / </option>
												<?php echo isset($selectCategorys) ? $selectCategorys : '';?>
											</select>
										</div>
									</div>
								</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 状态 </label>
										<div class="col-sm-9">
											<div class="radio">
												<label>   
													<input name="status" <?php echo empty($status) || $status == 1 ? 'checked' : ''; ?> value="1" type="radio" class="ace status" checked />
													<span class="lbl"> 显示</span>
												</label>
											</div>
											<div class="radio">
												<label>
													<input name="status" <?php echo $status == 2 ? 'checked' : ''; ?> value="2" type="radio" class="ace status" />
													<span class="lbl"> 隐藏</span>
												</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 类型 </label>
										<div class="col-sm-9">

											<div class="radio">
												<label>
													<input name="type" <?php echo $type == 1 ?'checked':''?> value="1" type="radio" class="ace type" />
													<span class="lbl"> 一级菜单 </span>
												</label>
											</div>

											<div class="radio">
												<label>
													<input name="type" <?php echo $type == 2 ? 'checked' : ''; ?> value="2" type="radio" class="ace type" />
													<span class="lbl"> 权限认证 + 二级菜单 </span>
												</label>
											</div>

											<div class="radio">
												<label>   
													<input name="type" <?php echo empty($type) || $type == 3 ? 'checked' : ''; ?> value="3" type="radio" class="ace type" />
													<span class="lbl"> 权限认证 </span>
												</label>
											</div>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 名称 </label>
										<div class="col-sm-9">
											<div class="clearfix">
												<input type="text" name="name" id="name" value="<?php echo isset($info['name']) ? $info['name'] : ''; ?>"  aria-required="true" aria-invalid="true" placeholder="名称" class="col-xs-10 col-sm-5" />
											</div>
										</div>
									</div>		

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 应用 </label>
										<div class="col-sm-9">
											<div class="clearfix">
												<input type="text" name="app" id="app" value="<?php echo isset($info['app']) ? $info['app'] : 'admin';?>"  aria-required="true" aria-invalid="true" placeholder="应用" class="col-xs-10 col-sm-5" />
											</div>
										</div>
									</div>	

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 控制器 </label>
										<div class="col-sm-9">
											<div class="clearfix">
												<input type="text" name="controller" id="controller" value="<?php echo isset($info['controller']) ? $info['controller'] : ''; ?>"  aria-required="true" aria-invalid="true" placeholder="控制器" class="col-xs-10 col-sm-5" />
											</div>
										</div>
									</div>	

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 方法 </label>
										<div class="col-sm-9">
											<div class="clearfix">
												<input type="text" name="action" id="action" value="<?php echo isset($info['action']) ? $info['action'] : ''; ?>"  aria-required="true" aria-invalid="true" placeholder="方法" class="col-xs-10 col-sm-5" />
											</div>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 图标 </label>
										<div class="col-sm-9">
											<div class="clearfix">
												<input type="text" name="icon" id="icon" value="<?php echo isset($info['icon']) ? $info['icon'] : ''; ?>"  aria-required="true" aria-invalid="true" placeholder="图标" class="col-xs-10 col-sm-5" />
											</div>
										</div>
									</div>										

									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 备注 </label>
										<div class="col-sm-9">
											<div class="clearfix">
												<input type="text" name="remark" id="remark" value="<?php echo isset($info['remark']) ? $info['remark'] : ''; ?>" placeholder="备注" class="col-xs-10 col-sm-5" />
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
							</div>
						</form>
					</div>
				</div>
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
					},
					app: {
						required: true,
					},
					controller: {
						required: true,
					},
					action: {
						required: true,
					}
				},
				messages: {
					name: {
						required: "&nbsp;&nbsp;请填写功能名.",
					},
					app: {
						required: "&nbsp;&nbsp;请填写应用名.",
					},
					controller : {
						required:"&nbsp;&nbsp;请填写控制器名.",
					},
					action: {
						required: "&nbsp;&nbsp;请填写方法名.",
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
					param['app'] = $("#app").val();
					param['controller'] = $("#controller").val();
					param['parent_id'] = $("#parent_id").val();
					param['action'] = $("#action").val();
					param['status'] = $(".status:checked").val();
					param['type'] = $(".type:checked").val();
					param['remark'] = $("#remark").val();
					param['icon'] = $("#icon").val();
					g.func.ajaxPost("/admin/operator/edit-menu?id=<?php echo $info['id']; ?>", param , function(res){
						if (res.code && res.code == 200) {
							g.func.success(res.msg, function(){
								window.location.href = "/admin/operator/menu";
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