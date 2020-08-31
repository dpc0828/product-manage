<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title><?php echo \app\utils\Utils::webSiteTitle(); ?></title>
    <?php echo \app\utils\Utils::getCsrfMeta(); ?>
    <script src="/js/common/jquery.min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/layer/layui.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script src="/js/common/common.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link href="/css/layui/layui.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/common.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/bootsnav.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <link href="/css/common/bootstrap.min.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css" />
    <head>
<body>
<!--头部logo、用户信息、导航栏end-->
<div class="col-xs-offset-3 col-md-offset-0 col-sm-offset-0 col-lg-offset-0">
    <link href="/css/user/user.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
    <div class="padding-2">
        <blockquote class="layui-elem-quote layui-quote-nm suspend_shadow">
            <p>【 设置须知 】</p>
            <p>1、不勾选代表不做限制，勾选则代表需要按您设置的百分比进行目标客户匹配。</p>
            <p>2、限制目标客户之后，将有可能减慢任务的匹配速度。请合理设置百分比。不限制（即不勾选）的情况下匹配速度最快。</p>
            <p>3、地区限制中，勾选对应的区域代表不允许这些省份的用户接单。</p>
        </blockquote>
        <br />
        <form class="layui-form narrow_2" id="target" action="javascript:;" lay-filter="target">
            <input type="hidden" name="tag" value="" />
            <div class="layui-form-item" id="set_sex">
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="checkbox" name="sex" title="性别" lay-filter="set" lay-skin="primary">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">男</label>
                    <div class="layui-input-inline">
                        <input type="number" name="Sex[0]" autocomplete="off" class="layui-input Sex"
                               oninput="Tools.clearNaN(this);"
                        >
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">女</label>
                    <div class="layui-input-inline">
                        <input type="number" name="Sex[1]" autocomplete="off" class="layui-input Sex"
                               oninput="Tools.clearNaN(this);"
                        >
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <div class="layui-form-item" id="set_age">
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <input type="checkbox" name="age" title="年龄" lay-filter="set" lay-skin="primary">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">18-24</label>
                    <div class="layui-input-inline">
                        <input type="number" name="Age[younger]" autocomplete="off" class="layui-input"
                               oninput="Tools.clearNaN(this);"
                        >
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">25-33</label>
                    <div class="layui-input-inline">
                        <input type="number" name="Age[middle]" autocomplete="off" class="layui-input"
                               oninput="Tools.clearNaN(this);"
                        >
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">34-50</label>
                    <div class="layui-input-inline">
                        <input type="number" name="Age[older]" autocomplete="off" class="layui-input"
                               oninput="Tools.clearNaN(this);"
                        >
                    </div>
                    <div class="layui-form-mid layui-word-aux">%</div>
                </div>
            </div>
            <hr>
            <!-- <div class="layui-form-mid layui-word-aux">地区限制（省份和地域二选一，只能选择其中一个进行限制。推荐按省份进行限制，更加精准）</div> -->
            <div class="layui-form-mid layui-word-aux">
                <strong class="text-danger">【 不给哪个省份的接，就勾哪个！注意别勾反了哦！ 】</strong>
            </div>
            <div class="layui-form-item" id="set_province">
                <div class="layui-inline">
                    <p>
                    <div class="layui-form-mid layui-word-aux">华东地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[山东]" title="山东" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[江苏]" title="江苏" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[安徽]" title="安徽" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[浙江]" title="浙江" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[福建]" title="福建" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[上海]" title="上海" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">华南地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[广东]" title="广东" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[广西]" title="广西" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[海南]" title="海南" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">华中地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[湖北]" title="湖北" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[湖南]" title="湖南" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[河南]" title="河南" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[江西]" title="江西" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">华北地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[北京]" title="北京" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[天津]" title="天津" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[河北]" title="河北" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[山西]" title="山西" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">西北地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[青海]" title="青海" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[陕西]" title="陕西" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[甘肃]" title="甘肃" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">西南地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[四川]" title="四川" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[云南]" title="云南" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[贵州]" title="贵州" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[重庆]" title="重庆" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">东北地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[辽宁]" title="辽宁" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[吉林]" title="吉林" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[黑龙江]" title="黑龙江" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">台港澳区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[台湾]" title="台湾" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[香港]" title="香港" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[澳门]" title="澳门" value="1" lay-skin="primary" />
                    </p>
                    <p>
                    <div class="layui-form-mid layui-word-aux">偏远地区：</div>
                    <!-- <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" /> -->
                    <input type="checkbox" name="province[宁夏]" title="宁夏" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[新疆]" title="新疆" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[西藏]" title="西藏" value="1" lay-skin="primary" />
                    <input type="checkbox" name="province[内蒙古]" title="内蒙古" value="1" lay-skin="primary" />
                    </p>
                </div>
            </div>
            <hr>
            <!-- <div class="layui-form-item" id="set_territory">
              <div class="layui-inline">
                <div class="layui-input-inline">
                  <input type="checkbox" name="territory" title="按地域" lay-filter="set" lay-skin="primary">
                </div>
              </div>
              <div class="layui-inline">
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[0]" title="华东地区（山东、江苏、安徽、浙江、福建、上海）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[1]" title="华南地区（广东、广西、海南）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[2]" title="华中地区（湖北、湖南、河南、江西）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[3]" title="华北地区 （北京、天津、河北、山西）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[4]" title="西北地区 （青海、陕西、甘肃）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[5]" title="西南地区 （四川、云南、贵州、重庆）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[6]" title="东北地区 （辽宁、吉林、黑龙江）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[7]" title="台港澳地区（台湾、香港、澳门）" value="1" lay-skin="primary" />
                </div>
                <br />
                <div class="layui-input-inline">
                  <input type="checkbox" name="Territory[8]" title="偏远地区（内蒙古、宁夏、新疆、西藏）" value="1" lay-skin="primary" />
                </div>
              </div>
            </div>
            <hr /> -->
            <div class=" text-center">
                <?php if(!empty($info)) { ?>
                <button class="layui-btn layui-btn-primary" onclick="saveModifyTemplate(<?php echo $info['id']; ?>, '<?php echo $info['template_name']; ?>', 0)">保存为模板</button>
                <?php } ?>
            </div>
        </form>
    </div>
    <script src="/js/user/user.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
    <script>
        layui.use('form', function(){
            <?php if(!empty($info)) { ?>
            var form = layui.form;
            form.val("target", {
                //性别
                "sex": "<?php if($info['gender'] == 1) {echo 1;}?>",
                "Sex[0]": "<?php if(!empty($info['male_percent'])) {echo $info['male_percent'] * 100;}?>",
                "Sex[1]": "<?php if(!empty($info['female_percent'])) {echo $info['female_percent'] * 100;}?>",
                //年龄
                "age": "<?php if($info['age'] == 1) {echo 1;}?>",
                "Age[younger]": "<?php if(!empty($info['age18_24'])) {echo $info['age18_24'] * 100;}?>",
                "Age[middle]": "<?php if(!empty($info['age25_33'])) {echo $info['age25_33'] * 100;}?>",
                "Age[older]": "<?php if(!empty($info['age34_50'])) {echo $info['age34_50'] * 100;}?>",
                //地域
                // "territory": "",
                // "Territory[0]": "",
                // "Territory[1]": "",
                // "Territory[2]": "",
                // "Territory[3]": "",
                // "Territory[4]": "",
                // "Territory[5]": "",
                // "Territory[6]": "",
                // "Territory[7]": "",
                // "Territory[8]": "",
                <?php
                if(!empty($info['exclude_province'])) {
                    $exclude_province = explode(' ', $info['exclude_province']);
                    foreach ($exclude_province as $exclude) {
                        echo "\"province[{$exclude}]\": 1," . PHP_EOL;
                    }
                }
                ?>
            })
            form.render();
            <?php } ?>
        });
        $('#set_territory').find('input[name^="Territory"]').attr('disabled', true);
    </script>
</div>
<script src="/js/common/share.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
</body>
</html>