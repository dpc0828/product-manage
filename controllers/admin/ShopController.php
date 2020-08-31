<?php


namespace app\controllers\admin;


use app\models\Shop;
use app\models\User;
use app\utils\Utils;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii;

class ShopController extends AdminBaseController
{

    public function actionIndex() {
        $keyword = Utils::request('keyword');
        $state = (int) Utils::request('state');
        $model = Shop::find()->alias('s')->innerJoin(User::tableName() . ' u', 'u.id = s.user_id');
        if(!empty($keyword)) {
            $model->where([
                    'or',
                    ['=', 's.shop_name', $keyword],
                    ['=', 'u.mobile', $keyword],
            ]);
        }
        if($state > 0) {
            $model->andWhere(['s.state' => $state]);
        }

        $count = $model->count();
        $pagination = new Pagination([
            'totalCount' => $count,
            'defaultPageSize' => $this->pageSize,
        ]);
        $list = $model->select('s.*, u.mobile')->limit($this->_page_size)
            ->offset($this->_offset)->orderBy('s.id desc')->asArray()->all();
        return $this->render('index.php', [
            'list' => $list,
            'keyword' => $keyword,
            'state' => $state,
            'page' => LinkPager::widget([
                'pagination' => $pagination,
            ]),
        ]);
    }

    /**
     * @throws \yii\base\ExitException
     */
    public function actionAudit() {
        $id = (int) yii::$app->request->get('id');
        $state = (int) yii::$app->request->get('state');
        $info = Shop::findOne(['id' => $id, 'state' => 1]);
        if(empty($info)) {
            $this->errorJson('店铺信息不存在');
        }

        $info->state = $state == 3 ? 3 : 2;
        $info->update_time = Utils::dateYmd();
        if($info->save()) {
            $this->successJson('操作成功');
        }
        $this->errorJson();
    }
}