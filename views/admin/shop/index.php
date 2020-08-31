<div class="page-content">
    <div class="page-header">
        <h1>
            店铺管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                店铺列表
            </small>
        </h1>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <form autocomplete="off" method="get" action="">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>
                                    <input name="keyword" value="<?php echo $keyword; ?>"  class="input-sm" type="text"  placeholder="用户手机号">
                                    <select name="state" style="width: 10%;">
                                        <option value="">用户状态</option>
                                        <option <?php if($state == 1) { echo "selected";} ?> value="1">启用</option>
                                        <option <?php if($state == 2) { echo "selected";} ?> value="2">禁用</option>
                                    </select>
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
                            <th class="center">ID</th>
                            <th>注册用户手机号</th>
                            <th>店铺类型</th>
                            <th>掌柜号</th>
                            <th>店铺名称</th>
                            <th>所属类目</th>
                            <th>店铺性质</th>
                            <th>寄件人姓名</th>
                            <th>寄件人电话</th>
                            <th>生意参谋截图</th>
                            <th>加群二维码</th>
                            <th>加群密码</th>
                            <th>状态</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <?php if(!empty($list)) { ?>
                            <tbody>
                            <?php foreach ($list as $vo) { ?>
                                <tr class="">
                                    <td class="center"><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['mobile']; ?></td>
                                    <td>
                                        <?php
                                            if($vo['shop_type'] == 3) {
                                                echo "阿里巴巴";
                                            } elseif ($vo['shop_type'] == 2) {
                                                echo  '天猫';
                                            } else {
                                                echo  '淘宝';
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $vo['manager']; ?></td>
                                    <td><?php echo $vo['shop_name']; ?></td>
                                    <td><?php echo $vo['shop_cate']; ?></td>
                                    <td>
                                        <?php echo $vo['shop_nature'] == 1 ? '公司' : '个人'; ?>
                                    </td>
                                    <td><?php echo $vo['sender_name']; ?></td>
                                    <td><?php echo $vo['send_phone']; ?></td>
                                    <td>
                                        <?php if(!empty($vo['business_consultan'])) { ?>
                                            <a href="<?php echo $vo['business_consultan']; ?>" target="_blank">
                                                <img src="<?php echo \app\utils\Utils::fullImageUrl($vo['business_consultan']); ?>" width="120" height="120">
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if(!empty($vo['qrcode'])) { ?>
                                        <a href="<?php echo $vo['qrcode']; ?>" target="_blank">
                                            <img src="<?php echo \app\utils\Utils::fullImageUrl($vo['qrcode']); ?>" width="120" height="120">
                                        </a>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $vo['password']; ?></td>
                                    <td>
                                        <?php if ($vo['state'] == 1) { ?>
                                            <span class="label label-sm label-success">待审核</span>
                                        <?php } elseif($vo['state'] == 2) { ?>
                                            <span class="label label-sm label-info">已审核</span>
                                        <?php } elseif($vo['state'] == 3) { ?>
                                            <span class="label label-sm label-warning">审核不过</span>
                                        <?php } else { ?>
                                            <span class="label label-sm label-danger">已删除</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $vo['create_time']; ?></td>
                                    <td>
                                        <?php if($vo['state'] == 1) { ?>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="green data-delete" href="javascript:;" data-title="确认审核通过?" data-href="/admin/shop/audit?id=<?php echo $vo['id']; ?>&state=2" title="编辑">
                                                    审核通过
                                                </a>
                                            </div>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="warning data-delete" href="javascript:;" data-title="确认审核驳回?" data-href="/admin/shop/audit?id=<?php echo $vo['id']; ?>&state=3" title="编辑">
                                                    审核驳回
                                                </a>
                                            </div>
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