<div class="page-content">
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <form autocomplete="off" method="get" action="">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <select name="task_type">
                                        <option value="">任务类型</option>
                                        <option <?php echo $task_type == 1 ? 'selected' : ''; ?> value="1">销量任务</option>
                                        <option <?php echo $task_type == 10 ? 'selected' : ''; ?> value="10">标签任务</option>
                                        <option <?php echo $task_type == 5 ? 'selected' : ''; ?> value="5">预约任务</option>
                                        <option <?php echo $task_type == 13 ? 'selected' : ''; ?> value="13">提前购</option>
                                        <option <?php echo $task_type == 16 ? 'selected' : ''; ?> value="16">AB单</option>
                                        <option <?php echo $task_type == 8 ? 'selected' : ''; ?> value="8">多链接任务</option>
                                        <option <?php echo $task_type == 7 ? 'selected' : ''; ?> value="7">猜你喜欢</option>
                                        <option <?php echo $task_type == 11 ? 'selected' : ''; ?> value="11">微淘/直播任务</option>
                                    </select>

                                    <select name="state">
                                        <option value="">任务状态</option>
                                        <option <?php echo $state == 3 ? 'selected' : ''; ?> value="3">待接任务</option>
                                        <option <?php echo $state == 6 ? 'selected' : ''; ?> value="6">已接任务</option>
                                        <option <?php echo $state == 9 ? 'selected' : ''; ?> value="9">已完成任务</option>
                                        <option <?php echo $state == 12 ? 'selected' : ''; ?> value="12">取消任务</option>
                                    </select>

                                    <select name="is_hide">
                                        <option value="">隐藏任务</option>
                                        <option <?php echo $is_hide == 1 ? 'selected' : ''; ?> value="3">否</option>
                                        <option <?php echo $is_hide == 2 ? 'selected' : ''; ?> value="2">是</option>
                                    </select>

                                    <input name="task_no" value="<?php echo $task_no; ?>"  class="input-sm" type="text"  placeholder="任务编号">
                                    <input name="keyword" value="<?php echo $keyword; ?>"  class="input-sm" type="text"  placeholder="产品标题/产品ID">

                                    <input readonly="readonly" class="date-picker input-sm" onclick="WdatePicker()" value="<?php echo $start; ?>" name="start" placeholder="创建开始时间" type="text" data-date-format="yyyy-mm-dd">
                                    -
                                    <input readonly="readonly" class="date-picker input-sm" onclick="WdatePicker()"  value="<?php echo $end; ?>" name="end" placeholder="创建结束时间" type="text" data-date-format="yyyy-mm-dd">
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <span class="ace-icon fa fa-search icon-on-right bigger-100"></span>
                                        搜索
                                    </button>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </form>
                    <table id="simple-table" class="table  table-bordered table-hover">
                        <thead>
                        <tr>
                            <th width="5%">发布用户</th>
                            <th width="10%">任务类型</th>
                            <th width="20%">任务详情</th>
                            <th width="30%">商品信息</th>
                            <th width="5%">任务状态</th>
                            <th>价格信息</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <?php if(!empty($list)) { ?>
                            <tbody>
                            <?php foreach ($list as $val) { ?>
                                <tr class="">
                                    <td>
                                        ID:<?php echo $val['id']; ?>
                                        <br />
                                        <br />
                                        <?php echo $val['mobile']; ?>
                                    </td>
                                    <td>
                                        <span class="label label-info">
                                        <?php echo \app\utils\ProductReleaseUtils::taskType($val['task_type']); ?>
                                        </span>
                                        <br />
                                        <br />
                                        <span class="label label-success">
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
                                        <span class="label label-warning">
                                            <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                            <?php echo $val['deliver_fee'] > 0 ? '平台发货' : '自理快递'; ?>
                                        </span>
                                        <hr />
                                        <?php if($val['chat_before_buy'] == 1) { ?>
                                            <span class="label label-warning" style="margin-top: 2px; margin-bottom: 2px">
                                            <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                            拍前聊天
                                            </span>
                                        <?php } ?>

                                        <?php if($val['collection'] == 1) { ?>
                                            <span class="label label-warning" style="margin-top: 2px; margin-bottom: 2px">
                                            <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                            收藏商品
                                            </span>
                                        <?php } ?>

                                        <?php if($val['add_to_cart'] == 1) { ?>
                                            <span class="label label-warning" style="margin-top: 2px; margin-bottom: 2px">
                                            <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                            加入购物车
                                            </span>
                                        <?php } ?>

                                        <?php if($val['get_coupons'] == 1) { ?>
                                            <span class="label label-warning" style="margin-top: 2px; margin-bottom: 2px">
                                            <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                            领取优惠券
                                            </span>
                                        <?php } ?>

                                        <?php if($val['recommon_product'] == 1) { ?>
                                            <span class="label label-warning" style="margin-top: 2px; margin-bottom: 2px">
                                            <i class="ace-icon fa fa-exclamation-triangle bigger-120"></i>
                                            推荐商品
                                            </span>
                                        <?php } ?>

                                        <?php if(!empty($val['task_waring'])) { ?>
                                            <div class="well well-sm" style="margin-top: 10px;"> 任务确认前提醒:<?php echo $val['task_waring']; ?> </div>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <p>标题:<?php echo $val['product_title'] ?></p>
                                        <p>店铺:<?php echo $val['shop_name'] ?></p>
                                        <p>关键词:<?php echo $val['target_keyword']; ?></p>
                                        <p>货比词:<?php echo $val['vie_keyword1']; ?> <?php echo $val['vie_keyword2']; ?> <?php echo $val['vie_keyword3']; ?></p>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-white btn-success">
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
                                            <?php if($val['is_hide'] == 2) { ?>
                                                <span class="label label-danger arrowed-in">隐</span>
                                            <?php } ?>
                                        </button>
                                        <?php if($val['state'] == 12) { ?>
                                        <div class="well well-sm" style="margin-top: 10px;">
                                            <?php echo $val['cancel_remark']; ?>
                                        </div>
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <p>佣金：<?php echo $val['commission']; ?>元 / 单</p>
                                        <p>拍下件数：<?php echo $val['buy_quantity']; ?>元 / 单</p>
                                        <p>商品单价：<?php echo $val['price']; ?>元 / 单</p>
                                        <p>邮费：<?php echo $val['deliver_price']; ?>元 / 单</p>
                                        <p>成交金额：<?php echo $val['price'] *  $val['buy_quantity'] + $val['deliver_price']; ?>/单</p>
                                        <p>任务数量:<?php echo $val['task_quantity']; ?></p>
                                    </td>

                                    <td>
                                        <p>
                                            <a href="javascript:;" data-href="/admin/task/detail?id=<?php echo $val['id']; ?>" class="btn btn-white btn-success product-detail">任务详情</a>
                                        </p>

                                        <?php if($val['state'] == 3 && $val['is_hide'] == 1) { ?>
                                            <p>
                                                <a href="javascript:;" data-title="确认接单?" data-href="/admin/task/recived?id=<?php echo $val['id']; ?>" class="btn btn-white btn-warning data-delete">接手任务</a>
                                            </p>

                                            <?php if($val['state'] == 3) { ?>
                                                <p>
                                                    <a href="javascript:;" data-title="确认取消任务?" data-href="/admin/task/cancel?id=<?php echo $val['id']; ?>" class="btn btn-white btn-warning data-delete">取消任务</a>
                                                </p>
                                            <?php } ?>

                                        <?php } ?>

                                        <?php if($val['state'] == 6) { ?>
                                            <p>
                                                <a href="javascript:;" data-title="确认已完成任务?" data-href="/admin/task/finished?id=<?php echo $val['id']; ?>" class="btn btn-white btn-warning data-delete">标记完成</a>
                                            </p>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        <?php } ?>
                    </table>
                    <?php echo $page; ?>
                </div>
            </div>
            <div class="hr hr-18 dotted hr-double"></div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('.product-detail').click(function(){
            layer.open({
                title: '任务详情',
                type: 2,
                shadeClose: true,
                maxmin: true,
                shade: 0.8,
                area: ['900px', '900px'],
                content: $(this).attr('data-href')
            });
        });
    })
</script>