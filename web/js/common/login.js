$(document).ready(function() {
    var $login = $(".login");
    function ripple(elem, e) {
        $(".ripple").remove();
        var elTop = elem.offset().top,
            elLeft = elem.offset().left,
            x = e.pageX - elLeft,
            y = e.pageY - elTop;
        var $ripple = $("<div class='ripple'></div>");
        $ripple.css({top: y, left: x});
        elem.append($ripple);
    }
  
    $(document).on("click", ".login__submit", function(e) {
        var csrfValue = $("meta[name=_csrf_token_]").attr('content');
        var csrfName = $("meta[name=_csrf_name_]").attr('content');
        var $this = $(this);
        var post_data = {};
        post_data['username'] = $('input[name=mc-username]').val().trim();
        post_data['pwd'] = $('input[name=pwd]').val();
        post_data[csrfName] = csrfValue;
        ripple($this, e);
        if (post_data['username'] != '' && post_data['pwd'] != '')
        {
            $this.addClass("processing").attr('disabled', true);
            Tools.ajax('/login/login', post_data, function(datas){
                if (datas.code != 200) {
                    $this.removeClass('processing').attr('disabled', false);
                } else {
                    location.href = '/index/index';
                }
            }, false);
        }
        else {
            dialog.hint(10001, '登录手机号或密码不能为空');
        }
    });
    $(document).on("click", ".app__logout", function(e) {
        if (animating) {
            return;
        }
        $(".ripple").remove();
        animating = true;
        var that = this;
        $(that).addClass("clicked");
        setTimeout(function() {
            $app.removeClass("active");
            $login.show();
            $login.css("top");
            $login.removeClass("inactive");
            }, logoutPhase1 - 120);
        setTimeout(function() {
            $app.hide();
            animating = false;
            $(that).removeClass("clicked");
            }, logoutPhase1);
    });
});