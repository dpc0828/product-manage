Tools.hashLocation('user');
layui.use(['element', 'form', 'laydate', 'laypage', 'table'], function(){
  var element = layui.element,
  		form = layui.form;
  table = layui.table;
  //监听提现-Tab的切换
  element.on('tab(withdraw)', function(data){
  	if (!$(this).hasClass('un-cut'))
  	{
  		dialog.load();
	  	var $anchor = $(this).attr('lay-id');
	  	switch ($anchor)
	  	{
  			case '资金安全':
  			case '任务过程':
  			case '邀请好友':
  			case '其它':
  				Tools._load('FAQ-box', '/user/loadFAQLists?type=' + $anchor);
  				break;
				case 'creditsLog':
					Tools._load('doc-box', '/user/creditsLog');
					break;
				case 'assistant':
				case 'flagFeedback':
					$('#assistant-box').load('/user/' + $anchor, '', function(){
						layer.close(load);
					});
				break;
			case 'inviteList':
				$('#invite-list').load('/user/' + $anchor, '', function(){
					layer.close(load);
				});
				break;
  			default:
  				$has_search = false;
		  		$('.layui-table-view').remove();
		  		$('#right').load('/user/' + $anchor, '', function(){
						layer.close(load);
					});
	  	}
  	}
  });
  
  //监听指定开关
  form.on('switch(mark)', function(data){
  	$('input[name=colour]').attr('disabled', !data.elem.checked);
  	$('textarea[name=comment]').attr('disabled', !data.elem.checked);
  	form.render();
  });
  
  /**
   * 监听目标客户、购买行为的设置项选择 territory
   */
  form.on('checkbox(set)', function(data){
  	var curr_input = $(data.elem).parents('.layui-form-item');
		curr_input.find('input[type=number]').attr('disabled', !data.elem.checked);
		curr_input.find('input[name^="Territory"]').attr('disabled', !data.elem.checked);
		form.render("checkbox");
	}); 
  
  //商品列表头部按纽栏
  table.on('toolbar(pro_list)', function(obj){
    var checkObj = table.checkStatus(obj.config.id),
    		datas = checkObj.data;
    switch(obj.event)
    {
    	case 'add':
    		dialog.iframe('/user/add-product', 66.39, 49, '添加商品', 'em');
    		break;
            
        case 'edit':
            if (datas.length == 1)
                dialog.iframe('/user/edit-product?tag=' + datas[0].id, 66.39, 49, '编辑商品信息', 'em');
            else
                dialog.hint(10001, '请选择一个商品进行编辑');
            break;
        
        case 'del':
            if (datas.length > 0)
            {
                dialog.confirm('确认删除所选的商品吗？操作不可撤销', function(){
                    var $key = '';
                    $.each(datas, function(index, value){
                        $key += value.id + ',';
                    });
                    Tools.ajax('/user/delete-product', {key: $key.substring(0, $key.length-1)}, function(datas){
                        if (datas.code == 200)
                        {
                            parent.layui.table.reload('pro-list', {page: {curr: 1}});
                        }
                    });
                });
            }
            else
                dialog.hint(10001, '请至少选择一个商品删除');
            break;
        
        case 'view':
            if (datas.length == 1)
                dialog.iframe('/user/view-product?tag=' + datas[0].id, 800, 600, '添加商品');
            else
                dialog.hint(10001, '请选择一个商品查看详情');
            break;
            
  		case 'target':
  			if (datas.length == 1)
                dialog.iframe('/user/target-customer?tag=' + datas[0].id, 80, 88, '设置目标用户', '%');
            else
                dialog.hint(10001, '请选择一个商品进行设置');
            break;
            
  		case 'behavior':
  			if (datas.length == 1)
                dialog.iframe('/user/behavior?tag=' + datas[0].id, 850, 600, '设置购买行为');
            else
                dialog.hint(10001, '请选择一个商品进行设置');
            break;
        
        case "target_template":
            check_pros = datas;
            dialog.iframe('/user/customer-template?tag=0', 80, 88, '目标客户 - 模板管理', '%');
            break;
        
        case "behavior_template":
            check_pros = datas;
            dialog.iframe('/user/behavior-template?tag=1', 80, 88, '购买行为 - 模板管理', '%');
            break;
            
  		default:
  			dialog.hint(10001, '正在开发中...');
    };
  });
  
  // 监听模板选择
  form.on('select(target_template)', (data) => {
	  if (data.value == '')
		return false;
	  
      dialog.load(undefined, 2);
      
	  var template = $("select#select_target option:selected").attr("data-target");
	  
	  if (template == '')
		return false;
		
	  template = JSON.parse(template);
	  
	  var update_form = {},
		  set_sex = template.sex != '',
		  set_age = template.age != '';
	  
	  if (set_sex == true)
		 template.sex = JSON.parse(template.sex);
		 
	  if (set_age == true)
		template.age = JSON.parse(template.age);
		
	  if (template.province != '')
	  		template.province = JSON.parse(template.province);
	  
	  // 重置input可写状态
	  $('#set_sex').find('input[type=number]').attr('disabled', !set_sex);
	  $('#set_age').find('input[type=number]').attr('disabled', !set_age);
		  
	  // 刷新form表单
	  var update_form = {
		  "sex": set_sex,
		  "Sex[0]": template.sex[0] || 0,
		  "Sex[1]": template.sex[1] || 0,
		  
		  "age": set_age,
		  "Age[younger]": template.age.younger || 0,
		  "Age[middle]": template.age.middle || 0,
		  "Age[older]": template.age.older || 0,
	  };
	  
	  $.each(template.province, ($k, $v) => {
		  update_form["province[" + $k + "]"] = $v;
	  });
	  
	  $('form#target')[0].reset();
	  form.val("target", update_form)
	  form.render(null, 'target');
      
      layer.close(layer.index);
  }); 
  
    form.on('select(behavior_template)', (data) => {
          if (data.value == '')
            return false;
            
          dialog.load(undefined, 2);
          
          var template = $("select#select_behavior option:selected").attr("data-target");
          
          if (template == '')
            return false;
            
          template = JSON.parse(template);
          
          var update_form = {};
          		
          if (template.x_home != '')
          		template.x_home = JSON.parse(template.x_home);
                
          if (template.deep != '')
          		template.deep = JSON.parse(template.deep);
              
          // 刷新form表单
          var update_form = {
              "bookmark": template.bookmark,
              "c_goods": template.c_goods,
              "add_car": template.add_car,
              "talk": template.talk,
          };
          
          $.each(template.x_home, ($k, $v) => {
              update_form["compare[" + $k + "]"] = $v;
          });
          
          $.each(template.deep, ($k, $v) => {
              update_form["browse[" + $k + "]"] = $v;
          });
          
          $('form#behavior')[0].reset();
          form.val("behavior", update_form)
          form.render(null, 'behavior');
          
          layer.close(layer.index);
    });
  
});

//侧边栏点击事件
$('#sidenav li').on('click', function(obj){
	var $this = $(this);
	$anchor = $this.data('anchor');
	location.hash = 'anchor='+ $anchor;  //修改hash地址
	$this.addClass('active_li').siblings().removeClass('active_li');
	dialog.load();
	$has_search = false;
	Tools.sidenavChange('user', $anchor);
});

/**
 * 计算数组之和
 * @param {Object} arr
 */
function _array_sum(arr)
{
	var sum = 0;
	arr.each(function(){
		sum += Number($(this).val());
	});
	return sum;
}

/**
 * @description 提交目标客户设置
 */
function issueTarget()
{
	checkTargetOrBehaviorSet(0, () => {
		Tools.ajax('/user/target-customer', $('#target').serialize(), function(datas){
			if (datas.code == 200)
				dialog.iframe_close();
		});
	});
	
	// var sex = $('input[name=sex]').is(':checked'),
	// 		set = $('input[name^="Sex"]');
	// if (sex == false || _array_sum(set) == 100)
	// {
	// 	var age = $('input[name=age]').is(':checked'),
	// 			Age = $('input[name^="Age"]');
	// 			if (age == false || _array_sum(Age) == 100)
	// 			{
	// 				Tools.ajax('/user/issueTarget', $('#target').serialize(), function(datas){
	// 					if (datas.code == 200)
	// 						dialog.iframe_close();
	// 				})
	// 			}
	// 			else
	// 				dialog.hint(30004, '选择限制年龄，各年龄层的比例之和必须为100');
	// }
	// else
	// 	dialog.hint(30004, '选择限制性别，男女比例之和必须为100');
}

/**
 * @description 提交购买行为设置
 */
function issueBehavior()
{
    checkTargetOrBehaviorSet(1, () => {
        Tools.ajax('/user/behavior', $('#behavior').serialize(), function(datas){
        	if (datas.code == 200)
        		dialog.iframe_close();
        });
    });
}

/**
 * @description 动态加载订单标志反馈
 */
function loadFlagLists($where)
{
	$cols = [[
		{field:'tasksn', width:'16%', title: '任务编号', align: 'center'},
		{field:'ordersn', width:'20%', title: '订单编号', align: 'center'},
		{field:'shopname', width:'22%', title: '店铺名称', align: 'center'},
		{field:'wangwang', width:'20%', title: '买号', align: 'center'},
		{field:'updatetime', width:'22.3%', title: '下单时间', align: 'center'},
	]];
	Tools.dynamicLoadTable('flag-box', '/user/dynamicLoadFlagLists', $cols, $where);
}

/*
 * 订单标志反馈  - 搜索
 */
function searchFlagLists()
{
	dialog.load(undefined, 2);
	$has_search = true;
	var $is_logs = $('#logs').hasClass('layui-this');
	$where = {
		'key': $('select[name=key]').val(),
		'search_value': $('input[name=search_value]').val(),
		'start': $('input[name=start]').val(),
		'end': $('input[name=end]').val(),
	};
	loadFlagLists($where);
}

/**
 * 绑定新店铺
 */
function bindingShop()
{
	dialog.iframe('/user/add-shop', 55, 70, '绑定新店铺', '%');
}

//提交绑定店铺
function submitBinding(is_eidt)
{
	is_eidt = is_eidt || false;
	var $inputs = $('.layui-input'),
			_cur = null;
	for(var i = 0; i < $inputs.length; i++)
	{
		_cur = $inputs.eq(i);
		console.log(_cur.attr('name'));
		switch (_cur.attr('name'))
		{
			case('type'):
				if ($.inArray($('input[name=type]:checked').val(), [0, 1]) == false) return Tools._from_error(_cur, '请选择有效的店铺类型');
				break;
			case('manager'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写有效的掌柜号');
				break;
			case('shopname'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写有效的店铺名');
				break;
			case('their'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请选择有效的店铺性质');
				break;
			case('category'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请选择有效的店铺类目');
				break;
			case('consigner'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写有效的发货人');
				break;
			case('mobile'):
				var mobile = args.mobile_format, 
						phone = /^0\d{2,3}-?\d{7,8}$/;
				if (!mobile.test(_cur.val()) && !phone.test(_cur.val())) return Tools._from_error(_cur, '请填写有效的发货人号码，可填写固话或手机号码');
				break;
			case('P1'):
			case('C1'):
			case('A1'):
				if (_cur.val() == '全部') return Tools._from_error(_cur, '请选择有效的省市区');
				break;
			case('address'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写有效的发货详细地址');
				break;
			case('staff'):
				if (_cur.val().trim() == '' && typeof(_cur_img) == 'undefined' && is_eidt == false) return Tools._from_error(_cur, '请上传生意参谋截图');
				break;
		}
	}
	Tools.ajaxSubmit('binding-shop', function(datas){
		dialog.hint(datas.code, datas.message);
		if (datas.code == 200)
		{
			dialog.iframe_close();
            setTimeout(() => {
                parent.location.reload();
            }, 900);
		}
	}, '/user/add-shop', {is_edit: is_eidt});
};

//提交修改发货人的信息
$('#save-edit').on('click', function(){
	var $inputs = $('.layui-input'),
			_cur = null;
	for(var i = 0; i < $inputs.length; i++)
	{
		_cur = $inputs.eq(i);
		console.log(_cur.attr('name'));
		switch (_cur.attr('name'))
		{
			case('consigner'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写有效的发货人');
				break;
			case('mobile'):
				var mobile = args.mobile_format, 
						phone = /^0\d{2,3}-?\d{7,8}$/;
				if (!mobile.test(_cur.val()) && !phone.test(_cur.val())) return Tools._from_error(_cur, '请填写有效的发货人号码，可填写固话或手机号码');
				break;
			case('P1'):
			case('C1'):
			case('A1'):
				if (_cur.val() == '全部') return Tools._from_error(_cur, '请选择有效的省市区');
				break;
			case('address'):
				if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写有效的发货详细地址');
				break;
		}
	}
	Tools.ajaxSubmit('edit-send', function(datas){
		dialog.hint(datas.code, datas.message);
		if (datas.code == 200)
		{
			var $tag = $('input[name=tag]').val(),
					$consigner = $('input[name=consigner]').val(),
					$mobile = $('input[name=mobile]').val(),
					$address = $('textarea[name=address]').val(),
					$obj = $('tr#s_' + $tag, parent.document);
			$obj.find('.consigner').html($consigner);
			$obj.find('.mobile').html($mobile);
			$obj.find('.address').html($address);
			dialog.iframe_close();
		}
	}, '/user/saveEdit');
});

/**
 * @description  提交保存商品信息
 * @param {Object} $helper 是否使用小助手
 * @param {Object} $type 操作类型，0-新增  1-修改
 */
function submitAdd($helper, $type)
{
	$helper = 0;
	if ($.inArray($helper, ['0', '1']))
	{
		var $inputs = $('.layui-input'),
			_cur = null;
		for(var i = 0; i < $inputs.length; i++)
		{
			_cur = $inputs.eq(i);
			switch (_cur.attr('name'))
			{
				case('manager'):
					if (_cur.val().trim() == '') return Tools._from_error(_cur, '请选择商品所属店铺');
					break;
				case('pid'):
					if (_cur.val() == '' || isNaN(_cur.val()) != false) return Tools._from_error(_cur, '请填写有效的商品ID');
					break;
				case('link'):
				  if ($helper == 1)
				  {
				  	if (_cur.val().trim() == '') return Tools._from_error(_cur, '商品链接为空，请获取商品信息');
				  }
				  else
				  {
				  	var url =  /((http|ftp|https|file):\/\/([\w\-]+\.)+[\w\-]+(\/[\w\u4e00-\u9fa5\-\.\/?\@\%\!\&=\+\~\:\#\;\,]*)?)/ig;
				  	if (url.test(_cur.val()) == false) return Tools._from_error(_cur, '请填写有效的商品链接');
				  }
					break;
				case('headline'):
				  if ($helper == 1)
				  {
				  	if (_cur.val().trim() == '') return Tools._from_error(_cur, '商品标题为空，请获取商品信息');
				  }
				  else
				  {
				  	if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写有效的商品标题');
				  }
					break;
				case('master'):
				  if ($helper == 1)
				  {
				  	if (_cur.val().trim() == '') return Tools._from_error(_cur, '商品主图为空，请获取商品信息');
				  }
				  else
				  {
				  	if (_cur.val().trim() == '' && $type == 0)
				  	{
							if ($('#unUserHelperPic input[name=masterHide]').val() == "")				  		
				  			return Tools._from_error(_cur, '请选择商品主图');
				  	}
				  }
					break;
				case('abbreviation'):
					if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写商品简称，帮助您快速区分商品');
					break;
				case('weight'):
					var regular = /^([1-9]\d*(\.\d*[1-9])?)|(0\.\d*[1-9])$/;
					if (regular.test(_cur.val()) == false || _cur.val() < 0.05 || _cur.val() > 40) return Tools._from_error(_cur, '请填写有效的商品重量');
					break;
			}
		}
		$args = {
			link: $('input[name=link]').val(),
			headline: $('input[name=headline]').val(),
			master: $('input[name=master]').val(),
		};
		var $target = $type == 0 ? 'add-product' : 'edit-product';
		Tools.ajaxSubmit('add-pro', function(datas){
			dialog.hint(datas.code, datas.message);
			if (datas.code == 200)
			{
				parent.layui.table.reload('pro-list', {page: {curr: 1}});
				dialog.iframe_close();
			}
		}, '/user/' + $target, $args);
	}
	else
		dialog.hint(10001, '参数异常');
}


/**
 * 删除店铺
 */
function deleteShop($tag, $obj)
{
	if (isNaN($tag) == false)
	{
		dialog.confirm('确认删除此店铺？操作不可撤销', function(){
			Tools.ajax('/user/delete-shop', {tag: $tag}, function(datas){
				if (datas.code == 200)
				{
					var $count = $('#shop-num');
					$($obj).parents('tr').remove();
					$count.html(parseInt($count.html()) - 1);
				}
			});
		})
	}
	else
		dialog.hint(10001, '无效的参数：tag');
}

/**
 * @description 查看店铺详情
 * @param {Object} $sid
 */
function viewShop($tag)
{
	if (isNaN($tag) == false)
	{
		dialog.iframe('/user/view-shop?tag=' + $tag, 800, 600, '查看店铺详情');
	}
	else
		dialog.hint(10001, '无效的参数');
}

/**
 * @description 编辑收货人信息
 * @param {Object} $tag
 */
function editSend($tag)
{
	if (isNaN($tag) == false)
	{
		dialog.iframe('/user/editSend?tag=' + $tag, 800, 600, '编辑发货信息');
	}
	else
		dialog.hint(10001, '无效的参数');
}

/**
 * @description 店铺审核被驳回，重新编辑店铺信息，再次提交
 * @param {Object} $tag
 */
function editShop($tag)
{
	if (isNaN($tag) == false)
	{
		dialog.iframe('/user/edit-shop?tag=' + $tag, 800, 639, '编辑店铺信息');
	}
	else
		dialog.hint(10001, '无效的参数');
}

/**
 * @description 动态加载商品列表
 * @param {Object} $where
 */
function loadProductLists($where)
{
	$cols = [[
	  {type: 'checkbox', fixed: 'left', style: 'height: 6.5em'},
	  {field:'id', title:'ID', width:0, fixed: 'left', hide: true},
	  {field:'shopname', title:'店铺', width:'18%', align:'center'},
	  {field:'commodity_image', title:'主图', width:'13%', align:'center', templet:'<div><img onclick="dialog.showImg(\'{{ d.commodity_image}}\')" src="{{ d.commodity_image}}" width="80" height="80" alt="找不到.."></div>'},
	  {field:'commodity_id', title:'商品ID', width:'13.9%', align:'center'},
	  {field:'commodity_title', title:'商品标题', width:'26.6%', align:'center'},
	  {field:'commodity_abbreviation', title:'简称', width:'16%', align:'center'},
	  {field:'status', title:'状态', width:'9%', align:'center', templet:'#pro_status'},
	]];
	Tools.dynamicLoadTable('pro-list', '/user/product-list', $cols, $where, '#toolbar');
}

/*
 * 搜索商品列表
 */
function searchProductLists()
{
	dialog.load(undefined, 2);
	$has_search = true;
	var $is_logs = $('#logs').hasClass('layui-this');
	$where = {
		'manager': $('select[name=manager]').val(),
		'name': $('input[name=name]').val(),
		'p_id': $('input[name=p_id]').val(),
	};
	loadProductLists($where);
}

/**
 * @description 获取商品信息
 */
function gainProductInfo()
{
	var $args = {
		tag: $('input[name=pid]').val().trim(),
		sid: $('select[name=manager]').val(),
	};
	if ($args.sid != '' && isNaN($args.sid) == false)
	{
		if ($args.tag != '' && isNaN($args.tag) == false)
		{
			Tools.ajax('/user/gainProductInfo', $args, function(datas){
				if (datas.code == 200)
				{
					layer.close(load);
					$('input[name=link]').val(datas.datas.detailUrl);
					$('input[name=headline]').val(datas.datas.title);
					$('input[name=master]').val(datas.datas.picUrl);
					$('img#master-map').attr('src', datas.datas.picUrl);
				}
			});
		}
		else
			dialog.hint(10001, '请输入有效的商品ID');
	}
	else
		dialog.hint(10001, '请选择商品所属店铺');
}

/**
 * @description 设置资料
 * @param {Object} $type
 */
function setDatum($type)
{
	if ($.inArray($type, ['0', 1, 2, 3]))
	{
		$('input').val('');
		var $title = '',
			$vessel = 'set-password',
			$height = 300;
		switch ($type)
		{
			case 0: $title =  '设置登陆密码'; break;
			case 1: $title =  '设置安全操作码'; break;
			case 2: $title =  '绑定QQ'; $vessel = 'set-social'; $height = 230;  break;
			case 3: $title =  '绑定微信'; $vessel = 'set-social'; $height = 230;  break;
		}
		$pwd_type = $type;  //保存修改信息的类型，以便在提交的时候做对应的操作
		dialog.iframe('#' + $vessel, 600, $height, $title);
	}
}

/**
 * 提交以修改绑定账号信息
 */
function submitSetSocial()
{
	var $regular = $pwd_type == 2 ? /^[1-9]\d{5,11}$/ : /^[a-zA-Z0-9_-]{5,19}$/,
		$datas = {
			account : $('input[name=account ]').val().trim(),
			code: $('input[name=social-code]').val(),
			type: $pwd_type,
		};
		if ($regular.test($datas.account))
		{
			if ($datas.code != '')
			{
				Tools.ajax('/user/set-social', $datas, function(datas){
					if (datas.code == 200)
					{
						window.location.reload();
						$('input').val('');
						$('#social' + $pwd_type).html('已设置');
						layer.close(open);
					} 
				});
			}
			else
				dialog.hint(10001, '请输入安全操作码');
		}
		else
			dialog.hint(10001, ($pwd_type == 2 ? 'QQ' : '微信') + '账号格式错误');
}

/**
 * 提交以设置密码
 */
function submitSetPwd()
{
	var $regular = /[0-9A-Za-z\.\@\?\%\&\=\-\_]{6,16}$/, 
		$datas = {
			pwd1: $('input[name=pwd1]').val().trim(),
			pwd2: $('input[name=pwd2]').val().trim(),
			code: $('input[name=code]').val(),
			type: $pwd_type,
		};
	if ($regular.test($datas.pwd1))
	{
		if ($datas.pwd1 == $datas.pwd2)
		{
			if ($datas.code != '')
			{
				Tools.ajax('/user/set-social', $datas, function(datas){
					if (datas.code == 200)
					{
						window.location.reload();
						$('input').val('');
						layer.close(open);
					} 
				});
			}
			else
				dialog.hint(10001, '请输入安全操作码');
		}
		else
			dialog.hint(10001, '两次输入的密码不一致');
	}
	else
		dialog.hint(10001, '请填写有效的密码，格式：以字母开头，长度在6~18之间，只能包含字符、数字和部分特殊字符');
}


/**
 * @description  阅读公告
 * @param {Object} $doc_name
 */
function readDoc($id, $curr)
{
	dialog.load(undefined, 2);
	var $url = '/user/readDoc?did=' + $id + '&curr=' + $curr;
	Tools._load('doc-box', $url);
}

/**
 * @description 询问框
 * @param {Object} $tip  提示
 * @param {Object} $btns 按钮组
 * @param {Object} yes 确认回调
 * @param {Object} cancel  取消回调
 */
function _confirm($tip, $btns, yes, cancel)
{
	layer.confirm($tip, {
		btn: $btns, 
		time: 0,
		closeBtn: 1,
		icon: 3,
		title: false
	}, function(){
			yes();
	}, function(){
			cancel();
	});
}

/**
 * @description  小助理授权
 * @param {Object} $uid  用户ID
 * @param {Object} $sid 店铺ID
 */
function authorization($uid, $sid)
{
	if ($uid != '' && $sid != '')
	{
		_confirm('温馨提示：此店铺是否在淘宝服务市场订购相关服务？未订购店铺无法完成授权！记得用主账号购买和授权哦~', ['主账号去订购', '主账号去授权'], function(){
			window.open('https://tb.cn/P3TbeDw');
		}, function(){
			window.open('https://oauth.taobao.com/authorize?response_type=code&client_id=21080912&redirect_uri=http://autorate2.souyousoft.com/CallBack/Entry&state=OutPlatformName=guanzhourongsheng,UserName=' + $sid + ',CallbackUrl=http://api.yqyun.cc/api/wrench/authCallBack', "_blank");
			_confirm('授权成功了吗？', ['成功了', '失败了，问客服'], function(){
				location.reload();
			}, function(){
				window.open('http://wpa.qq.com/msgrd?v=3&uin=&site=在线客服&menu=yes');
			});
		})
	}
	else
		dialog.hint(10001, '参数异常');
}

/**
 * @description 插旗
 * @param {Object} $tag  店铺标志
 */
function flag($tag)
{
	if (isNaN($tag) == false)
	{
		dialog.iframe('/user/flag?tag=' + $tag, 800, 500, '订单备注设置');
	}
	else
		dialog.hint(10001, '无效的参数');
}

/**
 * @description 提交备注信息
 */
function submitFlag($tag)
{
	var is_mark = $('input[name=mark]:checked').val();
	var $args = {
		mark: typeof(is_mark) != 'undefined' ? is_mark : 0,
		colour: $('input[name=colour]:checked').val(),
		comment: $('textarea[name=comment]').val().trim(),
		sid: $tag,
	};
	if ($.inArray($args.mark, ['0', '1']))
	{
		if ($.inArray($args.colour, [0, '0', '1', '2', '3', '4', '5']))
		{
			if ($args.comment != '' || $args.mark == 0)
			{
				if (isNaN($args.sid) == false)
				{
					Tools.ajax('/user/submitFlag', $args, function(datas){
						if (datas.code == 200)
						{
							dialog.iframe_close();
						}
					});
				}
				else
					dialog.hint(10001, '无效的参数');
			}
			else
				dialog.hint(10001, '备注内容不能为空');
		}
		else
			dialog.hint(10001, '请选择有效的旗帜颜色');
	}
	else
		dialog.hint(10001, '请选择有效的标志状态');
}

function checkRegisterInfos(callback)
{
	var $inputs = $('#register-form input'),
			_cur = null;
		for(var i = 0; i < $inputs.length; i++)
		{
			_cur = $inputs.eq(i);
			_cur_img = _cur.next().next().find('img').attr('src');  //当审核状态为未通过的时候，图片有默认值
			switch (_cur.attr('name'))
			{
				case('phone'):
					var pattern = args.mobile_format;
					if (!pattern.test(_cur.val())) return Tools._from_error(_cur, '请填写有效的手机号码');
					break;
				case('pwd'):
					var $pwd = _cur.val().trim();
					if ($pwd == '') return Tools._from_error(_cur, '请填写登陆密码');
					break;
				case('pwd2'):
					if ($pwd != _cur.val().trim()) return Tools._from_error(_cur, '两次输入的登陆密码不一致');
					break;
				case('qq'):
					var pattern =   /^[1-9]\d{4,9}$/;
					if (!pattern.test(_cur.val())) return Tools._from_error(_cur, '请填写有效的QQ号码');
					break;
				case('mail'):
					var pattern = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/;
					if (!pattern.test(_cur.val())) return Tools._from_error(_cur, '请填写有效的邮箱地址');
					break;
//				case('Vcode'):
//					if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写页面验证码');
//					break;
//				case('Mcode'):
//					if (_cur.val().trim() == '') return Tools._from_error(_cur, '请填写手机验证码');
//					break;
			}
		}
		callback();
}

/**
 * 提交注册
 */
function submitRegister()
{
	var mode = $('#mode').hasClass('boxcol') == false;
	console.log(mode);
	checkRegisterInfos(function(){
		var mode = $('#mode').hasClass('boxcol') == false;
		$('input[name=mode]').val(Number(mode));
		Tools.ajax('/user/submitRegister', $('form#register-form').serialize(), function(datas){
			if (datas.code == 200)
			{
				setTimeout(function(){
					location.href = '/';
				}, 900);
			}
		})
	});
}

/**
 * 发送验证码
 */
function sendCode($obj, type)
{
	checkRegisterInfos(function(){
        var code_type = type || 0;
        var obj = $($obj);
        
        if (typeof(obj.attr("onClick")) == "undefined")
            return dialog.hint(10001, obj.html());
            
		$posts = {
			tel: $('input[name=phone]').val(),
            type: code_type
		};
		Tools.ajax('/user/sendCode', $posts, function(datas){
			if (datas.code == 200)
			{
                if (code_type == 1)
                    dialog.hint(60000, '语验证码已发送，稍后请留意接听电话哦');
				obj.removeAttr('onClick');
				var $time = 60,
						t = setInterval(function(){
							 $time--;
							 obj.html($time + "秒后重新获取");
							 if ($time === 0) {
								 clearInterval(t);
								 obj.attr('onClick', 'sendCode(this)').html("重新获取短信验证码");
							 }
						}, 1000);
			}
		})
	});
}

/**
 * 忘记密码 -- 发送验证码
 * @param {Object} $obj
 */
function sendForgetCode($obj)
{
	var $account = $('input[name=phone]');
	var pattern = args.mobile_format;
	if (pattern.test($account.val().trim()) == true)
	{
		$posts = {
			tel: $account.val(),
		};
		Tools.ajax('/user/sendCode', $posts, function(datas){
			if (datas.code == 200)
			{
				var obj = $($obj);
				obj.removeAttr('onClick');
				var $time = 60,
						t = setInterval(function(){
							 $time--;
							 obj.html($time + "秒后重新获取");
							 if ($time === 0) {
								 clearInterval(t);
								 obj.attr('onClick', 'sendCode(this)').html("重新获取");
							 }
						}, 1000);
			}
		})
	}
	else
		return Tools._from_error($account, '请填写有效的手机号码');
}

/**
 * 忘记密码 -- 下一步
 */
function forgetNextStep()
{
	var $args = {
		account: $('input[name=phone]').val().trim(),
		code: $('input[name=Mcode]').val().trim(),
	};
	if ($args.account != '' && isNaN($args.account) == false)
	{
		if ($args.code != '' && isNaN($args.code) == false)
		{
			Tools.ajax('/user/forgetNextStep', $args, function(datas){
				if (datas.code == 200)
				{
					layer.close(load);
					sessionStorage.setItem('forgetFirstStep', true); // 存入一个值
					$('.first').remove();
					$('.second').removeClass('hide');
				}
			})
		}
		else
			dialog.hint(10001, '请输入手机验证码');
	}
	else
		dialog.hint(10001, '请输入您的账号（注册手机号码）');
}

/**
 * @description 忘记密码，提交修改
 */
function forgetIssue()
{
	if (sessionStorage.getItem('forgetFirstStep') == true || true)
	{
		var $args = {
			pwd1: $('input[name=pwd1]').val(),
			pwd2: $('input[name=pwd2]').val(),
		};
		if ($args.pwd1 != '')
		{
			if ($args.pwd1 == $args.pwd2)
			{
				Tools.ajax('/user/forgetIssue', $args, function(datas){
					if (datas.code == 200)
					{
						location.href = '/index/loginout';
					}
				})
			}
			else
				dialog.hint(10001, '两次输入的密码不一致');
		}
		else
			dialog.hint(10001, '请输入新的密码');
	}
	else
		dialog.hint(30004, '警告：请先完成身份验证操作');
}

/**
 * @description 切换入驻方式[保证金、服务费]
 * @param {Object} curr
 */
function cutWay(curr, service, margin, balance, last)
{
	var tip = curr == 0 ? "当前方式：保证金，准备切换至服务费方式。切换之后，您需向平台缴纳一次" + service + "元作为服务费，缴纳一次永久有效（服务费不退还），未缴纳无法发布任务。确认切换将立即进行缴费。是否确定继续操作？" :
				"当前方式：服务费，准备切换至保证金方式。切换之后，您的账户至少需要保留" + margin + "元作为保证金，账户低于保证金无法发布任务。是否确认继续操作？";
	dialog.confirm(tip, function(){
//		if (curr == 0 && balance <= service) //当前保证金，判断服务费
//		{
//			return dialog.hint(30004, "当前余额：" + balance + "不足，无法扣除服务费" + service + "元，请先充值");
//		}
//		else if(curr == 1 && balance <= margin) //当前服务费，判断保证金
//		{
//			return dialog.hint(30004, "当前余额：" + balance + "不足，低于保证金" + margin + "元，请先充值");
//		}
		var timestamp = Date.parse(new Date()),
				diff = Math.abs(parseInt((last - timestamp) / 1000 / 3600 / 24));
		if(diff < 30)
		{
			return dialog.hint(30004, "30天内至多切换一次");
		}
		Tools.ajax('/user/cutWay', "{}", function(datas){
			if (curr == 0)
				$('#change_way').remove();
			else
				$('#charge_mode').html(curr == 0 ? "服务费" : "保证金");
		});
	})
}

/**
 * 生成邀请链接
 */
function generateInviteLink()
{
	var arg = {
		phone: $('input[name=phone]').val().trim(),
	},
	pattern = args.mobile_format;
	if (pattern.test(arg.phone) == true)
	{
		Tools.ajax('/user/generateInviteLink', arg, function(datas){
			if (datas.code == 200)
			{
				layer.close(load);
				$('#link').html(datas.datas);
				$('#copy_btn').attr("onclick", "Tools.copyContent('" + datas.datas + "')");
				$('#myLink').removeClass('hide');
			}
		});
	}
	else
		dialog.hint(10001, "请正确输入你想要邀请的手机号码");
}


/**
 * @description 根据商品链接获取商品详情
 */
function getProductDetailsByUrl(btn_obj)
{
	var Args = {
		url: $('input[name=link]').val().trim(),
		Manager: $('select[name=manager] option:selected').html(),
	}
	//是否选择店铺
	if (Args.Manager == '')
		return dialog.hint(10001, '请选择商品所属店铺');
	//是否选择商品链接
	if (Args.url == "")
		return dialog.hint(10001, "请输入商品链接");
	//校验格式
	var UrlRegular =  /((http|ftp|https|file):\/\/([\w\-]+\.)+[\w\-]+(\/[\w\u4e00-\u9fa5\-\.\/?\@\%\!\&=\+\~\:\#\;\,]*)?)/ig;
	if (UrlRegular.test(Args.url) == false) 
		return dialog.hint(10001, "商品链接格式有误");
	//获取数据
	Tools.ajax('/user/get-product-details-by-url', Args, function(Data){
		if (Data.code == 60000)
		{
			layer.close(load);
			$('input[name=headline]').val(Data.datas.title);
			$('input[name=pid]').val(Data.datas.NumIid);
			//显示主图，赋值隐藏域
			$("#unUserHelperPic .dropify-render").html("<img src='" + Data.datas.picUrl + "'>");
			$('#unUserHelperPic input[name=masterHide]').val(Data.datas.picUrl);
			$("#unUserHelperPic .dropify-preview").css("display", "block");
			//情况主图文件选择框的值
			$("input[name=master]").val("");
		}
		// 获取按钮倒计时
		var obj = $(btn_obj);
		obj.removeAttr('onClick');
		var $time = 5;
		obj.html("获取商品详情(" + $time + ")");
		t = setInterval(function(){
			 $time--;
			 obj.html("获取商品详情(" + $time + ")");
			 if ($time === 0) {
				 clearInterval(t);
				 obj.attr('onClick', 'getProductDetailsByUrl(this)').html("获取商品详情");
			 }
		}, 1000);
	});
}


/**
 * 提交修改加群信息
 */
function submitChangeQrcode(sid)
{
	Tools.ajaxSubmit('binding-shop', function(datas){
			dialog.hint(datas.code, datas.message);
			if (datas.code == 200)
			{
				dialog.iframe_close();
			}
		}, '/user/edit-shop', {sid: sid});
}

/*
 * 搜索邀请列表信息
 */
function searchnviteList()
{
	dialog.load(undefined, 2);
	$has_search = true;
	var phone = $('input[name=u_phone]').val().trim();
	$url = '/user/inviteList?phone=' + phone;
	Tools._load('invite-list', $url);
}

function checkTargetOrBehaviorSet(type, callback)
{
    if (type == 0)
    {
        var sex = $('input[name=sex]').is(':checked'),
        	set = $('input[name^="Sex"]');
        
        if (sex == true && _array_sum(set) != 100)
        	return dialog.hint(30004, '选择限制性别，男女比例之和必须为100');
        	
        var age = $('input[name=age]').is(':checked'),
        	Age = $('input[name^="Age"]');
        	
        if (age == true && _array_sum(Age) != 100)
        	return dialog.hint(30004, '选择限制年龄，各年龄层的比例之和必须为100');
    }
	else
    {
        var bookmark = $('input[name=bookmark]').val(),
            c_goods = $('input[name=c_goods]').val(),
            talk = $('input[name=talk]').val();
            
        if (bookmark > 100 || c_goods > 100 || talk > 100)
            return dialog.hint(30004, '百分比不能大于100');
            
        var compare = $('input[name^="compare"]');
        
        if (_array_sum(compare) != 100)
            return dialog.hint(30004, '货币N家的比例之和必须为100');
            
        var browse = $('input[name^="browse"]');
        if (_array_sum(browse) != 100)
            return dialog.hint(30004, '浏览深度的比例之和必须为100');
    }
		
	callback();
}

/**
 * 保存目标客户的模板
 */
function saveTargetTemplate(type)
{
	checkTargetOrBehaviorSet(type, () => {
		var curr_prompt = layer.prompt({
			formType: 0,
			title: "请给模板取一个名字",
		}, (value) => {
			var name = $.trim(value);
			if (name == '')
				return dialog.hint(10001, '模板名无效，请重新输入');
			
            var form_id = "#target";
            var url = '/user/add-customer-template';
            if (type == 1) {
                form_id = "#behavior";
                url = '/user/add-behavior-template';
			}

			var post_data = $(form_id).serialize();
			post_data += "&name=" + encodeURIComponent(name);
			post_data += "&type=" + encodeURIComponent(type);
			Tools.ajax(url, post_data, (data) => {
				if (data.code == 200)
                {
                    var other_btn = $("#issue_btn");

                    if (other_btn.lenth > 0)
                        layer.close(curr_prompt);
                    else
                        setTimeout(() => {
                            parent.location.reload();
                        }, 1000);
                        
                }
			})
		});
	});
}

function templateCPM(title, url)
{
    layer.open({
        type: 2,
        title: title,
        area: ['96rem', '66.3rem'],
        shade: 0.6,
        maxmin: true,
        content: url,
        zIndex: layer.zIndex
    }); 
}

var handleTemplate = {
    // 预览模板
    previewTemplate: (tag, type, name) => {
    	if (tag == '')
            return dialog.hint(10001, '无效的参数，请刷新后再试');
            
        var title = '【 模板预览：' + name + '】',
            url = '/user/preview-customer-template?tag=' + tag + '&type=' + type;
            
        templateCPM(title, url);
    },
    
    // 修改模板
    modifyTemplate: (tag, type, name) => {
    	if (tag == '')
            return dialog.hint(10001, '无效的参数，请刷新后再试');
        
        var title = '【 修改模板：' + name + '】';
        if(type == 1) {
			url = '/user/modify-behavior-template?tag=' + tag + '&type=' + type;
		} else {
			url = '/user/modify-customer-template?tag=' + tag + '&type=' + type;
		}
        templateCPM(title, url);
    },
    
    // 应用模板
    useTemplate: (tag, type) => {
    	// 检查是否有勾选的商品
        var curr_check_pros = [];
        
        if (typeof(parent.check_pros) != "undefined")
            curr_check_pros = parent.check_pros;
            
        var tip_msg = '',
            post_data = {
                'tag': tag,
                'type': type
            };
        
        
        if (curr_check_pros.length > 0)
        {
            var ids = [];
            $.each(curr_check_pros, function(index, value){
                ids.push(value.id);
            });
            post_data.ids = ids.join(',');
            tip_msg = "您在“商品管理”那里勾选了" + ids.length + "个商品，是否将此模板应用到这些商品？（如需应用到所有商品，请不要在“商品管理”那勾选任何商品）";
        }
        else
            tip_msg = '系统监测到您没有勾选任何商品，是否将此模板应用到所有商品？（如需应用到指定商品，请先到“商品管理”勾选商品，再来应用）';
            
        dialog.confirm(tip_msg, () => {
            Tools.ajax('/user/use-template', post_data);
        });
    },
    
    // 删除模板
    delTemplate: (tag, type) => {
    	if (tag == '')
            return dialog.hint(10001, '无效的参数，请刷新后再试');
        
        var post_data = {
            'tag': tag,
			'type' : type
        };
        dialog.confirm("确定删除此模板吗？", () => {
            Tools.ajax('/user/delete-customer-template', post_data, function(datas){
                if (datas.code == 200)
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
            });
        });
    },
    
    addTemplate: (tag) => {
    	if (tag == undefined)
            return dialog.hint(10001, '无效的参数，请刷新后再试');
        
        var title = "";
        
        if (tag == 0) {
            title = "新增【目标客户】模板";
			templateCPM(title, "/user/add-customer-template?type=" + tag);
		}
        else {
            title = "新增【购买行为】模板";
			templateCPM(title, "/user/add-behavior-template?type=" + tag);
		}
    },
};

function saveModifyTemplate(curr_tag, curr_name, curr_type)
{
    checkTargetOrBehaviorSet(curr_type, () => {
    	var curr_prompt = layer.prompt({
    		formType: 0,
    		title: "请给模板取一个名字",
            value: curr_name,
    	}, (value) => {
    		var name = $.trim(value);
    		if (name == '')
    			return dialog.hint(10001, '模板名无效，请重新输入');
    		
            var form_id = "#target";
            if (curr_type == 1)
                form_id = "#behavior";
            
    		var post_data = $(form_id).serialize();
    		post_data += "&name=" + encodeURIComponent(name);
    		post_data += "&tag=" + encodeURIComponent(curr_tag);
    		post_data += "&type=" + encodeURIComponent(curr_type);

			if(curr_type == 1) {
				var url = '/user/modify-behavior-template';
			} else {
				var url = '/user/modify-customer-template';
			}

    		Tools.ajax(url, post_data, (data) => {
    			if (data.code == 200)
                    setTimeout(() => {
                        parent.location.reload();
                    }, 1000)
    		})
    	});
    });
}


var changeWarehouse = (s_id) => {
    
    if (isNaN(s_id) !== false)
        return dialog.hint(10001, '无效的参数');
    
    dialog.iframe('/user/change-warehouse?tag=' + s_id, 800, 600, '选择发货仓库');
}

var submitWh = () => {
    
    var consigner = $("input[name=consigner]").val().trim();
    var mobile = $("input[name=mobile]").val().trim();
    
    if (consigner == '')
        return dialog.hint(10001, "请输入寄件人的姓名");
        
    if (mobile == '' || Tools.verifyDataFormat(mobile, 'mobile_phone') == false)
        return dialog.hint(10001, "请输入寄件人的电话 / 分机号");
    
    var post_data = {
        tag: $("input[name=tag]").val(),
        sender_name: consigner,
        sender_phone: mobile,
        wh_id: $("input[name=wh_id]:checked").val(),
    };
    
    Tools.ajax('/user/save-shop', post_data, (data) => {
        if (data.code == 200)
        {
            dialog.iframe_close();
            parent.location.reload();
        }
    });
}