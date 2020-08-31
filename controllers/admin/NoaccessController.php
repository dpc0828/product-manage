<?php
namespace app\controllers\admin;
use Yii;
class NoaccessController extends AdminBaseController {

	public function actionIndex() {
		return $this->render('index');
	}
}