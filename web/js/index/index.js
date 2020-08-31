/**
 * @description  请求排队
 */
function liningUp()
{
	var $options = {
		platform: $('input[name=platform]:checked').val(),
		terminal: $('input[name=terminal]:checked').val(),
		amount: $('input[name=amount]').val(),
	};
	if ($options.platform == 0)
	{
		if (jQuery.inArray($options.terminal, ['0', '1']) != -1)
		{
			Tools.ajax('/index/filtration', $options, function(datas){
				if (datas.code == 200)
				{
					layer.close(load);
					cutConsole();
					var $socket_link = datas.datas.socket_link + '/Task?UserID=' + datas.datas.userid + '&TaskPrice=' + $options.amount + '&DownTaskPoint=' + $options.terminal + '&TaskCategory=0',
						$show_close = true;
					$socket = new WebSocket($socket_link)
					//建立socket成功
					$socket.onopen  = function(){
						
					}
					//监听socket错误
					$socket.onerror = function(event){
						console.log('error');
						$show_close = false;
						cutConsole();
						dialog.hint(30002, '建立网络链接失败');
					};
					//监听socket断开
					$socket.onclose = function(event){
						if ($show_close == true)
						{
							cutConsole();
							dialog.hint(30002, '请求异常中断');
						}
					};
					$socket.onmessage = function(event){
						var $msg = JSON.parse(event.data);
						$show_close = false;
						console.log(event);
						console.log($msg.RType == 100);
						if ($msg.IsOK == true)
						{
							localStorage.clear();
							switch ($msg.RType)
							{
								case 1:
									break;
								case 100:
								case 101:
									if ($msg.RType != 100)
									{
										$msg.Data.UTaskSN = $msg.Data.PTaskSN;
										$msg.Data.UTask_Commission = $msg.Data.PTask_Commission;
										$msg.Data.UTaskID = $msg.Data.PTaskID;
									}
									var $type = $msg.RType == 100 ? 'normal' : 'subscribe';
									cutConsole();
									showTask($msg.Data, function(){
										Tools.doTask($msg.Data.UTaskID, $type, '任务操作界面');
									}, function(){
										Tools.cancelTask($msg.Data.UTaskID, $type);
										return true;
									});
									break;	
							}
						}
						else
						{
							cutConsole();
							dialog.hint(30004, $msg.Description);
						}
							
					}
				}
			})
		}
		else
			dialog.hint(10001, '请选择有效的任务终端');
	}
	else
		dialog.hint(10001, '请选择有效的平台');
}

function stopLiningUp()
{
	console.log(typeof($socket));
	if(typeof($socket) != 'undefined')
	{
		cutConsole();
		$socket.close();
	}
}

/**
 * @description 切换控制台状态
 * @param {Object} $type
 */
function cutConsole($type)
{
	$('#request').toggle('fast', function(){
		$('#load').toggle();
	});
}

/**
 * @description 展示任务信息
 * @param {Object} $infos
 * @param {Object} affirm
 * @param {Object} cancel
 */
function showTask($infos, affirm, cancel)
{
	$('#tasksn').html($infos.UTaskSN);
	$('#shopname').html($infos.ShopName);
	$('#commission').html($infos.UTask_Commission);
	$('#remark').html($infos.Task_Remark);
	layer.open({
	  type: 1,
	  title: false,
	  closeBtn: false,
	  area: '330px;',
	  shade: 0.8,
	  id: 'LAY_layuipro',
	  resize: false,
	  btn: ['开始任务', '取消任务', '退出弹窗'],
	  btnAlign: 'c',
	  moveType: 1,
	  content: $('#showBar'),
	  btn1: function(){
	  	affirm();
	  },
	  btn2: function(){
	  	cancel();
	  },
	});
}

function matterTips($matter)
{
	layui.use('layer', function(){
	  layer = layui.layer;
	  layer.tips($matter, '#username', {
		tips: 3,
		time: 0,
	  });
	});
}

/**
 * 切换全局任务的状态
 * @param {Object} state
 */
function cutShowStatus(state, obj)
{
	var tip = state == 0 ? "确认全局隐藏任务？全局隐藏任务状态下，待接任务将不会进行派发。" : "确认取消全局隐藏任务？取消之后，[显示状态]的待接任务将会正常派发";
	dialog.confirm(tip, function(){
		Tools.ajax("/user/cutShowStatus", "{}", function(datas){
			if (datas.code == 200)
			{
				$('#ShowStatus').html(state == 0 ? "隐藏任务" : "显示任务");
				$(obj).attr('onclick', "cutShowStatus(" + !state + ", this)");
			}
		})
	});
}

var taskStatistics = () => {
    Tools.ajax('/task/taskStatistics', {}, (data) => {
        if (data.code == 200)
        {
            var html_str = `
                <div class="padding-2">
                    <table class="layui-table" lay-even lay-skin="nob">
                        <colgroup>
                            <col width="133">
                            <col width="99">
                            <col width="99">
                            <col width="99">
                        </colgroup>
                        <thead>
                            <tr class="col_name">
                              <th>店铺名</th>
                              <th>今日可接数</th>
                              <th>今日已接数</th>
                              <th>取消任务数</th>
                            </tr> 
                        </thead>
                        <tbody>
            `;
            $.each(data.datas, (k, v) => {
                html_str += `
                    <tr>
                      <td>${v.shopname}</td>
                      <td>${v.count}</td>
                      <td>${v.already}</td>
                      <td>${v.del}</td>
                    </tr>
                `;
            });
            
            html_str += `
                        </tbody>
                        </table>
                    </table>
                </div>
            `;
            
            layer.close(load);
            
            layer.open({
                type: 1,
                title: '店铺今日单量数据统计',
                area: ['69rem', '33rem'], //宽高
                content: html_str
            });
        }
    }, true, 'get');
}
