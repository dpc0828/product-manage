<?php
namespace app\controllers\admin;
use Yii;
class IndexController extends AdminBaseController {

	public function actionIndex() {
		return $this->render('index');
	}
}