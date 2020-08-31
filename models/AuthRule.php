<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%auth_rule}}".
 *
 * @property int $menu_id 后台菜单 ID
 * @property string $module 规则所属module
 * @property string $type 权限规则分类，请加应用前缀,如admin_
 * @property string $name 规则唯一英文标识,全小写
 * @property string|null $url_param 额外url参数
 * @property string $title 规则中文描述
 * @property int $status 是否有效(0:无效,1:有效)
 * @property string $rule_param 规则附加条件
 * @property int|null $nav_id nav id
 */
class AuthRule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_rule}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'Menu ID',
            'module' => 'Module',
            'type' => 'Type',
            'name' => 'Name',
            'url_param' => 'Url Param',
            'title' => 'Title',
            'status' => 'Status',
            'rule_param' => 'Rule Param',
            'nav_id' => 'Nav ID',
        ];
    }
}
