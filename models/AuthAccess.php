<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%auth_access}}".
 *
 * @property int $role_id 角色
 * @property string $rule_name 规则唯一英文标识,全小写
 * @property string|null $type 权限规则分类，admin_url:角色权限 admin:用户权限
 * @property int|null $menu_id 后台菜单ID
 */
class AuthAccess extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_access}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'rule_name' => 'Rule Name',
            'type' => 'Type',
            'menu_id' => 'Menu ID',
        ];
    }
}
