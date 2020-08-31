<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%customer_target_template}}".
 *
 * @property int $id
 * @property int $user_id 用户ID
 * @property string $template_name 模板名称
 * @property int $gender 性别占比设置 0：未设置 1：已设置
 * @property float|null $male_percent 男性占比
 * @property float|null $female_percent 女性占比
 * @property int $age 年龄设置 0：未设置 1：已设置
 * @property float|null $age18_24 18-24岁占比
 * @property float|null $age25_33 25-33岁占比
 * @property float|null $age34_50 34-50岁占比
 * @property string|null $exclude_province 目标客户排除地区
 * @property string $create_time
 * @property string|null $update_time
 */
class CustomerTargetTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%customer_target_template}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'template_name'], 'required'],
            [['user_id', 'gender', 'age'], 'integer'],
            [['male_percent', 'female_percent', 'age18_24', 'age25_33', 'age34_50'], 'number'],
            [['exclude_province'], 'string'],
            [['create_time', 'update_time'], 'safe'],
            [['template_name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'template_name' => 'Template Name',
            'gender' => 'Gender',
            'male_percent' => 'Male Percent',
            'female_percent' => 'Female Percent',
            'age' => 'Age',
            'age18_24' => 'Age18 24',
            'age25_33' => 'Age25 33',
            'age34_50' => 'Age34 50',
            'exclude_province' => 'Exclude Province',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
