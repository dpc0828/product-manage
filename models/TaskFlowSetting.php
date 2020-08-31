<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%task_flow_setting}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $task_id
 * @property int $flow_type 1:淘宝APP自然搜索 2:淘宝PC自然搜索 3:淘宝APP淘口令 4:淘宝APP直通车 5:淘宝PC直通车 6:淘宝APP二维码 7:淘宝APP猜你喜欢 8:拍立淘 9:聚划算
 * @property string|null $vie_keyword1 货比词1
 * @property string|null $vie_keyword2 货比词2
 * @property string|null $vie_keyword3 货比词3
 * @property string $target_keyword 目标关键词
 * @property int $quantity 数量
 * @property int $same_flow 是否同时发布流量单 0:否 1:是
 * @property int|null $sort_type 1:综合 2:新品 3:人气 4:销量 5:价格从低到高 6:价格从高到低
 * @property float|null $price_min  价格区间
 * @property float|null $price_max 价格区间
 * @property string|null $sendaddress 发货地
 * @property string|null $other 其他
 * @property string|null $create_time
 * @property string|null $update_time
 */
class TaskFlowSetting extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task_flow_setting}}';
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
            'flow_type' => 'Flow Type',
            'vie_keyword1' => 'Vie Keyword1',
            'vie_keyword2' => 'Vie Keyword2',
            'vie_keyword3' => 'Vie Keyword3',
            'target_keyword' => 'Target Keyword',
            'quantity' => 'Quantity',
            'same_flow' => 'Same Flow',
            'sort_type' => 'Sort Type',
            'price_min' => 'Price Min',
            'price_max' => 'Price Max',
            'sendaddress' => 'Sendaddress',
            'other' => 'Other',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
