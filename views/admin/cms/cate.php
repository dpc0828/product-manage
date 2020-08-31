<div class="page-content">
    <div class="page-header">
        <h1>
            文章管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                分类管理
            </small>
        </h1>
    </div>
    <div class="page-header">
        <h1>
            <a href="/admin/cms/add-cate">
                <span class="label label-xlg label-success">添加分类</span>
            </a>
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
                                    <input name="keyword" <?php if(!empty($keyword)) { echo 'value="' . $keyword . '"';} ?> class="input-sm" type="text"  placeholder="分类名称">
                                    <select name="state" style="width: 10%;">
                                        <option value="">状态</option>
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
                            <th>分类名称</th>
                            <th>图标</th>
                            <th>排序</th>
                            <th>状态</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <?php if(!empty($list)) { ?>
                            <tbody>
                            <?php foreach ($list as $key => $vo) { ?>
                                <tr class="">
                                    <td class="center"><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['cate_name']; ?></td>
                                    <td><img width="55" height="55" src="<?php echo $vo['image']; ?>"></td>
                                    <td><?php echo $vo['sort']; ?></td>

                                    <td>
                                        <?php if ($vo['state'] == 1) { ?>
                                            <span class="label label-sm label-success">启用</span>
                                        <?php } else { ?>
                                            <span class="label label-sm label-warning">禁用</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $vo['create_time']; ?></td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a target="_blank" class="green" href="/admin/cms/edit-cate?id=<?php echo $vo['id']; ?>" title="编辑">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <?php echo $page; ?>
            <div class="hr hr-18 dotted hr-double"></div>
        </div>
    </div>
</div>