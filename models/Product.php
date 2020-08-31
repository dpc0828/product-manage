<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_product".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $shop_id 店铺ID
 * @property string $product_link 商品链接
 * @property int $product_title 商品标题
 * @property string $product_id 商品ID
 * @property string $index_image 商品首图
 * @property string $product_shortname 商品简称
 * @property float $product_weight 商品重量 KG
 * @property int|null $customer_target_id 目标客户模板ID
 * @property int|null $buy_behavior_id 购买行为模板ID
 * @property string|null $app_index_image APP主图
 * @property string|null $qrcode 二维码
 * @property string|null $zhitongche 直通车图 JSON
 * @property int $state 1:上架 2:删除
 * @property string $create_time
 * @property string|null $update_time
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%product}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'shop_id' => 'Shop ID',
            'product_link' => 'Product Link',
            'product_title' => 'Product Title',
            'product_id' => 'Product ID',
            'index_image' => 'Index Image',
            'product_shortname' => 'Product Shortname',
            'product_weight' => 'Product Weight',
            'customer_target_id' => 'Customer Target ID',
            'buy_behavior_id' => 'Buy Behavior ID',
            'app_index_image' => 'App Index Image',
            'qrcode' => 'Qrcode',
            'zhitongche' => 'Zhitongche',
            'state' => 'State',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
