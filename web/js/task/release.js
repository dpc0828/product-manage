var myDate = new Date(),
	$min_time = Appendzero(myDate.getHours()) + ':' + myDate.getMinutes() + ':' + myDate.getSeconds(), //获取当前时间
	MD = ((myDate.getMonth() + 1) < 10 ? "0" : "") + (myDate.getMonth() + 1) + "-" + (myDate.getDate() + 1 < 10 ? "0" : "") + (myDate.getDate() + 1),
	//预约单的laydate公共属性
	subscribeTimeArg = {
		type: 'datetime',
		range: '~',
//		min: myDate.getFullYear() + "-" + MD + ' 09:00:00',
//		max: 3,
		change: function(value, date, endDate){
			if (checkSubscribeTime(value) == false)
				layer.msg("预约下单的时间间隔不能小于4个小时");
       	},
       	trigger: 'click', //采用click弹出
       	format: 'yyyy-MM-dd HH:mm',
//		value: MD + ' 09:00 ~ ' + MD + ' 23:59',
	},
	MorrowTimeArg = {
		type: 'time',
		range: '~',
		min: '09:00:00',
		change: function(value, date, endDate){
			if (checkSubscribeTime(value) == false)
				laydateObj[index].hint("预约第二天下单的时间间隔不能小于4个小时");
       	},
       	trigger: 'click', //采用click弹出
       	format: 'HH:mm',
		value: ' 09:00 ~ 23:59',
	},
	_timeTable = $("#time_table"),  //不选择【多关键词分别设置时间】的发布时间table
	_keywordTable = $("#keyword_table"); //选择【多关键词分别设置时间】的发布时间table

//监听任务管理界面当中，tab的切换事件
layui.use(['form', 'laydate', 'slider'], function() {
	var form = layui.form,
		laydate = layui.laydate,
		slider = layui.slider;
	
	// 分别初始化开始、结束、取消时间，使其产生最大最小值的联动
	var overTimeObject = {},
		beginTimeObject = {},
		cancelTimeObject = {},
		baseConfig = {
			type: 'time',
			trigger: 'click',
		};
	
	// 开始平均发布时间
	$('#time_tbody .begin, #oneKeySetTime .begin').each(function(index) {
		baseConfig.elem = this;
		baseConfig.min = index == 0 ? $min_time : '';
		baseConfig.done = function(value, date) {
			overTimeObject[index].config.min
			= cancelTimeObject[index].config.min
			= {
				year:date.year,
				month:date.month - 1,
				date: date.date,
				hours: date.hours, 
				minutes: date.minutes, 
				seconds : date.seconds + 1,
			};
		};
		beginTimeObject[index] = laydate.render(baseConfig);
	});
	
	// 结束平均发布时间
	$('#time_tbody .over, #oneKeySetTime .over').each(function(index) {
		baseConfig.elem = this;
		baseConfig.min = index == 0 ? $min_time : '';
		baseConfig.done = function(value, date) {
			cancelTimeObject[index].config.min
			= beginTimeObject[index].config.max
			= {
				year:date.year,
				month:date.month - 1,
				date: date.date,
				hours: date.hours, 
				minutes: date.minutes, 
				seconds : date.seconds,
			};
		};
		overTimeObject[index] = laydate.render(baseConfig);
	});
	
	// 取消发布时间
	$('#time_tbody .time.cancel, #oneKeySetTime .cancel').each(function(index) {
		baseConfig.elem = this;
		baseConfig.min = index == 0 ? $min_time : '';
		baseConfig.done = function(value, date) {
			overTimeObject[index].config.max
			= beginTimeObject[index].config.max
			= {
				year:date.year,
				month:date.month - 1,
				date: date.date,
				hours: date.hours, 
				minutes: date.minutes, 
				seconds : date.seconds - 1,
			};
		};
		cancelTimeObject[index] = laydate.render(baseConfig);
	});
	
	// 尾款开始支付时间
	begin_payment = laydate.render({
		elem: '#b_payment',
		type: 'datetime',
		min: $min_time,
		trigger: 'click',
		done: function(value, date) {
			end_payment.config.min
			= {
				year:date.year,
				month:date.month - 1,
				date: date.date,
				hours: date.hours, 
				minutes: date.minutes, 
				seconds : date.seconds - 1,
			};
		},
	});
	
	// 尾款最晚支付时间
	end_payment = laydate.render({
		elem: '#e_payment',
		type: 'datetime',
		min: $min_time,
		trigger: 'click',
		done: function(value, date) {
			begin_payment.config.max
			= {
				year:date.year,
				month:date.month - 1,
				date: date.date,
				hours: date.hours, 
				minutes: date.minutes, 
				seconds : date.seconds - 1,
			};
		},
	});
	
	// 退款单时间选择器
	refund_time = laydate.render({
		elem: '#refund_time',
		type: 'datetime',
		min: 1,
		max: 15,
		trigger: 'click'
	});
	
	$('.subscribeTime').each(function(index) {
		var currId = $("input[name=curr_id]").val(),
			subscribe_day = 2;
		if (currId == 15771)
			subscribe_day = 4;
		if (currId == 21511 || currId == 23265 || currId == 21648 || true)
			subscribe_day = 5;
		var curTime = new Date().getTime(),
			oneDate = 60 * 60 * 24 * 1000;
			startDate = curTime + (oneDate * (index + 1)),
			endDate = startDate + (oneDate * subscribe_day), //可预约3天之内的时间
			theDate = new Date(startDate),
			theEndDate = new Date(endDate),
			MD = ((theDate.getMonth() + 1) < 10 ? "0" : "") + (theDate.getMonth() + 1) + "-" + (theDate.getDate() < 10 ? "0" : "") + (theDate.getDate());
			EndMD = theEndDate.getFullYear() + "-" + ((theEndDate.getMonth() + 1) < 10 ? "0" : "") + (theEndDate.getMonth() + 1) + "-" + (theEndDate.getDate() < 10 ? "0" : "") + (theEndDate.getDate());
		var currId = $("input[name=curr_id]").val(),
			minTime = " 09:00:00";
		if (currId == 23280 || currId == 4226 || currId == 13373 || currId == 13919 
                || currId == 22678 || currId == 4609 || currId == 21648 || currId == 17068 
                || currId == 9366 || currId == 15957 || currId == 5241 || currId == 19810 
                || currId == 20818 || currId == 23317 || currId == 29217
        )
			minTime = " 00:00:00";
		var curr_ymd = theDate.getFullYear() + "-" + MD;
		subscribeTimeArg.min = curr_ymd + minTime;
		subscribeTimeArg.max = EndMD + " 23:59:59";
		subscribeTimeArg.value = curr_ymd + ' 09:00 ~ ' + curr_ymd + ' 23:59';
		subscribeTimeArg.elem = this;
		laydate.render(subscribeTimeArg);
	});
	
	$('.alone_subscribeTime').each(function(index) {
		var currId = $("input[name=curr_id]").val(),
			subscribe_day = 2;
		if (currId == 15771)
			subscribe_day = 4;
		if (currId == 21511 || currId == 23265 || currId == 21648 || true)
			subscribe_day = 5;
		var curTime = new Date().getTime(),
			oneDate = 60 * 60 * 24 * 1000;
			startDate = curTime + (oneDate * 1),
			endDate = startDate + (oneDate * subscribe_day), //可预约3天之内的时间
			theDate = new Date(startDate),
			theEndDate = new Date(endDate),
			MD = ((theDate.getMonth() + 1) < 10 ? "0" : "") + (theDate.getMonth() + 1) + "-" + (theDate.getDate() < 10 ? "0" : "") + (theDate.getDate());
			EndMD = theEndDate.getFullYear() + "-" + ((theEndDate.getMonth() + 1) < 10 ? "0" : "") + (theEndDate.getMonth() + 1) + "-" + (theEndDate.getDate() < 10 ? "0" : "") + (theEndDate.getDate());
		var currId = $("input[name=curr_id]").val(),
			minTime = " 09:00:00";
		if (currId == 23280 || currId == 4226 || currId == 13373 || currId == 13919 
                || currId == 22678 || currId == 4609 || currId == 17068 || currId == 21648 
                || currId == 9366 || currId == 15957 || currId == 5241 || currId == 19810
                || currId == 20818 || currId == 23317 || currId == 29217
         )
			minTime = " 00:00:00";
		
		var curr_ymd = theDate.getFullYear() + "-" + MD;
		subscribeTimeArg.min = curr_ymd + minTime;
		subscribeTimeArg.max = EndMD + " 23:59:59";
		subscribeTimeArg.value = curr_ymd + ' 09:00 ~ ' + curr_ymd + ' 23:59';
		subscribeTimeArg.elem = this;
		laydate.render(subscribeTimeArg);
	});
	
	// 再次浏览时间设置
	$('.second_visit_time').each(function(index) {
		var currId = $("input[name=curr_id]").val(),
			subscribe_day = 2;
		if (currId == 15771)
			subscribe_day = 4;
		var curTime = new Date().getTime(),
			oneDate = 60 * 60 * 24 * 1000;
			startDate = curTime + (oneDate * (index + 1)),
			endDate = startDate + (oneDate * subscribe_day), //可预约3天之内的时间
			theDate = new Date(startDate),
			theEndDate = new Date(endDate),
			MD = ((theDate.getMonth() + 1) < 10 ? "0" : "") + (theDate.getMonth() + 1) + "-" + (theDate.getDate() < 10 ? "0" : "") + (theDate.getDate());
			EndMD = theEndDate.getFullYear() + "-" + ((theEndDate.getMonth() + 1) < 10 ? "0" : "") + (theEndDate.getMonth() + 1) + "-" + (theEndDate.getDate() < 10 ? "0" : "") + (theEndDate.getDate());
		var currId = $("input[name=curr_id]").val(),
			minTime = " 09:00:00";
		if (currId == 4226)
			minTime = " 00:00:00";
		
		var curr_ymd = theDate.getFullYear() + "-" + MD;
		subscribeTimeArg.min = curr_ymd + minTime;
		subscribeTimeArg.max = EndMD + " 23:59:59";
		subscribeTimeArg.value = curr_ymd + ' 09:00 ~ ' + curr_ymd + ' 23:59';
		subscribeTimeArg.elem = this;
		laydate.render(subscribeTimeArg);
	});
	
	
	// 再次浏览时间@为多个关键词设置时间
	$('.alone_second_visit_time').each(function(index) {
		var currId = $("input[name=curr_id]").val(),
			subscribe_day = 2;
		if (currId == 15771)
			subscribe_day = 4;
		var curTime = new Date().getTime(),
			oneDate = 60 * 60 * 24 * 1000;
			startDate = curTime + (oneDate * 1),
			endDate = startDate + (oneDate * subscribe_day), //可预约3天之内的时间
			theDate = new Date(startDate),
			theEndDate = new Date(endDate),
			MD = ((theDate.getMonth() + 1) < 10 ? "0" : "") + (theDate.getMonth() + 1) + "-" + (theDate.getDate() < 10 ? "0" : "") + (theDate.getDate());
			EndMD = theEndDate.getFullYear() + "-" + ((theEndDate.getMonth() + 1) < 10 ? "0" : "") + (theEndDate.getMonth() + 1) + "-" + (theEndDate.getDate() < 10 ? "0" : "") + (theEndDate.getDate());
		var currId = $("input[name=curr_id]").val(),
			minTime = " 09:00:00";
		if (currId == 4226)
			minTime = " 00:00:00";
		
		var curr_ymd = theDate.getFullYear() + "-" + MD;
		subscribeTimeArg.min = curr_ymd + minTime;
		subscribeTimeArg.max = EndMD + " 23:59:59";
		subscribeTimeArg.value = curr_ymd + ' 09:00 ~ ' + curr_ymd + ' 23:59';
		subscribeTimeArg.elem = this;
		laydate.render(subscribeTimeArg);
	});
	
	form.on('select(line_day)', function(data) {
		var select_day = data.value;
		var Html = '<input type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel alone_subscribeTime" placeholder="预约下单时间">';
		$("#keyword_table td.subscribe_set").html(Html);
		$('.alone_subscribeTime').each(function(index) {
			var curTime = new Date(select_day).getTime(),
				oneDate = 60 * 60 * 24 * 1000;
				startDate = curTime + (oneDate * 1),
				endDate = startDate + (oneDate * 2), //可预约3天之内的时间
				theDate = new Date(startDate),
				theEndDate = new Date(endDate),
				MD = ((theDate.getMonth() + 1) < 10 ? "0" : "") + (theDate.getMonth() + 1) + "-" + (theDate.getDate() < 10 ? "0" : "") + (theDate.getDate());
				EndMD = theEndDate.getFullYear() + "-" + ((theEndDate.getMonth() + 1) < 10 ? "0" : "") + (theEndDate.getMonth() + 1) + "-" + (theEndDate.getDate() < 10 ? "0" : "") + (theEndDate.getDate());
			var currId = $("input[name=curr_id]").val(),
				minTime = " 09:00:00";
			if (currId == 23280 || currId == 4226 || currId == 13373 || currId == 13919 || currId == 22678 || currId == 4609 || currId == 21648
                    || currId == 17068 || currId == 9366 || currId == 15957 
                    || currId == 5241 || currId == 19810 || currId == 20818 
                    || currId == 23317 || currId == 29217
            )
				minTime = " 00:00:00";
			subscribeTimeArg.min = theDate.getFullYear() + "-" + MD + minTime;
			subscribeTimeArg.max = EndMD + " 23:59:59";
			subscribeTimeArg.value = theDate.getFullYear() + "-" + MD + ' 09:00 ~ ' + theDate.getFullYear() + "-" + MD + ' 23:59';
			subscribeTimeArg.elem = this;
			laydate.render(subscribeTimeArg);
		});
		
		$(".alone_day").val(select_day);
		
		// 重置为多个关键词设置时间中的浏览回看时间
		var Html = '<input type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel alone_second_visit_time" placeholder="浏览回看时间">';
		$("#keyword_table td.browse_set").html(Html);
		$('.alone_second_visit_time').each(function(index) {
			var curTime = new Date(select_day).getTime(),
				oneDate = 60 * 60 * 24 * 1000;
				startDate = curTime + (oneDate * 1),
				endDate = startDate + (oneDate * 2), //可预约3天之内的时间
				theDate = new Date(startDate),
				theEndDate = new Date(endDate),
				MD = ((theDate.getMonth() + 1) < 10 ? "0" : "") + (theDate.getMonth() + 1) + "-" + (theDate.getDate() < 10 ? "0" : "") + (theDate.getDate());
				EndMD = theEndDate.getFullYear() + "-" + ((theEndDate.getMonth() + 1) < 10 ? "0" : "") + (theEndDate.getMonth() + 1) + "-" + (theEndDate.getDate() < 10 ? "0" : "") + (theEndDate.getDate());
			var currId = $("input[name=curr_id]").val(),
				minTime = " 09:00:00";
			if (currId == 4226)
				minTime = " 00:00:00";
			
			var curr_ymd = theDate.getFullYear() + "-" + MD;
			subscribeTimeArg.min = curr_ymd + minTime;
			subscribeTimeArg.max = EndMD + " 23:59:59";
			subscribeTimeArg.value = curr_ymd + ' 09:00 ~ ' + curr_ymd + ' 23:59';
			subscribeTimeArg.elem = this;
			laydate.render(subscribeTimeArg);
		});
		selectAloneDaySyncOther();
	})
	
	var laydateObj = [];
	//标签任务单独预约第二天下单时间
	$('input[name="morrow_time[]"]').each(function(index) {
		MorrowTimeArg.elem = this;
		laydateObj[index] = laydate.render(MorrowTimeArg);
	});
	//监听任务类型的选择
	form.on('radio(tasktype)', function(data) {
		var sales_set = $('.sales_set'),
			subscribe_set = $('.subscribe_set'),
			flow_set = $('.flow_set'),
			purchase_set = $('.purchase_set'),
			presell_set = $('.presell_set'),
			more_set = $('.more_set'),
			diff_more = $('.diff_more'),
			tag_set = $('.tag_set'),  // 标签任务
			tag_hide = $('.tag_hide'),  // 标签任务设置的时候需要隐藏的项
			micro_set = $('.micro_set'),  // 微淘任务设置项
			browse_set = $('.browse_set'),  // 浏览任务设置项
			advance_set = $('.advance_set'),  // 提前购设置项
			new_retail_set = $('.new_retail'),  // 新零售设置项
			ab_set = $('.ab_set'),  // AB单设置项
			select_entrance = $('select[name="entrance[]"]'),  // 流量入口选择框
            keyword_input = $("input[name='keyword[]']"), // 关键词输入框集合
            express_set = $("#express_set"); // 快递类型设置
		tag_set.addClass('hide');
		presell_set.addClass('hide');
		micro_set.addClass('hide');
		browse_set.addClass('hide');
		tag_hide.removeClass('hide');
		advance_set.addClass('hide');
		new_retail_set.addClass('hide');
		ab_set.addClass('hide');
		express_set.removeClass('hide');
        keyword_input.attr('readonly', false);
		$('.remind_cart, .remind_chat, .remind_collect').removeClass('hide');
		select_entrance.html($('#common_entrance').html());
		more_set.addClass('hide').find("input:not(._Model)").attr("disabled", true);
		diff_more.removeClass('hide').find("input:not(._Model)").attr("disabled", false);
		if (data.value == 1 || data.value == 5 || data.value == 16)
			sales_set.removeClass('hide');
		else
			sales_set.addClass('hide');
		switch(data.value) {
			case '1': //销量任务
				purchase_set.removeClass('hide');
				flow_set.addClass('hide');
				subscribe_set.addClass('hide');
				select_entrance.html($('#sales').html());
				break;
			case '4':  //预定任务
				purchase_set.removeClass('hide');
				presell_set.removeClass('hide');
				flow_set.addClass('hide');
				subscribe_set.addClass('hide');
				break;
			case '5':  //预约任务
				purchase_set.removeClass('hide');
				flow_set.addClass('hide');
				subscribe_set.removeClass('hide');
				break;
			case '6': //流量任务
				flow_set.removeClass('hide');
				purchase_set.addClass('hide');
				subscribe_set.addClass('hide');
				break;
			case '7':  //猜你喜欢
				subscribe_set.addClass('hide');
				purchase_set.removeClass('hide');
				flow_set.addClass('hide');
				select_entrance.html($('#like').html());
				break;
			case '8':  //多链任务
				subscribe_set.addClass('hide');
				purchase_set.removeClass('hide');
				flow_set.addClass('hide');
				diff_more.addClass("hide").find("input:not(._Model)").attr("disabled", true);
				more_set.removeClass('hide').find("input:not(._Model)").attr("disabled", false);
				select_entrance.html($('#multilink_entrance').html());
                break;
			case '10':  //标签任务
				subscribe_set.addClass('hide');
				tag_hide.addClass('hide');
				flow_set.addClass('hide');
				tag_set.removeClass('hide');
				select_entrance.html($('#tagPortal').html());
				break;
			case '11':  //微淘任务
				subscribe_set.addClass('hide');
				flow_set.addClass('hide');
				tag_set.addClass('hide');
				micro_set.removeClass('hide');
				select_entrance.html($('#microPortal').html());
				break;
			case '12':  //预约任务
				purchase_set.removeClass('hide');
				flow_set.addClass('hide');
				subscribe_set.removeClass('hide');
				browse_set.removeClass('hide');
				break;
			case '13': // 提前购
				$('.remind_cart, .remind_chat, .remind_collect').addClass('hide');
				advance_set.removeClass('hide');
				purchase_set.removeClass('hide');
				flow_set.addClass('hide');
				subscribe_set.addClass('hide');
				select_entrance.html($('#advancePortal').html());
				break;
            case '15': // 新零售
                new_retail_set.removeClass('hide');
            	advance_set.removeClass('hide');
            	purchase_set.removeClass('hide');
            	flow_set.addClass('hide');
            	subscribe_set.addClass('hide');
            	select_entrance.html($('#new_retail_portal').html());
                
                keyword_input.attr('readonly', true).val('');
                express_set.addClass('hide');
            	break;
                
            case '16': // AB单
            	ab_set.removeClass('hide');
            	purchase_set.removeClass('hide');
            	flow_set.addClass('hide');
            	subscribe_set.addClass('hide');
            	select_entrance.html($('#advancePortal').html());
            	break;
		}
		//切换型号单选框的选择对象
		var currSel = $("input[name=model]:checked").val();
		$("#pricing:not('.hide') input[name=model][value=" + currSel + "]").prop("checked", true);
		inputTaskNum();
		form.render();
	});
	
	//监听任务类型的选择
	form.on('radio(helpMe)', function(data) {
		localStorage.setItem("select_helpMe_value", data.value)
	});
	
	form.on('checkbox(Invert)', function(data){
		$('input[name="invert[]"]').each(function(){
			var checkState = $(this).prop("checked") == false;
			$(this).prop("checked", checkState);
        })
        form.render('checkbox');
	}); 

	//监听流量入口的选择
	form.on('select(entrance)', function(data) {
		var $obj = $(data.elem).parents('tr');
		$keyword = $obj.find('input[name="keyword[]"]'),
			$other = $obj.find('.other-search');
		switch(data.value) {
			case '3':
				$keyword.attr('placeholder', '请输入淘口令').attr('readonly', false).val('');
				$other.attr('disabled', true).addClass('layui-btn-disabled');
				break;
			case '6':
			case '8':
			case '11':
				$keyword.attr('readonly', true).val('');
				$other.attr('disabled', true).addClass('layui-btn-disabled');
				break;
			case '9':
				$keyword.attr('placeholder', '请输入聚划算中的浏览类目，如男装 / 鞋靴。').attr('readonly', false).val('');
				$other.attr('disabled', false).removeClass('layui-btn-disabled');
				break;
			default:
				$keyword.attr('placeholder', '请输入搜索关键词').attr('readonly', false).val('');
				$other.attr('disabled', false).removeClass('layui-btn-disabled');
				break;
		}
		//根据流量入口，选择是否禁用同时发布流量任务的按钮
		var Sel = $obj.find("select[name='entrance[]'] option:selected").hasClass("purchase_set"),
			SameFlow = $obj.find(".same_flow");
		if (Sel == true)
		{
			SameFlow.prop("disabled", true).prop("checked", false);
		}
		else
			SameFlow.prop("disabled", false);
		form.render('checkbox');
	});
	
	//监听发布认无日期的选择
	form.on('checkbox(date)', function(data){
	  var $release_time = $('input[name=release_time]:checked').val();
	  if ($release_time == 2)  //多天平均发布
	  {
	  	var $checked = $('input[name="date[]"]:checked').length,
	  		$origin = $('input[name="gross[]"]').length;
	  		$pricing = $('input[name="pat_count[]"]:not(:disabled)').length;
  		//if ($checked > $origin && $origin > 1 &&  $pricing > 1)  //限制tt == t
  		if (($origin > 1 || $pricing > 1) && $checked > $origin && $checked > $pricing)  //限制tt == t
  		{
  			$(data.elem).prop('checked', false);
			data.othis.removeClass('layui-form-checked');
  			dialog.hint(30004, '根据规则，当来路设置或定价类型的行数大于1时， 多天平均发布的天数不能大于它们')
  		}
	  }
	  var $curr_tr = $(data.elem).parents('tr');
	  if ($release_time != 0)
	  	$curr_tr.find('input').not(':checkbox').attr('disabled', false);
	  else
	  	$curr_tr.find('input').not(':checkbox, .begin, .over').attr('disabled', false);
  	  $('input[name="date[]"]').not(':checked').parents('tr').find('input').not(':checkbox').attr('disabled', true);
	  $curr_tr.find('[name="day_num[]"]').val(0);
	  inputTaskNum();
	  judgeDisabled();
	}); 

	//监听增值信息的选择
	form.on('select(appreciation)', function(data) {
		batchServePrice();
		var $curr_num = getTaskGross(true);
		var TotalCost = getPricePoint($curr_num, 'flow') + parseFloat($('#appreciation_cost').html());
		$('span#total_cost').html(TotalCost.toFixed(2)); //加上增值费，计算总额
		inputTaskNum();
		priceCalculate(true);
	});

	//监听单/多型号的选择
	form.on('radio(model)', function(data) {
		var $disable = data.value == '0' ? true : false;
		$('#pricing:not(.hide) input.set_pat_model').attr('disabled', $disable).val('');
	});
	//监听发布时间类型的选择
	form.on('radio(release-time)', function(data) {
		var $is_dis = data.value != '1' ? true : false,
			$hide_days = $('#releaseTime tbody#time_tbody tr').not(':first');
		handleAloneKeyword(false);
		$('#time_tbody .begin').attr('disabled', $is_dis);
		$('#time_tbody .over').attr('disabled', $is_dis);
		$('#time_tbody .cancel').slice(3).attr('disabled', $is_dis);
		$('input[name="day_num[]"]')
		.attr('readonly', true)
		.not(':first').val(0)
		.attr('disabled', true);
		$("input[name=alone]").attr("checked", false);
		allocateTaskToDay(980);
		switch(data.value) {
			case '0':
			case '1':
				$hide_days.addClass('hide');
				$('input[name="date[]"]').not(':first').prop('checked', false);
				$('input[name="date[]"]:first').prop('checked', true);
				break;
			case '2':
				$('input[name="date[]"]:checked').parents('tr').find('input').not(':checkbox').attr('disabled', false);
//				$('.subscribe').attr('disabled', $is_dis);
//				$('.time').attr('disabled', $is_dis);
//				$('input[name="day_num[]"]').attr('disabled', false);
				$hide_days.removeClass('hide');
				break;
		}
		traverseTaskNum();
		form.render();
		//		var $disable = data.value == '0' ? true :false;
		//		$('input[name="Model[]"]').attr('disabled', $disable).val('');
	});
	
	//监听【为多个关键词分别设置时间】按钮的勾选
	form.on('checkbox(alone)', function(data){
	  	handleAloneKeyword(data.elem.checked);
		selectAloneDaySyncOther();
	}); 
	
	//监听标签任务 @ 下单时间的选择
	form.on('select(order_time)', function(data) {
		var Obj = $(data.elem).parents('tr'),
			MorrowTime = Obj.find("p.morrow_time"),
			ValidTime = Obj.find("p.valid_time");
		ValidTime.removeClass("hide");
		switch(data.value) {
			case '0':
				ValidTime.addClass("hide");
				MorrowTime.addClass("hide");
				break;
			case '1':
				MorrowTime.addClass("hide");
				break;
			default:
				MorrowTime.removeClass("hide");
				ValidTime.addClass("hide");
				break;
		}
	});
	
	//滑块设置基础费用
	if (typeof(Grads) != "undefined")
	{
		slider.render({
		   elem: '#BasicsSlide',
		   theme: $("#time_tbody > tr:nth-child(1) > td:nth-child(1) > div > span").css("background-color"),
		   min: Grads * 10,
		   max: FlowBasicsSlide_Max * 10,
		   value: Grads * 10,
		   setTips: function(value){ //自定义提示文本
		   	return value / 10;
		   },
		   change:function(value){
		   	$("#ShowBasicsSlide").html(value);
		   	$("input[name=basics_slide]").val(value);
		   	inputTaskNum();
		   	priceCalculate(true);
		   }
		});		
	}
	
	//关联流量任务标志设置
	form.on("radio(relevance_flow_tag)", function(data){
		CheckBondFlowTag();
	});
	
	//派发任务设置，关联流量任务，强制只能选其中一项
	form.on("checkbox(relevance_flow)", function(data){
		$('input[name=relevance_flow]').not(data.elem).each(function(){
			if ($(this).prop("checked") == true)
				$(this).prop("checked", false);
        })
		CheckBondFlowTag();
		form.render('checkbox');
	});
	
	//监听同时发布流量单勾选框的选择，对应显示流量任务操作栏
	form.on("checkbox(same_flow)", function(data){
		var Len = $('input.same_flow:checked').length,
			FlowSet = $(".flow_set");
        inputTaskNum();
		priceCalculate(true);
		if (Len > 0)
			FlowSet.removeClass("hide");
		else
			FlowSet.addClass("hide");
	});
    
    //  监听快递类型的选择
    form.on('radio(express_type)', function(data) {
    	calculateExpress();
    });
	
	form.render();
});

$(function() {
	bsStep();
	$(document).on("focus", "input[type=number]:not([readonly])", function(){
		var currVal = $(this).val();
	  	if (currVal == "" || currVal == 0)
		  	$(this).val("");
	}).on("blur", "input[type=number]:not([readonly])", function(){
		var currVal = $(this).val();
	  	if (currVal == "" || currVal == 0)
		  	$(this).val(0);
	});
	dialog.tipsByMouseenterAndleave("预约下单时间的规则和方法：<br />1、可以预约未来三天的时间，时间间隔不能小于4个小时；<br />2：点击弹出时间选择面板，选择日期的时候，点击第一下选中开始付款日期，点击第二下选中结束付款日期。点击左下角选择时间。<br />3、如果您想在选择一天的周期付款，比如06-09 09:00 ~ 06-09 21:00内付款，可以在选择日期的面板上对“9”点击两次鼠标左键，右下角的“确认”键不是灰色的表示操作成功，然后选择时间即可", "#sub_set_tip");
})

/**
 * 选择为多个关键词设置时间的时候同步其它模块的日期勾选
 */
function selectAloneDaySyncOther()
{
	sel_index = $("select[name=line_day] option:selected").index();
	$("input[name='date[]']")
	.prop("checked", false)
	.eq(sel_index)
	.prop("checked", true);
	
	// 分别初始化开始、结束、取消时间，使其产生最大最小值的联动
	var min_time = sel_index == 0 ? $min_time : '';
	if (typeof(keyword_beginTimeObject) == "undefined")
	{
		keyword_overTimeObject = {};
		keyword_beginTimeObject = {};
		keyword_cancelTimeObject = {};
		var baseConfig = {
				type: 'time',
				trigger: 'click',
				min: min_time,
			};
		
		// 开始平均发布时间
		$('#keyword_tbody .begin').each(function(index) {
			baseConfig.elem = this;
			baseConfig.done = function(value, date) {
				keyword_overTimeObject[index].config.min
				= keyword_cancelTimeObject[index].config.min
				= {
					year:date.year,
					month:date.month - 1,
					date: date.date,
					hours: date.hours, 
					minutes: date.minutes, 
					seconds : date.seconds + 1,
				};
			};
			keyword_beginTimeObject[index] = laydate.render(baseConfig);
		});
		
		// 结束平均发布时间
		$('#keyword_tbody .over').each(function(index) {
			baseConfig.elem = this;
			baseConfig.done = function(value, date) {
				keyword_cancelTimeObject[index].config.min
				= keyword_beginTimeObject[index].config.max
				= {
					year:date.year,
					month:date.month - 1,
					date: date.date,
					hours: date.hours, 
					minutes: date.minutes, 
					seconds : date.seconds,
				};
			};
			keyword_overTimeObject[index] = laydate.render(baseConfig);
		});
		
		// 取消发布时间
		$('#keyword_tbody .time.cancel').each(function(index) {
			baseConfig.elem = this;
			baseConfig.done = function(value, date) {
				keyword_overTimeObject[index].config.max
				= keyword_beginTimeObject[index].config.max
				= {
					year:date.year,
					month:date.month - 1,
					date: date.date,
					hours: date.hours, 
					minutes: date.minutes, 
					seconds : date.seconds - 1,
				};
			};
			keyword_cancelTimeObject[index] = laydate.render(baseConfig);
		});
	}
	else
	{
		var change_config = "";
		if (sel_index == "0")
			change_config = {
				year: myDate.getFullYear(),
				month: myDate.getMonth(),
				date: 1,
				hours: Appendzero(myDate.getHours()), 
				minutes: myDate.getMinutes(), 
				seconds : myDate.getSeconds(),
			};
		
		$.each(keyword_beginTimeObject, function(x, v){
			keyword_beginTimeObject[x].config.min
			= keyword_cancelTimeObject[x].config.min
			= keyword_overTimeObject[x].config.min
			= change_config
		});
	}
}

/**
 * 检查关联流量任务的参数设置 
 */
function CheckBondFlowTag()
{
	var TaskCount = getTaskGross(),
		Input = $("input[name=relevance_flow_tag]"),
		BondFlowPro = $("#bond__flow_pro").html(),
		TagValue = $("input[name=relevance_flow_tag]:checked").val(),
		BondFlowType = $("input[name=relevance_flow]:checked").val();
	if (typeof(BondFlowType) != "undefined" && $.inArray(BondFlowType, ["3"]) != -1 && typeof(BondFlowPro) != "undefined")
	{
		var BondFlowProNum = parseInt(BondFlowPro.trim());
//			BondFlowShopNum = parseInt($("#bond__flow_shop").html().trim()),
//			BondFlowCount = BondFlowProNum + BondFlowShopNum;
		if (TagValue == "0" && BondFlowProNum >= TaskCount)
			return true;
//		else if (TagValue == "1" && BondFlowShopNum >= TaskCount)
//			return true;
//		else if (TagValue == "2" && BondFlowCount >= TaskCount)
//			return true;
//		if (BondFlowCount >= TaskCount)
//		{
//			Input.eq(2).prop("checked", true);
//			form.render('radio');			
//		}
//		else
//			return dialog.hint(30004, "任务总数（" + TaskCount + "）大于所有潜在用户数，请重新配置附加设置或调整任务总数");
//		return dialog.hint(30004, "所选标志的关联数小于任务总数（" + TaskCount + "），系统已为您选择最合适的标志");
		return dialog.hint(30004, "任务总数（" + TaskCount + "单）大于所有关联流量任务的潜在用户数，任务很有可能派不完。请重新配置附加设置或调整任务总数");
	}
	return true;
}

/**
 *	@description 处理单独设置关键词的按钮 
 */
function handleAloneKeyword(isAlone)
{
	_timeTable.find("input").attr("disabled", isAlone);
	_keywordTable.find("input").attr("disabled", !isAlone);
	if (isAlone == true)
	{
		_keywordTable.removeClass("hide");
		_timeTable.addClass("hide");
	}
	else
	{
		_keywordTable.addClass("hide");
		_timeTable.removeClass("hide");
	}
	handleShowAloneBtn();
	inputKeywordAndNum();
}

/**
 * @description  根据发布时间类型和关键词数量，决定单独设置按钮的显示 / 隐藏 
 */
function handleShowAloneBtn()
{
	var _release_time = $("input[name=release_time]:checked").val(),
		$time_auxiliary = $('#time_auxiliary'),  //多关键词操作按钮容器
		_alone = $("input[name=alone]"),  //多个关键词单独设置按钮
		$is_dis = _release_time != 1;
	_alone.attr("disabled", $is_dis);
	if ($is_dis == true)
	{
		$time_auxiliary.addClass('hide');
		_alone.attr("checked", false);
	}
	else
	{
		if ($("input[name='gross[]']").length > 1)
			$time_auxiliary.removeClass('hide');
		else
			$time_auxiliary.addClass('hide');
	}
		
}

/**
 * @description 检查预约单的预约下单时间是否合法
 * @param {Object} _time
 */
function checkSubscribeTime(_time)
{
	var limit_interval = 4;
	var curr_uid = $("input[name=curr_id]").val();
	if (curr_uid == 13373 || curr_uid == 13919 || curr_uid == 22678 || curr_uid == 9366)
		limit_interval = 1;
	var _val = _time.split("~"),
		ReDate = /\d{1,2}-\d{1,2}/,
		_min = new Date(Date.parse((ReDate.test(_val[0]) == false ? ("2019-06-10 " + _val[0]) : _val[0]).replace(/-/g, "/"))),
		_max = new Date(Date.parse((ReDate.test(_val[1]) == false ? ("2019-06-10 " + _val[1]) : _val[1]).replace(/-/g, "/")));
	return _max - _min >= 60 * 60 * limit_interval * 1000;
}

/**
 * 计算快递费用 
 */
function calculateExpress()
{
	var type = $('input[name=express_type]:checked').val(),
		express_cost = $('#express_cost');
	if (type == 1)
	{
		var cost = $('input[name=express_cost]').val(),
			count = getTaskGross();
		express_cost.html((cost * count).toFixed(2));
	}
	else	
		express_cost.html(0);
}

function bsStep(i) {
	$('.step').each(function() {
		var a, $this = $(this);
		if(i > $this.find('li').length) {
			a = $this.find('li').length;
		} else if(i == undefined && $this.data('step') == undefined) {
			a = 1
		} else if(i == undefined && $this.data('step') != undefined) {
			a = $(this).data('step');
		} else {
			a = i
		}
		$(this).find('li').removeClass('active');
		$(this).find('li:lt(' + a + ')').addClass('active');
	})
}

/**
 * 遍历服务费价格
 */
function batchServePrice() {
	var $curr = null,
		$curr_percent = 0,
		$curr_num = 0,
		$curr_cost = 0,
		$total_cost = 0;
	$task_count = getTaskGross(true);
	$('.serve').each(function() {
		$curr = $(this);
		$curr_percent = $curr.find('select').val();
		$curr_num = Math.round($curr_percent / 100 * $task_count);
		$curr.find('.num').html($curr_num);
		$curr_cost = parseFloat(($curr_num * valueAddedServices($curr.data('type'))).toFixed(2));
		$total_cost += $curr_cost;
		$curr.find('.cost').html(parseFloat($curr_cost));
		if ($curr_num > 0 && $curr.data('type') == 'ask')
			$('._ask').removeClass('hide');
		else
			$('._ask').addClass('hide');
	});
	var $top = parseInt($('span#total_top').html());
	$('#appreciation_cost').html($total_cost.toFixed(1) + (isNaN($top) == false ? $top : 0));
	priceCalculate(true);
}

/**
 *选择任务类型之后，进行下一步 
 */
$('.type-btn').eq(0).on('click', function() {
	if($('input[name=tasktype]').val() != '') {
		cutStep(1, $(this));
	} else
		dialog.hint(10001, '请选择有效的任务类型');
});

/**
 *	@description 来路设置中输入任务数量
 */
function inputTaskNum()
{
	inputTop();
	traverseTaskNum();
	batchServePrice();
	calculateExpress();
	var $count = getTaskGross(),
		$pat_count = typeof($total_pat_count) == 'undefined' ? 0 : $total_pat_count,
		$pat_num = $('input[name="pat_count[]"]:not(:disabled)'),
		$day_num = 0;
	$('span#total_task').html($count);
	$('span#task_num').html($count - $pat_count);
	$('input[name="day_num[]"]').not(":disabled").each(function() {
		$day_num += parseInt($(this).val());
	});
	$('span#datTask-num').html($count - $day_num);
	if ($('i#tag').html() == 'flow')  //如果是流量任务，则进行价格预估
	{
		var $curr_num = getTaskGross();
		var TotalCost = getPricePoint($curr_num, 'flow') + parseFloat($('#appreciation_cost').html());
		$('span#total_cost').html(TotalCost.toFixed(2)); //加上增值费，计算总额
	}
	
	// 计算货比词佣金
	var curr_tasktype = $('input[name=tasktype]:checked').val();
	if (curr_tasktype == 1 || curr_tasktype == 5)
	{
		calculateVieCommission();
	}
}

/**
 * 计算货比词佣金
 */
function calculateVieCommission()
{
	var vie_keyword_num = 0;
	$('input[data-role=tagsinput]').each(function(){
		var curr_this = $(this);
		var curr_val = curr_this.val();
		if (curr_val != '')
		{
			var curr_task_num = curr_this.parents('tr.clone')
			.find('.in_task_num').val();
			vie_keyword_num += curr_val.split(',').length * curr_task_num;
		}
	});
	$('#vie_commission').html(vie_keyword_num * 1);
}

/**
 * @description 获取来路设置中输入的任务总数任务总数 
 * @param {Object} diffSame  是否区分同时发布流量任务的勾选
 */
function getTaskGross(diffSame) 
{
	var $count = 0;
	$('input[name="gross[]"]').each(function() {
		var This = $(this);
		if (typeof(diffSame) != "undefined")
		{
			var Parent = This.parents("tr");
			var _tasktype = $("input[name=tasktype]:checked").val();
			if (_tasktype != 6)
			{
				if (Parent.find("input.same_flow").length == 0 || (Parent.find(".same_flow_p").hasClass("hide") == false && Parent.find("input.same_flow").prop("checked") == false))
					return true;
			}
		}
		$count += parseInt(This.val());
	});
	return $count;
}


/**
 * @description  任务定价计算  
 * @param {Object} $tag 是否为系统主动计算。如果设置该值，则为系统主动发起计算。主要用户系统主动计算的时候，不弹出提示
 */
function priceCalculate($tag) 
{
	var $curr = null,
		$curr_price = 0, //当前行单价
		$curr_pat_num = 0, //当前行拍下件数
		$curr_pat_count = 0; //当前行分配任务数量
		$curr_express = 0, //当前行快递费
		$turnover = 0,
		$total_turnover = 0, //累计成交金额
		$total_commission = 0, //累计佣金
		$total_express = 0, //累计快递费
		$line_total = 0, //当前行合计
		$task_stock = getTaskGross(), //任务库存
		$task_margin = $('span#task_num'), //任务余量
		_taskType = $("input[name=tasktype]:checked").val();
	$total_pat_count = 0; //全局变量记录已分配任务数
	$('#pricing:not(.hide) .clone').each(function() {
		$curr = $(this);
		var _currSubPrice = 0;
		$curr_price = parseFloat($curr.find('input[name="price[]"]').val());
		$curr_pat_num = parseInt($curr.find('input[name="pat_num[]"]').val());
		$curr_pat_count = parseInt($curr.find('input[name="pat_count[]"]:not(:disabled)').val());
		$curr_express = parseFloat($curr.find('input[name="express[]"]').val());
		//已分配任务数
		if($total_pat_count + $curr_pat_count > $task_stock) {
			$curr_pat_count = 0;
			$curr.find('input[name="pat_count[]"]:not(:disabled)').val(0);
			if(typeof($tag) == 'undefined') dialog.hint(10001, '最多分配' + $task_stock + '个任务，如需增加，请在来路设置中进行设置');
			return false;
		}
		$total_pat_count += $curr_pat_count;
		$task_margin.html($task_stock - $total_pat_count);
		$curr.find("tr:not(:first)").each(function(i){
			_currSubPrice += parseFloat($(this).find("input[name='sub_price[" + i + "][]']").val()) * parseInt($(this).find("input[name='sub_pat_num[" + i + "][]']").val());
		});
		//成交金额计算
        $addition_price = 0;  // 附加的商品价格
        if (_taskType == 15)
            $addition_price = parseFloat($curr.find('input[name="pick_price[]"]').val());
            
		$turnover = parseFloat(($curr_price + $addition_price) * $curr_pat_num + $curr_express) + _currSubPrice;
		$total_turnover += $turnover * $curr_pat_count;
		$curr.find('.turnover').html($turnover.toFixed(2));
		//快递费计算
		$total_express += $curr_express * $curr_pat_count;
		$curr.find('.express').html($curr_express);
		//佣金计算
		$commission = parseFloat(getPricePoint($turnover));
		$total_commission += $commission * $curr_pat_count;
		$curr.find('.commission').html($commission);
		//当前行合计
		$line_total = $commission + $turnover;
		$curr.find('.line-total').html($line_total.toFixed(2));
	});
	$('span#total-turnover').html($total_turnover.toFixed(2));
	$('span#total-commission').html($total_commission);
	$('span#total-express').html($total_express);
	var $total = $total_turnover + $total_commission;
	$('span#total').html($total.toFixed(2));
	var $cost = parseFloat($('#appreciation_cost').html());
	$('span#total_cost').html(($total + (isNaN($cost) == false ? $cost : 0)).toFixed(2)); //加上增值费，计算总额
	SameFlowRaisePrice();
}

/**
 * @description 分配任务到每一天
 */
function allocateTaskToDay($margin) 
{
	var $tag = $('i#tag').html(),
		$curr = null,
		$curr_daytTask = 0,
		$total_dayTask = 0,
		$task_margin = $('span#datTask-num'),
		$task_stock = getTaskGross(); //任务库存
	$('#releaseTime tbody tr').each(function() {
		$curr = $(this);
		$curr_daytTask = parseInt($curr.find('input[name="day_num[]"]').val());
		$total_dayTask += $curr_daytTask;
		if($total_dayTask > $task_stock) 
		{
			$curr.find('input[name="day_num[]"]').val(0);
			dialog.hint(10001, '最多分配' + $task_stock + '个任务，如需增加，请在来路设置中进行设置2');
		}
		if($curr_daytTask > $margin && $tag != 'flow')
		{
			$total_dayTask -= $curr_daytTask;
			$curr.find('input[name="day_num[]"]').val(0);
			dialog.hint(10001, $curr.find('[name="date[]"]').val() + '剩余' + $margin + '个任务，请不要贪杯哦！');
		}
	});
	var $curr_margin = $task_stock - $total_dayTask;
	$task_margin.html($curr_margin > 0 ? $curr_margin : 0);
}

function sortNumber(a, b) {
	return b - a
}

/**
 * @description 切换步骤
 * @param {Object} $increase 增减步数
 * @param {Object} $obj  对象
 */
function cutStep($increase, $obj) {
	var $curr_vessel = $obj.parents('.step'),
		$curr = $curr_vessel.data('step');
	bar_step = $increase + 1 > 0 ? $increase + 1 : 1;
	$curr_vessel.addClass('hide');
	bsStep(bar_step);
	$(".step[data-step=" + ($curr_vessel.data('step') + $increase) + "]").removeClass('hide');
}

/**
 * @description 选择商品
 */
function selectPro(type)
{
	var _type = type || 0; 
	var tasktype = $('input[name=tasktype]:checked').val();
    var title = "选择商品";
    
    if (type == 1)
        title = "选择副宝贝";
    else if (type == 2)
        title = "选择进店款";
        
    title += "（店铺需要审核通过并且已经开通小助理，其商品才会显示在下面的列表当中）";
        
	dialog.iframe('/task/select-product?tag=' + tasktype + "&type=" + _type, 90, 90, title, "%");
}

/**
 * @description 在视图显示选择的商品信息
 * @param {Object} $parent
 */
function showProInfos($parent)
{
	$('td#abbreviation', parent.document).html($parent.find('#abbreviation').html());
	$('td#pro-id', parent.document).html($parent.find('#commodity_id').html());
	$('td#shopname', parent.document).html($parent.find('#shopname').html());
	$('td#title', parent.document).html($parent.find('#title').html());
	$('a#pro-url', parent.document).html($parent.find('#url').html()).attr('href', $parent.find('#url').html());
	$('img#pro-img', parent.document).attr('src', $parent.find('#img').html());
	$('input[name=proid]', parent.document).val($parent.find('#pid').html());
	$('input[name=sid]', parent.document).val($parent.find('#sid').html());
	parent.$('.subjoin_pro').addClass("hide").html("");
	dialog.iframe_close(1);
}

/**
 * 确定选择商品
 */
function sureSelect(_type)
{
	if (_type == 0)  //选择主宝贝
	{
		var $checked = $('input[name=pro]:checked');
		if(typeof($checked.val()) != 'undefined') 
		{
			var $parent = $checked.parents('tr'),
				proId = $parent.find('#pid').html(),
				sid = $parent.find('#sid').html(),
				tasktype = parent.$('input[name=tasktype]:checked').val(),
				needHelp = $('input[name=helpMe]:checked').val();
			Tools.ajax("/task/pull-info", {tag: proId, how: needHelp, sid: sid, tasktype: tasktype}, function(data){
				if (data.code == 200)
				{
					var TaskData = data.datas.info;
					if (needHelp > 0 && TaskData != false)  //预填充任务数据
					{
						
						parent.$("input[name='keyword[]']").val(TaskData.keyword);
						parent.$("input[name='price[]']").val(TaskData.price);
						parent.$("input[name='express[]']").val(TaskData.express);
						parent.$("input[name='pat_count[]']").val(TaskData.auction);
						parent.$("textarea[name='remark']").val(TaskData.remark);
						parent.$("input[name='gross[]']").val(TaskData.number);
						//预填充人群画像
						if (TaskData.invert != '')
						{
							var _invert = TaskData.invert.split(',');
							$.each(_invert, function(index,value){
							    parent.$("input[name='invert[]'][value='" + value + "']").prop('checked', 'true');
							});
						}
						else
							parent.$("input[name='invert[]']").prop('checked', false);
						parent.inputTaskNum();
						parent.form.render('checkbox', 'invert');
					}
					//显示关联流量任务的信息
					var RelevanceFlow = data.datas.relevanceFlow;
						UserTips = "没有潜在用户(未接任务当中,选择关联的任务会占用潜在用户数)。如需关联，请先发布流量任务。注意：下列选项不可选",
						Input = $("input[name=relevance_flow], input[name=relevance_flow_tag]", parent.document),
						RelevanceProNum = parseInt(RelevanceFlow.pro - data.datas.bond);
//					if (RelevanceFlow.pro == 0 && RelevanceFlow.shop == 0)
					if (RelevanceProNum <= 0)
					{
						Input.attr("disabled", true);
					}
					else
					{
						Input.attr("disabled", false);
//						UserTips = "潜在用户：关联商品 - <strong id='bond__flow_pro'>" + RelevanceFlow.pro + "</strong>个，关联店铺 - <strong id='bond__flow_shop'>" + RelevanceFlow.shop + "</strong>个";
						UserTips = "潜在用户数：<strong id='bond__flow_pro'>" + RelevanceProNum + "</strong>个";
//						//纠正用户选择
//						var TagInput = $("input[name=relevance_flow_tag]", parent.document);
//						if (RelevanceFlow.pro == 0)  //商品关联为0, 则取消商品标志的勾选
//						{
//							if (TagInput.eq(0).is(":checked") == true)
//							{
//								TagInput.eq(0).attr("checked", false);
//								TagInput.eq(1).attr("checked", true);
//							}						
//						}
//						if (RelevanceFlow.pro == 0)  //店铺关联为0, 则取消店铺标志的勾选
//						{
//							if (TagInput.eq(1).is(":checked") == true)
//							{
//								TagInput.eq(1).attr("checked", false);
//								TagInput.eq(0).attr("checked", true);
//							}					
//						}
					}
					parent.form.render(null, 'relevance_flow_form');
					$("#relevance_flow_user", parent.document).html(UserTips);
					showProInfos($parent);
				}
				else
					return false;
			}, null, null, null, null, true);  //忽略错误
            
            // 显示更新主图的按钮
            $("#sync-pic-btn", parent.document).removeClass("hide");
		} 
		else
			dialog.hint(10001, '未选择商品');
	}
	else if (_type == 1)  //选择副宝贝
	{
		var checked = $('input[name="pro[]"]:checked');
		if(checked.length >= 1) 
		{
			if (checked.length <= 2)
			{
				var _tr = null,
					_subPro = parent.$('#subPro'),
					_setPrice = parent.$('.setPrice'),
					masterSid = parent.$('input[name=sid]').val(),
					masterPid = parent.$('input[name=proid]').val(),
					canClose = true;
				if (masterSid == '' || masterPid == "")
				{
					dialog.confirm("请先选择一个主宝贝", function(){
						dialog.iframe_close(1);
					})
					return false;
				}
				_subPro.removeClass("hide").html("");
				_setPrice.children("tr:not(.one_tr)").remove();
				checked.each(function(i, v){
					_tr = $(this).parents("tr");
					var abbreviation = _tr.find('#abbreviation').html(),
						sid = _tr.find('#sid').html(),
						pid = _tr.find('#pid').html();
					if (masterPid == pid)
					{
						dialog.hint(30004, "副宝贝和主宝贝不能相同。已为您去掉此商品的勾选");
						$(this).prop("checked", false);
						form.render('checkbox', 'selPro');
						_subPro.addClass("hide").html("");
						canClose = false;
						return false;
					}
					if (sid != masterSid)
					{
						dialog.hint(30004, "「商品简称：" + abbreviation + "」和主宝贝不属于同一个店铺。已为您去掉此商品的勾选");
						$(this).prop("checked", false);
						form.render('checkbox', 'selPro');
						_subPro.addClass("hide").html("");
						canClose = false;
						return false;
					}
					_subPro.append(`
						<div class="layui-timeline-title">
						    <h5>【 第${i+1}个副宝贝信息 】</h5>
						      	<div class="layui-row">
									<div class="layui-col-md10">
										<input type="hidden" name="sub_proid[]" value="${pid}">
										<input type="hidden" name="sub_sid[]" value="${_tr.find('#sid').html()}">
							      		<p><span class="layui-badge layui-bg-gray">商品简称</span>&nbsp;&nbsp;${abbreviation}</p>
							      		<p><span class="layui-badge layui-bg-gray">商 品 I D</span>&nbsp;&nbsp;${_tr.find('#commodity_id').html()}</p>
							      		<p><span class="layui-badge layui-bg-gray">店铺名称</span>&nbsp;&nbsp;${_tr.find('#shopname').html()}</p>
							      		<p><span class="layui-badge layui-bg-gray">商品标题</span>&nbsp;&nbsp;${_tr.find('#title').html()}</p>
							      		<p class="text-overflow"><span class="layui-badge layui-bg-gray">商品链接</span>&nbsp;&nbsp;<a target="_blank" href="${_tr.find('#url').html()}">${_tr.find('#url').html()}</a></p>
							      	</div>
							      	<div class="layui-col-md2 subjoin_pro_img">
                                        <div class="copy_masterImg">
                                            <img class="sub_m_pic_${pid}" height="173" src="${_tr.find('#img').html()}" alt="商品主图" width="200" style="right:0;">
                                            <br/>
                                            <button
                                                type="button" 
                                                class="layui-btn layui-btn-normal margin-0 suspend_shadow layui-btn-fluid"
                                                onclick="syncMasterPic(${pid})"
                                            >同步更新主图</button>
                                        </div>
							      	</div>
								</div>
						</div>
					`);
					_setPrice.append(`
						<tr>
                    		<td>
                    			<span class="layui-badge layui-bg-black">副宝贝${i+1}</span>
                    		</td>
                    		<td>
                    			<input type="number" step="0.01" name="sub_price[${i}][]" value="0" placeholder="商品单价" data-tipmsg="当天有活动,请注意活动价格哦~" autocomplete="off" class="layui-input _tips" oninput="Tools.clearNaN(this,true); priceCalculate()">       
                    		</td>
                    		<td>
                    			<input type="number" name="sub_pat_num[${i}][]" value="1" placeholder="拍下件数" autocomplete="off" class="layui-input" oninput="Tools.clearNaN(this); priceCalculate()">       
                    		</td>
                    		<td>
                    			<input type="text" name="sub_Model[${i}][]" placeholder="指定拍下型号,不填则拍下默认型号" autocomplete="off" class="layui-input set_pat_model">       
                    		</td>
                    	</tr>
                	`);
					if (i + 1 < checked.length)
						_subPro.append("<hr />");
				});
				if (canClose == true)
					dialog.iframe_close(1);
			}
			else
				dialog.hint(10001, "最多选择两个副宝贝");
		}
		else
			dialog.hint(10001, "至少选择一个副宝贝");
	}
    else if (_type == 2)
    {
        var checked = $('input[name=pro]:checked');
        
        if(typeof(checked.val()) == 'undefined')
            return dialog.hint(10001, '请选择一个进店款');
            
        var _tr = null,
        	master_shopid = parent.$('input[name=sid]').val(),
        	master_proid = parent.$('input[name=proid]').val();
            
        if (master_shopid == '' || master_proid == "")
            return dialog.confirm("请先选择一个成交款。", () => {
            	dialog.iframe_close(1);
            });
            
        var curr_sel_tr = checked.parents('tr'),
        	curr_proid = curr_sel_tr.find('#pid').html(),
        	curr_shopid = curr_sel_tr.find('#sid').html();
            
        if (curr_shopid != master_shopid)
            return dialog.hint(30004, '进店款和成交款必须是同一个店铺的商品');
            
        if (curr_proid == master_proid)
            return dialog.hint(30004, '进店款和成交款不能是同一个商品');
        
        var baguette_pro = parent.$("#baguette_pro"),
            pro_id = curr_sel_tr.find('#pid').html(),
            pro_url = curr_sel_tr.find('#url').html();
        
        baguette_pro.html("").append(`
        	<div class="layui-timeline-title">
        	    <h5><i class="layui-icon">&#xe63c;</i> 进店款的商品信息</h5>
        	      	<div class="layui-row">
        				<div class="layui-col-md10">
        					<input type="hidden" name="bg_proid" value="${pro_id}">
        					<input type="hidden" name="bg_sid" value="${curr_sel_tr.find('#sid').html()}">
        		      		<p><span class="layui-badge layui-bg-gray">商品简称</span>&nbsp;&nbsp;${curr_sel_tr.find('#abbreviation').html()}</p>
        		      		<p><span class="layui-badge layui-bg-gray">商 品 I D</span>&nbsp;&nbsp;${curr_sel_tr.find('#commodity_id').html()}</p>
        		      		<p><span class="layui-badge layui-bg-gray">店铺名称</span>&nbsp;&nbsp;${curr_sel_tr.find('#shopname').html()}</p>
        		      		<p><span class="layui-badge layui-bg-gray">商品标题</span>&nbsp;&nbsp;${curr_sel_tr.find('#title').html()}</p>
        		      		<p class="text-overflow"><span class="layui-badge layui-bg-gray">商品链接</span>&nbsp;&nbsp;<a target="_blank" href="${pro_url}">${pro_url}</a></p>
        		      	</div>
        		      	<div class="layui-col-md2 subjoin_pro_img">
                            <div class="copy_masterImg">
                                <img height="173" src="${curr_sel_tr.find('#img').html()}" alt="商品主图" width="200" style="right:0;">
                                <br/>
                                <button
                                    type="button" 
                                    class="layui-btn layui-btn-normal margin-0 suspend_shadow layui-btn-fluid"
                                    onclick="syncMasterPic(${pro_id})"
                                >同步更新主图</button>
                            </div>
        		      	</div>
        			</div>
        	</div>
        `);
        
        baguette_pro.removeClass("hide");
        dialog.iframe_close(1);
    }
    else
        return dialog.hint(30004, '选择商品无效，请刷新试试看');
}

/**
 * 其它搜索条件
 * @param {Object} $line
 */
function otherSet($obj) {
	var $index = $($obj).parents('tr').index();
	_otherSet = layer.open({
		type: 1,
		shade: false,
		title: false, //不显示标题
		area: ['380px'],
		content: $('.other').eq($index), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
	});
}

/**
 * @description 遍历填写任务数量相关 
 */
function traverseTaskNum()
{
	var $input_origin = $('input[name="gross[]"]'),  //来路设置
		$input_dayNum = $('input[name="date[]"]:checked'),  //发布时间中的次数/天
		$input_pricing = $('input[name="pat_count[]"]:not(:disabled)'),  //定价类型
		_currEachObj = $input_origin.length / $input_pricing.length >= 1 ? $input_origin : $input_pricing; 
	//遍历来路设置中设置的任务数，并按需进行自动填写
	_currEachObj.each(function(index){
		var $curr_val = $(this).val();  //当前来路设置的任务数
		if ($input_pricing.length > 1)  //当定价类型行数大于1的时候，根据下表index进行填写，否则填写所有
		{
			if ($curr_val > 0 && _currEachObj.length > 1)
				$input_pricing.eq(index).val($curr_val);
		}
		if($input_dayNum.length >= 1)
		{
			if ($curr_val > 0 && _currEachObj.length > 1)
				$input_dayNum.eq(index).parents('tr').find('input[name="day_num[]"]').val($curr_val);
		}
		var TaskGross = getTaskGross();
		if ($input_pricing.length == 1)
			$input_pricing.val(TaskGross);
		if ($input_dayNum.length == 1)
			$input_dayNum.parents('tr').find('input[name="day_num[]"]').val(TaskGross);
	})
}

/**
 * @description 根据来路设置、定价类型以及发布时间行数比，确定是否将定价类型和发布时间的【任务数input】设为readonly
 */
function judgeDisabled()
{
	var _gross = $('input[name="gross[]"]'),
		_patCount = $('input[name="pat_count[]"]:not(:disabled)'),
		_date = $('input[name="date[]"]:checked'),
		_dayNum = $('input[name="day_num[]"]');
	if (_gross.length / _patCount.length < 1)
		_patCount.attr("readonly", false);
	else if (_gross.length / _patCount.length >= 1)
		_patCount.attr("readonly", true);
		
	if (_gross.length == 1 && _patCount.length <= 1 && _date.length > 1) //定价类型小于0的情况应对流量任务
		_dayNum.attr("readonly", false);
	else
		_dayNum.attr("readonly", true);
}

/**
 * @description 新增定价类型
 * @param {Object} $obj
 */
function addPricing($obj)
{
	var $origin = $('#origin').find('.clone').length,
		$pricing = $('#pricing:not(.hide)').find('.clone').length,
		$line = $origin == 1 ? 1 : $origin - $pricing,
		$input_origin = $('input[name="gross[]"]');
		
	if ($origin == 1 || ($origin > 1 && $origin > $pricing))
	{
		for (var i = 0; i < $line; i++)
		{
			addRow($obj);
			$('input[name="pat_count[]"]:not(:disabled)').val(0);
		}
		if ($origin > 1)
		{
			traverseTaskNum();
			$('input[name="pat_count[]"]:not(:disabled)').attr("readonly", true);  //适应一对一的规则，当多关键词多价格的时候，禁止用户进行修改
			//$('#task_num').html(0);
		}
		priceCalculate(true);
	}
	else
		dialog.hint(30004, '根据规则，当来路设置大于一行的时候，定价类型行数需为1行或者相等');
}

/**
 * @description 新增来路
 * @param {Object} $obj
 */
function addKeyword($obj)
{
	addRow($obj);
	var _keyword = $("input[name='keyword[]']").length,
		_keywordTr = $("tbody#keyword_tbody tr").length;
	if (_keyword != _keywordTr)
	{
		var _tbody = $("#keyword_table").find('tbody'),
		_lastTr = _tbody.children("tr:last"),
		_clone = _lastTr.clone(true);
		_lastTr.after(_clone);
		
		if (typeof(keyword_beginTimeObject) != "undefined")
		{
			var len = Object.keys(keyword_beginTimeObject).length + 2;
			var min_time = sel_index == 0 ? $min_time : '',
				baseConfig = {
					type: 'time',
					trigger: 'click',
					min: min_time,
				};
			// 开始平均发布时间
			$('#keyword_tbody tr:last .begin').each(function(index) {
				$(this).removeAttr("lay-key");
				baseConfig.elem = this;
				baseConfig.done = function(value, date) {
					keyword_overTimeObject[len + index].config.min
					= keyword_cancelTimeObject[len + index].config.min
					= {
						year:date.year,
						month:date.month - 1,
						date: date.date,
						hours: date.hours, 
						minutes: date.minutes, 
						seconds : date.seconds + 1,
					};
				};
				keyword_beginTimeObject[len + index] = laydate.render(baseConfig);
			});
			
			// 结束平均发布时间
			$('#keyword_tbody tr:last .over').each(function(index) {
				$(this).removeAttr("lay-key");
				baseConfig.elem = this;
				baseConfig.done = function(value, date) {
					keyword_cancelTimeObject[len + index].config.min
					= keyword_beginTimeObject[len + index].config.max
					= {
						year:date.year,
						month:date.month - 1,
						date: date.date,
						hours: date.hours, 
						minutes: date.minutes, 
						seconds : date.seconds,
					};
				};
				keyword_overTimeObject[len + index] = laydate.render(baseConfig);
			});
			
			// 取消发布时间
			$('#keyword_tbody tr:last .time.cancel').each(function(index) {
				$(this).removeAttr("lay-key");
				baseConfig.elem = this;
				baseConfig.done = function(value, date) {
					keyword_overTimeObject[len + index].config.max
					= keyword_beginTimeObject[len + index].config.max
					= {
						year:date.year,
						month:date.month - 1,
						date: date.date,
						hours: date.hours, 
						minutes: date.minutes, 
						seconds : date.seconds - 1,
					};
				};
				keyword_cancelTimeObject[len + index] = laydate.render(baseConfig);
			});
		}
		
		
		// $("#keyword_tbody tr:last .time").each(function(){
		// 	$(this).removeAttr("lay-key");  //去掉此属性，解决动态绑定的laydate会闪现的问题
		// 	laydate.render({
		// 		elem: this,
		// 		type: 'time',
		// 		min: $min_time,
		// 	});
		// });
		
		$("#keyword_tbody tr:last .subscribeTime, #keyword_tbody tr:last .alone_subscribeTime, #keyword_tbody tr:last .second_visit_time, #keyword_tbody tr:last .alone_second_visit_time").each(function(){
			$(this).removeAttr("lay-key");  //去掉此属性，解决动态绑定的laydate会闪现的问题
			subscribeTimeArg.elem = this;
			laydate.render(subscribeTimeArg);
		});
		
		$("p.morrow_time:last").addClass("hide");
		$("p.valid_time:last").removeClass("hide");
		$("._MorrowTime:last").each(function(){
			$(this).removeAttr("lay-key");  //去掉此属性，解决动态绑定的laydate会闪现的问题
			MorrowTimeArg.elem = this;
			laydate.render(MorrowTimeArg);
		});
		
		//给多选框添加索引
		var currIndexValue = _keyword - 1,
			OriginLastTr = $("#origin tbody").children("tr:last");
		OriginLastTr.find(".same_flow").attr("name", "same_flow[" + currIndexValue + "]");  //同时发布流量任务勾选框索引
	}
	traverseTaskNum();
	inputTaskNum(); 
	inputKeywordAndNum();
}

/**
 * @description  新增一行tr 
 * @param {Object} $obj 当前按钮对象
 */
function addRow($obj) 
{
	var _parents = $($obj).parents('.fprw-sdsp');
		_clone = _parents.find('.clone'),
		_other = $('.other').last(),
		tag = _clone.last();
	if (_clone.length < 50)
	{
		tag.after(tag.clone());
        
        if (_clone.find(".other-search").length > 0)    // 只在新增来路设置列的时候，才复制其它搜索条件列
            _other.after(_other.clone());
            
		var _new = _parents.find("tbody").children("tr:last");
		_new.find('.recover-dis').removeClass('layui-btn-disabled').attr('disabled', false).attr('readonly', false).attr('placeholder', '请设置搜索关键词').val("");
		_new.find('.recover-num').html(0);
		_new.find('input[name="vie_keyword[]"]').val("");
		judgeDisabled();
		handleShowAloneBtn();
		form.render();
		
		// 标签输入框重置
		$("input[data-role=tagsinput]").tagsinput();
		_new.find('.bootstrap-tagsinput:first').remove();
	}
	else
		dialog.hint(10001, '至多新增至五十行');
}

/**
 * @description 在来路设置中，输入关键词和任务数量的时候，同步到[为多个关键词分别设置时间中] 
 */
function inputKeywordAndNum()
{
	var _keywordTr = $("#keyword_table").find('tbody tr');
	$(".SetKeyword:not(.hide) .OrderKey").each(function(index){
		var _theObj = _keywordTr.eq(index);
		_theObj.find(".copy_keyword").html($(this).val());
		_theObj.find(".copy_keywordNum").html($(this).parents("tr").find("input[name='gross[]']").val());
		_theObj.find("input[name='day_num[]']").val($(this).parents("tr").find("input[name='gross[]']").val());
	});
}

/**
 * @description 删除来路设置行
 * @param {Object} $obj
 */
function removeOrigin($obj)
{
	//删除定价类型中对应的行
	var $origin = $($obj).parents('tbody').find('tr'),
		$lenght = $origin.length,
		$index = $($obj).parents('tr').index()
		$pricing = $('#pricing').find('tbody tr'),
		$line = $origin == 1 ? 1 : $origin - $pricing;
	if ($lenght > 1)
	{
		var $date_tr = $('input[name="date[]"]:checked');
		if ($pricing.length > 1)
			$pricing.eq($index).remove();
		if ($date_tr.length > 1)
			$date_tr.eq($index).next().click();
	}
	//删除【为多个关键词分别设置时间中】对应的行
	var _keywordTr = $("#keyword_table").find('tbody tr');
	if (_keywordTr.length > 1)
			_keywordTr.eq($index).remove();
			
	traverseTaskNum();
	removeRow($obj);
	inputTaskNum(); 
	inputKeywordAndNum();
}

/**
 * 删除定价类型行 
 */
function removePricing($obj)
{
	var $origin = $('#origin').find('tbody tr').length,
		$pricing = $('#pricing:not(.hide)').find('.clone').length,
		$line = $origin == 1 ? 1 : $origin - $pricing,
		$input_origin = $('input[name="gross[]"]');
	removeRow($obj);
	if ($origin == 1 || ($origin > 1 && $origin < $pricing))
	{
		var $input_price = $('input[name="pat_count[]"]');
		traverseTaskNum();  //目的：如果只有一行，则自动填写上任务总数 
	}
}

/**
 * @description  移除当前tr 
 * @param {Object} $obj 当前按钮对象
 */
function removeRow($obj) 
{
	var _parents = $($obj).parents('.fprw-sdsp');
		_clone = _parents.find('.clone'),
		_other = $('.other:first'),
		tag = _clone.last();
		
		
	var $this = $($obj),
		_clone = $this.parents('.fprw-sdsp').find('.clone');
	if(_clone.length > 1) 
	{
        if (_clone.find(".other-search").length > 0)
            $('.other').eq($this.parents('tr').index()).remove();
            
		$this.parents('.clone').remove();
		judgeDisabled();
		handleShowAloneBtn();
		inputTaskNum(); //重新校准任务数量
		priceCalculate(true); //重新计价
	} else
		return dialog.hint(10001, '至少保留一行');
}

function Appendzero(obj) {
	if(obj < 10)
		return "0" + obj;
	else
		return obj;
}

function checkEndTime(startTime,endTime)
{
	var starArr = startTime.split(':');
	var endArr = endTime.split(':');
	console.log(starArr);
	console.log(endArr);
	if(parseInt(starArr[0]) > parseInt(endArr[0].trim()))
		return false;
	if(parseInt(starArr[0])==parseInt(endArr[0]))
	{
		if(parseInt(starArr[1])>parseInt(endArr[1]))
			return false;
		if(parseInt(starArr[1])==parseInt(endArr[1]))
		{
			if(parseInt(starArr[2])>parseInt(endArr[2]))
				return false;
		}
	}
	return true;
}

/**
 * @description 确认发布 
 * @param {Object} $tag  标志任务类型，对于流量任务，定价类型之类的不做提交判断。0 - 任务  1 - 流量任务
 */
function issue($tag, success_type = 0)
{
	//判断发布任务的规则是否有效
	var $origin_length = $('#origin').find('tbody tr').length,
		$pricing_length = $('#pricing:not(.hide)').find('.clone').length,
		$date_length = $('input[name="date[]"]:checked').length;
		//$alg = $tag == 0 ? $date_length / $origin_length / $pricing_length : $date_length / $origin_length;  //流量任务中没有定价类型，此处做处理
		$alg = $tag == 0 ? $origin_length / $pricing_length / $date_length : $origin_length / $date_length;  //流量任务中没有定价类型，此处做处理
	switch ($alg)
	{
		case 1:
			$isOk = true;
			var $pricing = $('#pricing:not(.hide) input[name="pat_count[]"]:not(:disabled)'),
				$date = $('input[name="date[]"]:checked').parents('tr').find('[name="day_num[]"]');
			$('input[name="gross[]"]').each(function(index){
				var $curr_pricing = $pricing.eq(index).val(),
					$curr_date = $date.eq(index).val();
				if ($pricing.length > 1 && $(this).val() != $curr_pricing)
					$isOk =  dialog.hint(30004, '根据规则，当来路设置、定价类型和发布时间行数相同的时候，每行的任务数必须相等。此处定价类型第' + (parseInt(index) + 1) + '行设置的任务数（' + $curr_pricing + '）与来路设置的不一致');
				if ($date.length > 1 && $(this).val() != $curr_date)
					$isOk =  dialog.hint(30004, '根据规则，当来路设置、定价类型和发布时间行数相同的时候，每行的任务数必须相等。此处发布时间第' + (parseInt(index) + 1) + '行设置的任务数（' + $curr_date + '）与来路设置的不一致');
			});
			if ($isOk == false) return false;
		case 1 / $date_length:
		case 1 / $pricing_length:
		case $origin_length:
		case 1 / Math.pow($pricing_length, 2):
			if ($date_length == 1 || ($date_length == $origin_length && ($pricing_length == 1 || $pricing_length == $origin_length)) || ($pricing_length == $origin_length == 1 && $date_length >1) || $tag == 1 || ($date_length == $pricing_length && $origin_length == 1))
				break;
		default: //对是否提示定价类型做判断
			return dialog.hint(30004, '来路设置行数（' + $origin_length + '）、' + ($tag == 0 ? '定价类型行数（' + $pricing_length + '）、' : '') + '发布时间选择数（' + $date_length + '）的关系不符合规则(<a href="" target="_blank">点击查看发布规则</a>)，无法发布');
	}
	//符合规则，检查前置条件
	if ($tag == 0 || $tag == 1)
	{
		if($('input[name=proid]').val() != '')
		{
			var $curr = null,
				$tips = '',
				$curr_input = null,
				$step = true,
				_tasktype = $("input[name=tasktype]:checked").val();
			if ($.inArray(_tasktype, ["8"]) != -1)
			{
				var subProNum = $("input[name='sub_proid[]']").length;
				if (subProNum <= 0)
					return dialog.hint(10001, "发布多链接任务，请至少选择一个副宝贝");
			}
            else if (_tasktype == 16)
            {
                // 检查是否设置了进店款
                var baguette_proid = $("input[name=bg_proid]");
                
                if (baguette_proid.length == 0 || isNaN(baguette_proid.val()) !== false)
                    return dialog.hint(10001, "发布AB单，请选择一个进店款");
            }
			//检查来路设置是否合法
			$('#origin tbody tr').each(function(index) {
				$tips = '来路设置中，第' + (index + 1) + '行';
				$curr = $(this);
				switch($curr.find('select[name="entrance[]"]').val()) //根据流量入口进行检查
				{
					case '6':
					case '8':
					case '11':
						break;
					default:
						switch (_tasktype)
						{
							case "10":	//标签任务判断多个关键词
								CurrTagKeyword = $curr.find('input[name="tag_keyword[]"]');
								if(CurrTagKeyword.val().trim() == '') 
								{
									CurrTagKeyword.focus();
									$step = dialog.hint(10001, $tips + '的打标关键词不能为空');
									return false;
								}
								CurrOrderKeyword = $curr.find('input[name="order_keyword[]"]');
								if(CurrOrderKeyword.val().trim() == '') 
								{
									CurrOrderKeyword.focus();
									$step = dialog.hint(10001, $tips + '的下单关键词不能为空');
									return false;
								}
								break;
							default:
								$curr_input = $curr.find('input[name="keyword[]"]');
								if($curr_input.val().trim() == '') {
									$curr_input.focus();
									$step = dialog.hint(10001, $tips + '的关键词不能为空');
									return false;
								}
						}
						break;
				}
				//检查打标价格区间是否设置正确
				if (_tasktype == "10")
				{
					var CurrTagPriceMin = $curr.find('input[name="tag_price_min[]"]'),
						CurrTagPriceMax = $curr.find('input[name="tag_price_max[]"]'),
						CurrTagPriceMin_Val = CurrTagPriceMin.val(),
						CurrTagPriceMax_Val = CurrTagPriceMax.val();
					if (CurrTagPriceMin_Val == "")
					{
						CurrTagPriceMin.focus();
						$step = dialog.hint(10001, $tips + "打标签价格区间的最低价不能为空");
						return false;						
					}
					if (CurrTagPriceMax_Val == "")
					{
						CurrTagPriceMax.focus();
						$step = dialog.hint(10001, $tips + "打标签价格区间的最高价不能为空");
						return false;						
					}
					if (parseInt(CurrTagPriceMin_Val) >= parseInt(CurrTagPriceMax_Val))
					{
						CurrTagPriceMax.focus();
						$step = dialog.hint(10001, $tips + "打标签价格区间的最高价必须大于最低价");
						return false;
					}
					//判断预约下单时间是否设置合法
					var OrderTime = $curr.find('select[name="order_time[]"] option:selected').val(),
						MorrowTime = $("input[name='morrow_time[]']");
					if (OrderTime == "-1" && checkSubscribeTime(MorrowTime.val()) == false)
					{
						MorrowTime.focus();
						$step = dialog.hint(10001, "预约第二天下单的时间间隔不能小于4个小时");
						return false;
					}	
				}
				$curr_input = $curr.find('input[name="gross[]"]');
				var $curr_num = $curr_input.val().trim();
				if(isNaN($curr_num) == true || $curr_num <= 0) {
					$curr_input.focus();
					$step = dialog.hint(10001, $tips + '的任务数量必须为大于0的数字');
				}
				return $step;
			});
			// if ($('.turnover').html() > 2999)
			// {
			// 	$step = dialog.hint(30004, '单任务成交金额不能大于2999元');
			// 	return $step;
			// }
			if($step == true) //来路设置合法，检查定价类型合法性
			{
				var $total_input_num = 0;
				$('#pricing:not(.hide) .clone').each(function(index) {
					$tips = '定价类型中，第' + (index + 1) + '行';
					$curr = $(this);
					$curr.find('input').each(function() {
						var $obj = $(this),
							$val = $obj.val().trim();
						switch($obj.attr('name')) {
							case 'price[]':
								if(isNaN($val) == true || $val <= 0) {
									$obj.focus();
									$step = dialog.hint(10001, $tips + '商品单价必须为大于0的数字');
								}
								break;
                            case 'pick_price[]':
                                if (_tasktype == 15)
                                {
                                    if(isNaN($val) == true || $val <= 0)
                                    {
                                    	$obj.focus();
                                    	$step = dialog.hint(10001, $tips + '商品的门店自提券价格必须为大于0的数字');
                                    }
                                }
                                break;
                            	
							case 'pat_num[]':
								if(isNaN($val) == true || $val <= 0) {
									$obj.focus();
									$step = dialog.hint(10001, $tips + '拍下件数必须为大于0的数字');
								}
								break;
							case 'Model[]':
								if($('input[name=model]').val() == '1') //多型号
								{
									if($val == 1) {
										$step = dialog.hint(10001, $tips + '指定型号不能为空');
									}
								}
								break;
							case 'pat_count[]':
								$total_input_num += parseInt($val);
								if(isNaN($val) == true || $val <= 0) {
									$obj.focus();
									$step = dialog.hint(10001, $tips + '任务数量必须为大于0的数字');
								}
								break;
						}
						// 多链接任务判断副宝贝价格是否设置正确
						if (_tasktype == 8 && $step == true)
						{
							$("input[name^='sub_price']").each(function(){
								var curr_sub_price_input = $(this);
								if (curr_sub_price_input.val() <= 0)
								{
									curr_sub_price_input.focus();
									$step = dialog.hint(10001, '请设置副宝贝的价格');
								}
							});
						}
						return $step;
					});
				});
				if($step == true) 
				{
					var $task_stock = getTaskGross();
					if($total_input_num != $task_stock && $tag == 0) 
					{
						$step = dialog.hint(10001, '定价类型中，分配的任务数量总和必须等于来路设置中设置的任务数总和，请重新分配');
					}
				}
			}
			if($step == true) //定价类型设置合法，进行发布时间合法性的判断
			{
				$('#releaseTime tbody tr').not('.hide').each(function(index) {
					$tips = '发布时间中，第' + (index + 1) + '行';
					$curr = $(this);
					$curr.find('input:not(:disabled)').each(function() {
						var $obj = $(this),
							$val = $obj.val(),
							time_regular = /^(0\d{1}|1\d{1}|2[0-3]):[0-5]\d{1}:([0-5]\d{1})$/;
							var myDate = new Date(),
								$min_time = Appendzero(myDate.getHours()) + ':' + myDate.getMinutes() + ':' + myDate.getSeconds();
						switch($obj.attr('name')) {
							case 'day_num[]':
								if(isNaN($val) == true || $val <= 0) {
									$obj.focus();
									$step = dialog.hint(10001, $tips + '分配的任务数必须为大于0的数字');
								}
								break;
							case 'begin[]':
								if(time_regular.test($val) == true) {
									var sel_index = $("select[name=line_day] option:selected").index();
									if(
										checkEndTime($min_time, $val) == false 
										&& ( 
												(index == 0 && $obj.parents("tbody").attr("id") != "keyword_tbody")
											|| (sel_index == 0 && $obj.parents("tbody").attr("id") == "keyword_tbody")
										   )
									  ) {
										$obj.focus();
										$step = dialog.hint(10001, $tips + '开始时间必须大于当前时间');
									}
								} else {
									$obj.focus();
									$step = dialog.hint(10001, $tips + '开始时间格式不正确');
								}
								break;
							case 'over[]':
								if(time_regular.test($val) == true) {
									var $curr_begin = $curr.find('input[name="begin[]"]').val();
									if(checkEndTime($curr_begin, $val) == false) {
										$obj.focus();
										$step = dialog.hint(10001, $tips + '结束时间必须大于当前行的开始时间');
									}
								} else {
									$obj.focus();
									$step = dialog.hint(10001, $tips + '结束时间格式不正确');
								}
								break;
							case 'cancel[]':
								if($val != '') //有设置超时取消时间
								{
									if(time_regular.test($val) == true) {
										var $over = $curr.find('input[name="over[]"]');
										$curr_over = $over.prop('disabled') == true ? $min_time : $over.val();
										if(checkEndTime($curr_over, $val) == false) {
											$obj.focus();
											$step = dialog.hint(10001, $tips + '结束时间设置的不合理');
										}
									} else {
										$obj.focus();
										$step = dialog.hint(10001, $tips + '结束时间格式不正确');
									}
								}
								break;
							
							case 'second_visit[]':
								if($val != '') //有设置预约下单时间
								{
									if (checkSubscribeTime($val) == false)
									{
										$obj.focus();
										$step = dialog.hint(10001, "浏览回看的时间间隔不能小于4个小时");
									}	
								}
								break;
							
							case 'subscribe[]':
								if($val != '') //有设置预约下单时间
								{
									if (checkSubscribeTime($val) == false)
									{
										$obj.focus();
										$step = dialog.hint(10001, "预约下单的时间间隔不能小于4个小时");
									}	
//									var arr = $val.split("~");
//									var startArr = arr[0]
//									if(checkEndTime(arr[0], arr[1]) == false) {
//										$obj.focus();
//										$step = dialog.hint(10001, $tips + '截至下单时间必须大于当前行的开始下单时间');
//									}
								}
								break;
						}
						return $step;
					});
					// 检查回看时间和下单时间是否有重叠
					if ($step == true && $('input[name=tasktype]:checked').val() == 12)
					{
						var second_visit_time_doc = $curr.find('input[name="second_visit[]"]');
						if (second_visit_time_doc.attr('disabled') == undefined && second_visit_time_doc.val() != undefined)
						{
							var second_visit_time = second_visit_time_doc.val().split('~');
							var subscribeTime = $curr.find('input[name="subscribe[]"]').val().split('~');
							if (isDateIntersection(
									second_visit_time[0], 
									second_visit_time[1],
									subscribeTime[0],
									subscribeTime[1]
								) == true)
								{
									second_visit_time_doc.focus();
									$step = dialog.hint(10001, "浏览回看时间和预约下单时间不能重叠");
								}
						}
					}
					
					return $step;
				});
			}
			if($('input[name=tasktype]:checked').val() == 5)
			{
				var howPay = $('select[name=howPay] option:selected').val(),
					newKey = $('input[name=newKeyword]');
				if (howPay == 2 && newKey.val().trim() == '')
				{
					newKey.focus();
					$step = dialog.hint(10001, "选择以新的关键词下单，新的关键词不能为空");
				}
			}
			else if (_tasktype == 4)  // 预定任务判断定金是否设置合理
			{
				var handsel = $("input[name=handsel]"),
					handsel_val = handsel.val();
				if (handsel_val == "" || handsel_val <= 0)
				{
					handsel.focus();
					$step = dialog.hint(10001, "预售商品的定金不能为空，且必须大于0");
				}
				$("#pricing input[name='price[]']").each(function(){
					var curr_price = $(this).val();
					if (curr_price > 0 && parseFloat(curr_price) <= parseFloat(handsel_val))
					{
						handsel.focus();
						$step = dialog.hint(10001, "预售商品的定金不能大于商品单价");
					}
				});
				
				// 判断下单时间是否设置合理
				var b_payment = $("input[name=b_payment]").val(),
					e_payment = $("input[name=e_payment]").val(),
					format_start = new Date(b_payment.replace("-", "/").replace("-", "/")),
					format_end = new Date(e_payment.replace("-", "/").replace("-", "/"));
					
				if (b_payment == "")
					$step = dialog.hint(10001, "请设置尾款开始支付时间");
				else if ($min_time < format_start)
					$step = dialog.hint(10001, "尾款开始支付时间必须大于当前时间");
				else if (e_payment == "")
					$step = dialog.hint(10001, "请设置尾款最晚支付时间");
				else if (format_start >= format_end)
					$step = dialog.hint(10001, "尾款最晚支付时间必须大于开始支付时间");
				else if (format_end - format_start <= 60 * 60 * 4 * 1000)
					$step = dialog.hint(10001, "尾款支付时间至少相隔4个小时");
			}
			
			if ($step == true)  //检查问大家的设置
			{
				var _ask = $('tr._ask').not('.hide'),
					_curr = '',
					_len = 0;
				_ask.find('input[name="quiz[]"]').each(function(){
					_curr = $(this).val().trim();
					if (_curr != '')
					{
						_len = _curr.length;
						if (_len < 4 || _len > 40)
						{
							$(this).focus();
							$step = dialog.hint(10001, '问大家提问的内容4-40个字，当前：' + _len + '个字');
						}
					}
					else
					{
						$(this).focus();
						$step = dialog.hint(10001, '问大家提问的内容不能为空');
					}
				});
			}
			if($step == true) //检查附加设置
			{
				$step = CheckBondFlowTag();
			}
//			if($step == true) //发布时间设置无误，判断置顶费设置
//			{
//				$curr_input = $('input[name=top]');
//				var $top = $curr_input.val();
//				if(isNaN($top) == true || $top > 50) {
//					$curr_input.focus();
//					$step = dialog.hint(10001, '快递费不能大于50元/单');
//				}
//			}
			if($step == true) //所有设置通过检查，提交数据
			{
				//提醒商家查看填写的信息有没有误差
				$('body,html').animate({scrollTop: $('#origin').offset().top}, 500);
				dialog.tips("瞄一下单价填错没有", "[name='price[]']", 0, 1);
				dialog.tips("瞄一下关键词填错没有", "td:not(.hide) .Keyword:last", 0, 1);
				dialog.tips("瞄一下数量填错没有", "[name='gross[]']:last", 0, 1);
				$("input[name='price[]'], input.Keyword, input[name='gross[]']").css("border-color", "red")
				Tools._importSecurityCode('发布任务', function(value) {
					if(value != '') {
						_total_commission = 0;
						switch ($tag)
						{
							case 0:
								_total_commission = $('#total-commission').html();
								break;
							case 1:
								_total_commission = $('#total_cost').html();
								break;
							default:
								_total_commission = $('#total-commission').html();
						}
						$other_args = {
							tag: $tag,
							safety: value,
							total_commission: _total_commission || 0,
							total_top: $('#total_top').html(),
							total_express: $('#express_cost').html(),
							browse: $('#browse option:selected').val(),
							howPay: $('#howPay option:selected').val(),
							newKeyword: $('input[name=newKeyword]').val(),
							vie_commission: $('#vie_commission').html(),
						};
						var $target_url = $tag == 0 ? '/task/issue' : '/task/issueFlow';
						Tools.ajaxSubmit('release-form', function(datas) {
							if(datas.code == 200) 
							{
								if (success_type == 0 || typeof(success_type)== "undefined")
								{
									layer.closeAll();
									cutStep(1, $('.sure-btn', parent.document));
									bsStep(3);
								}
								else
								{
									dialog.hint(200, "操作成功");
									window.parent.location.reload();
								}
							} 
							else if(datas.code == 30005)
							{
								layer.close(load);
								dialog.confirm(datas.message, function(){
									layer.close(layer.index);
									dialog.iframe(datas.datas, 94, 85, '充值 / 续费小助理窗口', '%');
								});
							}
							else
								dialog.hint(datas.code, datas.message);
						}, $target_url, $other_args);
					} else
						dialog.hint(10001, '请输入安全码');
				}, function(){
					layer.closeAll('tips');
				})
			}
		} else {
			$('input[name=proid]').focus();
			dialog.hint(10001, '请选择商品');
		}
	}
	else
		dialog.hint(10001, '参数异常：tag');
}

/**
 * @description 佣金计算器
 * @param {Object} $price
 * @param {Object} $express
 * @param {Object} $auction
 * @param {Object} $number
 */
function price_compute($price, $express, $auction, $number) {
	var $commission_one = GetPricePoint($price * $auction),
		$one_money = $price * $auction + $express;
	$('span#commission_one').html($commission_one);
	$('span#commission_all').html($commission_one * $number);
	$('span#one_money').html($one_money);
	$('span#sum_money').html($one_money * $number);
	$('span#total').html($one_money * $number + $commission_one * $number);
}

/**
 * @description  输入置顶费
 */
function inputTop() {
	var $top = parseInt($('input[name=top]').val()),
		$task_stock = getTaskGross(); //任务库存
	$('span#total_top').html($top * $task_stock);
	$('span#total_cost').html($top * $task_stock + parseInt($('span#total').html())); //最底栏合计任务费用
	batchServePrice();
}

/**
 * @description  新增一行tr 
 * @param {Object} $obj 当前按钮对象
 */
function addQuestion($obj) 
{
	var targetTbody = $($obj).parents('.fprw-sdsp_2').find('tbody'),
		_other = $('tr._q:first'),
		tr = targetTbody.children("tr._q:last");
	if (targetTbody.find('tr._q').length < 5)
	{
		tr.after(_other.clone());
		var _new = targetTbody.children("tr._q:last");
		_new.find('input[name="quiz[]"]').val('');
		form.render();
	}
	else
		dialog.hint(10001, '至多设置五个问题');
}

/**
 * 删除当前提问行
 * @param {Object} $obj
 */
function delQuestion($obj)
{
	var _q = $('tr._q');
	if (_q.length > 1)
	{
		$($obj).parents('tr').remove();
	}
	else
		dialog.hint(10001, '至少设置一个问题');
}

function inputQuestion($obj)
{
	var $this = $($obj),
		$length = $this.val().length;
	if ($length >= 4)
	{
		if ($length > 40)
		{
			$this.focus();
			dialog.hint(10001, '问大家提问的内容至多为40个字');
		}	
	}
	else
	{
		$this.focus();
		dialog.hint(10001, '问大家提问的内容至少为4个字');
	}
}

/**
 * 调出一键设置时间的界面
 */
function oneKeySetTime()
{
	dialog.iframe("#oneKeySetTime", 800, 280, "一键设置时间");
}

/**
 * @description 确认一键设置时间
 */
function affirmSet()
{
	var _begin = $("input[name=_begin]").val(),
		_over = $("input[name=_over]").val(),
		_cancel = $("input[name=_cancel]").val(),
		_curr = null;
	if (_over == "")
		_over = "23:59:59";
	if (_cancel == "")
		_cancel = "23:59:59";
	if(checkEndTime(_begin, _over) == false)
		return dialog.hint(10001, '结束时间必须大于开始时间');
	if(checkEndTime(_over, _cancel) == false)
		return dialog.hint(10001, '超时取消时间必须大于结束时间');
	$("input.time").not(":disabled").each(function(){
		_curr = $(this);
		switch (_curr.attr("name"))
		{
			case "begin[]":
				_curr.val(_begin);
				break;
			case "over[]":
				_curr.val(_over);
				break;
			case "cancel[]":
				_curr.val(_cancel);
				break;
		}
		layer.closeAll();
	});
}

/**
 * @description 同时发布流量任务加价
 */
function SameFlowRaisePrice()
{
	var TaskGross = getTaskGross(true);
		FlowBase = getPricePoint(TaskGross, "flow");
		TotalCostSpan = $('span#total_cost'),
		CurrTotalCost = TotalCostSpan.html();
	TotalCostSpan.html((parseFloat(CurrTotalCost) + parseFloat(FlowBase)).toFixed(2)); //加上增值费，计算总额
}

/**
 * 判断两个时间段是否有重叠
 * @param {Object} start1
 * @param {Object} end1
 * @param {Object} start2
 * @param {Object} end2
 */
function isDateIntersection(start1, end1, start2, end2) 
{
    var startdate1 = new Date(start1.replace("-", "/").replace("-", "/"));
    var enddate1 = new Date(end1.replace("-", "/").replace("-", "/"));

    var startdate2 = new Date(start2.replace("-", "/").replace("-", "/"));
    var enddate2 = new Date(end2.replace("-", "/").replace("-", "/"));

    if (startdate1 >= startdate2 && startdate1 <= enddate2)
		return true;

    if (enddate1 >= startdate2 && enddate1 <= enddate2)
        return true;

    if (startdate1 <= startdate2 && enddate1 >= enddate2)
        return true;
		
    return false;
}

var syncMasterPic = (pro_tag) => {
    var pro_id = pro_tag || $('input[name=proid]').val();
    
    if (typeof(pro_id) == "undefined")
     return dialog.hint(10001, '请选择商品之后再来更新！');
     
     Tools.ajax('/user/syncMasterPic', {tag: pro_id}, (data) => {
         if (data.code == 200)
            if (typeof(pro_tag) == "undefined")
                $("img#pro-img").prop("src", data.datas);
            else
                $(".sub_m_pic_" + pro_id).prop("src", data.datas);
     });
}