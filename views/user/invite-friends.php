<div class="layui-tab layui-tab-brief" lay-filter="withdraw">
    <ul class="layui-tab-title">
        <li lay-id = 'inviteFriends' data-state = "" class="layui-this">邀请好友</li>
        <li lay-id='inviteList'>我的邀请列表</li>
    </ul>
</div>
<div id="invite-box">
    <div class="tip-card ">
        <div class="card-header padding-1">邀请好友说明</div>
        <div class="card-body padding-1"><ul style="color:#222222;font-family:&quot;font-size:14px;background-color:#FFFFFF;">
                <li>
                    1.推广方式--复制下方推广链接或者将二维码图片发送给好友
                </li>
                <li>
                    2.邀请好友--好友点开链接或者扫描二维码注册
                </li>
                <li>
                    3.获得返利--注册成功的好友每完成1单任务后，您将获得1元推广费，推广费将发送至余额
                </li>
            </ul></div>
    </div>
    <div class="layui-form-item" id="invite">
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" name="phone" placeholder="请输入要邀请的手机号码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <button class="layui-btn" onclick="generateInviteLink()">生成邀请链接</button>
            </div>
        </div>
    </div>
    <div class="hide" id="myLink">
        <br>
        <div class="layui-form-mid layui-word-aux">我的邀请链接</div>
        <p id="link"></p>
        <p><a id="copy_btn" href="javascript:;">复制，发给好友注册</a></p>
        <textarea id="copy" style="display:none;"></textarea>
    </div>
</div>
<div id="invite-list"></div>