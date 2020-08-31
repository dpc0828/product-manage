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
            <th>任务/订单信息</th>
            <th>地址</th>
            <th>运单号</th>
            <th>发货状态</th>
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
        var $args = $has_search == true ? '&' + $('#logistics').serialize() : '';
        Tools._load('task_lists', '/task/logistics?page=' + obj.curr + $args);
    });
</script>
