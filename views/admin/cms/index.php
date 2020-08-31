<div class="page-content">
    <div class="page-header">
        <h1>
            文章管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                文章列表
            </small>
        </h1>
    </div>
    <div class="page-header">
        <h1>
            <a href="/admin/cms/add">
                <span class="label label-xlg label-success">添加新闻</span>
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
                                    <input name="keyword" <?php if(!empty($keyword)) { echo 'value="' . $keyword . '"';} ?> class="input-sm" type="text"  placeholder="标题">
                                    <select name="state" style="width: 10%;">
                                        <option value="">状态</option>
                                        <option <?php if($state == 1) { echo "selected";} ?> value="1">启用</option>
                                        <option <?php if($state == 2) { echo "selected";} ?> value="2">禁用</option>
                                    </select>


                                    <select name="cate_id" id="cate_id" aria-required="true" aria-invalid="true">
                                        <option value="">分类</option>
                                        {if !empty($cate)}
                                        {foreach $cate as $cli}
                                        <?php foreach($cate as $cli_next) { ?>
                                            <option <?php echo $cate_id == $cli_next['id'] ? 'selected' : ''; ?>  value="<?php echo $cli_next['id']; ?>"><?php echo $cli_next['cate_name']; ?></option>
                                        <?php } ?>
                                        {/foreach}
                                        {/if}
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
                            <th>文章标题</th>
                            <th>封面图</th>
                            <th>文章简介</th>
                            <th>分类</th>
                            <th>点击次数</th>
                            <th>点赞次数</th>
                            <th>排序</th>
                            <th>是否首页置顶</th>
                            <th>是否栏目置顶</th>
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
                                    <td><?php echo $vo['title']; ?></td>
                                    <td><?php if(!empty($vo['image'])){ ?><img width="182" height="113" src="<?php echo $vo['image']; ?>"><?php } ?></td>
                                    <td width="10%"><?php echo $vo['description']; ?></td>
                                    <td><?php echo $vo['cate_name']; ?></td>
                                    <td><?php echo $vo['view']; ?></td>
                                    <td><?php echo $vo['likes']; ?></td>
                                    <td><?php echo $vo['sort']; ?></td>
                                    <td>
                                        <?php if ($vo['home_top'] == 1) { ?>
                                            <span class="label label-sm label-success">是</span>
                                        <?php } else { ?>
                                            <span class="label label-sm label-warning">否</span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php if ($vo['list_top'] == 1) { ?>
                                            <span class="label label-sm label-success">是</span>
                                        <?php } else { ?>
                                            <span class="label label-sm label-warning">否</span>
                                        <?php } ?>
                                    </td>
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
                                            <a target="_blank" class="green" href="/admin/cms/edit?id=<?php echo $vo['id']; ?>" title="编辑">
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