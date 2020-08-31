<style type="text/css">
    .layui-table-cell{
        height:auto !important;
    }
</style>
<div class="layui-tab layui-tab-brief" lay-filter="withdraw">
    <ul class="layui-tab-title">
        <li lay-id = 'productManage' data-state = "" class="layui-this">商品管理</li>
    </ul>
</div>
<div>
    <form data-target="transfer" action="javascript:;" id="transfer" class="layui-form search_form" lay-filter="search_form">
        <div class="layui-form-item">
            <div class="layui-inline">
                <div class="layui-input-inline select_box">
                    <select name="manager">
                        <option value="">选择掌柜号</option>
                        <?php if(!empty($shop)) { ?>
                            <?php foreach ($shop as $shop_li) { ?>
                                <option value="<?php echo $shop_li['manager']; ?>"><?php echo $shop_li['manager']; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="name"  placeholder="简称/标题" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="p_id"  placeholder="商品ID" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-inline">
                <button class="layui-btn layui-btn-radius layui-btn-primary" style="display: inline-block;" onclick="searchProductLists()">搜&nbsp;索</button>
            </div>
        </div>
    </form>
</div>
<div id="pro-list" lay-filter="pro_list"></div>
<script type="text/html" id="toolbar">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm" lay-event="add">添加</button>
        <button class="layui-btn layui-btn-sm" lay-event="edit">编辑</button>
        <button class="layui-btn layui-btn-sm" lay-event="del">删除</button>
        <div class="layui-btn-group" style="margin-right: 10px">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="target">目标客户</button>
            <button
                type="button"
                class="layui-btn layui-btn-sm layui-btn-primary"
                lay-event="target_template"
            >模板</button>
        </div>
        <div class="layui-btn-group" style="margin-left: 0; margin-right: 10px">
            <button type="button" class="layui-btn layui-btn-sm" lay-event="behavior">购买行为</button>
            <button
                type="button"
                class="layui-btn layui-btn-sm layui-btn-primary"
                lay-event="behavior_template"
            >模板</button>
        </div>
        <button class="layui-btn layui-btn-sm" lay-event="view">查看详情</button>
    </div>
</script>
<script type="text/html" id="pro_status">
    {{#  if(d.status == 0){ }}
    <strong class="text-danger">待审核</strong>
    {{#  } else if(d.status == 1){ }}
    <span>可用</span>
    {{#  } else { }}
    <span class="text-danger">不可用</span>
    {{#  } }}
</script>
<script type="text/javascript">
    loadProductLists();
    layui.use(['form', 'laydate'], function(){
        var form = layui.form;
        form.render();
    });
</script>