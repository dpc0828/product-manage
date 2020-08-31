<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%auth_menu}}".
 *
 * @property int $id 自增ID
 * @property int $parent_id 父级ID
 * @property string $name 菜单名称
 * @property string $app 应用名称app
 * @property string $controller 控制器
 * @property string $action 操作名称
 * @property int $type 菜单类型  1：一级菜单 2：权限认证 + 二级菜单 3：权限认证
 * @property int $status 状态，1：显示 2：不显示
 * @property string|null $icon 菜单图标
 * @property string $remark 备注
 */
class AuthMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_menu}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'parent_id' => 'Parent ID',
            'name' => 'Name',
            'app' => 'App',
            'controller' => 'Controller',
            'action' => 'Action',
            'type' => 'Type',
            'status' => 'Status',
            'icon' => 'Icon',
            'remark' => 'Remark',
        ];
    }
}
