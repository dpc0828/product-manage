<?php


namespace app\controllers\admin;


use app\models\Product;
use app\models\Shop;
use app\models\User;
use app\utils\Utils;
use yii\data\Pagination;
use yii\widgets\LinkPager;
use yii;

class ProductController extends AdminBaseController
{
    public function actionIndex() {
        $keyword = Utils::request('keyword');
        $model = Product::find()->alias('p')
            ->innerJoin(Shop::tableName() . ' s', 's.id = p.shop_id')
            ->innerJoin(User::tableName() . ' u', 'u.id = p.user_id');

        if(!empty($keyword)) {
            $model->where([
                'or',
                ['=', 'p.product_id', $keyword],
                ['like', 'p.product_title', $keyword],
                ['like', 'p.product_shortname', $keyword],
            ]);
        }

        $count = $model->count();
        $pagination = new Pagination([
            'totalCount' => $count,
            'defaultPageSize' => $this->pageSize,
        ]);
        $list = $model->select('p.*, s.shop_name, u.mobile')->limit($this->_page_size)
            ->offset($this->_offset)->orderBy('id desc')->asArray()->all();

        return $this->render('index.php', [
            'list' => $list,
            'keyword' => $keyword,
            'page' => LinkPager::widget([
                'pagination' => $pagination,
            ]),
        ]);
    }

    public function actionAudit() {
        if(Utils::isPost()) {
            $id = (int)yii::$app->request->get('id');
            $info = Product::findOne(['id' => $id, 'state' => 1]);
            if(empty($info)) {
                $this->errorJson('产品不存在或已删除');
            }

            $info->state = 2;
            $info->update_time = Utils::dateYmd();
            if($info->save()) {
                $this->successJson();
            }
            $this->errorJson();
        }
    }
}