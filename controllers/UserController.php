<?php


namespace app\controllers;


use app\models\BuyBehaviorTemplate;
use app\models\CustomerTargetTemplate;
use app\models\Product;
use app\models\Shop;
use app\models\User;
use app\utils\LoginUtils;
use app\utils\ProductReleaseUtils;
use app\utils\UploadImageUtils;
use app\utils\Utils;
use app\utils\ValidatorUtils;
use yii;

class UserController extends BaseController
{

    public $layout = false;

    /**
     * 用户中心
     * @return string
     */
    public function actionUcenter() {
        return $this->render('ucenter.php');
    }


    /**
     * 基本资料
     * @return string
     */
    public function actionBasicsInfo() {
        $user_info = User::findOne($this->login_user_id);
        $total_shop = Shop::find()->where(['state' => 2, 'user_id' => $this->login_user_id])->count();
        return $this->render('basics-info.php', [
            'info' => $user_info,
            'total_shop' => $total_shop,
        ]);
    }

    /**
     * 小助理
     * @return string
     */
    public function actionAssistantManage() {
        return $this->render('assistant-manage.php');
    }

    /**
     * 店铺管理
     * @return string
     */
    public function actionShopManage() {
        $list = Shop::find()->where([
            'and',
            ['=', 'user_id', $this->login_user_id],
            ['in', 'state', [1, 2, 3]],
        ])->orderBy('id desc')->all();
        return $this->render('shop-manage.php', [
            'list' => $list,
        ]);
    }

    /**
     * 保存店铺信息
     * @throws \Yii\base\ExitException
     */
    public function actionSaveShop() {
        if(Utils::isPost()) {
            $tag = (int) Utils::request('tag');
            $info = Shop::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            $sender_name = Utils::request('sender_name'); // 寄件人姓名
            $send_phone = Utils::request('sender_phone'); // 电话
            $wh_id = (int) Utils::request('wh_id'); // 选择仓库
            if(empty($info)) {
                $this->errorJson('店铺不存在');
            }

            $info->send_phone = $send_phone;
            $info->sender_name = $sender_name;
            $info->warehouse_id = $wh_id;
            $info->update_time = Utils::dateYmd();

            if($info->save()) {
                $this->successJson('编辑成功');
            }
            $this->errorJson('编辑失败,请重试');
        }
    }

    /**
     * 删除店铺
     * @throws \Yii\base\ExitException
     */
    public function actionDeleteShop() {
        if(Utils::isPost()) {
            $tag = (int)Utils::request('tag');
            $info = Shop::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            if(empty($info)) {
                $this->errorJson('店铺不存在');
            }
            $info->state = 4;
            $info->update_time = Utils::dateYmd();
            if($info->save()) {
                $this->successJson('删除成功');
            }
            $this->errorJson('删除失败,请重试');
        }
    }

    /**
     * 店铺预览
     * @return string
     * @throws \Exception
     */
    public function actionViewShop() {
        $tag = (int) Utils::request('tag');
        $info = Shop::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
        return $this->render('ViewShop.php', [
            'info' => $info,
        ]);
    }

    /**
     * 编辑店铺
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionEditShop() {
        if(Utils::isPost()) {
            $tag = (int) Utils::request('sid');
            $info = Shop::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);

            if(empty($info)) {
                $this->errorJson('店铺不存在');
            }

            if(!in_array($info['state'], [1, 2])) {
                $this->errorJson('当前店铺不能编辑');
            }

            $group_pwd = Utils::request('group_pwd', null, 'trim');
            try {
                $qrcode = UploadImageUtils::uploadImage('qrcode', 'qrcode');
            } catch (\Exception $exception) {

            }


            if(empty($group_pwd) && !isset($qrcode)) {
                $this->errorJson('未修改任何内容');
            }

            $info->password = $group_pwd;
            if(isset($qrcode)) {
                $info->qrcode = $qrcode;
            }

            if($info->save()) {
                $this->successJson('编辑成功');
            }
            $this->errorJson('编辑失败,请重试');

        } else {
            $tag = (int) Utils::request('tag');
            $info = Shop::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            return $this->render('EditShop.php', [
                'info' => $info,
            ]);
        }
    }

    /**
     * 修改仓库
     * @return string
     * @throws \Exception
     */
    public function actionChangeWarehouse() {
        if(Utils::isPost()) {

        } else {
            $tag = (int) Utils::request('tag');
            $info = Shop::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            return $this->render('ChangeWarehouse.php', [
                'info' => $info,
            ]);
        }
    }

    /**
     * 添加店铺
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionAddShop() {
        if(Utils::isPost()) {
            $type = Utils::request('type'); // 店铺性质 0:淘宝 1:天猫 2:阿里巴巴
            $manager = Utils::request('manager'); // 掌柜号
            $shopname = Utils::request('shopname'); // 店铺名
            $category = Utils::request('category'); // 所属类目
            $their = (int) Utils::request('their'); // 店铺性质
            $consigner = Utils::request('consigner'); // 寄件人姓名
            $mobile = Utils::request('mobile'); // 电话
            $wh_id = (int) Utils::request('wh_id'); // 选择仓库

            if(!in_array($type, [0, 1, 3])) {
                $this->errorJson('店铺类型选择错误');
            }

            if(empty($manager)) {
                $this->errorJson('请填写掌柜号');
            }

            if(empty($shopname)) {
                $this->errorJson('请填写店铺名');
            }

            if(empty($category)) {
                $this->errorJson('请选择类目');
            }

            if(!in_array($their, [0, 1])) {
                $this->errorJson('店铺性质选择错误');
            }

            if(empty($consigner)) {
                $this->errorJson('请填写寄件人姓名');
            }

            if(empty($mobile) || !ValidatorUtils::isMobile($mobile)) {
                $this->errorJson('请填写寄件人手机号');
            }

            try {
                $business_consultan = UploadImageUtils::uploadImage('staff', 'shop');
            } catch (\Exception $exception) {

            }

            if(!isset($business_consultan) || empty($business_consultan)) {
                $this->errorJson('请上传生意参谋截图');
            }

            $model = new Shop();
            $model->user_id = $this->login_user_id;
            $model->shop_type = $type;
            $model->manager = $manager;
            $model->shop_name = $shopname;
            $model->shop_cate = $category;
            $model->shop_nature = $their;
            $model->sender_name = $consigner;
            $model->send_phone = $mobile;
            $model->warehouse_id = $wh_id;
            $model->business_consultan = $business_consultan;
            $model->create_time = Utils::dateYmd();
            $model->state = 1;
            if($model->save()) {
                $this->successJson('店铺添加成功');
            }
            $this->errorJson('店铺添加失败,请重试');
        } else {
            return $this->render('AddShop.php');
        }
    }

    /**
     * 产品管理
     * @return string
     */
    public function actionProductManage() {
        $shop = Shop::find()->where(['user_id' => $this->login_user_id, 'state' => 2])->all();
        return $this->render('product-manage.php', [
            'shop' => $shop,
        ]);
    }

    /**
     * 用户行为模板列表
     * @return string
     */
    public function actionBehaviorTemplate() {
        $list = BuyBehaviorTemplate::find()->where(['state' => 1, 'user_id' => $this->login_user_id])->orderBy('id desc')->all();
        return $this->render('BehaviorTemplate.php', [
            'list' => $list,
        ]);
    }

    /**
     * 添加用户行为模板
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionAddBehaviorTemplate() {
        if(Utils::isPost()) {
            $bookmark = (int)Utils::request('bookmark');
            $c_goods = (int) Utils::request('c_goods');
            $add_car = (int) Utils::request('add_car');
            $talk = (int) Utils::request('talk');
            $compare = Utils::request('compare');
            $browse = Utils::request('browse');
            $name = Utils::request('name');

            if($bookmark < 0 || $bookmark > 100) {
                $this->errorJson('收藏店铺百分比不能大于100');
            }

            if($c_goods < 0 || $c_goods > 100) {
                $this->errorJson('收藏商品百分比不能大于100');
            }

            if($add_car < 0 || $add_car > 100) {
                $this->errorJson('加入购物车百分比不能大于100');
            }

            if($talk < 0 || $talk > 100) {
                $this->errorJson('拍前咨询百分比不能大于100');
            }

            if(!isset($compare['not']) || !isset($compare['com1']) || !isset($compare['com2']) || !isset($compare['com3'])) {
                $this->errorJson('货比N家比例之和必须为100');
            }

            if(!isset($browse['net']) || !isset($browse['shop1']) || !isset($browse['shop2']) || !isset($browse['shop3'])) {
                $this->errorJson('浏览深度比例之和必须为100');
            }

            $data['shop_collection_percent'] = $bookmark / 100;
            $data['product_collection_percent'] = $c_goods / 100;
            $data['add_cart_percent'] = $add_car / 100;
            $data['chat_percent'] = $talk / 100;

            $data['product_contrast_percent_0'] = ((int)$compare['not']) / 100;
            $data['product_contrast_percent_1'] = ((int)$compare['com1']) / 100;
            $data['product_contrast_percent_2'] = ((int)$compare['com2']) / 100;
            $data['product_contrast_percent_3'] = ((int)$compare['com3']) / 100;

            if((int)($compare['not'] + $compare['com1'] + $compare['com2'] + $compare['com3']) != 100) {
                $this->errorJson('货比N家比例之和必须为100');
            }

            $data['scan_percent_0'] = ((int)$browse['net']) / 100;
            $data['scan_percent_1'] = ((int)$browse['shop1']) / 100;
            $data['scan_percent_2'] = ((int)$browse['shop2']) / 100;
            $data['scan_percent_3'] = ((int)$browse['shop3']) / 100;

            if((int)($browse['net'] + $browse['shop1'] + $browse['shop2'] + $browse['shop3']) != 100) {
                $this->errorJson('浏览深度比例之和必须为100');
            }

            if(empty($name)) {
                $this->errorJson('请输入模板名称');
            }

            $data['template_name'] = $name;
            $data['user_id'] = $this->login_user_id;
            $data['create_time'] = Utils::dateYmd();
            $data['state'] = 1;

            $model = new BuyBehaviorTemplate();
            foreach ($data as $key => $li) {
                $model->$key = $li;
            }

            if($model->save()) {
                $this->successJson('模板设置成功');
            }
            $this->errorJson('模板设置失败,请重试');

        } else {
            return $this->render('AddBehaviorTemplate.php');
        }
    }

    /**
     * 编辑用户行为模板
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionModifyBehaviorTemplate() {
        if(Utils::isPost()) {
            $tag = (int) Utils::request('tag');
            $model = BuyBehaviorTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            if(empty($model)) {
                $this->errorJson('模板不存在');
            }

            $bookmark = (int)Utils::request('bookmark');
            $c_goods = (int) Utils::request('c_goods');
            $add_car = (int) Utils::request('add_car');
            $talk = (int) Utils::request('talk');
            $compare = Utils::request('compare');
            $browse = Utils::request('browse');
            $name = Utils::request('name');

            if($bookmark < 0 || $bookmark > 100) {
                $this->errorJson('收藏店铺百分比不能大于100');
            }

            if($c_goods < 0 || $c_goods > 100) {
                $this->errorJson('收藏商品百分比不能大于100');
            }

            if($add_car < 0 || $add_car > 100) {
                $this->errorJson('加入购物车百分比不能大于100');
            }

            if($talk < 0 || $talk > 100) {
                $this->errorJson('拍前咨询百分比不能大于100');
            }

            if(!isset($compare['not']) || !isset($compare['com1']) || !isset($compare['com2']) || !isset($compare['com3'])) {
                $this->errorJson('货比N家比例之和必须为100');
            }

            if(!isset($browse['net']) || !isset($browse['shop1']) || !isset($browse['shop2']) || !isset($browse['shop3'])) {
                $this->errorJson('浏览深度比例之和必须为100');
            }

            $data['shop_collection_percent'] = $bookmark / 100;
            $data['product_collection_percent'] = $c_goods / 100;
            $data['add_cart_percent'] = $add_car / 100;
            $data['chat_percent'] = $talk / 100;

            $data['product_contrast_percent_0'] = ((int)$compare['not']) / 100;
            $data['product_contrast_percent_1'] = ((int)$compare['com1']) / 100;
            $data['product_contrast_percent_2'] = ((int)$compare['com2']) / 100;
            $data['product_contrast_percent_3'] = ((int)$compare['com3']) / 100;

            if((int)($compare['not'] + $compare['com1'] + $compare['com2'] + $compare['com3']) != 100) {
                $this->errorJson('货比N家比例之和必须为100');
            }

            $data['scan_percent_0'] = ((int)$browse['net']) / 100;
            $data['scan_percent_1'] = ((int)$browse['shop1']) / 100;
            $data['scan_percent_2'] = ((int)$browse['shop2']) / 100;
            $data['scan_percent_3'] = ((int)$browse['shop3']) / 100;

            if((int)($browse['net'] + $browse['shop1'] + $browse['shop2'] + $browse['shop3']) != 100) {
                $this->errorJson('浏览深度比例之和必须为100');
            }

            if(empty($name)) {
                $this->errorJson('请输入模板名称');
            }

            $data['template_name'] = $name;
            $data['update_time'] = Utils::dateYmd();

            foreach ($data as $key => $li) {
                $model->$key = $li;
            }
            if($model->save()) {
                $this->successJson('模板编辑成功');
            }
            $this->errorJson('模板编辑失败,请重试');
        } else {
            $tag = (int) Utils::request('tag');
            $info = BuyBehaviorTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            return $this->render('ModifyBehaviorTemplate.php', [
                'info' => $info,
            ]);
        }
    }

    /**
     * 目标客户模板列表
     * @return string
     */
    public function actionCustomerTemplate() {
        $list = CustomerTargetTemplate::find()->where(['state' => 1, 'user_id' => $this->login_user_id])->orderBy('id desc')->all();
        return $this->render('CustomerTemplate.php', [
            'list' => $list,
        ]);
    }

    /**
     * 标客户模板预览
     * @return string
     * @throws \Exception
     */
    public function actionPreviewCustomerTemplate() {
        $type = (int) Utils::request('type');
        $tag = (int) Utils::request('tag');
        if($type == 1) {
            $info = BuyBehaviorTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            return $this->render('PreviewBehaviorTemplate.php', [
                'info' => $info,
            ]);
        } else {
            $info = CustomerTargetTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            return $this->render('PreviewCustomerTemplate.php', [
                'info' => $info,
            ]);
        }
    }

    /**
     * 编辑目标客户模板
     * @return string
     * @throws \Exception
     */
    public function actionModifyCustomerTemplate() {
        if(Utils::isPost()) {
            $tag = (int) Utils::request('tag');
            $model = CustomerTargetTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            if(empty($model)) {
                $this->errorJson('模板不存在');
            }
            $sex = Utils::request('sex');
            $age = Utils::request('age');
            $province = Utils::request('province');
            $name = Utils::request('name');
            $data['gender'] = $sex == 'on' ? 1 : 0;
            $data['male_percent'] = null;
            $data['female_percent'] = null;
            $data['age'] = $age == 'on' ? 1 : 0;
            $data['age18_24'] = null;
            $data['age25_33'] = null;
            $data['age34_50'] = null;
            if(is_array($province)) {
                $province = array_keys($province);
                $province = ProductReleaseUtils::question($province);
            } else {
                $province = [];
            }
            $data['exclude_province'] = !empty($province) ? implode(' ', $province) : null;
            if($sex == 'on') {
                $Sex = Utils::request('Sex');
                if(!isset($Sex[0]) || !isset($Sex[1])) {
                    $this->errorJson('请设置男女性别比列');
                }

                if((int)$Sex[0] + (int) $Sex[1] != 100) {
                    $this->errorJson('男女性别比列和为100');
                }
                $data['male_percent'] = ((int)$Sex[0]) / 100;
                $data['female_percent'] = ((int)$Sex[1]) / 100;
            }

            if($age == 'on') {
                $Age = Utils::request('Age');
                if(!isset($Age['younger']) || !isset($Age['middle']) || !isset($Age['older'])) {
                    $this->errorJson('请设置年龄比列');
                }
                if((int)$Age['younger'] + (int) $Age['middle'] + (int) $Age['older'] != 100) {
                    $this->errorJson('年龄比列和为100');
                }
                $data['age18_24'] = ((int)$Age['younger']) / 100;
                $data['age25_33'] = ((int)$Age['middle']) / 100;
                $data['age34_50'] = ((int)$Age['older']) / 100;
            }
            if(empty($name)) {
                $this->errorJson('请输入模板名称');
            }
            $data['template_name'] = $name;
            $data['update_time'] = Utils::dateYmd();

            foreach ($data as $key => $li) {
                $model->$key = $li;
            }

            if($model->save()) {
                $this->successJson('模板编辑成功');
            }
            $this->errorJson('模板编辑失败,请重试');

        } else {
            $tag = (int) Utils::request('tag');
            $info = CustomerTargetTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            return $this->render('ModifyCustomerTemplate.php', [
                'info' => $info,
            ]);
        }
    }

    /**
     * 删除模板
     * @throws \Yii\base\ExitException
     */
    public function actionDeleteCustomerTemplate() {
        $this->postMethod();
        $tag = (int) Utils::request('tag');
        $type = (int) Utils::request('type');
        if($type == 1) {
            $info = BuyBehaviorTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
        } else {
            $info = CustomerTargetTemplate::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
        }

        if(empty($info)) {
            $this->errorJson('模板不存在');
        }

        $info->state = 2;
        $info->update_time = Utils::dateYmd();
        if($info->save()) {
            $this->successJson('模板删除成功');
        }
        $info->errorJson('模板删除失败,请重试');
    }

    /**
     * 添加目标客户模板
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionAddCustomerTemplate() {
        if(Utils::isPost()) {
            $sex = Utils::request('sex');
            $age = Utils::request('age');
            $province = Utils::request('province');
            $name = Utils::request('name');
            $data['gender'] = $sex == 'on' ? 1 : 0;
            $data['male_percent'] = null;
            $data['female_percent'] = null;
            $data['age'] = $age == 'on' ? 1 : 0;
            $data['age18_24'] = null;
            $data['age25_33'] = null;
            $data['age34_50'] = null;
            if(is_array($province)) {
                $province = array_keys($province);
                $province = ProductReleaseUtils::question($province);
            } else {
                $province = [];
            }
            $data['exclude_province'] = !empty($province) ? implode(' ', $province) : null;
            if($sex == 'on') {
                $Sex = Utils::request('Sex');
                if(!isset($Sex[0]) || !isset($Sex[1])) {
                    $this->errorJson('请设置男女性别比列');
                }

                if((int)$Sex[0] + (int) $Sex[1] != 100) {
                    $this->errorJson('男女性别比列和为100');
                }
                $data['male_percent'] = ((int)$Sex[0]) / 100;
                $data['female_percent'] = ((int)$Sex[1]) / 100;
            }

            if($age == 'on') {
                $Age = Utils::request('Age');
                if(!isset($Age['younger']) || !isset($Age['middle']) || !isset($Age['older'])) {
                    $this->errorJson('请设置年龄比列');
                }
                if((int)$Age['younger'] + (int) $Age['middle'] + (int) $Age['older'] != 100) {
                    $this->errorJson('年龄比列和为100');
                }
                $data['age18_24'] = ((int)$Age['younger']) / 100;
                $data['age25_33'] = ((int)$Age['middle']) / 100;
                $data['age34_50'] = ((int)$Age['older']) / 100;
            }
            if(empty($name)) {
                $this->errorJson('请输入模板名称');
            }
            $data['template_name'] = $name;
            $data['user_id'] = $this->login_user_id;
            $data['create_time'] = Utils::dateYmd();
            $data['state'] = 1;

            $model = new CustomerTargetTemplate();
            foreach ($data as $key => $li) {
                $model->$key = $li;
            }

            if($model->save()) {
                $this->successJson('模板设置成功');
            }
            $this->errorJson('模板设置失败,请重试');
        } else {
            return $this->render('AddCustomerTemplate.php');
        }
    }

    /**
     * 邀请好友
     * @return string
     */
    public function actionInviteFriends() {

        return $this->render('invite-friends.php');
    }


    /**
     * 产品列表
     * @throws \Yii\base\ExitException
     */
    public function actionProductList() {
        $manager = Utils::request('manager');
        $name = Utils::request('name');
        $p_id = Utils::request('p_id');

        $where[] = 'and';
        $where[] = ['=', 'p.state', 1];
        $where[] = ['=', 'p.user_id', $this->login_user_id];
        if(!empty($manager)) {
            $where[] = ['=', 's.manager', $manager];
        }

        if(!empty($name)) {
            $where[] = [
                'or',
                ['like', 'p.product_shortname', $name],
                ['like', 'p.product_title', $name],
            ];
        }

        if(!empty($p_id)) {
            $where[] = ['=', 'p.product_id', $p_id];
        }
        $model = Product::find()->alias('p')
            ->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id')
            ->where($where);

        $total = (int) $model->count('p.id');
        $offset = ($this->_page - 1) * $this->_page_size;
        $list = $model->select('p.product_shortname as commodity_abbreviation, 
        p.product_id as commodity_id, p.index_image as commodity_image, p.product_title as commodity_title, p.id, 
        s.shop_name as shopname, p.state as status')->orderBy('p.id desc')
            ->limit($this->_page_size)->offset($offset)->asArray()->all();


        foreach ($list as $k => $v) {
            $list[$k]['commodity_image'] = Utils::fullImageUrl($v['commodity_image']);
        }


        $this->layerListDisplayJson(0, $total, 'success', $list);
    }


    public function actionGetProductDetailsByUrl() {
        $this->errorJson('获取失败,产品信息请手动输入');
    }


    /**
     * 产品详情
     * @return string
     * @throws \Exception
     */
    public function actionViewProduct() {
        $tag = (int) Utils::request('tag');
        $info = Product::find()->alias('p')->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id')
            ->where(['p.id' => $tag, 'p.user_id' => $this->login_user_id])
            ->select('p.*, s.manager, s.shop_name')
            ->asArray()->one();
        return $this->render('ViewProduct.php', [
            'info' => $info,
        ]);
    }

    /**
     * 模板应用
     * @throws \Yii\base\ExitException
     * @throws yii\db\Exception
     */
    public function actionUseTemplate() {
        $this->postMethod();
        $type = (int) Utils::request('type');
        $ids = Utils::request('ids');
        $tag = (int) Utils::request('tag');
        if($type == 1) {
            $temp = BuyBehaviorTemplate::findOne(['user_id' => $this->login_user_id, 'id' => $tag, 'state' => 1]);
            $key = 'buy_behavior_id';
            $setting = 'buy_setting';
        } else {
            $temp = CustomerTargetTemplate::findOne(['user_id' => $this->login_user_id, 'id' => $tag, 'state' => 1]);
            $key = 'customer_target_id';
            $setting = 'customer_setting';

        }
        if(empty($temp)) {
            $this->errorJson('模板不存在');
        }
        $ids = explode(',', $ids);
        $pids = [];

        if(!empty($ids)) {
            foreach ($ids as $id) {
                $info = Product::findOne(['id' => (int) $id, 'user_id' => $this->login_user_id]);
                if(!empty($info)) {
                    $pids[] = (int) $id;
                }
            }
        }
        if(empty($pids)) {
            $this->errorJson('请选择产品');
        }


        if(yii::$app->db->createCommand()->update(Product::tableName(), [
            $key => $tag,
            $setting => json_encode($temp->getAttributes()),
            'update_time' => Utils::dateYmd()
        ], [
            'and',
            ['in', 'id', $pids],
            ['=', 'user_id', $this->login_user_id],
        ])->execute()) {
            $this->successJson('模板应用成功');
        }
        $this->errorJson('模板应用失败,请重试');
    }

    /**
     * 删除产品
     * @throws \Yii\base\ExitException
     */
    public function actionDeleteProduct() {
        $this->postMethod();
        $tag = (int) Utils::request('key');
        $info = Product::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
        if(empty($info)) {
            $this->errorJson('产品不存在');
        }
        $info->update_time = Utils::dateYmd();
        $info->state = 2;
        if($info->save()) {
            $this->successJson('产品删除成功');
        }
        $this->errorJson('产品删除失败,请重试');
    }

    /**
     * 编辑产品
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionEditProduct() {
        if(Utils::isPost()) {
            $tag = (int) Utils::request('tag');
            $info = Product::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            if(empty($info)) {
                $this->errorJson('产品不存在');
            }
            $shop_id = (int) Utils::request('manager'); // 店铺ID
            $product_link = Utils::request('link'); // 商品链接
            $product_title = Utils::request('headline'); // 商品标题
            $product_id = Utils::request('pid'); // 商品ID
            $product_shortname = Utils::request('abbreviation'); // 商品简称
            $product_weight = (float) Utils::request('weight'); // 商品重量 KG

            $shop_info = Shop::findOne(['user_id' => $this->login_user_id, 'state' => 2, 'id' => $shop_id]);
            if(empty($shop_info)) {
                $this->errorJson('店铺不存在');
            }

            if(!ValidatorUtils::isUrl($product_link)) {
                $this->errorJson('产品地址错误');
            }

            if(empty($product_title)) {
                $this->errorJson('请填写产品标题');
            }

            if(empty($product_id)) {
                $this->errorJson('请填写产品ID');
            }

            $goods_id = ProductReleaseUtils::getGoodsIdByUrl($product_link);
            if($goods_id != $product_id) {
                $this->errorJson('产品连接与产品ID不符');
            }

            if(empty($product_shortname)) {
                $this->errorJson('请输入产品简称');
            }

            if($product_weight <= 0) {
                $this->errorJson('请填写有效的产品重量');
            }


            $data['update_time'] = Utils::dateYmd();
            $data['shop_id'] = $shop_id;
            $data['product_link'] = $product_link;
            $data['product_title'] = $product_title;
            $data['product_id'] = $product_id;
            $data['product_shortname'] = $product_shortname;
            $data['product_weight'] = $product_weight;

            // 商品主图
            try {
                $index_image = UploadImageUtils::uploadImage('master', 'product');
                $data['index_image'] = $index_image;
            } catch (\Exception $exception) {

            }


            // APP主图
            try {
                $app_index_image = UploadImageUtils::uploadImage('wireless', 'product');
                $data['app_index_image'] = $app_index_image;
            } catch (\Exception $exception) {

            }

            // 二维码图片
            try {
                $qrcode = UploadImageUtils::uploadImage('qrcode', 'product');
                $qrcode = $qrcode;
                $data['qrcode'] = $qrcode;
            } catch (\Exception $exception) {

            }

            // 直通车图片
            $zhitongche = [];
            $_train_1 = Utils::request('_train_1');
            $_train_2 = Utils::request('_train_2');
            $_train_3 = Utils::request('_train_3');
            $_train_4 = Utils::request('_train_4');
            try {
                $train_1 = UploadImageUtils::uploadImage('train_1', 'product');
                $zhitongche[] = $train_1;
            } catch (\Exception $exception) {
                if(!empty($_train_1)) {
                    $zhitongche[] = $_train_1;
                }
            }

            try {
                $train_2 = UploadImageUtils::uploadImage('train_2', 'product');
                $zhitongche[] = $train_2;
            } catch (\Exception $exception) {
                if(!empty($_train_1)) {
                    $zhitongche[] = $_train_2;
                }
            }
            try {
                $train_3 = UploadImageUtils::uploadImage('train_3', 'product');
                $zhitongche[] = $train_3;
            } catch (\Exception $exception) {
                if(!empty($_train_1)) {
                    $zhitongche[] = $_train_3;
                }
            }

            try {
                $train_4 = UploadImageUtils::uploadImage('train_4', 'product');
                $zhitongche[] = $train_4;
            } catch (\Exception $exception) {
                if(!empty($_train_1)) {
                    $zhitongche[] = $_train_4;
                }
            }
            $data['zhitongche'] = !empty($zhitongche) ? json_encode($zhitongche) : null;
            foreach ($data as $key => $v) {
                $info->$key = $v;
            }

            if($info->save()) {
                $this->successJson('产品编辑成功');
            }
            $this->errorJson('产品编辑失败,请重试');

        } else {
            $tag = (int) Utils::request('tag');
            $info = Product::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
            $shop = Shop::find()->where(['user_id' => $this->login_user_id, 'state' => 2])->orderBy('id desc')->all();
            $info['zhitongche'] = !empty($info['zhitongche']) ? json_decode($info['zhitongche'], true) : [];
            return $this->render('EditProduct.php', [
                'info' => $info,
                'shop' => $shop,
            ]);
        }
    }

    /**
     * 添加商品
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionAddProduct() {
        if(Utils::isPost()) {
            $shop_id = (int) Utils::request('manager'); // 店铺ID
            $product_link = Utils::request('link'); // 商品链接
            $product_title = Utils::request('headline'); // 商品标题
            $product_id = Utils::request('pid'); // 商品ID
            $product_shortname = Utils::request('abbreviation'); // 商品简称
            $product_weight = (float) Utils::request('weight'); // 商品重量 KG
            $customer_target_id = (int) Utils::request('template_target'); // 目标客户模板ID
            $buy_behavior_id = (int) Utils::request('template_behavior'); // 购买行为模板ID

            // 商品主图
            try {
                $index_image = UploadImageUtils::uploadImage('master', 'product');
                $index_image = $index_image;
            } catch (\Exception $exception) {

            }

            //  APP主图 二维码图片 直通车图片 非必填
            // APP主图
            try {
                $app_index_image = UploadImageUtils::uploadImage('wireless', 'product');
                $app_index_image = $app_index_image;
            } catch (\Exception $exception) {

            }

            // 二维码图片
            try {
                $qrcode = UploadImageUtils::uploadImage('qrcode', 'product');
                $qrcode = $qrcode;
            } catch (\Exception $exception) {

            }

            // 直通车图片
            $zhitongche = [];
            try {
                $train_1 = UploadImageUtils::uploadImage('train_1', 'product');
                $zhitongche[] = $train_1;
            } catch (\Exception $exception) {

            }
            try {
                $train_2 = UploadImageUtils::uploadImage('train_2', 'product');
                $zhitongche[] = $train_2;
            } catch (\Exception $exception) {

            }
            try {
                $train_3 = UploadImageUtils::uploadImage('train_3', 'product');
                $zhitongche[] = $train_3;
            } catch (\Exception $exception) {

            }

            try {
                $train_4 = UploadImageUtils::uploadImage('train_4', 'product');
                $zhitongche[] = $train_4;
            } catch (\Exception $exception) {

            }

            $shop_info = Shop::findOne(['user_id' => $this->login_user_id, 'state' => 2, 'id' => $shop_id]);
            if(empty($shop_info)) {
                $this->errorJson('店铺不存在');
            }

            if(!ValidatorUtils::isUrl($product_link)) {
                $this->errorJson('产品地址错误');
            }

            if(empty($product_title)) {
                $this->errorJson('请填写产品标题');
            }

            if(empty($product_id)) {
                $this->errorJson('请填写产品ID');
            }

            $goods_id = ProductReleaseUtils::getGoodsIdByUrl($product_link);
            if($goods_id != $product_id) {
                $this->errorJson('产品连接与产品ID不符');
            }

            if(!isset($index_image) || empty($index_image)) {
                $this->errorJson('请上传产品主图');
            }

            if(empty($product_shortname)) {
                $this->errorJson('请输入产品简称');
            }

            if($product_weight <= 0) {
                $this->errorJson('请填写有效的产品重量');
            }

            $cus_temp = CustomerTargetTemplate::findOne(['id' => $customer_target_id, 'state' => 1, 'user_id' => $this->login_user_id]);
            $customer_setting = null;
            if(empty($cus_temp)) {
                $customer_target_id = null;
            } else {
                $customer_setting = json_encode($cus_temp->getAttributes());
            }

            $buy_temp = BuyBehaviorTemplate::findOne(['id' => $buy_behavior_id, 'state' => 1, 'user_id' => $this->login_user_id]);
            $buy_setting = null;
            if(empty($buy_temp)) {
                $buy_behavior_id = null;
            } else {
                $buy_setting = json_encode($buy_temp->getAttributes());
            }

            if(!isset($app_index_image) || empty($app_index_image)) {
                $app_index_image = null;
            }

            if(!isset($qrcode) || empty($qrcode)) {
                $qrcode = null;
            }
            $zhitongche = !empty($zhitongche) ? json_encode($zhitongche) : null;
            $model = new Product();
            $model->user_id = $this->login_user_id;
            $model->shop_id = $shop_id;
            $model->product_link = $product_link;
            $model->product_title = $product_title;
            $model->product_id = $product_id;
            $model->index_image = $index_image;
            $model->product_shortname = $product_shortname;
            $model->product_weight = $product_weight;
            $model->customer_target_id = $customer_target_id;
            $model->customer_setting = $customer_setting;
            $model->buy_behavior_id = $buy_behavior_id;
            $model->buy_setting = $buy_setting;
            $model->app_index_image = $app_index_image;
            $model->qrcode = $qrcode;
            $model->zhitongche = $zhitongche;
            $model->state = 1;
            $model->create_time = Utils::dateYmd();
            if($model->save()) {
                $this->successJson('产品发布成功');
            }
            $this->errorJson('产品发布失败,请重试');
        } else {
            $shop = Shop::find()->where(['user_id' => $this->login_user_id, 'state' => 2])->orderBy('id desc')->all();
            $cus_temp = CustomerTargetTemplate::find()->where(['user_id' => $this->login_user_id, 'state' => 1])->orderBy('id desc')->all();
            $beh_temp = BuyBehaviorTemplate::find()->where(['user_id' => $this->login_user_id, 'state' => 1])->orderBy('id desc')->all();
            return $this->render('add-product.php', [
                'shop' => $shop,
                'cus_temp' => $cus_temp,
                'beh_temp' => $beh_temp
            ]);
        }

    }

    /**
     * 目标客户设置
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionTargetCustomer() {
        $tag = (int) Utils::request('tag');
        $info = Product::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
        if(Utils::isPost()) {

            if(empty($info)) {
                $this->errorJson('产品不存在');
            }

            $sex = Utils::request('sex');
            $age = Utils::request('age');
            $province = Utils::request('province');
            $data['gender'] = $sex == 'on' ? 1 : 0;
            $data['male_percent'] = null;
            $data['female_percent'] = null;
            $data['age'] = $age == 'on' ? 1 : 0;
            $data['age18_24'] = null;
            $data['age25_33'] = null;
            $data['age34_50'] = null;
            if(is_array($province)) {
                $province = array_keys($province);
                $province = ProductReleaseUtils::question($province);
            } else {
                $province = [];
            }
            $data['exclude_province'] = !empty($province) ? implode(' ', $province) : null;
            if($sex == 'on') {
                $Sex = Utils::request('Sex');
                if(!isset($Sex[0]) || !isset($Sex[1])) {
                    $this->errorJson('请设置男女性别比列');
                }

                if((int)$Sex[0] + (int) $Sex[1] != 100) {
                    $this->errorJson('男女性别比列和为100');
                }
                $data['male_percent'] = ((int)$Sex[0]) / 100;
                $data['female_percent'] = ((int)$Sex[1]) / 100;
            }

            if($age == 'on') {
                $Age = Utils::request('Age');
                if(!isset($Age['younger']) || !isset($Age['middle']) || !isset($Age['older'])) {
                    $this->errorJson('请设置年龄比列');
                }
                if((int)$Age['younger'] + (int) $Age['middle'] + (int) $Age['older'] != 100) {
                    $this->errorJson('年龄比列和为100');
                }
                $data['age18_24'] = ((int)$Age['younger']) / 100;
                $data['age25_33'] = ((int)$Age['middle']) / 100;
                $data['age34_50'] = ((int)$Age['older']) / 100;
            }
            $info->customer_setting = json_encode($data);
            $info->update_time = Utils::dateYmd();
            if($info->save()) {
                $this->successJson('模板设置成功');
            }
            $this->errorJson('模板设置失败,请重试');
        } else {
            if(empty($info)) {
                echo "产品不存在";exit;
            }
            $list = CustomerTargetTemplate::find()->where(['user_id' => $this->login_user_id, 'state' => 1])->orderBy('id desc')->all();
            $setting = [];
            if(!empty($list)) {
                foreach ($list as $v) {
                    //
                    //{"sex":"["10","90"]","age":"{"younger":"10","middle":"20","older":"70"}","province":"{"u5c71u4e1c":"1","u5e7fu4e1c":"1","u6e56u5317":"1","u5317u4eac":"1"}}
                    $province_temp = explode(' ', $v['exclude_province']);
                    $province = [];
                    if(!empty($province_temp)) {
                        foreach ($province_temp as $p) {
                            $province[$p] = 1;
                        }
                    }
                    $setting[] = [
                        'template_name' => $v['template_name'],
                        'id' => $v['id'],
                        'setting' => [
                            'sex' => json_encode([
                                $v['male_percent'] * 100,
                                $v['female_percent'] * 100,
                            ]),
                            'age' => json_encode([
                                'younger' => $v['age18_24'] * 100,
                                'middle' => $v['age25_33'] * 100,
                                'older' => $v['age34_50'] * 100,
                            ]),
                            'province' => json_encode($province)
                        ]
                    ];
                }
            }

            if(!empty($info['customer_setting'])) {
                $info['customer_setting'] = json_decode($info['customer_setting'], true);
            }

            return $this->render('TargetCustomer.php', [
                'info' => $info,
                'setting' => $setting,
            ]);
        }
    }

    /**
     * 购买行为设置
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionBehavior() {
        $tag = (int) Utils::request('tag');
        $info = Product::findOne(['id' => $tag, 'user_id' => $this->login_user_id]);
        if(Utils::isPost()) {

            if(empty($info)) {
                $this->errorJson('产品不存在');
            }

            $bookmark = (int)Utils::request('bookmark');
            $c_goods = (int) Utils::request('c_goods');
            $add_car = (int) Utils::request('add_car');
            $talk = (int) Utils::request('talk');
            $compare = Utils::request('compare');
            $browse = Utils::request('browse');

            if($bookmark < 0 || $bookmark > 100) {
                $this->errorJson('收藏店铺百分比不能大于100');
            }

            if($c_goods < 0 || $c_goods > 100) {
                $this->errorJson('收藏商品百分比不能大于100');
            }

            if($add_car < 0 || $add_car > 100) {
                $this->errorJson('加入购物车百分比不能大于100');
            }

            if($talk < 0 || $talk > 100) {
                $this->errorJson('拍前咨询百分比不能大于100');
            }

            if(!isset($compare['not']) || !isset($compare['com1']) || !isset($compare['com2']) || !isset($compare['com3'])) {
                $this->errorJson('货比N家比例之和必须为100');
            }

            if(!isset($browse['net']) || !isset($browse['shop1']) || !isset($browse['shop2']) || !isset($browse['shop3'])) {
                $this->errorJson('浏览深度比例之和必须为100');
            }

            $data['shop_collection_percent'] = $bookmark / 100;
            $data['product_collection_percent'] = $c_goods / 100;
            $data['add_cart_percent'] = $add_car / 100;
            $data['chat_percent'] = $talk / 100;

            $data['product_contrast_percent_0'] = ((int)$compare['not']) / 100;
            $data['product_contrast_percent_1'] = ((int)$compare['com1']) / 100;
            $data['product_contrast_percent_2'] = ((int)$compare['com2']) / 100;
            $data['product_contrast_percent_3'] = ((int)$compare['com3']) / 100;

            if((int)($compare['not'] + $compare['com1'] + $compare['com2'] + $compare['com3']) != 100) {
                $this->errorJson('货比N家比例之和必须为100');
            }

            $data['scan_percent_0'] = ((int)$browse['net']) / 100;
            $data['scan_percent_1'] = ((int)$browse['shop1']) / 100;
            $data['scan_percent_2'] = ((int)$browse['shop2']) / 100;
            $data['scan_percent_3'] = ((int)$browse['shop3']) / 100;

            if((int)($browse['net'] + $browse['shop1'] + $browse['shop2'] + $browse['shop3']) != 100) {
                $this->errorJson('浏览深度比例之和必须为100');
            }

            $info->buy_setting = json_encode($data);
            $info->update_time = Utils::dateYmd();
            if($info->save()) {
                $this->successJson('模板设置成功');
            }
            $this->errorJson('模板设置失败,请重试');

        } else {
            if(empty($info)) {
                echo "产品不存在";exit;
            }
            $list = BuyBehaviorTemplate::find()->where(['user_id' => $this->login_user_id, 'state' => 1])->orderBy('id desc')->all();
            $setting = [];
            if(!empty($list)) {
                foreach ($list as $v) {
                    $setting[] = [
                        'template_name' => $v['template_name'],
                        'id' => $v['id'],
                        'setting' => [
                            'bookmark' => $v['shop_collection_percent'] * 100,
                            'c_goods' => $v['product_collection_percent'] * 100,
                            'add_car' => $v['add_cart_percent'] * 100,
                            'talk' => $v['chat_percent'] * 100,
                            'x_home' => json_encode([
                                'not' => $v['product_contrast_percent_0'] * 100,
                                'com1' => $v['product_contrast_percent_1'] * 100,
                                'com2' => $v['product_contrast_percent_2'] * 100,
                                'com3' => $v['product_contrast_percent_3'] * 100,
                            ]),
                            'deep' => json_encode([
                                'net' => $v['scan_percent_0'] * 100,
                                'shop1' => $v['scan_percent_1'] * 100,
                                'shop2' => $v['scan_percent_2'] * 100,
                                'shop3' => $v['scan_percent_3'] * 100,
                            ]),
                        ]
                    ];
                }
            }
            if(!empty($info['buy_setting'])) {
                $info['buy_setting'] = json_decode($info['buy_setting'], true);
            }
            return $this->render('Behavior.php', [
                'info' => $info,
                'setting' => $setting,
            ]);
        }
    }


    /**
     * 用户资料修改
     * @throws \Yii\base\ExitException
     * @throws yii\base\Exception
     */
    public function actionSetSocial() {
        $this->postMethod();
        $type = (int) Utils::request('type');
        $code = Utils::request('code');
        $account = Utils::request('account');
        $pwd1 = Utils::request('pwd1');
        $pwd2 = Utils::request('pwd2');

        $info = User::findOne($this->login_user_id);
        if(empty($info)) {
            $this->errorJson('用户不存在');
        }

        switch ($type) {
            case 1:
                if(!ValidatorUtils::isPassword($pwd1)) {
                    $this->errorJson('密码格式错误,密码由数字、字母或下划线组成,长度6-18位');
                }

                if($pwd1 != $pwd2) {
                    $this->errorJson('两次输入密码不一致');
                }
                $info->safety_code = $pwd1;
                break;
            case 2:
                if(!ValidatorUtils::isQq($account)) {
                    $this->errorJson('QQ号格式错误');
                }
                $info->qq = $account;
                break;
            case 3:
                if(empty($account)) {
                    $this->errorJson('微信格式错误');
                }
                $info->wechat = $account;
                break;
            default:
                if(!ValidatorUtils::isPassword($pwd1)) {
                    $this->errorJson('密码格式错误,密码由数字、字母或下划线组成,长度6-18位');
                }

                if($pwd1 != $pwd2) {
                    $this->errorJson('两次输入密码不一致');
                }
                $info->password = LoginUtils::getEncryptPassword($pwd1);
                break;
        }

        if($code != $info['safety_code']) {
            $this->errorJson('安全操作码错误');
        }


        $info->update_time = Utils::dateYmd();
        if($info->save()) {
            $this->successJson('帐号设置成功');
        }
        $this->errorJson('帐号设置失败,请重试');
    }

    public function actionT() {
        $cus_temp = CustomerTargetTemplate::findOne(['id' => 1, 'state' => 1, 'user_id' => $this->login_user_id]);
        print_r($cus_temp->getAttributes());
    }
}