<div class="page-content">
    <div class="page-header">
        <h1>
            文章分类
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                分类管理
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" autocomplete="off" id="validation-form" novalidate="novalidate" method="post" action="">
                <div class="space-4"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 分类名称 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" value="<?php echo $info['cate_name']; ?>" name="cate_name" id="cate_name" aria-required="true" aria-invalid="true" placeholder="登录用户名" class="col-xs-10 col-sm-5" />
                        </div>
                    </div>
                </div>

                <div class="space-4"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 分类图标 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <div id="uploader" class="col-xs-12">
                                <button id="pickfiles" class="btn btn-app btn-purple btn-sm">
                                    <i class="ace-icon fa fa-cloud-upload bigger-200"></i>
                                    上传
                                </button>
                            </div>
                            <input type="hidden" value="<?php echo $info['image']; ?>" name="image" id="image" aria-required="true" aria-invalid="true"  placeholder="分类图标" class="col-xs-10 col-sm-5" />
                            <div class="row ">
                                <div class="col-sm-6 img-list">
                                    <div class="well well-sm">
                                        <img width='100' height='100' src='<?php echo $info['image']; ?>' />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-4"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 排序 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" value="<?php echo $info['sort']; ?>" id="sort" name="sort" placeholder="数字越小展示越靠前" class="col-xs-10 col-sm-5" />
                        </div>
                    </div>
                </div>

                <div class="space-4"></div>
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 分类状态 </label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input name="state" value="1" <?php if($info['state'] == 1){ ?> checked="checked" <?php } ?>  type="radio" class="ace state" />
                                <span class="lbl"> 启用</span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="state" value="2" <?php if($info['state'] == 2){ ?> checked="checked" <?php } ?> type="radio" class="ace state" />
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
                cate_name: {
                    required: true,
                },
                image: {
                    required: true,
                },
                sort: {
                    required: true,
                }
            },
            messages: {
                cate_name: {
                    required: "&nbsp;&nbsp;请填写分类名称.",
                },
                image : {
                    required:"&nbsp;&nbsp;请上传图片.",
                },
                sort: {
                    required: "&nbsp;&nbsp;请填写分类排序.",
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
                param['cate_name'] = $("#cate_name").val();
                param['image'] = $("#image").val();
                param['sort'] = $("#sort").val();
                param['state'] = $(".state:checked").val();
                g.func.ajaxPost("/admin/cms/edit-cate?id=<?php echo $info['id']; ?>", param , function(res){
                    if (res.code && res.code == 200) {
                        g.func.success(res.msg, function(){
                            window.location.href = "/admin/cms/cate";
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

    $(function(){
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash',
            browse_button : 'pickfiles',
            container: document.getElementById('uploader'),
            url : '/admin/upload/upload?type=cate',
            flash_swf_url : '/assets/plupload/js/Moxie.swf',
            silverlight_xap_url : '/assets/plupload/js/Moxie.xap',
            max_file_size : '5MB',
            filters : {
                mime_types: [
                    {
                        title : "Image files",
                        extensions : "jpg,jpeg,gif,png"
                    }
                ]
            },
            init: {
                FilesAdded: function(up, files) {
                    this.start();
                },
                Error: function(up, err) {
                    g.func.tips("\nError #" + err.code + ": " + err.message);
                },
                FileUploaded:function(up, file, response){
                    var json = JSON.parse(response.response);
                    var html = '<div class="well well-sm">' +
                        "<img width='100' height='100' src='" + json.url + "' />"  +
                        '</div>';
                    $(".img-list").html(html);
                    $("#image").val(json.url)
                }
            }
        });
        uploader.init();
    });

</script>