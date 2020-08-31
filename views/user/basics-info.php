<div>
    <div class="layui-tab layui-tab-brief" lay-filter="withdraw">
        <ul class="layui-tab-title">
            <li lay-id = 'basicsInfo' data-state = "" class="layui-this">会员基本资料</li>
        </ul>
    </div>
    <div id="infos-box" class="layui-row">
        <div class="handle_view layui-col-md5">
            <form id="apply-form" class="layui-form" action="javascript:;">
                <div class="layui-form-item">
                    <label class="layui-form-label">会员名</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux"><span><?php echo $info['mobile']; ?></span></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux"><span><?php echo $info['mobile']; ?></span></div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">登陆密码</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux">
                            <span>已设置</span>
                            <i class="layui-icon edit-pwd" title="点击进行设置" onclick="setDatum(0)">&#xe642;</i>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">安全码</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux">
                            <span><?php if(!empty($info['safety_code'])){echo  "已设置";} else {echo "未设置";} ?></span>
                            <i class="layui-icon edit-pwd" title="点击进行设置" onclick="setDatum(1)">&#xe642;</i>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">QQ</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux">
                            <span id="social2">
                                <?php if(!empty($info['qq'])){echo  "已设置";} else {echo "未设置";} ?>
                                <?php if(empty($info['qq'])){ ?>
                                    <i class="layui-icon edit-pwd" title="点击进行设置" onclick="setDatum(2)">&#xe642;</i>
                                <?php } ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">微信</label>
                    <div class="layui-input-block">
                        <div class="layui-form-mid layui-word-aux">
                            <span id="social3">
                                <?php if(!empty($info['wechat'])){echo  "已设置";} else {echo "未设置";} ?>
                                <?php if(empty($info['wechat'])){ ?>
                                    <i class="layui-icon edit-pwd" title="点击进行设置" onclick="setDatum(3)">&#xe642;</i>
                                <?php } ?>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="handle_view layui-col-md3 layui-col-md-offset2">
            <blockquote class="layui-elem-quote layui-quote-nm">
                <p>愉快合作第：<span class="text-blue"><?php echo \app\utils\Utils::registerDays($info['create_time'])?></span>天</p>
<!--                <p>账户存款：<span class="text-blue">0</span>元</p>-->
                <p>绑定店铺：<span class="text-blue"><?php echo $total_shop; ?></span>家</p>
            </blockquote>
            <hr />
            <div>

            </div>
        </div>
    </div>
</div>
<div id="set-password" class="padding-2" style="display: none;">
    <form id="set-password-form" class="layui-form" action="javascript:;">
        <div class="layui-form-item">
            <label class="layui-form-label">新密码</label>
            <div class="layui-input-block">
                <input type="password" name="pwd1" placeholder="要求：以字母开头，6~18位，只能包含字符、数字" autocomplete="new-password" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">确认密码</label>
            <div class="layui-input-block">
                <input type="password" name="pwd2" placeholder="请再次输入新密码" autocomplete="new-password" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份验证</label>
            <div class="layui-input-block">
                <input type="password" name="code" placeholder="请输入安全操作码" autocomplete="new-password" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" onclick="submitSetPwd()" lay-submit>立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>
<div id="set-social" class="padding-2" style="display: none;">
    <form id="set-social-form" class="layui-form" action="javascript:;">
        <div class="layui-form-item">
            <label class="layui-form-label">新账号</label>
            <div class="layui-input-block">
                <input type="text" name="account" placeholder="请输入您要绑定的账号" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">身份验证</label>
            <div class="layui-input-block">
                <input type="password" name="social-code" placeholder="请输入安全操作码" autocomplete="new-password" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" onclick="submitSetSocial()" lay-submit>立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>
    </form>
</div>