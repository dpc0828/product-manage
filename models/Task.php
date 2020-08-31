<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%task}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $task_type 1:销量任务 2:标签任务 3:预约任务 4:提前购 5:AB单 6:多链接任务 7:猜你喜欢 8:微淘/直播任务
 * @property string|null $usually_cate 买家长购类目
 * @property int $deliver_type 快递类型 1:自发快递 2:平台发货2.3/单
 * @property int|null $relevance_flow 关联流量任务 2：优先派给做过我家流量任务的用户 3：仅派给做过我家流量任务的用户
 * @property int|null $chat_before_buy 拍前聊天 0:否 1:是
 * @property int|null $collection 收藏商品 0:否 1:是
 * @property int|null $add_to_cart 加入购物车 0:否 1:是
 * @property int|null $get_coupons 领取优惠券 0:否 1:是
 * @property int|null $recommon_product 推荐商品  0:否 1:是
 * @property int|null $screenshot 任务过程不截图 1:不截图 0：截图
 * @property string|null $task_waring 任务确认前提醒
 * @property string|null $remark 任务备注
 * @property int $task_quantity 任务总量
 * @property float $vie_keyword_fee 货比词佣金
 * @property float $product_fee 产品总费用 佣金 快递 产品费用
 * @property float $basic_flow_price 流量单基础佣金单价
 * @property float $basic_flow_fee 流量单基础佣金总费用
 * @property float $value_added_fee 流量单增值服务总费用
 * @property float $deliver_fee 平台发货费用
 * @property float $total_fee 任务总费用
 * @property string|null $create_time
 * @property string|null $update_time
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task}}';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'task_type' => 'Task Type',
            'usually_cate' => 'Usually Cate',
            'deliver_type' => 'Deliver Type',
            'relevance_flow' => 'Relevance Flow',
            'chat_before_buy' => 'Chat Before Buy',
            'collection' => 'Collection',
            'add_to_cart' => 'Add To Cart',
            'get_coupons' => 'Get Coupons',
            'recommon_product' => 'Recommon Product',
            'screenshot' => 'Screenshot',
            'task_waring' => 'Task Waring',
            'remark' => 'Remark',
            'task_quantity' => 'Task Quantity',
            'vie_keyword_fee' => 'Vie Keyword Fee',
            'product_fee' => 'Product Fee',
            'basic_flow_price' => 'Basic Flow Price',
            'basic_flow_fee' => 'Basic Flow Fee',
            'value_added_fee' => 'Value Added Fee',
            'deliver_fee' => 'Deliver Fee',
            'total_fee' => 'Total Fee',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
