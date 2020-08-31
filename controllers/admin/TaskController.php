<?php


namespace app\controllers\admin;


use app\models\Product;
use app\models\Shop;
use app\models\Task;
use app\models\TaskAddvalueSetting;
use app\models\TaskFlowSetting;
use app\models\TaskProduct;
use app\models\TaskReleaseTime;
use app\models\User;
use app\utils\Utils;
use app\utils\ValidatorUtils;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii;
class TaskController extends AdminBaseController
{

    /**
     * 任务详情
     * @return string
     * @throws \Exception
     */
    public function actionIndex() {
        $task_no = Utils::request('task_no');
        $task_type = (int) Utils::request('task_type');
        $state = (int) Utils::request('state');
        $keyword = Utils::request('keyword');
        $start = Utils::request('start');
        $end = Utils::request('end');
        $is_hide = (int)Utils::request('is_hide');

        // 任务状态 3:待接  6:已接 9:已完成 12:取消任务
        $where[] = 'and';
        $where[] = ['=', 1, 1];
        if($state > 0) {
            $where[] = ['in', 't.state', $state];
        }

        if($task_type > 0) {
            $where[] = ['in', 't.task_type', $task_type];
        }

        if($state == 1 || $state == 2) {
            $where[] = ['=', 't.is_hide', $state];
        }

        if($task_type > 0) {
            $where[] = ['=', 't.task_type', $task_type];
        }

        if($is_hide > 0) {
            $where[] = ['=', 't.is_hide', $is_hide];
        }

        if(!empty($task_no)) {
            $where[] = ['=', 't.task_no', $task_no];
        }

        if(!empty($keyword)) {
            $where[] = [
                'or',
                ['like', 's.shop_name', $keyword],
                ['like', 'p.product_id', $keyword],
                ['like', 'p.product_title', $keyword],
                ['like', 'p.product_shortname', $keyword],
            ];
        }

        if(!empty($start) && ValidatorUtils::isDate($start)) {
            $where[] = ['>=', 't.create_time', $start];
        }

        if(!empty($end) && ValidatorUtils::isDate($end)) {
            $where[] = ['<=', 't.create_time', $end];
        }

        $field = [
            't.*',
            's.shop_name',
            'u.mobile',
            'f.flow_type,f.vie_keyword1,f.vie_keyword2,f.vie_keyword3,f.target_keyword',
            'p.product_link,p.product_title,p.product_shortname,p.app_index_image,p.customer_setting,p.buy_setting',
            'tp.commission,tp.deliver_price,tp.buy_quantity,tp.price',
            'tm.release_type,tm.release_quantity,tm.start_time,tm.end_time,tm.timeout_time',
        ];

        $model = Task::find()->alias('t')
            ->innerJoin(User::tableName() . ' u', 'u.id = t.user_id')
            ->innerJoin(TaskProduct::tableName() . ' tp', 'tp.task_id = t.id')
            ->innerJoin(TaskFlowSetting::tableName() . ' f', 'f.task_id = t.id')
            ->innerJoin(Product::tableName() . ' p', 'p.id = t.product_id')
            ->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id')
            ->innerJoin(TaskReleaseTime::tableName() . ' tm', 'tm.task_id = t.id')->where($where);


        $count = $model->count();
        $pagination = new Pagination([
            'totalCount' => $count,
            'defaultPageSize' => $this->pageSize,
        ]);

        $list = $model->select(implode(',', $field))->orderBy('t.id desc')
            ->offset($this->_offset)->limit($this->_page_size)
            ->asArray()
            ->all();
        return $this->render('index.php', [
            'list' => $list,
            'task_no' => $task_no,
            'start' => $start,
            'end' => $end,
            'state' => $state,
            'task_type' => $task_type,
            'keyword' => $keyword,
            'total' => (int) $model->where($where)->count(),
            'is_hide' => $is_hide,
            'page' => LinkPager::widget([
                'pagination' => $pagination,
            ]),
        ]);
    }

    public function actionCancel() {
        if(Utils::isPost()) {
            $id = (int) Yii::$app->request->get('id');
            $info = Task::findOne(['id' => $id, 'state' => 3]);
            if(empty($info)) {
                $this->errorJson('任务不存在或已取消');
            }

            if(yii::$app->db->createCommand()->update(Task::tableName(), [
                'cancel_time' => Utils::dateYmd(),
                'cancel_remark' => '平台取消',
                'state' => 12,
                'update_time' => Utils::dateYmd()
            ], [
                'id' => $id,
                'state' => 3
            ])->execute()) {
                $this->successJson();
            }
            $this->errorJson();
        }
    }


    public function actionFinished() {
        if(Utils::isPost()) {
            $id = (int) Yii::$app->request->get('id');
            $info = Task::findOne(['id' => $id, 'state' => 6]);
            if(empty($info)) {
                $this->errorJson('任务不存在或已完成');
            }

            if(yii::$app->db->createCommand()->update(Task::tableName(), [
                'finish_time' => Utils::dateYmd(),
                'state' => 9,
                'update_time' => Utils::dateYmd()
            ], [
                'id' => $id,
                'state' => 6
            ])->execute()) {
                $this->successJson();
            }
            $this->errorJson();
        }
    }


    public function actionRecived() {
        if(Utils::isPost()) {
            $id = (int) Yii::$app->request->get('id');
            $info = Task::findOne(['id' => $id, 'state' => 3]);
            if(empty($info)) {
                $this->errorJson('任务不存在或已接任务');
            }

            if(yii::$app->db->createCommand()->update(Task::tableName(), [
                'receive_time' => Utils::dateYmd(),
                'receive_user_id' => $this->op_user_id,
                'state' => 6,
                'update_time' => Utils::dateYmd()
            ], [
                'id' => $id,
                'state' => 3
            ])->execute()) {
                $this->successJson();
            }
            $this->errorJson();
        }
    }

    public function actionDetail() {
        $this->layout = false;
        $id = (int) Utils::request('id');
        $task = Task::findOne($id);
        if(empty($task)) {
            echo "任务不存在";
        }
        $release = TaskReleaseTime::find()->where(['task_id' => $id])->one();
        $product = Product::findOne(['id' => $task['product_id']]);
        $shop = Shop::findOne(['id' => $product['shop_id']]);
        $task_product = TaskProduct::findOne(['task_id' => $id]);
        $flow = TaskFlowSetting::findOne(['task_id' => $id]);
        $addvalue = TaskAddvalueSetting::findOne(['task_id' => $id]);
        return $this->render('detail.php', [
            'task' => $task,
            'product' => $product,
            'shop' => $shop,
            'task_product' => $task_product,
            'flow' => $flow,
            'release' => $release,
            'addvalue' => $addvalue
        ]);
    }
}