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
                    <p>接手情况：0 / <?php echo $val['task_quantity']; ?></p>
                    <p>发布时间：<?php echo $val['create_time']; ?></p>
                    <?php if($val['release_type'] == 2) { ?>
                        <p>开始平均发布时间：<?php echo $val['start_time']; ?></p>
                        <p>结束平均发布时间：<?php echo $val['end_time']; ?></p>
                    <?php } else {  ?>
                        <p>有效期:<?php echo $val['start_time']; ?> 至 <?php echo $val['end_time']; ?></p>
                    <?php } ?>
                    <p>失效时间：<?php echo $val['timeout_time']; ?></p>
                    <p>任务编号：<?php echo $val['task_no']; ?></p>
                    <p>失效原因：<?php echo $val['cancel_remark']; ?></p>
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
                    <p>佣金：<?php echo $val['commission']; ?>元 / 单</p>
                </td>
                <td class="handle_box">
                    <button class="layui-btn layui-btn-radius layui-btn-fluid" onclick="checkDetails(<?php echo $val['id']; ?>)">查看详情</button><br>
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
        Tools._load('task_lists', '/task/failure?page=' + obj.curr + $args);
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
