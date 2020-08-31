    <script src="/static/plugin/jquery.json.js"></script>
    <style type="text/css">
			.dropdown-preview {
				margin: 0 5px;
				display: inline-block;
			}
			.dropdown-preview  > .dropdown-menu {
				display: block;
				position: static;
				margin-bottom: 5px;
			}
    </style>
	<div class="page-content">
		<div class="page-header">
			<h1>
				聊天室
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					聊天室
				</small>
			</h1>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<div class="widget-box">
					<div class="widget-header">
						<h4 class="widget-title lighter smaller">
							<i class="ace-icon fa fa-comment blue"></i>
							Websocket测试
						</h4>
					</div>
					<div class="widget-body">
						<div class="widget-main no-padding">
							<div class="dialogs message-dialogs">

							</div>
							<form>
								<div class="form-actions">
									<div class="input-group">
										<input autocomplete="off" placeholder="输入内容 ..." maxlength="200" type="text" class="form-control message-input" name="message">
										<span class="input-group-btn">
											<button class="btn btn-sm btn-info no-radius send-message" type="button">
												<i class="ace-icon fa fa-share"></i>
												发送消息
											</button>
										</span>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
				<div class="col-sm-6">
					<div class="dropdown dropdown-preview">
						<ul class="dropdown-menu online-list">
							<?php foreach ($online_list as $online) { ?>
								<li class="online-<?php echo md5($online['id']); ?>">
									<li class="online-<?php echo md5($online['id']); ?> dropdown-hover">
										<a href="javascript:;" data-uid="<?php echo md5($online['id']); ?>" tabindex="-1" class="clearfix">
											<span class="pull-left"><?php echo $online['username']; ?></span>
											<i class="ace-icon fa fa-caret-right pull-right"></i>
										</a>
										<ul class="dropdown-menu dropdown-danger">
											<li>
												<a class="add-friends" data-uid="<?php echo md5($online['id']); ?>" href="javascript:;" tabindex="-1">添加好友</a>
											</li>
											<li>
												<a data-uid="<?php echo md5($online['id']); ?>" href="javascript:;" tabindex="-1">查看资料</a>
											</li>
										</ul>
									</li>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
		</div>
	</div>
<script type="text/javascript">
	var websocket = {};
	var uid = <?php echo $uid; ?>;
	var channel = <?php echo $channel; ?>;
	$(document).ready(function(){

		$('.dialogs').ace_scroll({
			size: 300
		});

		websocket = new WebSocket("<?php echo $ws; ?>");
		listenEvent();
		$(document).on('click', ".add-friends", function() {
			g.func.ajaxPost("/admin/chat/add-friend", {uid : $(this).attr('data-uid')} , function(res){
				if (res.code && res.code == 200) {
					g.func.success(res.msg);
				} else {
					g.func.error(res.msg);
				}
			}, function() {
			});
		});	
	});

	function listenEvent() {
		websocket.onopen = function(e) {
			msg = new Object();
			msg = {
				'uid' : uid,
				'channel' : channel
			};
			websocket.send('home.index:' + $.toJSON(msg));
		}
		websocket.onmessage = function(e) {
			var data = $.evalJSON(e.data);
			if(data.code == 200) {
				// 新消息
				if(data.data.action == 'home.message') {
					var me ='<div class="itemdiv dialogdiv">'+
								'<div class="user">'+
									'<img alt="' + data.data.username + '" src="/static/img/avater.jpg">'+
								'</div>'+
								'<div class="body">'+
									'<div class="time">'+
										'<span class="green">'+data.data.time+'</span>'+
									'</div>'+
									'<div class="name">'+
										'<a href="javascript:;">' + data.data.username + '</a>'+
									'</div>'+
									'<div class="text">' + data.data.data + '</div>'+
								'</div>'+
							'</div>';
					$(".message-dialogs").find(".scroll-content").append(me);
					toBottom();
				}

				// 新用户进入消息
				if(data.data.action == 'join.chat') {
					if(!$('.online-list>li').hasClass('online-' + data.data.uid)) {
						var onlineHtml = '<li class="online-' + data.data.uid + '">'+
											'<li class="online-' + data.data.uid + ' dropdown-hover">'+
												'<a href="javascript:;" data-uid="' + data.data.uid + '" tabindex="-1" class="clearfix">'+
													'<span class="pull-left">' + data.data.username + '</span>'+
													'<i class="ace-icon fa fa-caret-right pull-right"></i>'+
												'</a>'+
												'<ul class="dropdown-menu dropdown-danger">'+
													'<li>'+
														'<a class="add-friends" data-uid="' + data.data.uid + '" href="javascript:;" tabindex="-1">添加好友</a>'+
													'</li>'+
													'<li>'+
														'<a data-uid="' + data.data.uid + '" href="javascript:;" tabindex="-1">查看资料</a>'+
													'</li>'+
												'</ul>'+
											'</li>'+
										'</li>';
						$(".online-list").append(onlineHtml);
					}
				}

				// 添加好友消息
				if(data.data.action == 'chat.add_friend') {
                    var sys = '<li class="dropdown-content">' + 
                                '<ul class="dropdown-menu dropdown-navbar navbar-pink">' + 
                                    '<li>' + 
                                        '<a href="javascript:;">' + 
                                            '<i class="btn btn-xs btn-primary fa fa-user"></i>' + data.data.message + 
                                        '</a>' + 
                                    '</li>' + 
                                '</ul>' + 
                           '</li>';
					$(".system-message").prepend(sys);
					$(".message-content-notice").text("新消息");
				}

				// 退出房间消息
				if(data.data.action == 'chat.quit') {
					if($('.online-list>li').hasClass('online-' + data.data.uid)) {
						$(".online-" + data.data.uid).remove();
					}
				}
			}
		}
		
		websocket.onclose = function(e) {
			g.func.error('断开连接');
		}

		websocket.onerror = function(e) {

		}
	}

	function toBottom() {
	    var chat = $(".message-dialogs").find(".scroll-content");
	    chat[0].scrollTop = chat[0].scrollHeight;
	}

	function sendMessage(action, message) {
	    websocket.send(action + ':' + $.toJSON(message));
	    toBottom();
	}

	function sendInputMessage() {
		var content = $(".message-input").val();
		if (typeof content == "string") {
			content = content.replace(" ", "&nbsp;");
		}
		if (!content) {
			return false;
		}
		msg = new Object();
		msg = {
			'uid' : uid,
			'channel' : channel,
			'message' : content,
		};
		sendMessage('home.message', msg);
    	$('.message-input').val('');
	}

	$(function() {
		$(".send-message").click(function(){
			sendInputMessage();
		});
	})

	document.onkeydown = function (e) {
	    var ev = document.all ? window.event : e;
	    if (ev.keyCode == 13) {
	        sendInputMessage();
	        return false;
	    } else {
	        return true;
	    }
	};	
</script>