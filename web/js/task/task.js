$(function(){
	dialog.tipsByMouseenterAndleave("复制该计划的相关信息，再次进行发布", '.copy-btn');
	dialog.tipsByMouseenterAndleave("提前取消是取消不了当前买手正在进行的这个任务，但如果当前买手自行放弃该任务，此任务将不再被派送，默认隐藏此任务。", '.early-cancel');
	dialog.tipsByMouseenterAndleave("提醒用户在淘宝确认收货，可帮助您回流资金哦。推荐使用平台物流，尊享自动提醒功能「系统将在用户确认签收后，自动提醒，无需您手动操作」。发起提醒之后，用户需在12小时内确认收货，否则将无法接单。请您确保快递已经签收，再来操作，避免造成不必要的售后问题「同时注意避免信息刚签收，就立马确认收货的情况」", '.remind-btn');
	dialog.tipsByMouseenterAndleave("这个时间是指用户第一次进入“下单付款”任务流程的时间。可以判断用户是否记得去下单", '.affirm_tag_time');
});

//监听任务管理界面当中，tab的切换事件
layui.use(['element', 'form', 'laydate', 'laypage'], function(){
  var element = layui.element,
  	  form = layui.form,
  	  laydate = layui.laydate,
  	  table = layui.table,
  	  laypage = layui.laypage;
  $task_lists = $('#task_lists');
  //监听Tab的切换
  element.on('tab(task-state)', function(data){
	// 消掉实时监控的定时器
	if (typeof(monitoring_timer) != "undefined")
		clearInterval(monitoring_timer);
  	$has_search = false;  //当前操作是否为搜索，避免用户在搜索框输入但却未进行实际搜索时，在点击换页的时候为用户进行搜索的情况
  	dialog.load();
  	var $anchor = $(this).attr('lay-id'),
  			$state = $(this).data('state'),
  			$search_box = $('#search_box');
	location.hash = 'state='+ $(this).attr('lay-id');  //修改hash地址
	switch ($anchor)
	{
		case 'release':
			Tools._load('task_lists', '/task/' + $anchor + '?tag=' + $('i#tag').html(), function(){
				$('.search_box').addClass('hide');
			});
	  	break;
		default:
			Tools._load('task_lists', '/task/' + $anchor, function(){
				$('.search_box').addClass('hide');
				$('#' + $anchor + '_search').removeClass('hide');
			});
			break;
	}
  });
  
  //监听任务管理界面当中，搜索按钮的点击
	form.on('submit(search_form)', function(data){
		var $target = $(this).data('target');
		if (typeof($(this).data('target')) != 'undefined')
		{
			$has_search = true;
			var $args = $('#'+ $target).serialize();
			dialog.load(undefined, 2);
			Tools._load('task_lists', '/task/' + $target + '?' + $args, function(){
				
			})
			return false;
		}		
	});
	
	//发布评价任务，监听评价类型的选择
	form.on('radio(type)', function(data){
		var $cut = data.value == 0 ? false : true;
		var handel_obj = $(data.elem).parents(".layui-form-item").next();
		handel_obj.find('textarea.layui-textarea').attr('disabled', $cut).val('');
	}); 
	//发布评价任务，监听是否带图评价
	form.on('radio(TXT)', function(data){
		var handel_obj = $(data.elem).parents(".layui-form-item").next();
		var up_img_box = handel_obj,
			up_video_box = handel_obj.next();
		switch (data.value)
		{
			case "0":
				up_img_box.addClass("hide");
				up_video_box.addClass("hide");
				break;
			case "1":
				up_img_box.removeClass("hide");
				up_video_box.addClass("hide");
				break;
			case "2":
				up_img_box.removeClass("hide");
				up_video_box.removeClass("hide");
				break;
			default:
				break;
		}
	}); 
	//创建客服工单，监听工单类型的选择
	form.on('select(classify)', function(data){
		$('select[name=question]').empty().append('<option value="">请选择问题分类</option>');
		$('option[data-type=' + data.value + ']').clone().appendTo('select[name=question]');
		form.render();
	});
  
  //Tab切换进行Hash地址的定位
  var layid = location.hash.replace(/^#state=/, '');
  element.tabChange('task-state', layid);
  
  //时间&日期选择器
  $("input[name=start]").each(function(){
	  laydate.render({
	    elem: this,
	    type: 'datetime'
	  });
  });
  
  $("input[name=end]").each(function(){
  	  laydate.render({
  	    elem: this,
  	    type: 'datetime'
  	  });
  });
});

/**
 * 提前取消
 */
function earlyCancel(tag, _obj)
{
	if (isNaN(tag) == false)
	{
		dialog.confirm("您确认提前取消该任务对应的计划吗？此操作无法恢复", function(){
			Tools.ajax('/task/earlyCancel', {obj: tag}, function(datas){
				if (datas.code == 200)
				{
					$(_obj).remove();
				}
			});
		});
	}
	else
		dialog.hint(10001, '参数异常：tag');
}

/**
 * 发布评价任务，监听提交
 */
function affirmIssue()
{
	$('input#imgs').attr('name', 'imgs[]');  //将file-input数组归0，否则只能上传一个文件
	$('input[name^=d_imgs]').each(function(index){
		$(this).attr('name', 'd_imgs[' + index + '][]');
	});
	var $objs = {
		type: $("input[name=type]:checked").val(),
		content: $('textarea[name=content]'),
		TXT: $("input[name=TXT]:checked").val(),
		imgs: $('input#imgs'),
		t_video: $('input#t_video'),
	};
	if (($objs.type == '0' && $objs.content.val().trim() != '') || $objs.type == '1')
	{
		if ($objs.TXT == '1')
		{
			var not_upload = true;
			$objs.imgs.each(function(){
				if ($(this).val() != "")
				{
					not_upload = false;
					return false;
				}
			});
			if (not_upload == true)
				return dialog.hint(10001, '图文评价至少需要上传一张图片'); 
		}
		else if ($objs.TXT == '2')
		{
			if ($objs.t_video.val() == "")
				return dialog.hint(10001, '图文 + 视频评价需要上传评价视频'); 
		}
		
		var is_issue = true;
		
		// 判断副宝贝评价信息的完整性
		var deputy_ev = $(".deputy_ev");
		if (deputy_ev.length > 0)
		{
			deputy_ev.each(function(index){
				var curr_deputy_div = $(this);
				var curr_deputy_info = {
					type: curr_deputy_div.find("input[name^=d_type]:checked").val(),
					content: curr_deputy_div.find('textarea[name^=d_content]'),
					TXT: curr_deputy_div.find("input[name^=d_TXT]:checked").val(),
					imgs: curr_deputy_div.find('input[name^=d_imgs]'),
					t_video: curr_deputy_div.find('input[name^=d_t_video]'),
				};
				
				if (
					curr_deputy_info.type == '0' 
					&& curr_deputy_info.content.val().trim() == ''
				)
				{
					curr_deputy_info.content.focus();
					return is_issue = dialog.hint(10001, "第" + (index + 1) + '个副宝贝的评价类型为【指定评价内容】，必须填写评价内容'); 
				}
				
				if (curr_deputy_info.TXT == '1')
				{
					var not_upload = true;
					curr_deputy_info.imgs.each(function(){
						if ($(this).val() != "")
						{
							not_upload = false;
							return false;
						}
					});
					if (not_upload == true)
						return is_issue = dialog.hint(10001, "第" + (index + 1) + '个副宝贝评价方式为【图文评价】，至少需要上传一张图片'); 
				}
				else if (curr_deputy_info.TXT == '2')
				{
					if (curr_deputy_info.t_video.val() == "")
						return is_issue = dialog.hint(10001, "第" + (index + 1) + '个副宝贝评价方式为【图文 + 视频】，需要上传评价视频'); 
				}
					
				
			});
		}
		
		if (is_issue == false)
			return false;
			
		Tools.ajaxSubmit('issueEv-form', function(datas){
			dialog.hint(datas.code, datas.message);
			if (datas.code == 200)
			{
				var $obj = $('#t_' + $('input[name=tid]').val(), parent.document);
				$obj.find('.t_state').html('待评价');
				$obj.find('.issueEv-btn').remove();
				dialog.iframe_close();
			}
		}, '/task/affirmIssueEv');
	}
	else
	{
		$objs.content.focus();
		dialog.hint(10001, '评价类型为：指定评价内容，请填写评价内容');
	}
}

/**
 * 发布追评任务，监听提交
 */
function affirmIssueAdd()
{
	$('input#imgs').attr('name', 'imgs[]');  //将file-input数组归0，否则只能上传一个文件
	var $objs = {
		type: $("input[name=type]:checked").val(),
		content: $('textarea[name=content]'),
		TXT: $("input[name=TXT]:checked").val(),
		imgs: $('input#imgs'),
	};
	if (($objs.type == '0' && $objs.content.val().trim() != '') || $objs.type == '1')
	{
		if ($objs.TXT == '1')
		{
			var not_upload = true;
			$objs.imgs.each(function(){
				if ($(this).val() != "")
				{
					not_upload = false;
					return false;
				}
			});
			if (not_upload == true)
				return dialog.hint(10001, '带图评价为：是，请至少选择一张图片'); 
		}
		Tools.ajaxSubmit('issueEv-form', function(datas){
			dialog.hint(datas.code, datas.message);
			if (datas.code == 200)
			{
				var $obj = $('#t_' + $('input[name=tid]').val(), parent.document);
				$obj.find('.t_state').html('待评价');
				$obj.find('.issueEv-btn').remove();
				dialog.iframe_close();
			}
		}, '/task/affirmIssueAdd');
	}
	else
	{
		$objs.content.focus();
		dialog.hint(10001, '请填写追评内容');
	}
}

/**
 * 确认创建工单
 */
function affirmCreate()
{
	var $objs = {
		classify: $('select[name=classify]').val(),
		question: $('select[name=question]').val(),
		voucher: $('input#voucher').val(),
	};
	if ($objs.classify != '')
	{
		if ($objs.question != '')
		{
			if ($objs.voucher != '')
			{
				Tools.ajaxSubmit('work-form', function(datas){
					dialog.hint(datas.code, datas.message);
					if (datas.code == 200)
					{
						var $obj = $('#t_' + $('input[name=tid]').val(), parent.document);
						$obj.find('.work-btn').attr('disabled', true).addClass('layui-btn-disabled').html('已创建工单');
						dialog.iframe_close();
					}
				}, '/task/affirmIssueWork');
			}
			else
				dialog.hint(10001, '请至少选择一个凭证');
		}
		else
			dialog.hint(10001, '请选择问题分类');
	}
	else
		dialog.hint(10001, '请选择工单类型');
}

/**
 * 创建客服工单
 * @param {Object} $tid  用户任务表ID
 * @param {Object} $tag  任务标签
 */
function applyWork($tid, $tag, tasktype)
{
	if ($tid != '')
	{
		tasktype = tasktype || 1;
		dialog.iframe('/task/applyWork?tid=' + $tid + "&tasktype=" + tasktype, 800, 600, '创建工单（' + $tag + '）');
	}
	else
		dialog.hint(10001, '无效的参数：tid');
}

/**
 * 查看任务截图
 * @param {Object} $tag 任务标签
 * @param {Object} $status  任务状态
 */
function viewImg($tag, $status)
{
	if ($tag != '')
	{
		dialog.iframe('/task/viewImg?tag=' + $tag + '&status=' + $status, 800, 600, '查看任务图片');
	}
	else
		dialog.hint(10001, '参数异常');
}

/**
 * 查看流量任务截图
 * @param {Object} $tag 任务标签
 */
function viewFlowImg($tag)
{
	if ($tag != '')
	{
		dialog.iframe('/task/viewFlowImg?tag=' + $tag, 800, 600, '查看任务图片');
	}
	else
		dialog.hint(10001, '参数异常');
}

/**
 * 发布评价任务
 * @param {Object} $tid  用户任务表ID
 * @param {Object} $tid  任务标签
 */
function issueEvaluate($tid, $tag)
{
	if ($tid != '')
	{
		dialog.iframe('/task/issueEvaluate?tid=' + $tid, 88, 60, '发布评价任务(' + $tag + ')', 'rem');
	}
	else
		dialog.hint(10001, '无效的参数');
}

/**
 * 发布追评任务
 * @param {Object} $tid  用户任务表ID
 * @param {Object} $tid  任务标签
 */
function issueAdditionalReview($vid, $tag)
{
	if ($vid != '')
	{
		dialog.iframe('/task/issueAdditionalReview?vid=' + $vid, 88, 60, '发布追评任务(' + $tag + ')', 'rem');
	}
	else
		dialog.hint(10001, '无效的参数');
}

/**
 * @description 查看任务详情
 * @param {Object} $tid 任务id
 */
function checkDetails($tid, $type)
{
	if (isNaN($tid) == false)
	{
		var $action = typeof($type) == 'undefined' ? 'task-details' : 'flow-task-details';
		dialog.iframe('/task/' + $action + '?tid=' + $tid, 90, 90, '任务详情', "%");
	}
	else
		dialog.hint(10001, '参数异常');
}

/**
 * @description 取消任务
 * @param {Object} $tid  任务id
 */
function cancelTask($key, $obj)
{
	if ($key != '')
	{
		dialog.confirm('确认取消该任务？已接手的任务会继续进行', function(){
			Tools.ajax('/task/cancel-task', {key: $key}, function(datas){
				if (datas.code == 200)
				{
					$($obj, parent.document).parents('tr').remove();
				}
			});
		})
	}
	else
		dialog.hint(10001, '参数异常');
}


/**
 * @description 取消流量任务
 * @param {Object} $tag  任务id
 */
function cancelFlowTask($tag, $obj)
{
	if ($tag != '')
	{
		dialog.confirm('确认取消该任务？已接手的任务会继续进行', function(){
			Tools.ajax('/task/cancelFlowTask', {key: $tag}, function(datas){
				if (datas.code == 200)
				{
					$($obj, parent.document).parents('tr').remove();
				}
			});
		})
	}
	else
		dialog.hint(10001, '参数异常');
}


/**
 * @description  修改任务的状态，显示/隐藏
 * @param {Object} $tid
 * @param {Object} $status
 */
function changeTaskStatus($tid, $curr_status, $obj, $type)
{
	if ($.inArray($curr_status, ['0', '1']))
	{
		var $tips = '',
				$btn_name = '';
		if ($curr_status == '0')
		{
			$tips = '确认隐藏该任务？隐藏状态下任务无法被接手';
			$btn_name = '显示任务';
		}
		else
		{
			$tips = '确认显示此任务？显示状态下任务能够被接手';
			$btn_name = '隐藏任务';
		}
		dialog.confirm($tips, function(){
			$posts = {
				tid: $tid,
			};
			var $action = typeof($type) == 'undefined' ? 'change-task-status' : 'change-flow-task-status';
			Tools.ajax('/task/' + $action, $posts, function(datas){
				if (datas.code == 200)
				{
					$this = $($obj);
					$this.html($btn_name).attr('onclick', 'changeTaskStatus(' + $tid + ', ' + !$curr_status + ', this)');
					$this.parents('tr').toggleClass('layui-bg-black');
				}
			});
		});
	}
	else
		dialog.hint(10001, '无效的参数');
}

/**
 * 取消评价任务
 * @param {Object} $tid  评价表ID
 */
function cancelEvaluate($tid)
{
	if (isNaN($tid) == false)
	{
		dialog.confirm('确认取消此评价任务吗？', function(){
			Tools.ajax('/task/cancelEvaluate', {tid: $tid}, function(datas){
				if (datas.code == 200)
					$target = $('#t_' + $tid).remove();
			})
		})
	}
	else
		dialog.hint(10001, '无效的参数：tid');
}

/**
 * 取消追评任务
 * @param {Object} $tid  评价表ID
 */
function cancelAdditional($tid)
{
	if (isNaN($tid) == false)
	{
		dialog.confirm('确认取消此追评任务吗？', function(){
			Tools.ajax('/task/cancelAdditional', {tid: $tid}, function(datas){
				if (datas.code == 200)
					$target = $('#t_' + $tid).remove();
			})
		})
	}
	else
		dialog.hint(10001, '无效的参数：tid');
}


function viewImgs($tid)
{
	var $imgs = $('ul.imgs_' + $tid + ' li.imgs'),
			$show = [];
	$.each($imgs, function(index) {
		$show[index] = $(this).html();
	});
	dialog.showImgs($show);
}

/**
 * @description 导出流量任务数据
 */
function exportFlowList()
{
	dialog.confirm("确认导出相关流量任务明细吗？默认导出全部", function(){
		Tools.ajax('/finance/exportFlowList', $('#receivedListFlow').serialize(), function(datas){
			if (datas.code == 200)
			{
				document.location.href = datas.datas
			}
		});
	})
}

/**
 * @description 导出已接任务数据
 */
function derivereceivedList()
{
	dialog.confirm("确认导出相关订单明细吗？默认导出全部", function(){
		Tools.ajax('/task/derivereceivedList', $('#receivedList').serialize(), function(datas){
			if (datas.code == 200)
			{
				document.location.href = datas.datas
			}
		}, null, 'get');
	})
}


/**
 * @description 复制计划
 * @param {Object} tag  复制对象
 */
function toCopyPlan(tag)
{
	if (isNaN(tag) == false)
	{
		dialog.iframe("/task/toCopyPlan?tag=" + tag, 80, 93, '复制任务计划', "%");
	}
	else
		dialog.hint(10001, "参数异常：tag");
}

/**
 * @description 复制流量任务计划
 * @param {Object} tag  复制对象
 */
function toCopyFlowPlan(tag)
{
	if (isNaN(tag) == false)
	{
		dialog.iframe("/task/toCopyFlowPlan?tag=" + tag, 80, 93, '复制流量任务计划', "%");
	}
	else
		dialog.hint(10001, "参数异常：tag");
}

/**
 * @description 提醒用户确认收货
 */
function changeRemindState(_tag, state, obj)
{
	var _state = $.inArray(state, [0, 3]) != -1,
			tipMsg = _state == true ? "发起提醒之后，用户需在12小时内确认收货，否则将无法接单。请您确保快递已经签收，再来操作，避免造成不必要的售后问题「同时注意避免信息刚签收，就立马确认收货的情况」。<span class='text-danger'>注意：尽量不要批量提醒，以免被淘宝检测，订单异常！</span>" : "确认取消提醒用户去确认收货吗？";
	dialog.confirm(tipMsg, function(){
		Tools.ajax("/task/changeRemindState", {tag: _tag}, function(datas){
			if (datas.code == 200)
			{
				var _obj = $(obj);
				if (_state == true) //提醒用户收货
					_obj.attr("onclick", "changeRemindState(" + _tag + ", 1, this)").html("取消提醒收货");
				else //取消提醒用户收货
					_obj.attr("onclick", "changeRemindState(" + _tag + ", 0, this)").html("提醒用户收货");
			}
		});
	})
}

/**
 * @description 取消发货
 * @param {Object} Tag 物流ID
 */
function cancelSendOut(Tag, Obj)
{
	dialog.confirm("是否取消该笔订单的发货？", function(){
		Tools.ajax("/task/cancelSendOut", {tag: Tag}, function(datas){
			if (datas.code == 200)
			{
				var This = $(Obj);
				This.parents("tr").find(".t_state").html("取消发货");
				This.remove();								
			}
		})
	});
}


/**
 * 切换全局任务的状态
 * @param {Object} state
 */
function cutShowStatus(obj)
{
	var tip = "确认取消全局隐藏任务？取消之后，[显示状态]的待接任务将会正常派发";
	dialog.confirm(tip, function(){
		Tools.ajax("/user/cutShowStatus", "{}", function(datas){
			if (datas.code == 200)
				$(obj).parents("div.alert-danger").remove();
		})
	});
}

/**
 * 答复用户的提问
 * @param {Object} $curr_id  当前问答ID
 */
function ReplyQuestion(curr_id)
{
	if (isNaN(curr_id) != false)
		return dialog.hint(10001, '无效的参数');
	dialog.iframe(
		'/task/replyQuestion?tag=' + curr_id,
		800,
		638,
		'答复用户的提问'
	);
}

/**
 * 提交答复
 * @param {Object} curr_id 当前问答ID
 */
function submitReply(curr_id)
{
	if (isNaN(curr_id) != false)
		return dialog.hint(10001, '无效的参数');
	var data = {
		'tag': curr_id,
		'answer': $("textarea[name=answer]").val().trim(),
	};
	if (data.answer == '')
		return dialog.hint(10001, '请输入答复内容');
	Tools.ajax(
		'/task/submitReply',
		data,
		function(return_data){
			if (return_data.code == 200)
				dialog.iframe_close();
		}
	);
}

/**
 * 取消此条问答
 * @param {Object} curr_id  当前问答ID
 * @param {Object} btn_obj 当前按钮对象
 */
function cancelFAQs(curr_id, btn_obj)
{
	if (isNaN(curr_id) != false)
		return dialog.hint(10001, '无效的参数');
	
	dialog.confirm("确认取消此条问答吗？此操作无法撤销", function(){
		Tools.ajax(
			'/task/cancelFAQs',
			{
				tag: curr_id
			},
			function(return_data){
				if (return_data.code == 200)
					$(btn_obj).parents("tr").remove();
			}
		);
	});
}

/**
 * 查看指定评价视频
 */
function showEvVideo(video_url)
{
	layui.use("layer", function(){
		var layer = layui.layer;
		layer.open({
		  type: 2,
		  title: false,
		  area: ['630px', '360px'],
		  shade: 0.8,
		  closeBtn: 0,
		  shadeClose: true,
		  content: video_url
		});
	})
}


/**
 * 查看副宝贝的好评内容
 * @param {Object} curr_id
 */
function showDeputyEv(curr_id)
{
	if (isNaN(curr_id) != false)
		return dialog.hint(10001, '无效的参数');
	dialog.iframe(
		'/task/showDeputyEv?tag=' + curr_id,
		800,
		638,
		'查看副宝贝的好评内容'
	);
}

var copyFullPlan = (curr_tid) => {
    // 变更相关样式
    $(".layui-tab-title li").removeClass("layui-this");
    $("li[lay-id=release]").addClass("layui-this");
    location.hash = 'state=release';  //修改hash地址
    
    // 跳转到发布任务界面
    dialog.load();
    Tools._load('task_lists', '/task/release?obj=' + curr_tid, () => {
        $('.search_box').addClass('hide');
    });
}