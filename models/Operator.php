<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%operator}}".
 *
 * @property int $id 管理员ID
 * @property string $username 管理员登录用户名
 * @property string|null $title 管理员姓名
 * @property string $password 登录密码
 * @property string $salt 加密盐
 * @property string|null $role 角色
 * @property int $state 状态1：启用 0：禁用 -1：删除
 * @property string|null $last_logintime 最后登录时间
 * @property string|null $last_loginip 最后登录IP
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class Operator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%operator}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'title' => 'Title',
            'password' => 'Password',
            'salt' => 'Salt',
            'role' => 'Role',
            'state' => 'State',
            'last_logintime' => 'Last Logintime',
            'last_loginip' => 'Last Loginip',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
