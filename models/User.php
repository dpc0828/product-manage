<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property int $mobile 电话号码
 * @property string $password 密码
 * @property string|null $safety_code 安全码
 * @property string|null $qq QQ
 * @property string|null $wechat 微信
 * @property int $state 1:启用 2：禁用
 * @property string $create_time
 * @property string|null $update_time
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mobile', 'password'], 'required'],
            [['mobile', 'state'], 'integer'],
            [['create_time', 'update_time'], 'safe'],
            [['password'], 'string', 'max' => 255],
            [['safety_code', 'qq', 'wechat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mobile' => 'Mobile',
            'password' => 'Password',
            'safety_code' => 'Safety Code',
            'qq' => 'Qq',
            'wechat' => 'Wechat',
            'state' => 'State',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
