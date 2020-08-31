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
                                    <input name="keyword" value="<?php echo $keyword; ?>"  class="input-sm" type="text"  placeholder="产品标题/产品ID">
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
                            <th>店铺名称</th>
                            <th>产品链接 / 产品ID</th>
                            <th>产品标题</th>
                            <th>产品首图</th>
                            <th>产品简称</th>
                            <th>产品重量</th>
                            <th>APP主图</th>
                            <th>二维码</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <?php if(!empty($list)) { ?>
                            <tbody>
                            <?php foreach ($list as $vo) { ?>
                                <tr class="">
                                    <td class="center"><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['mobile']; ?></td>
                                    <td><?php echo $vo['shop_name']; ?></td>
                                    <td>
                                        <a href="<?php echo $vo['product_link']; ?>" target="_blank"><?php echo $vo['product_link']; ?></a>
                                        <br>
                                        <br>
                                        <br>
                                        <?php echo $vo['product_id']; ?>
                                    </td>
                                    <td><?php echo $vo['product_title']; ?></td>
                                    <td>
                                        <?php if(!empty($vo['index_image'])) { ?>
                                            <a href="<?php echo \app\utils\Utils::fullImageUrl($vo['index_image']); ?>" target="_blank">
                                                <img src="<?php echo \app\utils\Utils::fullImageUrl($vo['index_image']); ?>" width="120" height="120">
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $vo['product_shortname']; ?></td>
                                    <td><?php echo $vo['product_weight']; ?>KG</td>
                                    <td>

                                        <?php if(!empty($vo['app_index_image'])) { ?>
                                            <a href="<?php echo \app\utils\Utils::fullImageUrl($vo['app_index_image']); ?>" target="_blank">
                                                <img src="<?php echo \app\utils\Utils::fullImageUrl($vo['app_index_image']); ?>" width="120" height="120">
                                            </a>
                                        <?php } ?>
                                    </td>
                                    <td>

                                        <?php if(!empty($vo['qrcode'])) { ?>
                                            <a href="<?php echo \app\utils\Utils::fullImageUrl($vo['qrcode']); ?>" target="_blank">
                                                <img src="<?php echo \app\utils\Utils::fullImageUrl($vo['qrcode']); ?>" width="120" height="120">
                                            </a>
                                        <?php } ?>

                                    </td>
                                    <td>
                                        <?php if ($vo['state'] == 1) { ?>
                                            <span class="label label-sm label-success">启用</span>
                                        <?php } else { ?>
                                            <span class="label label-sm label-warning">删除</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="green data-delete" href="javascript:;" data-title="确认删除?" data-href="/admin/product/audit?id=<?php echo $vo['id']; ?>" title="编辑">
                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                            </a>
                                        </div>
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