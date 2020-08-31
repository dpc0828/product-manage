<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_cate".
 *
 * @property int $id
 * @property string $cate_name
 * @property string|null $create_time
 */
class Cate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cate_name'], 'required'],
            [['create_time'], 'safe'],
            [['cate_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cate_name' => 'Cate Name',
            'create_time' => 'Create Time',
        ];
    }
}
