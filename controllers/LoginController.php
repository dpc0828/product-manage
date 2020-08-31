<?php


namespace app\controllers;


use app\models\User;
use app\utils\LoginUtils;
use app\utils\Utils;
use app\utils\ValidatorUtils;

class LoginController extends BaseController
{

    public $layout = false;
    public $defaultAction = 'login';


    /**
     * 用户注册
     * @throws \Yii\base\ExitException
     * @throws \yii\base\Exception
     */
    public function actionRegister() {
        $mobile = Utils::request('mobile', null, 'trim');
        $password = Utils::request('password', null, 'trim');

        if(!ValidatorUtils::isMobile($mobile)) {
            $this->errorJson("手机号码格式错误");
        }

        if(!ValidatorUtils::isPassword($password)) {
            $this->errorJson("密码格式错误,密码由数字、字母或下划线组成,长度6-18位");
        }

        $encrypt_password = LoginUtils::getEncryptPassword($password);
        $transaction = User::getDb()->beginTransaction();
        try {
            $model = new User();
            $model->mobile = $mobile;
            $model->password = $encrypt_password;
            $model->password = $encrypt_password;
            $model->safety_code = 123456;
            $model->state = 1;
            $model->create_time = date('Y-m-d H:i:s');
            if(!$model->save()) {
                throw new \Exception("帐号注册失败,请重新提交", self::STATUS_COMMON_ERROR);
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            $this->errorJson('帐号注册失败,请重试');
        }
        $this->successJson("帐号注册成功");
    }

    /**
     * 用户登录
     * @return string
     * @throws \Yii\base\ExitException
     */
    public function actionLogin() {
        if(Utils::isPost()) {
            $username = Utils::request('username', null, 'trim');
            $password = Utils::request('pwd', null, 'trim');

            if(!ValidatorUtils::isMobile($username)) {
                $this->errorJson("手机号码错误");
            }

            if(!ValidatorUtils::isPassword($password)) {
                $this->errorJson("密码格式错误,密码由数字、字母或下划线组成,长度6-24位");
            }

            $account = User::findOne(['mobile' => $username, 'state' => 1]);
            if(empty($account)) {
                $this->errorJson("帐号不存在");
            }

            if(!LoginUtils::validatePassword($password, $account['password'])) {
                $this->errorJson('帐号密码错误');
            }

            $last_loginip = Utils::getRealUserIp();
            $last_logintime = date('Y-m-d H:i:s');
            $account->last_loginip = $last_loginip;
            $account->last_logintime = $last_logintime;

            if(!$account->save()) {
                $this->errorJson('登录失败,请重试');
            }
            LoginUtils::Login($account, $last_logintime, $last_loginip);
            $this->successJson('登录成功');
        } else {
            if(LoginUtils::checkLogin() !== false) {
                $this->redirect(['index/index']);
            }
            return $this->render('index.php');
        }
    }

    /**
     * 退出登录
     * @return \yii\web\Response
     * @throws \Exception
     */
    public function actionLogout() {
        LoginUtils::logout();
        $this->redirect(['login/login']);
    }
}