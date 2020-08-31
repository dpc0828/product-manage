<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%task_release_time}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $task_id
 * @property int $release_type 发布时间 0:立即发布 1:今日平均发布 2:多天平均发布 3:关键词单独发布
 * @property int $release_quantity
 * @property string $start_time
 * @property string $end_time
 * @property string $timeout_time
 * @property string $create_time
 * @property string $update_time
 */
class TaskReleaseTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%task_release_time}}';
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
            'release_type' => 'Release Type',
            'release_quantity' => 'Release Quantity',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'timeout_time' => 'Timeout Time',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
