<?php
namespace app\controllers\admin;
use Yii;
class ErrorController extends AdminBaseController {
	public function actionNotfound() {
		return $this->render('notfound');
	}

	public function actionError() {
		return $this->render('error');
	}
}