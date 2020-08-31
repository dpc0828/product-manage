<div class="page-content">
    <div class="page-header">
        <h1>
            消息管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                添加消息
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" autocomplete="off" id="validation-form" novalidate="novalidate" method="post" action="/admin/cms/add" >

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 分类 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <select name="cate_id" id="cate_id" aria-required="true" aria-invalid="true">
                                <option value="">分类</option>
                                {if !empty($cate)}
                                {foreach $cate as $cli}
                                <?php foreach($cate as $cli_next) { ?>
                                    <option <?php echo $info['cate_id'] == $cli_next['id'] ? 'selected' : ''; ?>  value="<?php echo $cli_next['id']; ?>"><?php echo $cli_next['cate_name']; ?></option>
                                <?php } ?>
                                {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 标题 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" value="<?php echo $info['title']; ?>" name="title" aria-required="true" aria-invalid="true" placeholder="标题" class="col-xs-10 col-sm-5 title" />
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 文章简介 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" value="<?php echo $info['description']; ?>" name="description" aria-required="true" aria-invalid="true" placeholder="文章简介" class="col-xs-10 col-sm-5 description" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 封面图 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <div id="uploader" class="col-xs-12">
                                <button id="pickfiles" class="btn btn-app btn-purple btn-sm">
                                    <i class="ace-icon fa fa-cloud-upload bigger-200"></i>
                                    上传
                                </button>
                            </div>
                            <input type="hidden" value="<?php if(!empty($info['image'])){echo $info['image'];} ?>" name="image" id="image" placeholder="封面图" class="col-xs-10 col-sm-5" />
                            <div class="row ">
                                <div class="col-sm-6 img-list">
                                    <?php if(!empty($info['image'])){ ?>
                                    <div class="well well-sm">
                                        <img width='100' height='100' src='<?php echo $info['image']; ?>' />
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 查看次数 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" value="<?php echo $info['view']; ?>"  name="view" value="0" aria-required="true" aria-invalid="true"  placeholder="查看次数" class="col-xs-10 col-sm-5 view" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 点赞次数 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" value="<?php echo $info['likes']; ?>"  name="likes" value="0" aria-required="true" aria-invalid="true"  placeholder="点赞次数" class="col-xs-10 col-sm-5 likes" />
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 排序 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
                            <input type="text" value="<?php echo $info['sort']; ?>" name="sort" aria-required="true" aria-invalid="true"  placeholder="排序,请输入数字,数字越小越消息靠前." class="col-xs-10 col-sm-5 sort" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 首页置顶 </label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input name="home_top" value="2" <?php if($info['home_top'] == 2){ ?> checked="checked" <?php } ?>  type="radio" class="ace home_top" />
                                <span class="lbl"> 否</span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="home_top" value="1" <?php if($info['home_top'] == 1){ ?> checked="checked" <?php } ?> type="radio" class="ace home_top" />
                                <span class="lbl"> 是</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 栏目置顶 </label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input name="list_top" value="2" <?php if($info['list_top'] == 2){ ?> checked="checked" <?php } ?>  type="radio" class="ace list_top" />
                                <span class="lbl"> 否</span>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input name="list_top" value="1" <?php if($info['list_top'] == 1){ ?> checked="checked" <?php } ?> type="radio" class="ace list_top" />
                                <span class="lbl"> 是</span>
                            </label>
                        </div>
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-input-readonly"> 分类状态 </label>
                    <div class="col-sm-9">
                        <div class="radio">
                            <label>
                                <input name="state" value="1" <?php if($info['state'] == 1){ ?> checked="checked" <?php } ?> type="radio" class="ace state" />
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

                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> 内容 </label>
                    <div class="col-sm-9">
                        <div class="clearfix">
								<textarea id="content" aria-required="true" aria-invalid="true"  name="content" rows="20" cols="60" style="width:380px;height:500px;">
                                    <?php echo $info['content']; ?>
								</textarea>
                        </div>
                    </div>
                </div>

                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info submit" type="submit">
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
    var uploadUrl = '/admin/upload/config'; // ue upload url
</script>

<script type="text/javascript" src="/static/js/ueditor.config.js"></script>
<script type="text/javascript" src="/static/plugin/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor('content');
    jQuery(function($) {
        $('#validation-form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                cate_id: {
                    required: true,
                },
                title: {
                    required: true,
                },
                description: {
                    required: true,
                },
                sort: {
                    required: true,
                }
            },
            messages: {
                cate_id: {
                    required: "请选择分类",
                },
                title : {
                    required:"请填写标题.",
                },
                description : {
                    required:"请填写文章简介.",
                },
                content : {
                    required:"请填写内容.",
                },
                sort : {
                    required:"请填写排序.",
                }
            },
            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },
            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },
            // errorPlacement: function (error, element) {
            // },
            submitHandler: function (form) {
                $(".submit").attr('disabled', true);
                var param = {};
                param['cate_id'] = $("#cate_id").val();
                param['title'] = $(".title").val();
                param['description'] = $(".description").val();
                param['image'] = $("#image").val();
                param['view'] = $(".view").val();
                param['likes'] = $(".likes").val();
                param['content'] =  ue.getContent();
                param['sort'] = $(".sort").val();
                param['state'] = $(".state:checked").val();
                param['home_top'] = $(".home_top:checked").val();
                param['list_top'] = $(".list_top:checked").val();
                g.func.ajaxPost("/admin/cms/edit?id=<?php echo $info['id']; ?>", param , function(res){
                    if (res.code && res.code == 200) {
                        g.func.success(res.msg, function(){
                            window.location.href = "/admin/cms/index";
                        }, 2);
                    } else {
                        $(".submit").attr('disabled', false);
                        g.func.tips(res.msg);
                    }
                }, function() {
                    $(".submit").attr('disabled', false);
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