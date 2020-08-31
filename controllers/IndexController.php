<?php


namespace app\controllers;


use app\models\Shop;
use app\models\Task;
use app\models\User;

class IndexController extends BaseController
{

    public $layout = false;
    public function actionIndex() {
        $user_info = User::findOne($this->login_user_id);
        $total_shop = Shop::find()->where(['state' => 2, 'user_id' => $this->login_user_id])->count();
        $wait = Task::find()->where(['user_id' => $this->login_user_id, 'state' => 3])->count();
        $recived = Task::find()->where(['user_id' => $this->login_user_id, 'state' => 6])->count();
        $hide = Task::find()->where(['user_id' => $this->login_user_id, 'is_hide' => 2, 'state' => 3])->count();
        return $this->render('index.php', [
            'total_shop' => $total_shop,
            'info' => $user_info,
            'recived' => $recived,
            'wait' => $wait,
            'hide' => $hide,
        ]);
    }

    public function actionNotice() {
        $this->errorJson('no msg');
    }
}