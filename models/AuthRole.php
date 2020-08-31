<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%auth_role}}".
 *
 * @property int $id
 * @property string $name 角色名称
 * @property int|null $pid 父角色ID
 * @property int $status 状态 1：启用 2：禁用
 * @property string|null $remark 备注
 * @property string|null $create_time 创建时间
 * @property string|null $update_time 更新时间
 */
class AuthRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%auth_role}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'pid' => 'Pid',
            'status' => 'Status',
            'remark' => 'Remark',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
