<link href="/css/task/release.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
<link href="/css/task/release_ok.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
<link href="/css/task/tagsinput.css?v=<?php echo \app\utils\Utils::version(); ?>" rel="stylesheet" type="text/css">
<div class="padding-2">
    <ul class="nav nav-pills nav-justified step step-arrow">
        <li>
            <a>选择任务类型</a>
        </li>
        <li>
            <a>设置任务信息</a>
        </li>
        <li>
            <a>完成</a>
        </li>
    </ul>
    <input type="hidden" name="curr_id" value="24187">
    <form id="release-form" class="layui-form" action="javascript:;" method="post">
        <!--选择任务类型-->
        <div data-step = "1" class="layui-bg-gray step">
            <div class="padding-2">
                <p class="alert alert-warning">
                    <i class="layui-icon layui-icon-speaker"></i>
                    <strong>数据只保留60天，如有需要，请做好备份</strong>
                </p>
                <div class="layui-row layui-col-space15">
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" value="1" title="销量任务" checked>
                                <a href="javascript:;" target="_blank"></a>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p>安全：兼职真实用户，一人一号，永不复购高权重：实名主号，三心以上可对目标客户进行定位</p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" disabled  value="10" title="标签任务">
                                <span class='layui-badge'>HOT</span>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p>安全：用户个性化标签，指定货比、收藏，宝贝权重提高。包含任务特点，大大提高有效性和安全性</p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" disabled value="5" title="预约任务">
                                <span class='layui-badge'>敬请期待</span>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p>安全：今日浏览，可设置三天内下单，订单安全，权重高，多型选择，灵活要求，让用户更严谨</p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>

                    <!-- 提前购 -->
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" disabled value="13"  title="提前购">
                                <span class='layui-badge'>敬请期待</span>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p>安全：新玩法！商品还未上架就把单量补进去，帮助商家做新品预告、潜力爆款的打造。
<!--                                    <a href="javascript:;" target="_blank">阅读教程</a> | <a href="javascript:;">上传群二维码</a>-->
                                </p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" disabled value="16" title="AB单">
                                <span class='layui-badge'>敬请期待</span>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p>安全：搜索A款进店，在店内找到B款成交。</p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>
                    <!-- 多链接 -->
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" disabled value="8" title="多链接任务">
                                <span class='layui-badge'>敬请期待</span>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p
                                    class="text-overflow"
                                    title="安全：实现多个单品权重，宝贝一拖一流量带动，店铺整体权重增加(一次可拍2-3个产品，搭配套餐销售)"
                                >安全：实现多个单品权重，宝贝一拖一流量带动，店铺整体权重增加(一次可拍2-3个产品，搭配套餐销售)</p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" disabled value="7" title="猜你喜欢">
                                <span class='layui-badge'>敬请期待</span>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p
                                    class="text-overflow"
                                    title="安全：实现人群标签，免费获取推送精准流量，通过购买行为达到提升店铺或者单品标签的效果。"
                                >安全：实现人群标签，免费获取推送精准流量，通过购买行为达到提升店铺或者单品标签的效果。</p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>
                    <!-- 微淘 / 直播 -->
                    <div class="layui-col-md6">
                        <div class="layui-card">
                            <div class="layui-card-header">
                                <input type="radio" name="tasktype" lay-filter="tasktype" disabled value="11" title="微淘 / 直播任务">
                                <span class='layui-badge'>敬请期待</span>
                            </div>
                            <div class="layui-card-body">
                                <h5>特点</h5>
                                <p>安全：关注店铺，从微淘、直播入口下单</p>
                                <p>智能化：自动标记 （必须开通小助理）</p>
                            </div>
                        </div>
                    </div>
                    <!-- 预售任务 -->
                </div>
                <div class="btn-box">
                    <button class="ayui-btn layui-btn-radius layui-btn-primary type-btn">下一步</button>
                </div>
            </div>
        </div>
        <!--选择任务类型END-->
        <!--设置任务信息-->
        <div data-step = "2" id="set-infos" class="step hide">
            <div class="fprw-sdsp">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;">
                        <strong>
                            <i class="layui-icon layui-icon-templeate-1">&nbsp;</i>
                            <span>选定商品</span>
                            <span class="ab_set">，设置成交款</span>
                        </strong>
                    </h4>
                    <span class="more_set hide">（主宝贝）</span>
                    <small class="ab_set layui-word-aux hide">
                        进店后在店内找到该商品成交
                    </small>
                    <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal _tips sel-pro" id="master_pro_sel" data-tipmsg="温馨提示:请确保发布任务的商品主图与店铺主图一致,如有改动,请在商品管理那里更新产品主图" onclick="selectPro()">&nbsp;&nbsp;&nbsp;选择商品&nbsp;&nbsp;&nbsp;</button>
                </div>
                <div class="fprw-sdsp_2" id="sel_pro">
                    <table style="table-layout: fixed;">
                        <tbody>
                        <tr>
                            <th width="110">商品简称</th>
                            <td width="500" id="abbreviation"></td>
                            <td width="138" rowspan="5"><img id="pro-img" src="" alt="" width="208"/></td>
                        </tr>
                        <tr>
                            <th width="110">商品ID&nbsp;&nbsp;&nbsp;</th>
                            <td width="500" id="pro-id"></td>
                        </tr>
                        <tr>
                            <th width="110">店铺名&nbsp;&nbsp;&nbsp;</th>
                            <td width="500" id="shopname"></td>
                        </tr>
                        <tr>
                            <th width="110">商品标题 </th>
                            <td width="500" id="title"></td>
                        </tr>
                        <tr>
                            <th width="110">商品链接</th>
                            <td width="500" style="word-wrap: break-word"><a id="pro-url" href="" target="_blank"></a></td>
                        </tr>
                        <tr>
                            <input type="hidden" name="proid" />
                            <input type="hidden" name="sid" />
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <button
                id="sync-pic-btn"
                type="button"
                class="layui-btn layui-btn-fluid layui-btn-normal margin-0 suspend_shadow hide"
                onclick="syncMasterPic()"
            >【 如果在淘宝后台更换了商品主图，需要点击此按钮同步更新至平台 】</button>
            <div class="fprw-sdsp more_set hide">
                <div class="add_sub_div">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-link">&nbsp;</i>添加副宝贝</strong></h4>
                    <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal _tips sel-pro"  data-tipmsg="温馨提示:请确保发布任务的商品主图与店铺主图一致,如有改动,请在商品管理那里更新产品主图" onclick="selectPro(1)">&nbsp;&nbsp;&nbsp;选择商品&nbsp;&nbsp;&nbsp;</button>
                </div>
                <div class="hide sub_pro_list subjoin_pro" id="subPro"></div>
            </div>

            <!-- AB单添加搜索款 -->
            <div class="fprw-sdsp ab_set hide">
                <div class="add_sub_div">
                    <h4 style="display: inline-block;">
                        <strong>
                            <i class="layui-icon layui-icon-search">&nbsp;</i>设置进店款
                            <small class="layui-word-aux">搜索关键词，找到此商品进店</small>
                        </strong>
                    </h4>
                    <button
                        class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal _tips sel-pro"
                        data-tipmsg="温馨提示:请确保发布任务的商品主图与店铺主图一致,如有改动,请在商品管理那里更新产品主图"
                        onclick="selectPro(2)"
                    >&nbsp;&nbsp;&nbsp;选择进店款&nbsp;&nbsp;&nbsp;</button>
                </div>
                <div class="hide padding-1 subjoin_pro" id="baguette_pro"></div>
            </div>

            <div id="origin" class="fprw-sdsp">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-senior">&nbsp;</i>来路设置</strong></h4>
                    <small class="ab_set layui-word-aux hide">
                        设置进店款的搜索关键词
                    </small>
                    <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal sel-pro" id="add_keyword_btn" onclick="addKeyword(this)">&nbsp;&nbsp;&nbsp;新增&nbsp;&nbsp;&nbsp;</button>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th width="18%">流量入口</th>
                            <th width="30%">
                                <span class="advance_set hide">货比</span><span>关键词</span><span class="more_set hide text-danger">（只需设置主宝贝搜索关键词）</span>
                                <small class="layui-icon layui-icon-tips _tips tag_set hide" data-tipmsg="「打标关键词」设置您产品类目的一级关键词、高转化的词或热搜词、高流量的词，先给用户打上标签<br />「下单关键词」：设置让用户下单购买的关键词"></small>
                            </th>
                            <th width="15%">数量</th>
                            <th class="tag_set hide" width="15%">
                                <span>打标签价格区间</span>
                                <small class="layui-icon layui-icon-tips _tips tag_set hide" data-tipmsg="注意:这个价格区间不是让用户用来卡价格的哦！是根据您产品的价格段，让用户选择性的浏览您设置的价格段的商品，让打标更精准"></small>
                            </th>
                            <th class="tag_set hide micro_set" width="15%">下单时间</th>
                            <th class="hide micro_set" width="15%">下单入口</th>
                            <!-- 预约任务设置项表头 -->
                            <th class="hide subscribe_set" width="15%">如何浏览商品</th>
                            <th class="hide subscribe_set" width="20%">下单关键词</th>
                            <!-- 预约任务设置项表头END -->
                            <th class="purchase_set" width="15%">其它设置（可选）<i class="layui-icon layui-icon-tips _tips" data-tipmsg = "同时发布流量单：同时用这个关键词发布相同数量的流量单，用来稀释此关键词的成交率。流量任务的流量入口只能是淘宝APP"></i></th>
                            <th width="15%">其它搜索条件（可选）</th>
                            <th width="10%">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="clone">
                            <td>
                                <select name="entrance[]" lay-filter="entrance">
                                    <option value="1">淘宝APP自然搜索</option>
                                    <option class="purchase_set" value="2">淘宝PC自然搜索</option>
                                    <option value="3">淘宝APP淘口令</option>
                                    <option value="4">淘宝APP直通车</option>
                                    <option class="purchase_set" value="5">淘宝PC直通车</option>
                                    <option value="6">淘宝APP二维码</option>
                                    <option class="purchase_set" value="8">拍立淘</option>
                                    <option value="9">聚划算</option>
                                </select>
                            </td>
                            <td class="tag_hide SetKeyword">
                                <div class="form-group sales_set">
                                    <div class="text-left layui-word-aux">
                                        <small>
                                            <i class="layui-icon layui-icon-tips" style="font-size: 85%;"></i>
                                            用货比词先浏览竞品。最多填3个，每个词每笔佣金多收1元
                                        </small>
                                    </div>
                                    <input name="vie_keyword[]" class="layui-input" data-role="tagsinput" placeholder="货比词，选填，输入后回车"/>
                                </div>
                                <input type="text" name="keyword[]" placeholder="请设置目标关键词" class="OrderKey Keyword layui-input recover-dis " data-tipmsg = "请确保设置的关键词能在前10页找到，如果找不到，请更换关键词或设置卡条件" oninput="inputKeywordAndNum()">
                            </td>
                            <td class="tag_set hide SetKeyword">
                                <input type="text" name="tag_keyword[]" placeholder="设置打标关键词(用来给用户打上标签)" class="Keyword layui-input recover-dis " data-tipmsg = "请确保设置的关键词能在前10页找到，如果找不到，请更换关键词或设置卡条件" oninput="inputKeywordAndNum()">
                                <p></p>
                                <input type="text" name="order_keyword[]" placeholder="设置下单关键词(用这个词进店，浏览、下单)" class="OrderKey Keyword layui-input recover-dis " data-tipmsg = "请确保设置的关键词能在前10页找到，如果找不到，请更换关键词或设置卡条件" oninput="inputKeywordAndNum()">
                            </td>
                            <td>
                                <input type="number" name="gross[]" placeholder="请设置任务数量" value="0" class="layui-input in_task_num" oninput="Tools.clearNaN(this);inputTaskNum(); inputKeywordAndNum()">
                            </td>
                            <td class="tag_set hide price_tag">
                                <div class="layui-form-item">
                                    <div class="layui-inline">
                                        <div class="layui-input-inline" style="width: 5.3rem;">
                                            <input type="text" name="tag_price_min[]" placeholder="最低价" autocomplete="off" class="layui-input">
                                        </div>
                                        <div class="layui-form-mid">-</div>
                                        <div class="layui-input-inline" style="width: 5.3rem;">
                                            <input type="text" name="tag_price_max[]" placeholder="最高价" autocomplete="off" class="layui-input">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="tag_set hide">
                                <select name="order_time[]" lay-filter="order_time">
                                    <option value="0">打标后立即下单</option>
                                    <option value="1" selected>打标后一个小时后下单</option>
                                    <option value="2">打标后预约第二天下单</option>
                                    <option value="3">打标后预约第三天下单</option>
                                    <option value="4">打标后预约第四天下单</option>
                                    <option value="5">打标后预约第五天下单</option>
                                </select>
                                <p class="padding-top-2 hide morrow_time">
                                    <input type="text" name="morrow_time[]" autocomplete="off" class="layui-input _MorrowTime" placeholder="预约下单时间">
                                </p>
                                <p class="padding-top-2 valid_time">
                                    <select name="valid_time[]">
                                        <option value="1">开始下单后必须1个小时内完成</option>
                                        <option value="2">开始下单后必须2个小时内完成</option>
                                        <option value="3">开始下单后必须3个小时内完成</option>
                                        <option value="4">开始下单后必须4个小时内完成</option>
                                        <option value="5">开始下单后必须5个小时内完成</option>
                                        <option value="6">开始下单后必须6个小时内完成</option>
                                        <option value="7">开始下单后必须7个小时内完成</option>
                                    </select>
                                </p>
                            </td>
                            <!-- 微淘任务设置项 -->
                            <td class="micro_set hide">
                                <select name="micro_order_time[]" lay-filter="order_time">
                                    <option value="0">关注店铺后立即下单</option>
                                    <option value="1" selected>关注店铺一个小时后下单</option>
                                </select>
                            </td>
                            <td class="micro_set hide">
                                <select name="orders_entrance[]" lay-filter="order_time">
                                    <option value="0" selected>淘宝首页微淘</option>
                                    <option value="1">淘宝首页直播</option>
                                </select>
                            </td>
                            <!-- 微淘任务设置项 END -->

                            <!-- 预约任务设置项 -->
                            <td class="subscribe_set  hide">
                                <select name="browse[]"  class="layui-input " lay-filter="browse">
                                    <option value="3">货比三家，并上传【足迹】截图至平台</option>
                                    <option value="2">收藏商品，并收藏五款其他店铺的同类产品，上传【收藏夹】截图</option>
                                    <option value="1">加入购物车，并加购四款其他店铺的同类产品，上传【购物车】截图</option>
                                </select>
                            </td>
                            <td class="subscribe_set  hide">
                                <input
                                    type="text"
                                    name="newKeyword[]"
                                    placeholder="选填,不填则从昨日浏览处进入商品"
                                    class="layui-input"
                                />
                            </td>
                            <!-- 预约任务设置项 END -->

                            <td class="purchase_set">
                                <p class=".same_flow_p">
                                    <input class="same_flow" type="checkbox" name="same_flow[0]" value="1" title="同时发布流量单" lay-skin="primary" lay-filter="same_flow">
                                </p>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-radius layui-btn-primary other-search recover-dis" onclick="otherSet(this)">设置</button>
                            </td>
                            <td>
                                <button class="layui-btn layui-btn-radius layui-btn-primary" onclick="removeOrigin(this)">删除</button>
                            </td>
                        </tr>
                        </tbody>
                        <thead>
                        <tr style="display: none;">
                            <td>

                            </td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div id="target" class="fprw-sdsp purchase_set">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-note">&nbsp;</i>买号常购类目<small>（不勾选则匹配所有买号）</small></strong></h4>
                    <p class="float-right"><input type="checkbox" title="全选 / 反选" lay-skin="primary" lay-filter="Invert"></p>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <tbody class="layui-form" lay-filter="invert">
                        <tr class="clone">
                            <td>
                                <p align="left">
                                    <input type="checkbox" name="invert[]" title="潮流女装" value="潮流女装" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="时尚男装" value="时尚男装" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="鞋子箱包" value="鞋子箱包" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="数码家电" value="数码家电" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="美食特产" value="美食特产" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="居家日用" value="居家日用" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="母婴用品" value="母婴用品" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="珠宝配饰" value="珠宝配饰" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="家装家纺" value="家装家纺" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="住宅家具" value="住宅家具" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="车品车饰" value="车品车饰" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="运动户外" value="运动户外" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="家庭保健" value="家庭保健" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="中老年用" value="中老年用" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="护肤彩妆" value="护肤彩妆" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="百货食品" value="百货食品" lay-skin="primary">
                                    <input type="checkbox" name="invert[]" title="其它类目" value="其它类目" lay-skin="primary">
                                </p>
                            </td>
                        </tr>
                        </tbody>
                        <thead>
                        <tr style="display: none;">
                            <td>

                            </td>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--销量 / 预约单的定价类型-->
            <div id="pricing" class="fprw-sdsp purchase_set diff_more">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-rmb">&nbsp;</i>定价类型</strong></h4>
                    <small class="ab_set layui-word-aux hide">
                        请设置成交款的定价类型
                    </small>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="hidden" name="model" value="0" />
                    <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal sel-pro" id="add_price_btn" onclick="addPricing(this)">&nbsp;&nbsp;&nbsp;新增&nbsp;&nbsp;&nbsp;</button>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th width="20">商品单价</th>
                            <th width="20" class="new_retail hide">自提券价格</th>
                            <th width="20">快递费</th>
                            <th width="20">拍下件数</th>
                            <th width="50">型号(选填)</th>
                            <th width="20">任务数量（<span id="task_num" class="text-danger task_num">0</span>）</th>
                            <th width="20">单任务成交金额</th>
                            <th width="20">单任务佣金</th>
                            <th width="20">单任务快递费</th>
                            <th width="20">合计</th>
                            <th width="20">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="clone">
                            <td>
                                <input type="number" step="0.01" name="price[]" value="0" placeholder="商品单价" data-tipmsg="当天有活动,请注意活动价格哦~" autocomplete="off" class="layui-input _tips" oninput="Tools.clearNaN(this,true); priceCalculate()">
                            </td>
                            <td class="new_retail hide">
                                <input type="number" step="0.01" name="pick_price[]" value="0" placeholder="门店自提券的价格" autocomplete="off" class="layui-input" oninput="Tools.clearNaN(this,true); priceCalculate()">
                            </td>
                            <td>
                                <input type="number" name="express[]" value="0" placeholder="（选填）" autocomplete="off" class="layui-input" oninput="Tools.clearNaN(this, true); priceCalculate()">
                            </td>
                            <td>
                                <input type="number" name="pat_num[]" value="1" placeholder="拍下件数" autocomplete="off" class="layui-input" oninput="Tools.clearNaN(this); priceCalculate()">
                            </td>
                            <td>
                                <input type="text" name="Model[]" placeholder="指定拍下型号, 不填则拍默认型号" autocomplete="off" class="layui-input _Model set_pat_model">
                            </td>
                            <td>
                                <input type="number" name="pat_count[]" value="0" placeholder="任务数量" autocomplete="off" class="layui-input" oninput="Tools.clearNaN(this); priceCalculate(); traverseTaskNum();" readonly>
                            </td>
                            <td><span class="turnover recover-num">0</span>元</td>
                            <td><span class="commission recover-num">0</span>元</td>
                            <td><span class="express recover-num">0</span>元</td>
                            <td><span class="line-total recover-num">0</span>元</td>
                            <td>
                                <button class="layui-btn layui-btn-radius layui-btn-primary" onclick="removePricing(this)">删除</button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="10"  class="total">
                                <ul>
                                    <li>成交总金额: <span id="total-turnover">0</span>元</li>
                                    <li>佣金总金额: <span id="total-commission">0</span>元</li>
                                    <li>其中快递费总金额: <span id="total-express">0</span>元</li>
                                    <li>合计: <span id="total">0</span>元</li>
                                </ul>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!--销量 / 预约单的定价类型END-->

            <!--多链任务的定价类型-->
            <div id="pricing" class="fprw-sdsp  more_set hide">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-rmb">&nbsp;</i>定价类型</strong></h4>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="hidden" name="model" value="0" />
                    <button class="layui-btn layui-btn-sm layui-btn-radius layui-btn-normal sel-pro" onclick="addPricing(this)">&nbsp;&nbsp;&nbsp;新增&nbsp;&nbsp;&nbsp;</button>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th width="20"></th>
                            <th width="20">商品单价</th>
                            <th width="20">拍下件数</th>
                            <th width="50">型号(选填)</th>
                            <th width="20">快递费</th>
                            <th width="20">任务数量（<span id="task_num" class="text-danger task_num">0</span>）</th>
                            <th width="20">单任务成交金额</th>
                            <th width="20">单任务佣金</th>
                            <th width="20">单任务快递费</th>
                            <th width="20">合计</th>
                            <th width="20">操作</th>
                        </tr>
                        </thead>
                        <tbody class="clone setPrice">
                        <tr class="one_tr">
                            <td>
                                <span class="layui-badge layui-bg-black">主宝贝</span>
                            </td>
                            <td>
                                <input type="number" step="0.01" name="price[]" value="0" placeholder="商品单价" data-tipmsg="当天有活动,请注意活动价格哦~" autocomplete="off" class="layui-input _tips" disabled oninput="Tools.clearNaN(this,true); priceCalculate()">
                            </td>
                            <td>
                                <input type="number" name="pat_num[]" value="1" placeholder="拍下件数" autocomplete="off" class="layui-input" oninput="Tools.clearNaN(this); priceCalculate()" disabled>
                            </td>
                            <td>
                                <input type="text" name="Model[]" placeholder="指定拍下型号,不填则拍下默认型号" autocomplete="off" class="layui-input _Model set_pat_model">
                            </td>
                            <td rowspan="3">
                                <input type="number" name="express[]" value="0" placeholder="（选填）" autocomplete="off" class="layui-input" oninput="Tools.clearNaN(this, true); priceCalculate()" disabled>
                            </td>
                            <td rowspan="3">
                                <input type="number" name="pat_count[]" value="0" placeholder="任务数量" autocomplete="off" class="layui-input"  readonly disabled oninput="Tools.clearNaN(this); priceCalculate(); traverseTaskNum();">
                            </td>
                            <td rowspan="3"><span class="turnover recover-num">0</span>元</td>
                            <td rowspan="3"><span class="commission recover-num">0</span>元</td>
                            <td rowspan="3"><span class="express recover-num">0</span>元</td>
                            <td rowspan="3"><span class="line-total recover-num">0</span>元</td>
                            <td rowspan="3">
                                <button class="layui-btn layui-btn-radius layui-btn-primary" onclick="removePricing(this)">删除</button>
                            </td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="11"  class="total">
                                <ul>
                                    <li>成交总金额: <span id="total-turnover">0</span>元</li>
                                    <li>佣金总金额: <span id="total-commission">0</span>元</li>
                                    <li>其中快递费总金额: <span id="total-express">0</span>元</li>
                                    <li>合计: <span id="total">0</span>元</li>
                                </ul>
                            </th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!--多链任务的定价类型END-->
            <div id="releaseTime" class="fprw-sdsp">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-console">&nbsp;</i>发布时间</strong></h4>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="release_time" value="0" title="立即发布" lay-filter="release-time">
                    <input type="radio" name="release_time" value="1" title="今日平均发布" lay-filter="release-time" checked>
                    <input type="radio" name="release_time" value="2" title="多天平均发布" lay-filter="release-time" >
                    <span class="hide" id="time_auxiliary" style="margin: 0;">
  						<input type="checkbox" name="alone" title="为多个关键词分别设置时间" value="1" lay-skin="primary" lay-filter="alone">
						<i class="layui-icon layui-icon-tips _tips" data-tipmsg="设置了多个关键词，选择今日平均发布的时候，系统默认对这些关键词依次派发， 即在您设置的时间段内，派完一个关键词再派另外一个关键词。如需要对这些关键词单独设置时间，请勾选此选项"></i>
						&nbsp;&nbsp;
					</span>
                    <small><a href="javascript:;" onclick="oneKeySetTime()">一键设置时间</a></small>
                </div>
                <div class="fprw-sdsp_2">
                    <!--时间table-->
                    <table id="time_table" style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th id="line_hearder" width="120">日期（剩余可发布数）</th>
                            <th width="80">任务数（<span id="datTask-num" class="text-danger task_num">0</span>）</th>
                            <th width="100">开始时间</th>
                            <th width="100">结束时间<br />(默认当天23:59)</th>
                            <th width="100">超时取消<br />(默认当天23:59)</th>
                            <th width="100" class="browse_set hide">浏览回看时间</th>
                            <th width="100" class="subscribe_set hide">预约下单时间&nbsp;<i class="layui-icon layui-icon-tips" id="sub_set_tip"></i><br />(默认次日09:00-23:59)</th>
                        </tr>
                        </thead>
                        <tbody id="time_tbody">
                        <tr class="">
                            <td>
                                <input checked="checked" type="checkbox" name="date[]" title='（今天）<?php echo date('Y-m-d', time()); ?>(200)' value="<?php echo date('Y-m-d', time()); ?>" lay-filter="date"/>
                            </td>
                            <td>
                                <input  type="number" name="day_num[]" value="0" placeholder="设置该天任务数" autocomplete="off" class="layui-input" onfocus="$tag = 'do'" onkeyup="Tools.clearNaN(this); allocateTaskToDay(200, $tag)" readonly>
                            </td>
                            <td>
                                <input  type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                            </td>
                            <td>
                                <input  type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                            </td>
                            <td>
                                <input  type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                            </td>
                            <td class="browse_set hide">
                                <input  type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel second_visit_time" placeholder="浏览回看时间">
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input  type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel subscribeTime" placeholder="预约下单时间">
                            </td>
                        </tr>
                        <tr class="hide">
                            <td>
                                <input  type="checkbox" name="date[]" title='<?php echo date('Y-m-d', time() + 86400); ?>(200)' value="<?php echo date('Y-m-d', time() + 86400); ?>" lay-filter="date"/>
                            </td>
                            <td>
                                <input disabled type="number" name="day_num[]" value="0" placeholder="设置该天任务数" autocomplete="off" class="layui-input" onfocus="$tag = 'do'" onkeyup="Tools.clearNaN(this); allocateTaskToDay(200, $tag)" readonly>
                            </td>
                            <td>
                                <input disabled type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                            </td>
                            <td class="browse_set hide">
                                <input disabled type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel second_visit_time" placeholder="浏览回看时间">
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input disabled type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel subscribeTime" placeholder="预约下单时间">
                            </td>
                        </tr>
                        <tr class="hide">
                            <td>
                                <input  type="checkbox" name="date[]" title='<?php echo date('Y-m-d', time() + 2 * 86400); ?>(200)' value="<?php echo date('Y-m-d', time() + 2 * 86400); ?>" lay-filter="date"/>
                            </td>
                            <td>
                                <input disabled type="number" name="day_num[]" value="0" placeholder="设置该天任务数" autocomplete="off" class="layui-input" onfocus="$tag = 'do'" onkeyup="Tools.clearNaN(this); allocateTaskToDay(200, $tag)" readonly>
                            </td>
                            <td>
                                <input disabled type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                            </td>
                            <td class="browse_set hide">
                                <input disabled type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel second_visit_time" placeholder="浏览回看时间">
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input disabled type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel subscribeTime" placeholder="预约下单时间">
                            </td>
                        </tr>
                        <tr class="hide">
                            <td>
                                <input  type="checkbox" name="date[]" title='<?php echo date('Y-m-d', time() + 3 * 86400); ?>(200)' value="<?php echo date('Y-m-d', time() + 3 * 86400); ?>" lay-filter="date"/>
                            </td>
                            <td>
                                <input disabled type="number" name="day_num[]" value="0" placeholder="设置该天任务数" autocomplete="off" class="layui-input" onfocus="$tag = 'do'" onkeyup="Tools.clearNaN(this); allocateTaskToDay(200, $tag)" readonly>
                            </td>
                            <td>
                                <input disabled type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                            </td>
                            <td class="browse_set hide">
                                <input disabled type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel second_visit_time" placeholder="浏览回看时间">
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input disabled type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel subscribeTime" placeholder="预约下单时间">
                            </td>
                        </tr>
                        <tr class="hide">
                            <td>
                                <input  type="checkbox" name="date[]" title='<?php echo date('Y-m-d', time() + 4 * 86400); ?>(200)' value="<?php echo date('Y-m-d', time() + 4 * 86400); ?>" lay-filter="date"/>
                            </td>
                            <td>
                                <input disabled type="number" name="day_num[]" value="0" placeholder="设置该天任务数" autocomplete="off" class="layui-input" onfocus="$tag = 'do'" onkeyup="Tools.clearNaN(this); allocateTaskToDay(200, $tag)" readonly>
                            </td>
                            <td>
                                <input disabled type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                            </td>
                            <td class="browse_set hide">
                                <input disabled type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel second_visit_time" placeholder="浏览回看时间">
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input disabled type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel subscribeTime" placeholder="预约下单时间">
                            </td>
                        </tr>
                        <tr class="hide">
                            <td>
                                <input  type="checkbox" name="date[]" title='<?php echo date('Y-m-d', time() + 5 * 86400); ?>(200)' value="<?php echo date('Y-m-d', time() + 5 * 86400); ?>" lay-filter="date"/>
                            </td>
                            <td>
                                <input disabled type="number" name="day_num[]" value="0" placeholder="设置该天任务数" autocomplete="off" class="layui-input" onfocus="$tag = 'do'" onkeyup="Tools.clearNaN(this); allocateTaskToDay(200, $tag)" readonly>
                            </td>
                            <td>
                                <input disabled type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                            </td>
                            <td class="browse_set hide">
                                <input disabled type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel second_visit_time" placeholder="浏览回看时间">
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input disabled type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel subscribeTime" placeholder="预约下单时间">
                            </td>
                        </tr>
                        <tr class="hide">
                            <td>
                                <input  type="checkbox" name="date[]" title='<?php echo date('Y-m-d', time() + 6 * 86400); ?>(200)' value="<?php echo date('Y-m-d', time() + 6 * 86400); ?>" lay-filter="date"/>
                            </td>
                            <td>
                                <input disabled type="number" name="day_num[]" value="0" placeholder="设置该天任务数" autocomplete="off" class="layui-input" onfocus="$tag = 'do'" onkeyup="Tools.clearNaN(this); allocateTaskToDay(200, $tag)" readonly>
                            </td>
                            <td>
                                <input disabled type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                            </td>
                            <td>
                                <input disabled type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                            </td>
                            <td class="browse_set hide">
                                <input disabled type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel second_visit_time" placeholder="浏览回看时间">
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input disabled type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel subscribeTime" placeholder="预约下单时间">
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--时间table END-->
                    <!--关键词table-->
                    <table class="hide" id="keyword_table" style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th id="line_hearder" width="63">
                                关键词
                                <select name="line_day" lay-filter="line_day">
                                    <option value="<?php echo date('Y-m-d', time() + 0 * 86400); ?>">（今天）<?php echo date('Y-m-d', time() + 0 * 86400); ?>剩余200</option>
                                    <option value="<?php echo date('Y-m-d', time() + 1 * 86400); ?>"><?php echo date('Y-m-d', time() + 1 * 86400); ?>剩余200</option>
                                    <option value="<?php echo date('Y-m-d', time() + 2 * 86400); ?>"><?php echo date('Y-m-d', time() + 2 * 86400); ?>剩余200</option>
                                    <option value="<?php echo date('Y-m-d', time() + 3 * 86400); ?>"><?php echo date('Y-m-d', time() + 3 * 86400); ?>剩余200</option>
                                    <option value="<?php echo date('Y-m-d', time() + 4 * 86400); ?>"><?php echo date('Y-m-d', time() + 4 * 86400); ?>剩余200</option>
                                    <option value="<?php echo date('Y-m-d', time() + 5 * 86400); ?>"><?php echo date('Y-m-d', time() + 5 * 86400); ?>剩余200</option>
                                    <option value="<?php echo date('Y-m-d', time() + 6 * 86400); ?>"><?php echo date('Y-m-d', time() + 6 * 86400); ?>剩余200</option>
                                </select>
                            </th>
                            <th width="80">任务数</th>
                            <th width="100">开始时间</th>
                            <th width="100">结束时间<br />(默认当天23:59)</th>
                            <th width="100">超时取消<br />(默认当天23:59)</th>
                            <th width="100" class="browse_set hide">浏览回看时间</th>
                            <th width="100" class="subscribe_set hide">预约下单时间<br />(默认次日09:00-23:59)</th>
                        </tr>
                        </thead>
                        <tbody id="keyword_tbody">
                        <tr>
                            <td>
                                <input readonly type="hidden" name="date[]" class="alone_day" value="2020-08-17" lay-filter="date" disabled/>
                                <span class="copy_keyword"></span>
                            </td>
                            <td>
                                <input readonly type="hidden" name="day_num[]" value="0" class="layui-input" disabled>
                                <span class="copy_keywordNum"></span>
                            </td>
                            <td>
                                <input type="text" name="begin[]" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务" disabled>
                            </td>
                            <td>
                                <input type="text" name="over[]" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务" disabled>
                            </td>
                            <td>
                                <input type="text" name="cancel[]" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务" disabled>
                            </td>
                            <td class="browse_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input type="text" name="second_visit[]" autocomplete="off" class="layui-input subscribe cancel alone_second_visit_time" placeholder="浏览回看时间" disabled>
                            </td>
                            <td class="subscribe_set hide">
                                <!--<input class="layui-input" type="text" name="subscribe[]" id="subscribe" value="09:00:00 ~ 23:59:59" readonly="readonly" />-->
                                <input type="text" name="subscribe[]" autocomplete="off" class="layui-input subscribe cancel alone_subscribeTime" placeholder="预约下单时间" disabled>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!--关键词table END-->
                </div>
            </div>
            <!-- <div class="subscribe_set hide fprw-sdsp">
                <div class="fprw-sdsp_1">
                	<h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-flag">&nbsp;</i>预约任务设置</strong></h4>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                    	<thead>
                    		<tr>
                        		<th width="25%">指定浏览商品之后的操作</th>
                        		<th width="25%">指定下单时候的商品入口</th>
                        		<th width="25%">新的关键词</th>
                        	</tr>
                    	</thead>
                        <tbody>
                        	<tr>
                        		<td>
                        			<select name="browse"  class="layui-input " lay-filter="browse">
									  <option value="3">货比三家，并上传“足迹”截图至平台</option>
									  <option value="2">收藏商品，并收藏五款其他店铺的同类产品，上传“收藏夹”截图</option>
									  <option value="1">加入购物车，并加购四款其他店铺的同类产品，上传“购物车”截图</option>
									</select>
                        		</td>
                        		<td>
                        			<select name="howPay" lay-filter="howPay">
									  <option value="1">从昨日浏览操作入口进入商品</option>
									  <option value="2">以新的关键词搜索</option>
									</select>
                        		</td>
                        		<td>
                        			<input type="text" name="newKeyword" placeholder="指定下单入口选择新关键词时，请填写" class="layui-input">
                        		</td>
                        	</tr>
                    	</tbody>
                    </table>
                </div>
            </div> -->
            <!-- 预定任务设置项 -->
            <div class="presell_set hide fprw-sdsp">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-flag">&nbsp;</i>预售任务设置</strong></h4>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th width="20%">定金（需乘以拍下件数）</th>
                            <th width="20%">尾款开始支付时间</th>
                            <th width="20%">尾款最晚支付时间</th>
                            <th width="40%">说明</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <input
                                    type="number"
                                    step="0.01"
                                    name="handsel"
                                    placeholder="请输入预售商品的定金"
                                    autocomplete="off"
                                    class="layui-input"
                                    oninput="Tools.clearNaN(this,true); priceCalculate()"
                                >
                            </td>
                            <td>
                                <input
                                    type="text"
                                    class="layui-input"
                                    id="b_payment"
                                    name="b_payment"
                                >
                            </td>
                            <td>
                                <input
                                    type="text"
                                    class="layui-input"
                                    id="e_payment"
                                    name="e_payment"
                                >
                            </td>
                            <td class="text-left">
                                <p>
                                    <i class="layui-icon layui-icon-log"></i>
                                    转本金的时间：等买家支付尾款后，连同定金和尾款一起转；
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- 预定任务设置项END -->
            <div class="fprw-sdsp purchase_set" id="express_set">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-form">&nbsp;</i>快递类型</strong></h4>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <tbody>
                        <tr>
                            <th width="100">快递类型</th>
                            <th width="100">说明</th>
                        </tr>
                        <tr>
                            <td>
                                <input type="radio" name="express_type" value="0" lay-filter="express_type" title="自发快递" checked>
                            </td>
                            <td>
                                快递物流信息自理。
                            </td>
                        </tr>
                        <input type="hidden" readonly name="express_cost" value="2.3" />
                        <tr>
                            <td>
                                <input type="radio" name="express_type" lay-filter="express_type" value="1" title="平台发货(2.3元 / 单)">
                            </td>
                            <td>
                                <p class="text-left">
                                    <strong>
                                        1、 平台发的是礼品，是真实寄出的。发货地址是指定的仓库地址（默认的是广州仓库，申通快递）。
                                    </strong>
                                    <a href="/user/ucenter#anchor=shop-manage" target="_blank">设置发货仓库</a>
                                </p>
                                <p class="text-left">
                                    <strong>
                                        2、 为保障安全性，请把仓库地址添加到淘宝后台的地址库（不用设置成默认地址）。
                                    </strong>
                                </p>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!--流量任务基础佣金设置-->
            <div class="fprw-sdsp flow_set hide">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block; width: 60rem;">
                        <strong><i class="layui-icon layui-icon-flag">&nbsp;</i>设置流量单基础佣金</strong>
                        &nbsp;&nbsp;&nbsp;
                        <div id="BasicsSlide"></div>
                        <small>&nbsp;&nbsp;<strong class="text-danger" id="ShowBasicsSlide">1</strong>元 / 单</small>
                        <input type="hidden" name="basics_slide" value="1" />
                    </h4>
                    <small><i class="layui-icon layui-icon-tips"></i> 默认1元/单，您可以拖动滑块，设置较高的佣金，提高用户做任务的积极性</small>
                </div>
            </div>
            <!--增值服务设置-->
            <div class="fprw-sdsp flow_set hide">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;">
                        <strong><i class="layui-icon layui-icon-praise">&nbsp;</i>流量单增值服务</strong><small class="text-danger">（增值服务需要收取附加费，同时要求用户上传相应截图证明）</small>
                    </h4>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th width="20%">增值服务</th>
                            <th width="20%">占比</th>
                            <th width="20%">数量</th>
                            <th width="20%">单价</th>
                            <th width="20%">费用</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="serve" data-type="collect_pro">
                            <td>收藏商品</td>
                            <td>
                                <select name="appreciation[collect_pro]" lay-filter="appreciation">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                            <td class="num">0</td>
                            <td>0.1元 / 个</td>
                            <td class="cost">0</td>
                        </tr>
                        <tr class="serve" data-type="recommend_pro">
                            <td>推荐商品</td>
                            <td>
                                <select name="appreciation[recommend_pro]" lay-filter="appreciation">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                            <td class="num">0</td>
                            <td>0.1元 / 个</td>
                            <td class="cost">0</td>
                        </tr>
                        <tr class="serve" data-type="collect_shop">
                            <td>关注店铺</td>
                            <td>
                                <select name="appreciation[collect_shop]" lay-filter="appreciation">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                            <td class="num">0</td>
                            <td>0.1元 / 个</td>
                            <td class="cost">0</td>
                        </tr>
                        <tr class="serve" data-type="add_cart">
                            <td>加入购物车</td>
                            <td>
                                <select name="appreciation[add_cart]" lay-filter="appreciation">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                            <td class="num">0</td>
                            <td>0.1元 / 个</td>
                            <td class="cost">0</td>
                        </tr>
                        <tr class="serve" data-type="chat">
                            <td>旺旺咨询</td>
                            <td>
                                <select name="appreciation[chat]" lay-filter="appreciation">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                            <td class="num">0</td>
                            <td>0.3元 / 个</td>
                            <td class="cost">0</td>
                        </tr>
                        <tr class="serve" data-type="coupon">
                            <td>领优惠券</td>
                            <td>
                                <select name="appreciation[coupon]" lay-filter="appreciation">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                            <td class="num">0</td>
                            <td>0.1元 / 个</td>
                            <td class="cost">0</td>
                        </tr>
                        <tr class="serve" data-type="ask">
                            <td>淘宝问大家</td>
                            <td>
                                <select name="appreciation[ask]" lay-filter="appreciation">
                                    <option value="0">0%</option>
                                    <option value="10">10%</option>
                                    <option value="20">20%</option>
                                    <option value="30">30%</option>
                                    <option value="40">40%</option>
                                    <option value="50">50%</option>
                                    <option value="60">60%</option>
                                    <option value="70">70%</option>
                                    <option value="80">80%</option>
                                    <option value="90">90%</option>
                                    <option value="100">100%</option>
                                </select>
                            </td>
                            <td class="num">0</td>
                            <td>0.5元 / 个</td>
                            <td class="cost">0</td>
                        </tr>
                        <tr class="_ask hide">
                            <td colspan="5">问大家提问内容设置（<a href="javascript:;" onclick="addQuestion(this)">增加</a>）</td>
                        </tr>
                        <tr class="_q _ask hide">
                            <td colspan="1">提问（<a href="javascript:;" onclick="delQuestion(this)">删除</a>）</td>
                            <td colspan="4"><input type="text" name="quiz[]" placeholder="请输入问大家提问内容，4-40字" autocomplete="off" class="layui-input" maxlength="40" onchange="inputQuestion(this)"></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-left total" colspan="5">
                                <label class="layui-form-label float-right">总增值费用：<strong id="appreciation_cost" class="text-danger">0</strong>元</label>
                            </th>
                        </tr>
                        </tfoot>
                        <!--<tfoot>
                            <tr>
                                <td class="text-left" colspan="5">
                                    <div id="set_top" class="layui-form-item">
                                        <label class="layui-form-label">置顶费</label>
                                        <div class="layui-input-inline">
                                          <input type="text" name="top" value="0" placeholder="每单扣除" autocomplete="off" class="layui-input" onkeyup="Tools.clearNaN(this); inputTop();">
                                        </div>
                                        <div class="layui-form-mid layui-word-aux">元/单，置顶费用越高，任务越快被派出，共设置<span id="total_top">0</span>元置顶费</div>
                                        <label class="layui-form-label float-right">总增值费用：<strong id="appreciation_cost" class="text-danger">0</strong>元</label>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>-->
                    </table>
                </div>
            </div>
            <!--附加选项设置-->
            <div class="fprw-sdsp purchase_set">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-form">&nbsp;</i>附加选项</strong><small>（可选项，如果没有需要，可以不勾选）</small></h4>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <tbody>
                        <ul class="layui-timeline subjoin">
                            <!--关联流量任务-->
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe6b1;</i>
                                <div class="layui-timeline-content layui-text layui-form" lay-filter="relevance_flow_form">
                                    <h5 class="layui-timeline-title">
                                        关联流量任务
                                        <p class="hide">
                                            <small>&nbsp;&nbsp;关联标志（对保留任务不生效）</small>
                                            <input type="radio" name="relevance_flow_tag" value="0" lay-filter="relevance_flow_tag" title="商品" lay-skin="primary" checked>
                                            <input type="radio" name="relevance_flow_tag" value="1" lay-filter="relevance_flow_tag" title="店铺" lay-skin="primary">
                                            <input type="radio" name="relevance_flow_tag" value="2" lay-filter="relevance_flow_tag" title="账号" lay-skin="primary">
                                        </p>
                                    </h5>
                                    <div>
                                        <br>
                                        <p><small class="text-danger" id="relevance_flow_user"></small></p>
                                        <p>
                                            <input type="checkbox" name="relevance_flow" value="2" lay-filter="relevance_flow" title="优先派给做过我家流量任务的用户" lay-skin="primary">
                                        </p>
                                        <p class="_tips" data-tipmsg="不建议，有可能任务会放不出去">
                                            <input type="checkbox" name="relevance_flow" value="3" lay-filter="relevance_flow" title="仅派给做过我家流量任务的用户" lay-skin="primary">
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <!--强提醒-->
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe667;</i>
                                <div class="layui-timeline-content layui-text layui-form" lay-filter="relevance_flow_form">
                                    <h5 class="layui-timeline-title">
                                        强提醒&nbsp;&nbsp;<small>（在任务过程中，以弹幕的形式全程强提醒用户）</small>
                                    </h5>
                                    <div>
                                        <br>
                                        <p class="remind_chat">
                                            <input type="checkbox" name="top_remind[chat]" value="1" title="拍前聊天" lay-skin="primary">
                                        </p>
                                        <p class="remind_collect">
                                            <input type="checkbox" name="top_remind[collect]" value="1" title="收藏商品" lay-skin="primary">
                                        </p>
                                        <p class="remind_cart">
                                            <input type="checkbox" name="top_remind[cart]" value="1" title="加入购物车" lay-skin="primary">
                                        </p>
                                        <p class="remind_coupon">
                                            <input type="checkbox" name="top_remind[coupon]" value="1" title="领取优惠券" lay-skin="primary">
                                        </p>
                                        <p class="remind_like_pro">
                                            <input type="checkbox" name="top_remind[like_pro]" value="1" title="推荐商品" lay-skin="primary">
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <!-- 核销码 / 电子凭证 -->
                            <!-- 确认订单 -->
                            <!-- 退款单 -->
                            <!-- 不需要截图 -->
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe64a;</i>
                                <div class="layui-timeline-content layui-text layui-form" lay-filter="relevance_flow_form">
                                    <h5 class="layui-timeline-title">
                                        任务过程不截图
                                    </h5>
                                    <div>
                                        <br>
                                        <p>
                                            <input
                                                type="checkbox"
                                                name="no_img"
                                                value="1" lay-filter="relevance_flow"
                                                title="任务过程不要求买家在淘宝截图，同时买家提交任务时无需上传截图"
                                                lay-skin="primary"
                                            />
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <!-- 确认订单 -->
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe6b2;</i>
                                <div class="layui-timeline-content layui-text layui-form" lay-filter="relevance_flow_form">
                                    <h5 class="layui-timeline-title">
                                        任务确认前提醒
                                    </h5>
                                    <div style="padding-right: 1%;">
                                        <br>
                                        <textarea
                                            name="require"
                                            placeholder="您可以设置您的接单要求，系统会在用户开始任务的时候，弹出提示框，让用户判断自己是否符合要求，选择继续任务或取消任务。为保障提醒的有效性，字数限制在20个字以内"
                                            class="layui-textarea"
                                            cols="1"
                                            maxlength="20"
                                            style="width: 46em;"
                                        />
                                    </div>
                                </div>
                            </li>
                        </ul>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="fprw-sdsp">
                <div class="fprw-sdsp_1">
                    <h4 style="display: inline-block;"><strong><i class="layui-icon layui-icon-edit">&nbsp;</i>任务备注</strong></h4>
                </div>
                <div class="fprw-sdsp_2">
                    <table style="table-layout: fixed;">
                        <tbody>
                        <tr>
                            <td class="text-left" colspan="10">
                                <textarea name="remark" placeholder="请输入备注内容。备注内容会在用户在接到任务后第一时间看到哦，诸如货比、拍前聊天等关键字眼，我们会以红色加粗字体显示，并在用户做任务的每一步骤给予展示哦~" class="layui-textarea"></textarea>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br />
            <p>
                任务总数：<span id="total_task">0</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                总费用 (基础总费用+增值总费用)： <span id="total_cost">0</span>元<span class="sales_set text-danger">（+<span id="vie_commission">0</span>元货比词佣金）</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                平台发货费用 ： <span id="express_cost">0</span>元</p>
            <input class="_replace"/>
            <div class="btn-box">
                <button class="ayui-btn layui-btn-radius layui-btn-primary type-btn" onclick="cutStep(-1, $(this))">上一步</button>
                <button class="ayui-btn layui-btn-radius layui-btn-primary sure-btn type-btn" onclick="issue(0)">确认发布</button>
            </div>
        </div>
        <!--设置任务信息END-->
        <!--其它搜索条件，外层嵌套一个div，防止重复clone导致网页卡住-->
        <div id="other-box">
            <div class="padding-2 other" style="display: none;">
                <br />
                <div class="layui-form-item">
                    <label class="layui-form-label">排序方式</label>
                    <div class="layui-input-inline">
                        <select name="orderby[]" lay-verify="required">
                            <option value="1">综合</option>
                            <option value="2">新品</option>
                            <option value="3">人气</option>
                            <option value="4">销量</option>
                            <option value="5">价格从低到高</option>
                            <option value="6">价格从高到低</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">价格区间</label>
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" name="price_min[]" placeholder="￥" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" name="price_max[]" placeholder="￥" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">&nbsp;&nbsp;&nbsp;&nbsp;发货地</label>
                    <div class="layui-input-inline">
                        <input type="text" name="sendaddress[]" placeholder="请输入要求筛选的发货地" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;其它</label>
                    <div class="layui-input-inline">
                        <input type="text" name="other[]" placeholder="" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item otherSet">
                    <button class="layui-btn layui-btn-radius layui-btn-fluid" onclick="layer.close(_otherSet)">确认</button>
                </div>
            </div>
        </div>
    </form>
    <div data-step = "3" class="step hide">
        <div class="padding-2">
            <div class="container_ok">
                <div class="item" id="pink">
                    <div class="chewing">
                        <div class="eye left"><span></span></div>
                        <div class="eye right"><span></span></div>
                        <div class="mounth"></div>
                        <div class="arm left"></div>
                        <div class="arm right"></div>
                    </div>
                    <div class="shadow"></div>
                </div>

                <div class="item" id="orange">
                    <div class="chewing">
                        <div class="eye left"><span></span></div>
                        <div class="eye right"><span></span></div>
                        <div class="mounth"></div>
                        <div class="arm left"></div>
                        <div class="arm right"></div>
                    </div>
                    <div class="shadow"></div>
                </div>

                <div class="item" id="blue">
                    <div class="chewing">
                        <div class="eye left"><span></span></div>
                        <div class="eye right"><span></span></div>
                        <div class="mounth"></div>
                        <div class="arm left"></div>
                        <div class="arm right"></div>
                    </div>
                    <div class="shadow"></div>
                </div>
            </div>
            <div style="position: relative; top: 14em;">
                <h4 class="text-center">恭喜您，发布任务成功！</h4>
                <div class="btn-box">
                    <button class="ayui-btn layui-btn-radius layui-btn-primary type-btn" onclick="location.reload()">继续发布</button>
                    <button class="ayui-btn layui-btn-radius layui-btn-primary type-btn" onclick="$('li[lay-id=wait]').click()">未接任务</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sales" style="display: none;">
    <option value="1">淘宝APP自然搜索</option>
    <option class="purchase_set" value="2">淘宝PC自然搜索</option>
    <option value="3">淘宝APP淘口令</option>
    <option value="4">淘宝APP直通车</option>
    <option class="purchase_set" value="5">淘宝PC直通车</option>
    <option value="6">淘宝APP二维码</option>
    <option class="purchase_set" value="8">拍立淘</option>
    <option value="9">聚划算</option>
</div>

<div id="multilink_entrance" style="display: none;">
    <option value="1">淘宝APP自然搜索</option>
    <option class="purchase_set" value="2">淘宝PC自然搜索</option>
    <option value="3">淘宝APP淘口令</option>
    <option value="4">淘宝APP直通车</option>
    <option class="purchase_set" value="5">淘宝PC直通车</option>
    <option value="6">淘宝APP二维码</option>
    <option class="purchase_set" value="8">拍立淘</option>
</div>

<div id="common_entrance" style="display: none;">
    <option value="1">淘宝APP自然搜索</option>
    <option class="purchase_set" value="2">淘宝PC自然搜索</option>
    <option value="3">淘宝APP淘口令</option>
    <option value="4">淘宝APP直通车</option>
    <option class="purchase_set" value="5">淘宝PC直通车</option>
    <option value="6">淘宝APP二维码</option>
    <option class="purchase_set" value="8">拍立淘</option>
</div>

<!--猜你喜欢入口-->
<div class="hide" id="like">
    <option class="like_set" value="7">淘宝APP猜你喜欢</option>
</div>

<!--标签任务入口-->
<div class="hide" id="tagPortal">
    <option value="1">淘宝APP自然搜索</option>
    <option value="4">淘宝APP直通车</option>
</div>

<!--微淘任务入口-->
<div class="hide" id="microPortal">
    <option value="1">淘宝APP自然搜索</option>
    <option value="3">淘宝APP淘口令</option>
    <option value="4">淘宝APP直通车</option>
    <option value="6">淘宝APP二维码</option>
    <option class="purchase_set" value="8">拍立淘</option>
</div>

<!-- 提前购流量入口 -->
<div class="hide" id="advancePortal">
    <option value="1">淘宝APP自然搜索</option>
</div>

<!-- 新零售流量入口 -->
<div class="hide" id="new_retail_portal">
    <option value="6">淘宝APP二维码</option>
</div>

<div id="oneKeySetTime" style="display: none;">
    <div class="fprw-sdsp padding-2">
        <div class="fprw-sdsp_2">
            <table style="table-layout: fixed;">
                <thead>
                <tr>
                    <th width="100">开始时间</th>
                    <th width="100">结束时间<br />(默认23:59)</th>
                    <th width="100">超时取消<br />(默认23:59)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <input type="text" name="_begin" autocomplete="off" class="layui-input time begin" placeholder="何时开始平均派发任务">
                    </td>
                    <td>
                        <input type="text" name="_over" autocomplete="off" class="layui-input time over" placeholder="何时结束平均派发任务">
                    </td>
                    <td>
                        <input type="text" name="_cancel" autocomplete="off" class="layui-input time cancel" placeholder="何时取消未接任务">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="btn-box">
            <button class="ayui-btn layui-btn-radius layui-btn-primary type-btn" onclick="affirmSet()">确认</button>
            <button class="ayui-btn layui-btn-radius layui-btn-primary type-btn" onclick="layer.closeAll();">退出</button>
        </div>
    </div>
</div>
<script src="/js/common/jquery.form.js?v=<?php echo \app\utils\Utils::version(); ?>"></script>
<script src="/js/task/release.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
<script src="/js/task/tagsinput_min.js?v=<?php echo \app\utils\Utils::version(); ?>" type="text/javascript"></script>
<script type="text/javascript">
    $(function(){
        var text_form = $('#release-form');
        if (typeof(text_form.ajaxSubmit) == 'undefined')
            $.getScript("/js/common/jquery.form.js?v=<?php echo \app\utils\Utils::version(); ?>");

    });
    var subscribe_set = $('.subscribe_set'),
        flow_set = $('.flow_set'),
        sales_set = $('.sales_set'),
        purchase_set = $('.purchase_set');
    flow_set.addClass("hide");
    /*
 * 佣金明细
 */
    function getPricePoint(price, $tag)
    {
        $tag = $tag || $('input[name=tasktype]:checked').val();
        var priceinfo = '50=11|100=14|200=15|500=16|1000=20|1500 =22|2000=24|2500 =26|3000 =30|3500=33|4500=35';
        switch ($tag)
        {
            case '1':
                priceinfo = '50=11|100=14|200=15|500=16|1000=20|1500 =22|2000=24|2500 =26|3000 =30|3500=33|4500=35';
                break;
            case '4':
            case '5':
                priceinfo = '50=12|100=15|200=17|500=18|1000=22|1500 =26|2000=28|2500=30|3000=30|3500=34|4500=37';
                break;
            case '7':
                priceinfo = '50=12|100=15|200=17|500=18|1000=22|1500 =26|2000=28|2500=30|3000=30|3500=34';
                break;
            case '8':
                priceinfo = '50=11|100=14|200=15|500=16|1000=20|1500 =22|2000=24|2500 =26|3000 =30|3500=33';
                break;
            case '10':
                priceinfo = '50=14|100=16|200=18|500=20|1000=23|1500 =26|2000=29|2500 =32|3000 =34|3500=34|4500=37';
                break;
            case '11':
                priceinfo = '50=12|100=15|200=17|500=18|1000=22|1500 =26|2000=28|2500=30|3000=30|3500=34|4500=37';
                break;
            case '12':
                priceinfo = '50=13|100=16|200=18|500=19|1000=23|1500 =27|2000=29|2500=31|3000=31|3500=35|4500=38';
                break;
            case '13':
                priceinfo = '50=11|100=14|200=15|500=16|1000=20|1500=22|2000=24|2500=26|3000=30|3500=33';
                break;
            case '15':
                priceinfo = '50=12|100=15|200=17|500=18|1000=22|1500 =26|2000=28|2500=30|3000=30|3500=34|4500=37';
                break;
            case '16':
                priceinfo = '50=11|100=14|200=15|500=16|1000=20|1500 =22|2000=24|2500 =26|3000 =30|3500=33|4500=35';
                break;
            case 'flow':
                Grads = $("input[name=basics_slide]").val();
                return Grads * price;
                break;
        }
        var gard = priceinfo.split("|"),
            temporary = [],
            start = 0,
            _commission = 0;
        gard.forEach(function(val, key){
            temporary = val.trim().split("=");
            if (key != 0)
            {
                var last = gard[key - 1].trim().split("=");
                start = last[0];
            }
            else
                start = 0;
            if (parseInt(start) <= price && price < parseInt(temporary[0]))
            {
                _commission = temporary[1];
                return false;
            }
        })
        return _commission;
    }

    /**
     * @description 增值服务费用计算
     */
    function valueAddedServices($type)
    {
        var grads = 'collect_pro=0.1|collect_shop=0.1|add_cart=0.1|chat=0.3|coupon=0.1|ask=0.5|recommend_pro=0.1',
            grads_arr = grads.split('|'),
            temp = new Array(),
            target = new Array();
        for (i in grads_arr)
        {
            temp = grads_arr[i].split('=');
            target[temp[0]] = temp[1];
        }
        return target[$type];
    }

    //设置流量任务的最低基础佣金
    Grads = 1;
    FlowBasicsSlide_Max = 6;
</script>
