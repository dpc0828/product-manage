<?php


namespace app\controllers;


use app\models\Product;
use app\models\Shop;
use app\models\Task;
use app\models\TaskAddvalueSetting;
use app\models\TaskFlowSetting;
use app\models\TaskProduct;
use app\models\TaskReleaseTime;
use app\models\User;
use app\utils\ProductReleaseUtils;
use app\utils\Utils;
use app\utils\ValidatorUtils;
use yii;

class TaskController extends BaseController
{
    public $layout = false;
    public function actionIndex() {

        return $this->render('index.php');
    }

    /**
     * 发布任务
     */
    public function actionRelease() {
        return $this->render('release.php');
    }

    /**
     * 待接任务
     * @return string
     * @throws \Exception
     */
    public function actionWait() {
        $task_type = (int) Utils::request('tasktype');
        $state = (int) Utils::request('state');
        $key = Utils::request('key');
        $search_value = Utils::request('search_value');
        $time = Utils::request('time');
        $start = Utils::request('start');
        $end = Utils::request('end');
        // 任务状态 3:待接  6:已接 9:已完成 12:取消任务
        $where[] = 'and';
        $where[] = ['=', 't.user_id', $this->login_user_id];
        $where[] = ['=', 't.state', 3];

        if($state == 1 || $state == 2) {
            $where[] = ['=', 't.is_hide', $state];
        }

        if($task_type > 0) {
            $where[] = ['=', 't.task_type', $task_type];
        }

        if(!empty($search_value)) {
            switch ($key) {
                case 'shopname':
                    $where[] = ['=', 's.shop_name', $search_value]; # 店铺名
                    break;
                case 'commodity_id':
                    $where[] = ['=', 'p.product_id', $search_value]; # 产品ID
                    break;
                case 'keyword':
                    $where[] = [
                        'or',
                        ['like', 'p.product_title', $search_value],
                        ['like', 'p.product_shortname', $search_value]
                    ];
                    break;
            }
        }

        $time_type = 't.create_time';
        switch ($time) {
            case 'catchertime':
                $time_type = 'receive_time';
                break;
            case 'issuetime':
                $time_type = 'create_time';
                break;
            case 'orders_interval':
                $time_type = 'order_time';
                break;
        }

        if(!empty($start) && ValidatorUtils::isDate($start)) {
            $where[] = ['>=', $time_type, $start];
        }

        if(!empty($end) && ValidatorUtils::isDate($end)) {
            $where[] = ['<=', $time_type, $end];
        }


        $field = [
            't.*',
            's.shop_name',
            'f.flow_type,f.vie_keyword1,f.vie_keyword2,f.vie_keyword3,f.target_keyword',
            'p.product_link,p.product_title,p.product_shortname',
            'tp.commission,tp.deliver_price,tp.buy_quantity,tp.price',
            'tm.release_type,tm.release_quantity,tm.start_time,tm.end_time,tm.timeout_time',
        ];

        $model = Task::find()->alias('t')
            ->innerJoin(TaskProduct::tableName() . ' tp', 'tp.task_id = t.id')
            ->innerJoin(TaskFlowSetting::tableName() . ' f', 'f.task_id = t.id')
            ->innerJoin(Product::tableName() . ' p', 'p.id = t.product_id')
            ->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id')
            ->innerJoin(TaskReleaseTime::tableName() . ' tm', 'tm.task_id = t.id');
        $list = $model->select(implode(',', $field))->where($where)->orderBy('t.id desc')
            ->offset($this->_offset)->limit($this->_page_size)
            ->asArray()
            ->all();
        return $this->render('wait.php', [
            'list' => $list,
            'total' => (int) $model->where($where)->count(),
            'page' => $this->_page,
        ]);
    }

    /**
     * 取消任务
     * @throws \Yii\base\ExitException
     * @throws yii\db\Exception
     */
    public function actionCancelTask() {
        if(Utils::isPost()) {
            $key = (int) Utils::request('key');
            $info = Task::findOne(['id' => $key, 'user_id' => $this->login_user_id]);
            if(empty($info)) {
                $this->errorJson('任务不存在');
            }

            if(yii::$app->db->createCommand()->update(Task::tableName(), [
                'state' => 12,
                'cancel_remark' => '用户手动取消',
                'cancel_time' => Utils::dateYmd(),
                'update_time' => Utils::dateYmd()
            ], [
                'id' => $key,
                'user_id' => $this->login_user_id,
                'state' => 3
            ])->execute()) {
                $this->successJson('任务取消成功');
            }
            $this->errorJson('取消失败,请重试');
        }
    }

    /**
     * 已接任务
     * @return string
     * @throws \Exception
     */
    public function actionReceived() {
        $task_type = (int) Utils::request('tasktype');
        $key = Utils::request('key');
        $search_value = Utils::request('search_value');
        $time = Utils::request('time');
        $start = Utils::request('start');
        $end = Utils::request('end');
        // 任务状态 3:待接  6:已接 9:已完成 12:取消任务
        $where[] = 'and';
        $where[] = ['=', 't.user_id', $this->login_user_id];
        $where[] = ['in', 't.state', [6, 9]];

        if($task_type > 0) {
            $where[] = ['=', 't.task_type', $task_type];
        }

        if(!empty($search_value)) {
            switch ($key) {
                case 'tasksn':
                    $where[] = ['=', 't.task_no', $search_value]; # 任务号
                    break;
                case 'shopname':
                    $where[] = ['=', 's.shop_name', $search_value]; # 店铺名
                    break;
                case 'ordersn':
                    $where[] = ['=', 't.task_no', $search_value]; # 订单号
                    break;
                case 'wangwang':
                    $where[] = ['=', 't.task_no', $search_value]; #  买家旺旺
                    break;
                case 'commodity_id':
                    $where[] = ['=', 'p.product_id', $search_value]; # 产品ID
                    break;
                case 'keyword':
                    $where[] = [
                        'or',
                        ['like', 'p.product_title', $search_value],
                        ['like', 'p.product_shortname', $search_value]
                    ];
                    break;
            }
        }

        $time_type = 't.pay_time';
        switch ($time) {
            case 'catchertime':
                $time_type = 'receive_time';
                break;
            case 'issuetime':
                $time_type = 'create_time';
                break;
            case 'orders_interval':
                $time_type = 'order_time';
                break;
        }

        if(!empty($start) && ValidatorUtils::isDate($start)) {
            $where[] = ['>=', $time_type, $start];
        }

        if(!empty($end) && ValidatorUtils::isDate($end)) {
            $where[] = ['<=', $time_type, $end];
        }


        $field = [
            't.*',
            's.shop_name',
            'f.flow_type,f.vie_keyword1,f.vie_keyword2,f.vie_keyword3,f.target_keyword',
            'p.product_link,p.product_title,p.product_shortname',
            'tp.commission,tp.deliver_price'
        ];

        $model = Task::find()->alias('t')
            ->innerJoin(TaskProduct::tableName() . ' tp', 'tp.task_id = t.id')
            ->innerJoin(TaskFlowSetting::tableName() . ' f', 'f.task_id = t.id')
            ->innerJoin(Product::tableName() . ' p', 'p.id = t.product_id')
            ->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id');
        $list = $model->select(implode(',', $field))->where($where)->orderBy('t.id desc')
            ->offset($this->_offset)->limit($this->_page_size)
            ->asArray()
            ->all();
        return $this->render('received.php', [
            'list' => $list,
            'total' => (int) $model->where($where)->count(),
            'page' => $this->_page,
        ]);
    }


    /**
     * 任务详情
     * @return string
     * @throws \Exception
     */
    public function actionTaskDetails() {
        $id = (int) Utils::request('tid');
        $task = Task::findOne(['id' => $id, 'user_id' => $this->login_user_id]);
        if(empty($task)) {
            echo "任务不存在";
        }
        $release = TaskReleaseTime::find()->where(['task_id' => $id])->all();
        $product = Product::findOne(['id' => $task['product_id']]);
        $shop = Shop::findOne(['id' => $product['shop_id']]);
        $task_product = TaskProduct::findOne(['task_id' => $id]);
        $flow = TaskFlowSetting::findOne(['task_id' => $id]);
        return $this->render('TaskDetail.php', [
            'release' => $release,
            'product' => $product,
            'shop' => $shop,
            'flow' => $flow,
            'task' => $task,
            'task_product' => $task_product,
        ]);
    }


    /**
     * @return string 评价管理
     */
    public function actionEvaluate() {

        return $this->render('evaluate.php');
    }

    /**
     * @return string 追评管理
     */
    public function actionAdditional() {
        return $this->render('additional.php');
    }

    /**
     * @return string 物流管理
     */
    public function actionLogistics() {
        return $this->render('logistics.php');
    }

    /**
     * 无效任务
     * @return string
     * @throws \Exception
     */
    public function actionFailure() {
        $task_type = (int) Utils::request('tasktype');
        $state = (int) Utils::request('state');
        $key = Utils::request('key');
        $search_value = Utils::request('search_value');
        $time = Utils::request('time');
        $start = Utils::request('start');
        $end = Utils::request('end');
        // 任务状态 3:待接  6:已接 9:已完成 12:取消任务
        $where[] = 'and';
        $where[] = ['=', 't.user_id', $this->login_user_id];
        $where[] = ['=', 't.state', 12];

        if($state == 1 || $state == 2) {
            $where[] = ['=', 't.is_hide', $state];
        }

        if($task_type > 0) {
            $where[] = ['=', 't.task_type', $task_type];
        }

        if(!empty($search_value)) {
            switch ($key) {
                case 'shopname':
                    $where[] = ['=', 's.shop_name', $search_value]; # 店铺名
                    break;
                case 'commodity_id':
                    $where[] = ['=', 'p.product_id', $search_value]; # 产品ID
                    break;
                case 'keyword':
                    $where[] = [
                        'or',
                        ['like', 'p.product_title', $search_value],
                        ['like', 'p.product_shortname', $search_value]
                    ];
                    break;
            }
        }

        $time_type = 't.create_time';
        switch ($time) {
            case 'catchertime':
                $time_type = 'receive_time';
                break;
            case 'issuetime':
                $time_type = 'create_time';
                break;
            case 'orders_interval':
                $time_type = 'order_time';
                break;
        }

        if(!empty($start) && ValidatorUtils::isDate($start)) {
            $where[] = ['>=', $time_type, $start];
        }

        if(!empty($end) && ValidatorUtils::isDate($end)) {
            $where[] = ['<=', $time_type, $end];
        }


        $field = [
            't.*',
            's.shop_name',
            'f.flow_type,f.vie_keyword1,f.vie_keyword2,f.vie_keyword3,f.target_keyword',
            'p.product_link,p.product_title,p.product_shortname',
            'tp.commission,tp.deliver_price,tp.buy_quantity,tp.price',
            'tm.release_type,tm.release_quantity,tm.start_time,tm.end_time,tm.timeout_time',
        ];

        $model = Task::find()->alias('t')
            ->innerJoin(TaskProduct::tableName() . ' tp', 'tp.task_id = t.id')
            ->innerJoin(TaskFlowSetting::tableName() . ' f', 'f.task_id = t.id')
            ->innerJoin(Product::tableName() . ' p', 'p.id = t.product_id')
            ->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id')
            ->innerJoin(TaskReleaseTime::tableName() . ' tm', 'tm.task_id = t.id');
        $list = $model->select(implode(',', $field))->where($where)->orderBy('t.id desc')
            ->offset($this->_offset)->limit($this->_page_size)
            ->asArray()
            ->all();
        return $this->render('failure.php', [
            'list' => $list,
            'total' => (int) $model->where($where)->count(),
            'page' => $this->_page,
        ]);
    }

    /**
     * 产品设置隐藏
     * @throws \Yii\base\ExitException
     */
    public function actionChangeTaskStatus() {
        if(Utils::isPost()) {
            $tid = (int) Utils::request('tid');
            $info = Task::findOne(['id' => $tid, 'user_id' => $this->login_user_id]);
            if(empty($info)) {
                $this->errorJson('任务不存在');
            }

            $info->is_hide = $info->is_hide == 1 ? 2 : 1;
            $info->update_time = Utils::dateYmd();
            if($info->save()) {
                $this->successJson('设置成功');
            }
            $this->errorJson('设置失败,请重试');
        }
    }

    /**
     * 淘宝问大家
     * @return string
     */
    public function actionFaqs() {
        return $this->render('faqs.php');
    }

    /**
     * 产品选择
     * @return string
     * @throws \Exception
     */
    public function actionSelectProduct() {
        $tag = (int) Utils::request('tag');
        $type = (int) Utils::request('type');
        $sid = (int) Utils::request('sid');
        $key = Utils::request('key');
        $search_value = Utils::request('search_value');

        $where[] = 'and';
        $where[] = ['=', 'p.state', 1];
        $where[] = ['=', 'p.user_id', $this->login_user_id];
        if(!empty($sid)) {
            $where[] = ['=', 'p.shop_id', $sid];
        }

        if(!empty($search_value)) {
            if($key == 'commodity_id') {
                $where[] = ['=', 'p.product_id', $search_value];
            } else {
                $where[] = [
                    'or',
                    ['like', 'p.product_shortname', $search_value],
                    ['like', 'p.product_title', $search_value],
                ];
            }
        }


        $model = Product::find()->alias('p')
            ->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id')
            ->where($where);
        $list = $model->select('p.product_shortname as commodity_abbreviation, 
        p.product_id as commodity_id, p.index_image as commodity_image, p.product_title as commodity_title, p.id, 
        s.shop_name as shopname, p.state as status, p.shop_id, p.product_link')->orderBy('p.id desc')
            ->asArray()->all();

        $shop = Shop::find()->where(['user_id' => $this->login_user_id, 'state' => 2])->orderBy('id desc')->all();

        return $this->render('SelectProduct.php', [
            'tag' => $tag,
            'type' => $type,
            'list' => $list,
            'shop' => $shop,
            'sid' => $sid,
            'key' => $key,
            'search_value' => $search_value,
        ]);
    }

    /**
     * ?
     * @throws \Yii\base\ExitException
     */
    public function actionPullInfo() {
        $this->successJson('success', [
            'info' => false,
            'relevanceFlow' => [
                'pro' => null,
                'shop' => null,
            ],
            'bond' => null,
        ]);
    }

    /**
     * 发布任务
     * @throws \Yii\base\ExitException
     */
    public function actionIssue() {
        $this->postMethod();
        try {
            $tasktype = (int) Utils::request('tasktype');
            $tasktype = in_array($tasktype, ProductReleaseUtils::$task_type) ? $tasktype : 1;
            $product_id = (int) Utils::request('proid');
            $entrance = Utils::request('entrance');
            $vie_keyword = Utils::request('vie_keyword');
            $keyword = Utils::request('keyword');
            $gross = Utils::request('gross');
            $same_flow = Utils::request('same_flow');
            $orderby = Utils::request('orderby');
            $price_min = Utils::request('price_min');
            $price_max = Utils::request('price_max');
            $sendaddress = Utils::request('sendaddress');
            $other = Utils::request('other');
            $usually_cate = Utils::request('invert');
            $deliver_type = (int) Utils::request('express_type');
            $deliver_type = $deliver_type == 1 ? 1 : 0;
            $relevance_flow = (int) Utils::request('relevance_flow');
            $top_remind = Utils::request('top_remind');
            $no_img = (int) Utils::request('no_img');
            $require = Utils::request('require');
            $remark = Utils::request('remark');
            $basics_slide = (float) Utils::request('basics_slide');
            $basics_slide = Utils::priceWithRounding($basics_slide);
            $appreciation = Utils::request('appreciation');
            $quiz = Utils::request('quiz');
            $price = Utils::request('price'); // 商品单价
            $express = Utils::request('express'); // 快递费
            $pat_num = Utils::request('pat_num'); // 拍下件数
            $pat_count = Utils::request('pat_count'); // 任务数量
            $Model = Utils::request('Model'); // 型号
            $release_time = (int) Utils::request('release_time');
            $release_time = in_array($release_time, ProductReleaseUtils::$release_type) ? $release_time : 0;
            $alone = (int) Utils::request('alone');
            $release_time = $alone == 1 ? 3 : $release_time;
            $date = Utils::request('date');
            $cancel = Utils::request('cancel');
            $begin = Utils::request('begin');
            $over = Utils::request('over');
            $day_num = Utils::request('day_num');
            $safety = Utils::request('safety');
            $user_info = User::findOne($this->login_user_id);
            if(!empty($user_info['safety_code']) && $safety != $user_info['safety_code']) {
                $this->errorJson('安全码错误');
            }

            if($tasktype != 1) {
                $this->errorJson('目前仅开放销量任务,其他功能开发中...');
            }

            if(!is_array($entrance)) {
                $this->errorJson('流量入口选择错误');
            }

            if(!is_array($vie_keyword)) {
                $this->errorJson('货比词参数错误');
            }

            if(!is_array($keyword)) {
                $this->errorJson('目标关键词错误');
            }

            if(!is_array($gross)) {
                $this->errorJson('来路设置-数量必填');
            }

            $total_task_quantity = 0; //来路设置-任务总量
            $total_pat_count = 0; // 定价类型-任务总量
            $keyword_quantity = 0; // 关键词总量
            $flow_data = [];
            // 流量入口
            foreach ($entrance as $key => $entrance_li) {
                $vie_keyword_quantity = 0;
                if(!in_array($entrance_li, ProductReleaseUtils::$flow_type)) {
                    $this->errorJson('来路设置-流量入口必选');
                }
                $flow_data[$key]['user_id'] = $this->login_user_id;
                $flow_data[$key]['product_id'] = $product_id;
                $flow_data[$key]['task_id'] = 0;
                $flow_data[$key]['flow_type'] = (int) $entrance_li;
                $flow_data[$key]['vie_keyword1'] = null;
                $flow_data[$key]['vie_keyword2'] = null;
                $flow_data[$key]['vie_keyword3'] = null;
                if(isset($vie_keyword[$key])) {
                    $vie_keyword_array = ProductReleaseUtils::vieKeyword($vie_keyword[$key]);
                    if(!empty($vie_keyword_array)) {
                        foreach ($vie_keyword_array as $vie_keyword_key => $vie_keyword_array_li) {
                            $vie_keyword_quantity += 1;
                            $flow_data[$key]['vie_keyword' . ($vie_keyword_key + 1)] = $vie_keyword_array_li;
                        }
                    }
                }
                if(!isset($keyword[$key]) || empty($keyword[$key])) {
                    $this->errorJson('来路设置-目标关键词必填');
                }
                $flow_data[$key]['target_keyword'] = $keyword[$key];
                $keyword_quantity += 1;
                if(!isset($gross[$key]) || (int)$gross[$key] <= 0) {
                    $this->errorJson('来路设置-数量须大于0');
                }
                $flow_data[$key]['quantity'] = (int) $gross[$key];
                $task_quantity = (int) $gross[$key]; // 任务总量
                $total_task_quantity += $task_quantity;
                $vie_keyword_fee = $vie_keyword_quantity * (int) $gross[$key] * ProductReleaseUtils::$vie_keyword_fee; // 比货词费用

                if(in_array($entrance_li, ProductReleaseUtils::$allow_same_flow)) {
                    $flow_data[$key]['same_flow'] = isset($same_flow[$key]) && in_array($same_flow[$key], [0 ,1]) ? $same_flow[$key] : 0;
                } else {
                    $flow_data[$key]['same_flow'] = 0;
                }
                $flow_data[$key]['sort_type'] = 1;
                if(isset($orderby[$key]) && in_array($orderby[$key], ProductReleaseUtils::$sort_type)) {
                    $flow_data[$key]['sort_type'] = (int) $orderby[$key];
                }
                $price_min_li = isset($price_min[$key]) && is_numeric($price_min[$key]) ? Utils::priceWithRounding($price_min[$key]) : null;
                $price_max_li = isset($price_max[$key]) && is_numeric($price_max[$key]) ? Utils::priceWithRounding($price_max[$key]) : null;

                if(!is_null($price_min_li) && !ValidatorUtils::isMoney($price_min_li)) {
                    $this->errorJson('来路设置-其他搜索条件-价格设置错误');
                }
                if(!is_null($price_max_li) && !ValidatorUtils::isMoney($price_max_li)) {
                    $this->errorJson('来路设置-其他搜索条件-价格设置错误');
                }

                if(!is_null($price_min_li) && !is_null($price_max_li) && $price_min_li >= $price_max_li) {
                    $this->errorJson('来路设置-其他搜索条件-价格范围设置错误');
                }
                $flow_data[$key]['price_min'] = $price_min_li;
                $flow_data[$key]['price_max'] = $price_max_li;
                $flow_data[$key]['sendaddress'] = isset($sendaddress[$key]) && !empty($sendaddress[$key]) ? $sendaddress[$key] : null;
                $flow_data[$key]['other'] = isset($other[$key]) && !empty($other[$key]) ? $other[$key] : null;
                $flow_data[$key]['create_time'] = Utils::dateYmd();


                // 设置了流量单
                $value_added_fee = 0; // 总增值费
                if($flow_data[$key]['same_flow'] == 1) {
                    $basics_slide = $basics_slide < 1 || $basics_slide > 6 ? 1 : $basics_slide;
                    // 流量单增值服务
                    $addvalue[$key]['user_id'] = $this->login_user_id;
                    $addvalue[$key]['product_id'] = $product_id;
                    $addvalue[$key]['task_id'] = 0;

                    foreach (ProductReleaseUtils::$flow_addvalue_fee as $flow_addvalue_fee_key => $flow_addvalue_fee_li) {
                        if(isset($appreciation[$flow_addvalue_fee_key])) {
                            $percent = ((int) $appreciation[$flow_addvalue_fee_key]) / 100;
                            $percent = $percent > 1 || $percent < 0.1 ? 0 : $percent;
                            $addvalue[$key][$flow_addvalue_fee_key . '_percent'] = $percent;
                            $addvalue[$key][$flow_addvalue_fee_key . '_quantity'] = round($percent * $task_quantity);
                            $addvalue[$key][$flow_addvalue_fee_key . '_price'] = $flow_addvalue_fee_li;
                            $addvalue[$key][$flow_addvalue_fee_key . '_fee'] = round($percent * $task_quantity) * $flow_addvalue_fee_li;
                            $value_added_fee += round($percent * $task_quantity) * $flow_addvalue_fee_li;
                        }
                    }

                    $question = ProductReleaseUtils::question($quiz);
                    $addvalue[$key]['question_1'] = isset($question[0]) ? $question[0] : null;
                    $addvalue[$key]['question_2'] = isset($question[1]) ? $question[1] : null;
                    $addvalue[$key]['question_3'] = isset($question[2]) ? $question[2] : null;
                    $addvalue[$key]['question_4'] = isset($question[3]) ? $question[3] : null;
                    $addvalue[$key]['question_5'] = isset($question[4]) ? $question[4] : null;
                    $addvalue[$key]['create_time'] = Utils::dateYmd();
                } else {
                    $basics_slide = 0;
                }


                // 产品定价类型
                if(!isset($price[$key])) {
                    $this->errorJson('定价类型与来路设置不一致');
                }

                if(!ValidatorUtils::isPrice($price[$key])) {
                    $this->errorJson('定价类型-商品单价错误,商品单价最多保留两位有效小数');
                }

                // 产品定价-快递
                if(!isset($express[$key]) || !ValidatorUtils::isMoney($express[$key])) {
                    $this->errorJson('定价类型-快递费错误,快递费最多保留两位有效小数');
                }

                // 产品定价类型-拍下件数
                if(!isset($pat_num[$key]) || (int) $pat_num[$key] <= 0) {
                    $this->errorJson('定价类型-拍下件数错误');
                }

                // 产品定价类型-任务数量
                if(!isset($pat_count[$key]) || (int) $pat_count[$key] <= 0) {
                    $this->errorJson('定价类型-任务数量错误');
                }

                // 定价类型
                $product_data[$key]['user_id'] = $this->login_user_id;
                $product_data[$key]['product_id'] = $product_id;
                $product_data[$key]['task_id'] = 0;
                $product_data[$key]['price'] = $price[$key];
                $product_data[$key]['deliver_price'] = $express[$key];
                $product_data[$key]['buy_quantity'] = $pat_num[$key];
                $product_data[$key]['sku'] = isset($Model[$key]) && !empty($Model[$key]) ? $Model[$key] : null;
                $product_data[$key]['task_quantity'] = (int) $pat_count[$key];

                $total_pat_count += (int) $pat_count[$key]; # 任务数量

                // 产品单价 * 拍下件数 + 快递费
                $each_price = ((int) $pat_num[$key]) * $price[$key] + $express[$key];
                $commission = ProductReleaseUtils::commissionPrice($each_price); // 计算佣金多少钱/单

                $product_data[$key]['commission'] = $commission;
                $product_data[$key]['commission_fee'] = $commission * ((int)$pat_count[$key]);
                $product_data[$key]['deliver_fee'] = $express[$key] * ((int)$pat_count[$key]);
                $product_data[$key]['product_fee'] = $price[$key] * ((int)$pat_num[$key]) * ((int)$pat_count[$key]);

                $product_data[$key]['total_fee'] = $product_data[$key]['commission_fee'] + $product_data[$key]['deliver_fee'] + $product_data[$key]['product_fee'];

                $product_total_fee = $product_data[$key]['total_fee'];
                $product_data[$key]['create_time'] = Utils::dateYmd();


                // 任务信息
                $task_data[$key]['user_id'] = $this->login_user_id;
                $task_data[$key]['product_id'] = $product_id;
                $task_data[$key]['task_type'] = $tasktype;
                $task_data[$key]['usually_cate'] = ProductReleaseUtils::usuallyCate($usually_cate);
                $task_data[$key]['deliver_type'] = $deliver_type;
                $task_data[$key]['relevance_flow'] = in_array($relevance_flow, [2, 3]) ? $relevance_flow : null;
                $task_data[$key]['chat_before_buy'] = isset($top_remind['chat']) && $top_remind['chat'] == 1 ? 1 : 0;
                $task_data[$key]['collection'] = isset($top_remind['collect']) && $top_remind['collect'] == 1 ? 1 : 0;
                $task_data[$key]['add_to_cart'] = isset($top_remind['cart']) && $top_remind['cart'] == 1 ? 1 : 0;
                $task_data[$key]['get_coupons'] = isset($top_remind['coupon']) && $top_remind['coupon'] == 1 ? 1 : 0;
                $task_data[$key]['recommon_product'] = isset($top_remind['like_pro']) && $top_remind['like_pro'] == 1 ? 1 : 0;
                $task_data[$key]['screenshot'] = $no_img == 1 ? 1 : 0;
                $task_data[$key]['task_waring'] = !empty($require) ? $require : null;
                $task_data[$key]['remark'] = !empty($remark) ? $remark : null;
                $task_data[$key]['task_quantity'] = $task_quantity;
                $task_data[$key]['vie_keyword_fee'] = $vie_keyword_fee;
                $task_data[$key]['product_fee'] = $product_total_fee;
                $task_data[$key]['basic_flow_price'] = $basics_slide;
                $task_data[$key]['basic_flow_fee'] = $basics_slide * $task_quantity;
                $task_data[$key]['value_added_fee'] = $value_added_fee;
                $task_data[$key]['deliver_fee'] = $deliver_type == 1 ? $task_quantity * ProductReleaseUtils::$deliver_fee : 0;
                $task_data[$key]['total_fee'] = $product_total_fee
                    + $task_data[$key]['deliver_fee']
                    + $task_data[$key]['value_added_fee']
                    + $task_data[$key]['basic_flow_fee']
                    + $task_data[$key]['vie_keyword_fee'];
                $task_data[$key]['create_time'] = Utils::dateYmd();
                $task_data[$key]['state'] = 3;
                $task_data[$key]['task_no'] = '';
                $task_data[$key]['create_day'] = date('Ymd');
            }

            if($total_pat_count != $total_task_quantity) {
                $this->errorJson('来路设置数量与定价类型任务数量不一致');
            }


            $release_data = [];
            if(!is_array($date) || empty($date)) {
                $this->errorJson('请填写发布时间信息');
            }

            $date_key = 0;
            foreach ($date as $date_li) {
                if(!isset($cancel[$date_key])) {
                    $this->errorJson('发布时间-超时取消时间必填');
                }

                $timeout_time = $date_li . ' ' . $cancel[$date_key];
                if(!ValidatorUtils::isDate($timeout_time)) {
                    $this->errorJson('发布时间-超时取消时间错误');
                }

                if($release_time == 0) {
                    // 当天发布
                    $start_time = Utils::dateYmd();
                    $end_time = date('Y-m-d 23:59:59', time());
                    $timeout_time = date('Y-m-d 23:59:59', time());
                } else {
                    if(!isset($begin[$date_key])) {
                        $this->errorJson('发布时间-开始时间必填');
                    }

                    $start_time = $date_li . ' ' . $begin[$date_key];
                    if(!ValidatorUtils::isDate($start_time)) {
                        $this->errorJson('发布时间-开始时间错误');
                    }

                    if(!isset($over[$date_key])) {
                        $this->errorJson('发布时间-结束时间必填');
                    }

                    $end_time = $date_li . ' ' . $over[$date_key];
                    if(!ValidatorUtils::isDate($end_time)) {
                        $this->errorJson('发布时间-结束时间错误');
                    }
                }

                if($start_time >= $end_time) {
                    $this->errorJson('发布时间-开始时间须小于结束时间');
                }

                if($end_time > $timeout_time) {
                    $this->errorJson('发布时间-结束时间须小于超时取消时间');
                }

                $release_data[$date_key]['user_id'] = $this->login_user_id;
                $release_data[$date_key]['product_id'] = $product_id;
                $release_data[$date_key]['task_id'] = 0;
                $release_data[$date_key]['release_type'] = $release_time;
                $release_data[$date_key]['release_quantity'] = 0;
                $release_data[$date_key]['start_time'] = $start_time;
                $release_data[$date_key]['end_time'] = $end_time;
                $release_data[$date_key]['timeout_time'] = $timeout_time;
                $release_data[$date_key]['create_time'] = Utils::dateYmd();
                $date_key += 1;
                if($release_time == 0 || $release_time == 1) {
                    // 立即发布和当天发布只有一条
                    break;
                }
            }

            if($release_time == 3 && count($release_data) != count($task_data)) {
                $this->errorJson('多个关键词发布时间设置错误');
            }

            $transaction = Task::getDb()->beginTransaction();
            try {
                foreach ($task_data as $task_data_key => $task_data_li) {
                    $task_data_li['task_no'] =  ProductReleaseUtils::getAvailableTaskNo();
                    $model = new Task();
                    foreach ($task_data_li as $data_key => $data_v) {
                        $model->$data_key = $data_v;
                    }
                    if(!$model->save()) {
                        throw new \Exception('发布失败,请重试');
                    }
                    $task_id = $model->id;

                    $product_data[$task_data_key]['task_id'] = $task_id;
                    $status = (int) yii::$app->db->createCommand()->insert(TaskProduct::tableName(), $product_data[$task_data_key])->execute();
                    if($status <= 0) {
                        throw new \Exception('发布失败,请重试');
                    }

                    $flow_data[$task_data_key]['task_id'] = $task_id;
                    $status = (int) yii::$app->db->createCommand()->insert(TaskFlowSetting::tableName(), $flow_data[$task_data_key])->execute();
                    if($status <= 0) {
                        throw new \Exception('发布失败,请重试');
                    }

                    if(isset($addvalue) && isset($addvalue[$task_data_key])) {
                        $addvalue[$task_data_key]['task_id'] = $task_id;
                        $status = (int) yii::$app->db->createCommand()->insert(TaskAddvalueSetting::tableName(), $addvalue[$task_data_key])->execute();
                        if($status <= 0) {
                            throw new \Exception('发布失败,请重试');
                        }
                    }

                    // 发布时间 0:立即发布 1:今日平均发布 2:多天平均发布 3:关键词单独发布
                    if($release_time == 3) {
                        $release_data[$task_data_key]['task_id'] = $task_id;
                        $release_data[$task_data_key]['release_quantity'] = $task_data_li['task_quantity'];
                        $status = (int) yii::$app->db->createCommand()->insert(TaskReleaseTime::tableName(), $release_data[$task_data_key])->execute();
                        if($status <= 0) {
                            throw new \Exception('发布失败,请重试');
                        }
                    } elseif ($release_time == 2) {
                        if(count($release_data) == count($task_data)) {
                            $release_data[$task_data_key]['task_id'] = $task_id;
                            $release_data[$task_data_key]['release_quantity'] = $task_data_li['task_quantity'];
                            $status = (int) yii::$app->db->createCommand()->insert(TaskReleaseTime::tableName(), $release_data[$task_data_key])->execute();
                            if($status <= 0) {
                                throw new \Exception('发布失败,请重试');
                            }
                        } else {
                            $release_data[0]['task_id'] = $task_id;
                            $release_data[0]['release_quantity'] = $task_data_li['task_quantity'];
                            $status = (int) yii::$app->db->createCommand()->insert(TaskReleaseTime::tableName(), $release_data[0])->execute();
                            if($status <= 0) {
                                throw new \Exception('发布失败,请重试');
                            }
                        }
                    } else {
                        foreach ($release_data as $release_data_li) {
                            $release_data_li['task_id'] = $task_id;
                            $release_data_li['release_quantity'] = $task_data_li['task_quantity'];
                            $status = (int) yii::$app->db->createCommand()->insert(TaskReleaseTime::tableName(), $release_data_li)->execute();
                            if($status <= 0) {
                                throw new \Exception('发布失败,请重试');
                            }
                        }
                    }
                }
                $transaction->commit();
            } catch (\Exception $exception) {
                $transaction->rollBack();
//                 print_r($exception->getTraceAsString());
                $this->errorJson('发布失败,请重试');
            }
            $this->successJson('发布成功');
        } catch (\Exception $exceptions) {
            // print_r($exceptions->getTraceAsString());
            $this->errorJson('发布失败,请重试');
        }
    }

    /**
     * 产品详情
     * @return string
     * @throws \Exception
     */
    public function actionTaskDetail() {
        $tid = (int) Utils::request('tid');
        $info = Task::findOne(['tid' => $tid, 'user_id' => $this->login_user_id]);
        if(empty($info)) {
            echo "任务不存在";
        }
        $flow_setting = TaskFlowSetting::find()->where(['task_id' => $tid])->orderBy('id asc')->all();
        $product = Product::find()->where(['task_id' => $tid])->orderBy('id asc')->all();
        $release_time = TaskReleaseTime::find()->where(['task_id' => $tid])->orderBy('id asc')->all();
        return $this->render('TaskDetail.php', [
            'info' => $info,
            'flow_setting' => $flow_setting,
            'product' => $product,
            'release_time' => $release_time
        ]);
    }
}