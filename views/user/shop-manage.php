<div class="layui-tab layui-tab-brief" lay-filter="withdraw">
    <ul class="layui-tab-title">
        <li lay-id='assistant' data-state = "" class="layui-this un-cut">店铺管理</li>
    </ul>
</div>
<blockquote class="layui-elem-quote layui-quote-nm">
    <p>
        淘宝店铺：<strong id="shop-num" class="text-danger"><?php echo count($list); ?></strong>个&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="layui-btn layui-btn-radius layui-btn-primary" onclick="bindingShop()">绑定新店铺</button>
    </p>
</blockquote>
<table class="layui-table">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr class="col_name">
        <th>店铺名称</th>
        <th>所属平台</th>
        <th>状态</th>
        <th>发货信息</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($list)) { ?>
        <?php foreach ($list as $li) { ?>
            <tr id="s_<?php echo $li['id'];?>">
                <td><?php echo $li['shop_name'];?></td>
                <td>
                    <?php
                        if($li['shop_type'] == 1) {
                            echo '天猫';
                        } elseif ($li['shop_type'] == 3) {
                            echo '阿里巴巴';
                        } else {
                            echo '淘宝';
                        }
                    ?>
                </td>
                <td>
                    <strong>
                        <?php
                        if($li['state'] == 1) {
                            echo '待审核';
                        } elseif ($li['shop_type'] == 2) {
                            echo '已审核';
                        } elseif ($li['shop_type'] == 3) {
                            echo '审核不过';
                        } else {
                            echo '已审核';
                        }
                        ?>
                    </strong>
                </td>
                <td class="text-left">
                    <p>姓名：<span class="consigner"><?php echo $li['sender_name'];?></span></p>
                    <p>电话：<span class="mobile"><?php echo $li['send_phone'];?></span></p>
                    <p>快递：申通快递</p>
                    <p>仓库地址：广东省广州市白云区广从三路</p>
                    <p>
                        <a href="javascript:;" onclick="changeWarehouse(<?php echo $li['id'];?>)">修改</a>
                    </p>
                </td>
                <td>
                    <button class="layui-btn layui-btn-radius layui-btn-fluid layui-btn-normal" onclick="viewShop(<?php echo $li['id'];?>)">查看详情</button><br>
                    <?php if($li['shop_type'] == 1 || $li['shop_type'] == 2) { ?>
                        <button class="layui-btn layui-btn-radius layui-btn-fluid layui-btn-primary" onclick="editShop(<?php echo $li['id'];?>)">编辑</button><br>
                    <?php } ?>
                    <button class="layui-btn layui-btn-radius layui-btn-fluid layui-btn-danger" onclick="deleteShop(<?php echo $li['id'];?>, this)">删除</button><br>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
    </tbody>
</table>