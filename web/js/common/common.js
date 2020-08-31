//layer弹窗
layui.use(['layer', 'laypage', 'table', 'form', 'element', 'laydate'], function(){
  layer = layui.layer;
  laypage = layui.laypage;  //分页组件
  table = layui.table;  //数据表格组件
  form = layui.form;  //表单组件
  element = layui.element;
  laydate = layui.laydate;  //日期选择器
});

$(document).on('mouseenter', '._tips', function(){
	if (typeof(tip_index) != "undefined")
		return;
	tip_index = layer.tips($(this).data('tipmsg'), this, {time:0, tips: 1, tipsMore: true});
}).on('mouseleave', '._tips', function(){
	layer.close(tip_index);
	tip_index = undefined;
});

var dialog = {
  /**
   * @description 弹窗提示，包括错误提示和成功提示
   * @param {Object} $code  10000 - 20000属于用户级错误提示，无需确认错误； 20000 - 30000属于系统级错误提示，需确认错误； 200为成功提示
   * @param {Object} $msg  提示语
   * @param {Object} $time  弹窗展示时间，默认为1600毫秒
   */
	hint: function($code, $msg, $time)
	{
		layer.close(load);
		$code = $code || 400; $time = $time || 3000;
		if ($code == 400)  //用户级错误提示，无需确认错误
		{
			layer.msg($msg, function(){});
		}
		else if($code == 401) {
			parent.location.href = '/login/login';
		}
		else if($code == 500)  //系统级错误提示，需确认错误
		{
			layer.alert('系统异常：' + $msg, {anim: 6, icon: 0, closeBtn: 0, title: false, shade: 0.6});
		}
		else if($code == 200)  //正确提示
		{
			layer.msg($msg, {icon: 6, time: $time});
		} 	else if (10000 < $code && $code < 20000) {  //用户级错误提示，无需确认错误
			layer.msg($msg, function(){});
		}
		else if(20000 <= $code && $code < 30000)  //系统级错误提示，需确认错误
		{
			layer.alert('系统异常：' + $msg, {anim: 6, icon: 0, closeBtn: 0, title: false, shade: 0.6});
		}
		else if(30000 <= $code && $code < 50000)  //业务逻辑错误提示，需确认错误
		{
			layer.alert('系统提示：' + $msg, {anim: 6, icon: 0, closeBtn: 0, title: false, shade: 0.6});
		}
		else if(60000 <= $code && $code < 70000)  //温柔的系统提示
		{
			layer.alert('系统提示：' + $msg, {anim: 0, icon: 6, closeBtn: 0, title: false, shade: 0.6});
		}
		return false;
	},
	
	
	
	/**
	 * @description 加载层
	 * @param {Object} $load_tip  加载提示语，可为空
	 */
	load: function($load_tip, $style)
	{
		load = null;
		$style = $style || 0
		if (typeof($load_tip) == "undefined")
		{
			load = layer.load($style, {shade: 0.1});
		}
		else
			load = layer.msg($load_tip, {icon: 16, time: 0, shade: 0.3});
	},
	
	/**
	 * 询问框
	 * @param {Object} $msg
	 * @param {Object} fun1
	 * @param {Object} $btn1
	 * @param {Object} $btn2
	 */
	confirm: function($msg, fun1, $btn1, $btn2)
	{
		$btn1 = $btn1 || '确定';  $btn2 = $btn2 || '取消';
		layer.alert($msg, {
			btn: [$btn1, $btn2], 
			time: 0,
			closeBtn: 0,
			icon: 3,
			title: false,
			yes: fun1
		});
	},
	
	full: function($url)
	{
		layer.close(layer.index);
		index = layer.open({
			type: 2,
			content: $url,
			area: ['320px', '195px'],
			maxmin: true
		});
		layer.full(index);
	},
	
	iframe: function($url, $width, $height, $title, unit)
	{
		var $type = $url.indexOf('#') != 0 ? 2 : 1;
		$width = $width || '770';	$height = $height || '550';    $title = $title || '操作窗口'; unit = unit || "px";
		var _open = layer.open({
			type: $type,
			title: $title,
			shadeClose: false,
			shade: 0.8,
			area: [$width + unit, $height + unit],
			content: $type == 2 ? $url : $($url),
		}); 
	},
	
	iframe_close: function($time)
	{
		$time = $time || 800;
		var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
		setTimeout(function(){
			parent.layer.close(index);
		}, $time);
	},
	
	/*
	 * 单图展示
	 */
	showImg: function($src, $title)
	{
		var json = {
		  'title': "相片查看",
		  'id': 123, //相册id
		  'start': 0,
		  'data': [
		    {
		      'alt': $title || '图片',
		      'pid': 1,
		      'src': $src,
		    },
		  ]
		};
	  layer.photos({
	    photos: json,
	  });
	},
	
	/*
	 * 多图展示
	 */
	showImgs: function($infos)
	{
		var data = [],
				i = 0;
		$.each($infos, function(key, val){
			data[i] = {
		      'alt': key,
		      'pid': i,
		      'src': val,
		   };
		   i++;
		});
		var json = {
		  'title': "查看截图",
		  'id': 123, //相册id
		  'start': 0,
		  'data': data,
		};
	  layer.photos({
	    photos: json,
	  });
	},
	
	simpLog: function($content, $width)
	{
		var $width = $width || 300;
		layer.open({
			type: 1,
			shade: false,
			area: $width + 'px',
			title: false,
			content: '<div style="padding: 5%">' + $content + '</div>',
		});
	},
	
	/**
	 * @description tip提示框
	 * @param {Object} msg  提示内容
	 * @param {Object} vessel  黏附容器
	 * @param {Object} _time 自动消失时间，默认为不自动消息
	 */
	tips: function(msg, vessel, _time = 0, _tips = 2)
	{
		layui.use('layer', function(){
			layer.tips(msg, vessel, {tips: _tips, closeBtn: 1, time:_time, tipsMore: true });
		});
	},
	
	/**
	 * @description 鼠标移入移除vessel，弹出tip。应用场景：列表当中对某个按钮的注释，避免加载太多不必要的文字
	 * @param {Object} msg  提示语
	 * @param {Object} vessel 目标容器
	 */
	tipsByMouseenterAndleave: function(msg, vessel)
	{
		$(document).on('mouseenter', vessel, function(){
			tip_index = layer.tips(msg, this, {time:0, tips: 1, tipsMore: true});
		}).on('mouseleave', vessel, function(){
			layer.close(tip_index);
		});
	},
};

load = '';
//公用的一些方法
var Tools = {
	/**
	 * @description 发起ajax请求
	 * @param {Object} url  请求的URL
	 * @param {Object} data  携带的数据
	 * @param {Object} success 请求处理成功即code=200，回调此函数（当ajax成功返回的时候，无需做弹窗提示，该插件自动根据code类型做相关提示）
	 * @param {Object} $has_hint  是否显示加载层
	 * @param {Object} type 请求方式，可选post/get，默认为post
	 * @param {Object} timeout  超时时间，默认为0，即永不超时
	 * @param {Object} dataType  数据格式，默认为json
	 * @param {Object} IgnoreError  忽略错误回调
	 * @param {Object} Async  true = 异步   / false = 同步
	 */
	ajax: function(url, data, success, $has_hint, type, timeout, dataType, IgnoreError, Async)
	{
		dataType = dataType || 'JSON';  type = type || 'post';  timeout = timeout || 0;  $has_hint = $has_hint == null ?  true : false; 
		IgnoreError = IgnoreError == true ? true : false;  
		Async = Async == false ? false : true;
		$.ajax({
			type: type,
			dataType: dataType,
			url: url,
			data: data,
			traditional:true,
			timeout: timeout,
			async: Async,
			beforeSend: function (){
	      if($has_hint) 
	      	dialog.load(undefined, 2);
	    },
			success: function(datas){
				if (datas.code != 1215)
				{
					if(datas.message != '') dialog.hint(datas.code, datas.message);
			  	success(datas);
				}
				else
				{
					dialog.confirm(datas.message, function(){
						top.location.href="/index/login"
					});
				}
			},
			error: function(jqXHR, textStatus, errorThrown)  //ajax错误提示
			{
				if (IgnoreError == false)
					dialog.hint(20001, '[' + textStatus + ']' + errorThrown);
			},
		});
	},
	
	
	//携带post数据跳转页面
	standardPost: function(url,args) 
    {
        var form = $("<form method='post'></form>");  //在内存中创建form表单
		$(document.body).append(form);  //将创建的form表单添加到body中，否则该函数不工作
        form.attr("action", url);
        for (arg in args)
        {
            var input = $("<input type='hidden'>");
            input.attr("name", arg);
            input.val(args[arg]);
            form.append(input);
        }
        form.submit();
    },
    
    /**
     * @description ajax表单提交
     * @param {Object} $form_id  form标签ID
     * @param {Object} success  成功回调函数
     * @param {Object} $url 提交URL，默认为form中action值
     * @param {Object} $data 携带的参数
     */
    ajaxSubmit: function($form_id, success, $url, $data)
    {
    	$form = $('form#' + $form_id);
    	$url = $url || $form.attr('action');
    	$data = $data || {};
    	$form.ajaxSubmit({
	    		url: $url,
	    		data: $data,
	    		beforeSubmit: function(){
	    			dialog.load(undefined, 2);
	    		},
	    		success: function(datas){
	    			if (datas.code != 1215)
						{
							success(datas);
						}
						else
						{
							layer.close(layer.index);
							dialog.confirm(datas.message, function(){
								top.location.href="/index/login"
							});
						}
	    		},
	    		error: function(jqXHR, textStatus, errorThrown)  //ajax错误提示
					{
						dialog.hint(20001, '[' + textStatus + ']' + errorThrown);
					},
	    		timeout: 0, 
	    		dataType: 'JSON',
			});
    },
    
    /*
     * 修改URL参数
     */
    changeURLArg: function($url, $arg_val, $arg)
    {
       var $arg = $arg || 'page',
       	   pattern = $arg + '=([^&]*)',
           replaceText = $arg + '=' + $arg_val;
       if($url.match(pattern))  //有对应的参数
       {
           var tmp = '/(' + $arg + '=)([^&]*)/gi'; 
           tmp = $url.replace(eval(tmp), replaceText); 
           return tmp; 
       }
       else  //无对应的参数
       {
       		return $url.match('[\?]') ? $url + '&' + replaceText : $url + '?' + replaceText; 
       } 
    },
    
   /**
   * @description 分页组件，需要在页面添加id为page的容器
   * @param {Object} $count 总条数
   * @param {Object} callback  跳转页面的时候触发的回调函数
   * @param {Object} $limit  每页显示条数，默认为10条
   */
    page: function($count, $curr, callback, $limit, _layout)
		{
			$limit = $limit || 10;
			_layout = _layout || ['count', 'prev', 'page', 'next', 'skip'];
			if (typeof(laypage) == 'undefined')
			{
				layui.use(['laypage'], function(){
				  laypage = layui.laypage;  //分页组件
				});
			}
			laypage.render({
				elem: 'page',
				count: $count,
				curr: $curr,
				limit: $limit,
				theme: '#00bcd5',
				layout: _layout,
				jump: function(obj, first){
					if (!first)
					{
						dialog.load(undefined, 2);
						callback(obj);
					}
						
				}
			}); 
		},
		
		/**
		 * @description  清除input当中非数字或小数点的字符
		 * @param {Object} obj  调用该方法的当前对象
		 * @param {Object} $allow_dot  是否允许输入小数点，默认为不允许
		 */
		clearNaN: function(obj, $allow_dot)
		{
			$allow_dot = $allow_dot || false;
			obj.value = obj.value.replace($allow_dot == true ? /[^\d.]/g : /[^\d]/g, ""); //清除"数字"和"."以外的字符
		  	obj.value = obj.value.replace(/^\./g,""); //验证第一个字符是数字而不是.
		  	obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的.
		  	obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");//只允许输入一个小数点
		  	obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3'); //只能输入两个小数
		  	obj.value = obj.value.replace(/^0+([0-9]\d*|0\.\d+)/g, "$1"); //去除非小数前面的0
		  	obj.value = obj.value == '' ? 0 : obj.value;
		},
		
		/**
		 * @description 是否为纯数字
		 * @param {Object} $val  检查的值
		 */
		isNumeric: function($val)
		{
			var reg =  /^[0-9]*[1-9][0-9]*$/;
			return reg.test($val);
		},
		
		/**
		 * @description  动态表格
		 * @param {Object} $vessel_id  目标容器，用以存放表格
		 * @param {Object} $url  数据来源URL
		 * @param {Object} $cols  列数据
		 * @param {Object} $cols  列数据
		 */
		dynamicLoadTable: function ($vessel_id, $url, $cols, $where, $tools)
		{
			$('#' + $vessel_id).html('');
			layui.use('table', function(){
			  var table = layui.table;  //数据表格组件
			  table.render({
			    elem: '#' + $vessel_id,
			    toolbar: $tools,
			    defaultToolbar: false,
			    url: $url,
			    where: $where,
			    page: {
			      layout: ['count', 'prev', 'page', 'next', 'skip'],
			    },
			    cols: $cols,
			  });
			  layer.close(load);
			});			
		},
		
		/**
		 * @description 表单填写错误
		 * @param {Object} _cur  当前表单标签
		 * @param {Object} $err_msg  错误提示
		*/
		_from_error: function(_cur, $err_msg)
		{
			_cur.focus();
			return dialog.hint(10001, $err_msg);
		},
		
		/**
		 * @description 输入安全操作码
		 * @param {Object} $title  校验验证码的目的
		 * @param {Object} callback  校验的回调函数
		 */
		_importSecurityCode: function($title, callback, cancelCallback)
		{
			layer.prompt({
			  formType: 1,
			  title: '请输入安全码(默认登陆密码)',
			  btn2: function(){
			  	if (typeof(cancelCallback) == "function")
			  		cancelCallback();
			  },
			}, function(value, index, elem){
				callback(value, index);
			}, function(){
				
			});
		},
		
		/**
		 * @description 侧边栏切换
		 * @param {Object} $controller  控制器
		 * @param {Object} $anchor  方法名
		 */
		sidenavChange: function($controller, $anchor)
		{
			$('#right').load('/' + $controller + '/' + $anchor, '', function(){
				layer.close(load);
			});
		},
		
		/**
		 * hash定位
		 * @param {Object} $controller
		 */
		hashLocation: function($controller)
		{
			//Tab切换进行Hash地址的定位
			var $curr_anchor = location.hash.replace(/^#anchor=/, '');
			$('li[data-anchor=' + $curr_anchor + ']').addClass('active_li').siblings().removeClass('active_li');
			Tools.sidenavChange($controller, $curr_anchor);
		},
		
		_load: function($vessel_id, $url, callback)
	  {
			$('#' + $vessel_id).load($url, '', function(response,status,xhrs){
				try {
            var datas = JSON.parse(response);
            if (datas.code == 1215)
            {
            	dialog.confirm(datas.message, function(){
								top.location.href="/index/login"
							});
            }
        } catch(e) {
        	if (typeof(callback) != 'undefined') callback();
        }
				layer.close(load);
			});
		},
		
		/**
		 * @description  倒计时控件
		 * @param {Object} $end  结束时间，毫秒时间戳
		 * @param {Object} $now  当前时间， 毫秒时间戳
		 * @param {Object} callback  计时结束的回调函数
		 */
		_countdown: function($end, $now, callback)
		{
			layui.use('util', function(){
			  var util = layui.util;
			  		endTime = $end
			  		serverTime = $now;
			  util.countdown(endTime, serverTime, function(date, serverTime, timer){
			  		callback(date);
			  });
			});
		},
		
		
		_btnCountdown: function($vessel, $duration, callback, $isGoOn)
		{
			var serverTime = new Date().getTime();
			if (localStorage.hasOwnProperty('memory_end') == false && $isGoOn == true)
			{
				localStorage.setItem('memory_end', serverTime + $duration * 1000);
			}
			var $this = $('#' + $vessel),
		  		endTime = $isGoOn == true ? parseInt(localStorage.getItem('memory_end')) : serverTime + $duration * 1000,
		  		cur_html = $this.html();
			$this.addClass('layui-btn-disabled');
  		Tools._countdown(endTime, serverTime, function(date){
  			layui.$('#' + $vessel).html(cur_html + '(' + (date[2] != 0 ? date[2] + '分' : '') + date[3] + '秒)');
  			if (date[2] == 0 && date[3] == 0)
  			{
  				$this.html(cur_html).removeClass('layui-btn-disabled');
  				callback();
  			}
  		});
		},
		
		/**
		 * @description  开始做任务
		 * @param {Object} $tid  任务表ID
		 * @param {Object} $task_type  任务类型
		 * @param {Object} $win_name  窗口名称
		 */
		doTask: function($tid, $task_type, $win_name)
		{
			dialog.iframe('/task/doTasks?type=normal&tid=' + $tid + '&type=' + $task_type, 1200, 600 , $win_name)
		},
		
		cancelTask: function($tid, $task_type)
		{
			dialog.iframe('/task/cancelTask?type=normal&tid=' + $tid + '&type=' + $task_type, 600, 460 , '取消任务')
		}
		,
		hideSoundCode: function()
		{
			Source=document.body.firstChild.data;
			document.open();
			document.close();
			document.body.innerHTML=Source;
		},
		autoScroll: function(obj, height)
		{
			$(obj).find("ul").animate({  
				marginTop : "-" + height + "px",
			}, 800, function(){  
				$(this).css({marginTop : "0px"}).find("li:first").appendTo(this);  
			})  
		},
		
		/**
		 * @descriptioncopy评价内容
		 */
		copyContent: function($content)
		{
            
            
            if ($('#copy').length == 0)
                $(document.body).append('<textarea id="copy" style="display:none;"></textarea>');
            
            var copy_vector = $('#copy');
            
			copy_vector.text($content).show();
            var obj = document.getElementById("copy");
            obj.select();
            document.execCommand('copy', false, null);
            copy_vector.hide();
			layer.msg('所选内容已经为您准备到粘贴板');
		},
        
        /**
         * 校验数据格式是否正确
         */
        verifyDataFormat: (verify_val, date_type) => {
            switch (date_type)
            {
                case('phone'):
                    var pattern = args.mobile_format;
                    if (!pattern.test(verify_val)) 
                        return false;
                    break;
                case('qq'):
                    var pattern =   /^[1-9]\d{4,9}$/;
                    if (!pattern.test(verify_val)) 
                        return false;
                    break;
                case('mail'):
                    var pattern = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
                    if (!pattern.test(verify_val)) 
                        return false;
                    break;
                case('mobile_phone'):
                    var pattern = args.mobile_format;
                    var tel_pattern = /^0\d{2,3}-?\d{7,8}$/;
                    if (!pattern.test(verify_val) && !tel_pattern.test(verify_val)) 
                        return false;
                    break;
            }
            return true;
        }
};

var args = {
	dropify: {
		messages: {
        'default': '点击或拖拽上传',
        'replace': '点击或拖拽替换',
        'remove':  '删除',
        'error':   '文件不符合条件，请重新选择',
    },
    error: {
        'fileSize': '文件超过 ({{ value }})',
        'fileExtension': '文件格式仅支持上传({{ value }})',
    },
	},
	sampleGraph: {
		'staffTmp': '/images/sampleSraph/staffTmp.png',  //生意参谋示例图
		'GroupGrCodeTmp': '/images/sampleSraph/GroupGrCodeTmp.png',  //生意参谋示例图
	},
	mobile_format: /^1[3456789]\d{9}$/,
};