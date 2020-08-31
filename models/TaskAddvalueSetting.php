<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%task_addvalue_setting}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $task_id
 * @property float $collect_pro_percent 收藏商品占比
 * @property int $collect_pro_quantity 收藏商品总数量
 * @property float $collect_pro_price 收藏商品单价
 * @property float $collect_pro_fee 收藏商品费用
 * @property float $recommend_pro_percent 推荐商品占比
 * @property int $recommend_pro_quantity 推荐商品数量
 * @property float $recommend_pro_price 推荐商品单价
 * @property float $recommend_pro_fee 推荐商品总费用
 * @property float $collect_shop_percent 关注店铺占比
 * @property int $collect_shop_quantity 关注店铺数量
 * @property float $collect_shop_price 关注店铺单价
 * @property float $collect_shop_fee 关注店铺总费用
 * @property float $add_cart_percent 加入购物车占比
 * @property int $add_cart_quantity 加入购物车数量
 * @property float $add_cart_price 加入购物车单价
 * @property float $add_cart_fee 加入购物车总费用
 * @property float $chat_percent 旺旺咨询占比
 * @property int $chat_quantity 旺旺咨询数量
 * @property float $chat_price 旺旺咨询单价
 * @property float $chat_fee 旺旺咨询总费用
 * @property float $coupon_percent 领优惠券占比
 * @property int $coupon_quantity 领优惠券数量
 * @property float $coupon_price 领优惠券单价
 * @property float $coupon_fee 领优惠券总费用
 * @property float $ask_percent 淘宝问大家占比
 * @property int $ask_quantity 淘宝问大家数量
 * @property float $ask_price 淘宝问大家单价
 * @property float $ask_fee 淘宝问大家总费用
 * @property string|null $question_1 问题1
 * @property string|null $question_2 问题2
 * @property string|null $question_3 问题3
 * @property string|null $question_4 问题4
 * @property string|null $question_5 问题5
 * @property string $create_time
 * @property string|null $update_time
 */
class TaskAddvalueSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task_addvalue_setting}}';
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
            'task_id' => 'Task ID',
            'collect_pro_percent' => 'Collect Pro Percent',
            'collect_pro_quantity' => 'Collect Pro Quantity',
            'collect_pro_price' => 'Collect Pro Price',
            'collect_pro_fee' => 'Collect Pro Fee',
            'recommend_pro_percent' => 'Recommend Pro Percent',
            'recommend_pro_quantity' => 'Recommend Pro Quantity',
            'recommend_pro_price' => 'Recommend Pro Price',
            'recommend_pro_fee' => 'Recommend Pro Fee',
            'collect_shop_percent' => 'Collect Shop Percent',
            'collect_shop_quantity' => 'Collect Shop Quantity',
            'collect_shop_price' => 'Collect Shop Price',
            'collect_shop_fee' => 'Collect Shop Fee',
            'add_cart_percent' => 'Add Cart Percent',
            'add_cart_quantity' => 'Add Cart Quantity',
            'add_cart_price' => 'Add Cart Price',
            'add_cart_fee' => 'Add Cart Fee',
            'chat_percent' => 'Chat Percent',
            'chat_quantity' => 'Chat Quantity',
            'chat_price' => 'Chat Price',
            'chat_fee' => 'Chat Fee',
            'coupon_percent' => 'Coupon Percent',
            'coupon_quantity' => 'Coupon Quantity',
            'coupon_price' => 'Coupon Price',
            'coupon_fee' => 'Coupon Fee',
            'ask_percent' => 'Ask Percent',
            'ask_quantity' => 'Ask Quantity',
            'ask_price' => 'Ask Price',
            'ask_fee' => 'Ask Fee',
            'question_1' => 'Question 1',
            'question_2' => 'Question 2',
            'question_3' => 'Question 3',
            'question_4' => 'Question 4',
            'question_5' => 'Question 5',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
