<div class="page-content">
    <div class="page-header">
        <h1>
            用户管理
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                用户列表
            </small>
        </h1>
    </div>
    <div class="page-header">
        <a class="green" href="/admin/user/add" title="添加用户">
            <span class="label label-xlg label-success">添加用户</span>
        </a>
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
                            <th>电话号码</th>
                            <th>微信</th>
                            <th>QQ</th>
                            <th>安全码</th>
                            <th>状态</th>
                            <th>最后登录时间</th>
                            <th>注册时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <?php if(!empty($list)) { ?>
                            <tbody>
                            <?php foreach ($list as $vo) { ?>
                                <tr class="">
                                    <td class="center"><?php echo $vo['id']; ?></td>
                                    <td><?php echo $vo['mobile']; ?></td>
                                    <td><?php echo $vo['wechat']; ?></td>
                                    <td><?php echo $vo['qq']; ?></td>
                                    <td><?php echo $vo['safety_code']; ?></td>
                                    <td>
                                        <?php if ($vo['state'] == 1) { ?>
                                            <span class="label label-sm label-success">启用</span>
                                        <?php } else { ?>
                                            <span class="label label-sm label-warning">禁用</span>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo $vo['last_logintime']; ?></td>
                                    <td><?php echo $vo['create_time']; ?></td>
                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="green" href="/admin/user/edit?id=<?php echo $vo['id']; ?>" title="编辑">
                                                <i class="ace-icon fa fa-pencil bigger-130"></i>
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