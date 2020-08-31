<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%auth_role_user}}".
 *
 * @property int|null $role_id 角色 id
 * @property int|null $user_id 用户id
 */
class AuthRoleUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_role_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'user_id' => 'User ID',
        ];
    }
}
