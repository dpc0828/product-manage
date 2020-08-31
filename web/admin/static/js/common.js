;(function () {
    var g = {};
    g.func = {};
    g.func.loading = function (action, type) {
        if (action === 'close') {
            layer.closeAll('loading'); //关闭加载层
        } else {
            layer.load(type ? type : 3, {
                shade: [0.5, '#000'] //0.1透明度的白色背景
            });
        }
    };
    
    //提示层
    g.func.tips = function (message, callback, time) {
        layer.msg(message, {time: time ? time * 1000 : 2000});
    };
    
    // 普通信息框
    g.func.alert = function (message, callback) {
        layer.alert(message, function (index) {
            layer.close(index);
            $.isFunction(callback) && callback.apply(this);
        });
    };
    
    //警告层
    g.func.warn = function (message, callback, time) {
        layer.msg(message, {
            icon: 7,
            time: time ? time * 1000 : 2000,
        })
    };
    
    //成功层
    g.func.success = function (message, callback, time) {
        layer.msg(message, {
            icon: 6,
            time: time ? time * 1000 : 2000,
            end: function () {
                $.isFunction(callback) && callback.apply(this);
            }
        });
    };
    
    //失败层
    g.func.error = function (message, callback, time) {
        layer.msg(message, {
            icon: 2,
            time: time ? time * 1000 : 2000,
            end: function () {
                $.isFunction(callback) && callback.apply(this);
            }
        });
    };
    
    //确认层
    g.func.confirm = function (message, yes, no) {
        layer.confirm(message, {
            time: 0, //不自动关闭
            btn: ['确定', '取消'],
            title: '温馨提示',
            shade: 0.6,
            shadeClose: true, //点击阴影关闭
            yes: function (index) {
                layer.close(index);
                $.isFunction(yes) && yes.apply(this);
            },
            cancel: function (index) {
                layer.close(index);
                $.isFunction(no) && no.apply(this);
            }
        });
    };
    
    //对话框
    g.func.dialog = function (url, title, width, height, must_use) {
        must_use = must_use || false;
        if (!must_use) {
            height = Math.min(height || 597, $(window).height() - 50);
            width = Math.min(width || 960, $(window).width() - 30);
        }
        layer.open({
            type: 2,
            shadeClose: true,
            maxmin: true,
            title: title || "窗口",
            shade: [0.8, '#000'],
            area: [width + 'px', height + 'px'],
            shift: -1,
            content: url + ((url.indexOf('?') > -1 ? '&' : '?') + '_dialog=1')
        });
    };
    
    
    /**
     * 跳转
     * @param url
     */
    g.func.goTo = function (url) {
        window.location.href = url;
    };
    
    //重载
    g.func.reload = function () {
        window.location.reload();
    };
    
    //重新加载所有
    g.func.reloadAll = function () {
        window.location.reload();
    };
    
    //关闭自身层
    g.func.layerCloseSelf = function () {
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    };
    
    //页面层
    g.func.page = function (str, title, callback, width, height) {
        height = Math.min(height || 597, $(window).height() - 50);
        width = Math.min(width || 960, $(window).width() - 30);
        layer.open({
            type: 1,
            shadeClose: true,
            maxmin: true,
            title: title || "窗口",
            shade: [0.8, '#000'],
            area: [width + 'px', height + 'px'],
            shift: -1,
            content: str,
            success: function () {
                $.isFunction(callback) && callback.apply(this);
            }
        });
    };
    
    
    // 输入层
    g.func.prompt = function(str, title, callback, width, height) {
        if (!width) {
            width = 'auto';
        } else {
            width = width + 'px';
        }
        if (!height) {
            height = 'auto';
        } else {
            height = height + 'px';
        }
        layer.prompt({
            formType: 2,
            value: str,
            title: title,
            area: [width, height] //自定义文本域宽高
        }, function (value, index, elem) {
            $.isFunction(callback) && callback.apply(this, [value]);
            layer.close(index);
        });
    };
    
    /**
     * ajax 提交
     * @param url
     * @param data
     * @param success
     * @param error
     * @param complete
     * @param beforeSend
     * @param showMsg
     */
    g.func.ajaxPost = function (url, data, success, error, complete, beforeSend, showMsg) {
        if (typeof showMsg == 'undefined') {
            showMsg = true;
        }
        var csrfName = $("meta[name=_csrf_name_]").attr('content');
        var csrfValue = $("meta[name=_csrf_token_]").attr('content');
        data[csrfName] = csrfValue;
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            beforeSend: function () {
                $.isFunction(beforeSend) && beforeSend.apply(this);
                g.func.loading('open');
            },
            complete: function (complete) {
                g.func.loading('close');
                $.isFunction(complete) && complete.apply(this);
            },
            success: function (res) {
                if (res.code && res.code === 200) {
                    if (showMsg && res.msg) {
                        g.func.tips(res.msg);
                    }
                    $.isFunction(success) && success.apply(this, [res]);
                } else if (res.code && res.code === 401) {
                    if (showMsg && res.msg) {
                        g.func.error(res.msg, g.func.goTo(res.data.login_url), 3000);
                    }
                } else {
                    if (showMsg && res.msg) {
                        g.func.error(res.msg);
                    }
                    $.isFunction(error) && error.apply(this, [res]);
                }
            },
            error: function () {
                g.func.error('无法提交,请检查网络连接是否正常');
            }
        });
    };
    
    /**
     * ajax post 提交 无loading 动画
     * @param url
     * @param data
     * @param success
     * @param error
     * @param complete
     * @param beforeSend
     * @param showMsg
     */
    g.func.ajaxPostNoLoading = function (url, data, success, error, complete, beforeSend, showMsg) {
        if (typeof showMsg == 'undefined') {
            showMsg = true;
        }
        var csrfName = $("meta[name=_csrf_name_]").attr('content');
        var csrfValue = $("meta[name=_csrf_token_]").attr('content');
        data[csrfName] = csrfValue;
        $.ajax({
            url: url,
            data: data,
            type: 'post',
            dataType: 'json',
            beforeSend: function (beforeSend) {
                $.isFunction(beforeSend) && beforeSend.apply(this);
                g.func.loading();
            },
            complete: function (complete) {
                $.isFunction(complete) && complete.apply(this);
            },
            success: function (res) {
                if (res.code && res.code === 200) {
                    if (showMsg && res.msg) {
                        g.func.success(res.msg);
                    }
                    $.isFunction(success) && success.apply(this, [res]);
                } else if (res.code && res.code === 401) {
                    if (showMsg && res.msg) {
                        g.func.error(res.msg, g.func.goTo(res.data.login_url), 3000);
                    }
                } else {
                    if (showMsg && res.msg) {
                        g.func.error(res.msg);
                    }
                    $.isFunction(error) && error.apply(this, [res]);
                }
            },
            error: function () {
                g.func.error('无法提交,请检查网络连接是否正常');
            }
        });
    };

    g.func.ajaxDelete = function (message, url, data) {
        g.func.confirm(message, function() {
            g.func.ajaxPost(url, data, function() {
                g.func.reload();
            });
        });
    };

    window.g = g;
    $(".data-delete").click(function() {
        g.func.ajaxDelete($(this).attr('data-title'), $(this).attr('data-href'), {});
    });
})(jQuery);