<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%waring_setting}}".
 *
 * @property int $id
 * @property int|null $product_id 产品ID
 * @property int|null $chat_before_buy 拍前聊天 1:否 2:是
 * @property int|null $collection 收藏商品 1:否 2:是
 * @property int|null $add_to_cart 加入购物车 1:否 2:是
 * @property int|null $get_coupons 领取优惠券 1:否 2:是
 * @property int|null $recommon_product 推荐商品 1:否 2:是
 * @property string|null $create_time
 * @property string|null $update_time
 */
class WaringSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%waring_setting}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'chat_before_buy', 'collection', 'add_to_cart', 'get_coupons', 'recommon_product'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'chat_before_buy' => 'Chat Before Buy',
            'collection' => 'Collection',
            'add_to_cart' => 'Add To Cart',
            'get_coupons' => 'Get Coupons',
            'recommon_product' => 'Recommon Product',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
