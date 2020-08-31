<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%buy_behavior_template}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property string $template_name 模板名称
 * @property float|null $shop_collection_percent 收藏店铺
 * @property float|null $product_collection_percent 收藏商品
 * @property float|null $add_cart_percent 加入购物车
 * @property float|null $chat_percent 拍前咨询
 * @property float|null $product_contrast_percent_0 货比N家-不货比
 * @property float|null $product_contrast_percent_1 货比N家-货比一家
 * @property float|null $product_contrast_percent_2 货比N家-货比两家
 * @property float|null $product_contrast_percent_3 货比N家-货比三家
 * @property float|null $scan_percent_0 浏览深度-不浏览
 * @property float|null $scan_percent_1 浏览深度-店内一款
 * @property float|null $scan_percent_2 浏览深度-店内两款
 * @property float|null $scan_percent_3 浏览深度-店内三款
 * @property string|null $create_time
 * @property string|null $update_time
 */
class BuyBehaviorTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%buy_behavior_template}}';
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'template_name' => 'Template Name',
            'shop_collection_percent' => 'Shop Collection Percent',
            'product_collection_percent' => 'Product Collection Percent',
            'add_cart_percent' => 'Add Cart Percent',
            'chat_percent' => 'Chat Percent',
            'product_contrast_percent_0' => 'Product Contrast Percent 0',
            'product_contrast_percent_1' => 'Product Contrast Percent 1',
            'product_contrast_percent_2' => 'Product Contrast Percent 2',
            'product_contrast_percent_3' => 'Product Contrast Percent 3',
            'scan_percent_0' => 'Scan Percent 0',
            'scan_percent_1' => 'Scan Percent 1',
            'scan_percent_2' => 'Scan Percent 2',
            'scan_percent_3' => 'Scan Percent 3',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
