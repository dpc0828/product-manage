<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_area".
 *
 * @property int $id
 * @property int|null $group_id 1:华东地区 2:华南地区 3:华中地区 4:华北地区 5:西北地区 6:西南地区 7:东北地区 8:台港澳区 9:偏远地区
 * @property string $name
 * @property string $create_time
 */
class Area extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%area}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['group_id'], 'integer'],
            [['name'], 'required'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'group_id' => 'Group ID',
            'name' => 'Name',
            'create_time' => 'Create Time',
        ];
    }
}
