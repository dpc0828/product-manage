<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%task_product}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property int $product_id 产品ID
 * @property int $task_id 任务ID
 * @property float $price 商品单价
 * @property float $deliver_price 快递费单价
 * @property int $buy_quantity 拍下件数
 * @property string|null $sku 型号
 * @property int $task_quantity 任务数量
 * @property float $commission 单任务佣金
 * @property float $commission_fee 总佣金
 * @property float $deliver_fee 总快递费
 * @property float $product_fee 产品费
 * @property float $total_fee 总费用 
 * @property string $create_time
 * @property string|null $update_time
 */
class TaskProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task_product}}';
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
            'price' => 'Price',
            'deliver_price' => 'Deliver Price',
            'buy_quantity' => 'Buy Quantity',
            'sku' => 'Sku',
            'task_quantity' => 'Task Quantity',
            'commission' => 'Commission',
            'commission_fee' => 'Commission Fee',
            'deliver_fee' => 'Deliver Fee',
            'product_fee' => 'Product Fee',
            'total_fee' => 'Total Fee',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
