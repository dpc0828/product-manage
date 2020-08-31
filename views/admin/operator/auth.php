<style>
    .checkmod{
        margin-bottom:20px;
        border: 1px solid #ebebeb;padding-bottom: 5px;
    }
    .checkmod dt{
        padding-left:30px;
        height:30px;
        line-height:30px;
        font-weight:bold;
        border-bottom: 1px solid #ebebeb;
        background-color:#fcf8e3;
    }
    .checkmod dt{
        margin-bottom: 5px;
        border-bottom-color:#ebebeb;
        background-color:#fcf8e3;
    }
    .checkbox , .radio{
        display:inline-block;
        height:20px;
        line-height:20px;
    }
    .checkmod dd{
        padding-left:30px;
        line-height:30px;
    }
    .checkmod dd .checkbox{
        margin:0 50px 0 0;
    }
    .checkmod dd .divsion{
        margin-right:20px;
    }
    .checkmod dt{
        line-height:30px;
        font-weight:bold;
    }
    .rule_check{border: 1px solid #ebebeb;margin: auto;padding: 5px 30px;}
    .menu_parent{margin-bottom: 5px;}
</style>
	<div class="page-content">
		<div class="page-header">
			<h1>
				权限管理
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					权限设置
				</small>
			</h1>
		</div>
		<div class="row">
			<div class="col-xs-12">
                <div class="cf well form-search alert alert-info" style="height: 58px; background-color: #dff0d8">
                    <p>★标识的为用户已经拥有的角色权限 &nbsp;&nbsp;<input checked="checked"  type="checkbox">已选中的为分配的权限</p>
                </div>
				<form class="form-horizontal">
			        <div class="table_full">
			            <table width="100%" cellspacing="0" id="dnd-example">
			                <tbody>
			                	<?php echo $info['html']; ?>
			                </tbody>
		            	</table>
		            </div>

					<div class="clearfix form-actions">
						<div class="col-md-offset-3 col-md-9">
							<button class="btn btn-info j-dpc-form-submit" type="submit">
								<i class="ace-icon fa fa-check bigger-110"></i>
								提交
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
    <script type="text/javascript">
        function checknode(obj) {
            var chk = $("input[type='checkbox']");
            var count = chk.length;
            var num = chk.index(obj);
            var level_top = level_bottom = chk.eq(num).attr('level');
            for (var i = num; i >= 0; i--) {
                var le = chk.eq(i).attr('level');
                if (eval(le) < eval(level_top)) {
                    chk.eq(i).prop("checked",true);
                    var level_top = level_top - 1;
                }
            }
            for (var j = num + 1; j < count; j++) {
                var le = chk.eq(j).attr('level');
                if (chk.eq(num).prop("checked")) {
                    if (eval(le) > eval(level_bottom)){

                        chk.eq(j).prop("checked",true);
                    }
                    else if (eval(le) == eval(level_bottom)){
                        break;
                    }
                } else {
                    if (eval(le) > eval(level_bottom)){
                        chk.eq(j).prop("checked",false);
                    }else if(eval(le) == eval(level_bottom)){
                        break;
                    }
                }
            }
        }
        $(function() {
            $('.j-dpc-form-submit').click(function() {
                $(".j-dpc-form-submit").attr('disabled', true);
                var param = new Array();
                $("input[type='checkbox']").each(function() {
                    if($(this).is(':checked')) {
                        param.push($(this).val());
                    }
                });
                g.func.ajaxPost("/admin/operator/auth?id=<?php echo $id; ?>&name=<?php echo $name; ?>", {'menuid' : param}, function(res){
                    if (res.code && res.code == 200) {
                        g.func.success(res.msg, function(){
                            window.location.href = "/admin/operator/auth?id=<?php echo $id; ?>&name=<?php echo $name; ?>";
                        }, 2);
                        return false;
                    } else {
                        $(".j-dpc-form-submit").attr('disabled', false);
                        g.func.tips(res.msg);
                        return false;
                    }
                }, function() {
                    $(".j-dpc-form-submit").attr('disabled', false);
                    return false;
                });
                return false;
            })
        })
    </script>