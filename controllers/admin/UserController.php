<?php


namespace app\controllers\admin;


use app\models\User;
use app\utils\LoginUtils;
use app\utils\Utils;
use app\utils\ValidatorUtils;
use yii\data\Pagination;
use yii\widgets\LinkPager;

class UserController extends AdminBaseController
{

    /**
     * 用户列表
     * @return string
     * @throws \Exception
     */
    public function actionIndex() {
        $keyword = Utils::request('keyword');
        $state = (int) Utils::request('state');
        $model = User::find();
        if(!empty($keyword)) {
            $model->where(['mobile' => $keyword]);
        }
        if($state > 0) {
            $model->andWhere(['state' => $state]);
        }
        $count = $model->count();
        $pagination = new Pagination([
            'totalCount' => $count,
            'defaultPageSize' => $this->pageSize,
        ]);
        $list = $model->limit($this->_page_size)->offset($this->_offset)->orderBy('id desc')->all();

        return $this->render('index.php', [
            'list' => $list,
            'keyword' => $keyword,
            'state' => $state,
            'page' => LinkPager::widget([
                'pagination' => $pagination,
            ]),
        ]);
    }

    public function actionAdd() {
        if(Utils::isPost()) {
            $mobile = Utils::request('username');
            $password = Utils::request('password');
            $confirm_password = Utils::request('confirm_password');
            $state = (int) Utils::request('state');

            if(!ValidatorUtils::isMobile($mobile)) {
                $this->errorJson('手机号格式错误');
            }

            if(!ValidatorUtils::isPassword($password)) {
                $this->errorJson('密码格式错误,密码由数字、字母或下划线组成,长度6-18位');
            }

            if($password != $confirm_password) {
                $this->errorJson('两次输入密码不一致');
            }

            $info = User::findOne(['mobile' => $mobile]);
            if(!empty($info)) {
                $this->errorJson('手机号码已存在');
            }

            $model = new User();
            $model->mobile = $mobile;
            $model->password = LoginUtils::getEncryptPassword($password);
            $model->safety_code = $password;
            $model->state = $state == 1 ? 1 : 2;
            $model->create_time = Utils::dateYmd();
            if($model->save()) {
                $this->successJson('添加成功');
            }
            $this->errorJson('添加失败');

        } else {
            return $this->render('add.php');
        }
    }

    public function actionEdit() {
        $id = (int) Utils::request('id');
        $info = User::findOne($id);
        if(Utils::isPost()) {
            if(empty($info)) {
                $this->errorJson('用户不存在');
            }
            $password = Utils::request('password');
            $confirm_password = Utils::request('confirm_password');
            $state = (int) Utils::request('state');
            if(!empty($password)) {
                if(!ValidatorUtils::isPassword($password)) {
                    $this->errorJson('密码格式错误,密码由数字、字母或下划线组成,长度6-18位');
                }

                if($password != $confirm_password) {
                    $this->errorJson('两次输入密码不一致');
                }
                $info->password = LoginUtils::getEncryptPassword($password);
            }
            $info->state = $state == 1 ? 1 : 2;
            $info->update_time = Utils::dateYmd();
            if($info->save()) {
                $this->successJson('编辑成功');
            }
            $this->errorJson('编辑失败');
        } else {
            if(empty($info)) {
                $this->redirect(['/admin/error/notfound']);
            }
            return $this->render('edit.php', [
                'info' => $info,
            ]);
        }
    }
}