<div id="list">
    <table class="layui-table">
        <colgroup>
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <col width="7%">
        </colgroup>
        <thead>
        <tr class="col_name">
            <th>任务/订单编号</th>
            <th>买号/商品信息</th>
            <th>评价 / 追评内容</th>
            <th>追评状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="text-left">
        </tbody>
    </table>
</div>
<div id="page"></div>
<script type="text/javascript">
    Tools.page(0, 1, function(obj){
        var $args = $has_search == true ? '&' + $('#additionalManage').serialize() : '';
        Tools._load('task_lists', '/task/additional?page=' + obj.curr + $args);
    });
</script>
