<div class="page-content">
    <div class="page-header">
        <h1>
            用户管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                编辑用户
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" autocomplete="off" id="validation-form" novalidate="novalidate" method="post" action="">
                <div class="space-4"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 手机号 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" disabled value="<?php echo $info['mobile']; ?>" placeholder="手机号" class="col-xs-10 col-sm-5" />
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

                <div class="space-4"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 用户状态 </label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input name="state" <?php echo $info['state'] == 1 ? 'checked' : ''; ?> value="1" checked="checked"  type="radio" class="ace state" />
                                <span class="lbl"> 启用</span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="state" <?php echo $info['state'] == 2 ? 'checked' : ''; ?>  value="2" type="radio" class="ace state" />
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
            },
            messages: {
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
                param['id'] = <?php echo $info['id']; ?>;
                param['password'] = $("#password").val();
                param['confirm_password'] = $("#confirm_password").val();
                param['state'] = $(".state:checked").val();
                g.func.ajaxPost("/admin/user/edit", param , function(res){
                    if (res.code && res.code == 200) {
                        g.func.success(res.msg, function(){
                            window.location.href = "/admin/user/index";
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