<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tb_shop".
 *
 * @property int $id
 * @property int $shop_type 店铺性质 0:淘宝 1:天猫 2:阿里巴巴
 * @property string|null $manager 掌柜号
 * @property string|null $shop_name 店铺名称
 * @property int $shop_cate 所属类目
 * @property int $shop_nature 店铺性质 0：个人 1：公司
 * @property string $sender_name 寄件人姓名
 * @property int $send_phone 寄件人电话
 * @property int $warehouse_id 仓库ID
 * @property string $business_consultan 生意参谋截图
 * @property int $state 1:待审核 2：已审核 3：审核不过
 * @property string $create_time
 * @property string|null $update_time
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%shop}}';
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'shop_type' => 'Shop Type',
            'manager' => 'Manager',
            'shop_name' => 'Shop Name',
            'shop_cate' => 'Shop Cate',
            'shop_nature' => 'Shop Nature',
            'sender_name' => 'Sender Name',
            'send_phone' => 'Send Phone',
            'warehouse_id' => 'Warehouse ID',
            'business_consultan' => 'Business Consultan',
            'state' => 'State',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
