<div id="list">
    <table class="layui-table">
        <colgroup>
            <col width="10%">
            <col width="21%">
            <col width="18%">
            <col width="15%">
            <col width="20%">
            <col width="13%">
        </colgroup>
        <thead>
        <tr class="col_name">
            <th>任务分类</th>
            <th>任务 / 订单编号</th>
            <th>买号 / 商品信息</th>
            <th>商品价格</th>
            <th>任务信息</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="text-left">
        <?php  if(!empty($list)) { foreach ($list as $k => $val) { ?>
            <tr id="t_<?php echo $val['id']; ?>">
                <td class="text-center">
                    <h5 class="text-primary"><?php echo \app\utils\ProductReleaseUtils::taskType($val['task_type']); ?></h5>
                    <span class="layui-badge layui-bg-black">
                        <?php echo \app\utils\ProductReleaseUtils::flowType($val['flow_type']); ?>
                    </span>
                </td>
                <td>
                    <p>任务编号：<?php echo $val['task_no']; ?></p>
<!--                    <p>订单编号：</p>-->
                    <span class="layui-badge layui-bg-orange">
                        <?php echo $val['deliver_fee'] > 0 ? '平台发货' : '自理快递'; ?>
                    </span>
                    <hr />
                    <?php if($val['chat_before_buy'] == 1) { ?>
                        <span class="layui-badge layui-bg-black"><i class="layui-icon layui-icon-notice"></i>&nbsp;拍前聊天</span>
                    <?php } ?>

                    <?php if($val['collection'] == 1) { ?>
                        <span class="layui-badge layui-bg-black"><i class="layui-icon layui-icon-notice"></i>&nbsp;收藏商品</span>
                    <?php } ?>

                    <?php if($val['add_to_cart'] == 1) { ?>
                        <span class="layui-badge layui-bg-black"><i class="layui-icon layui-icon-notice"></i>&nbsp;加入购物车</span>
                    <?php } ?>


                    <?php if($val['get_coupons'] == 1) { ?>
                        <span class="layui-badge layui-bg-black"><i class="layui-icon layui-icon-notice"></i>&nbsp;领取优惠券</span>
                    <?php } ?>

                    <?php if($val['recommon_product'] == 1) { ?>
                        <span class="layui-badge layui-bg-black"><i class="layui-icon layui-icon-notice"></i>&nbsp;推荐商品</span>
                    <?php } ?>

                    <?php if(!empty($val['task_waring'])) { ?>
                    <span class="layui-badge layui-bg-black _tips" data-tipmsg="<?php echo $val['task_waring']; ?>">
                        <i class="layui-icon layui-icon-survey"></i>&nbsp;任务确认前提醒
                    </span>
                    <?php } ?>
                </td>
                <td>
<!--                    <p>旺旺号：</p>-->
                    <p>商品简称：<?php echo $val['product_shortname']; ?></p>
<!--                    <p>商品标题：--><?php //echo $val['product_title']; ?><!--</p>-->
                    <p>店铺：<?php echo $val['shop_name']; ?></p>
                    <p>关键词：<?php echo $val['target_keyword']; ?></p>
                    <p>货比词：<?php echo $val['vie_keyword1']; ?> <?php echo $val['vie_keyword2']; ?> <?php echo $val['vie_keyword3']; ?></p>
                </td>
                <td>
                    <?php if($val['task_type'] == 6) { ?>
                    <a href="javascript:;" onclick="checkDetails(<?php echo $val['id']; ?>)">查看主副宝贝设置</a>
                    <?php } ?>
                    <p>邮费：<?php echo $val['deliver_price']; ?>元 / 单</p>
                    <p>佣金：<?php echo $val['commission']; ?>元 / 单</p>
                    <!--<p>置顶费：元/单</p>-->
                </td>
                <td>
                    <h5 class="text-center text-primary t_state">
                        <span class="layui-badge layui-bg-cyan">
                            <?php
                                if($val['state'] == 3) {
                                    echo '待接任务';
                                } elseif ($val['state'] == 6) {
                                    echo '已接任务';
                                } elseif ($val['state'] == 9) {
                                    echo '已完成';
                                } elseif ($val['state'] == 12) {
                                    echo '已取消';
                                } elseif ($val['state'] == 15) {

                                }
                            ?>
                        </span>
                    </h5>
                    <p>发布时间：<?php echo $val['create_time']; ?></p>
                    <p>接手时间：<?php echo $val['receive_time']; ?></p>
                </td>
                <td class="handle_box">
<!--                    <button class="layui-btn layui-btn-radius layui-btn-fluid issueEv-btn" onclick="issueEvaluate(<?php //echo $val['id']; ?>, '<?php //echo $val['task_no']; ?>')">发布评价任务</button><br>-->
<!--                    <button class="layui-btn layui-btn-radius layui-btn-fluid layui-btn-normal" onclick="viewImg('<?php //echo $val['task_no']; ?>', 4)">查看截图</button><br>-->
<!--                    <button class="layui-btn layui-btn-radius layui-btn-fluid layui-btn-danger work-btn layui-btn-disabled" >已创建工单</button><br>-->
                    <p class="text-center"><a href="javascript:;" onclick="checkDetails(<?php echo $val['id']; ?>)">查看任务详情</a></p>
                </td>
            </tr>
        <?php }} ?>
        </tbody>
    </table>
</div>
<audio id="monitoring" src="/monitoring.mp3" loop="loop"></audio>
<div id="page"></div>
<script type="text/javascript">
    Tools.page(<?php echo $total; ?>, <?php echo $page; ?>, function(obj){
        var $args = $has_search == true ? '&' + $('#receivedList').serialize() : '';
        Tools._load('task_lists', '/task/received?page=' + obj.curr + $args);
    });
    layui.use('form', function(){
        var form = layui.form;
        form.render();
    });

    // $(() => {
    //     monitoring_timer = setInterval(() => {
    //         var monitoring_switch = $("input[name=monitoring]").is(':checked');
    //         if (monitoring_switch == true)
    //         {
    //             Tools.ajax("/task/monitoring", {}, (data) => {
    //                     // 有新订单,响铃且弹窗提醒
    //                     if (data.datas > 0)
    //                     {
    //                         monitoring_open = layer.open({
    //                             type: 1,
    //                             title: false,
    //                             closeBtn: false,
    //                             area: '300px',
    //                             shade: 0.8,
    //                             id: 'monitoring_open',
    //                             resize: false,
    //                             content: '<div style="padding: 50px; line-height: 22px; background-color: #393D49; color: #fff; font-weight: 300; text-align: center">' + data.message + '</div>',
    //                             btn: '查看新订单',
    //                             btnAlign: 'c',
    //                             yes: () => {
    //                                 layer.close(monitoring_open);
    //                                 Tools._load('task_lists', '/task/received?page=1');
    //                             }
    //                         });
    //                         $('#monitoring')[0].play();
    //                         clearInterval(monitoring_timer);
    //                     }
    //                 },
    //                 false, null, null, null, true
    //             );
    //         }
    //     }, 10000);
    // })

</script>
