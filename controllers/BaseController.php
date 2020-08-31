<?php


namespace app\controllers;


use app\utils\LoginUtils;
use app\utils\Utils;
use Yii;
use yii\web\Controller;
use yii\web\Response;

class BaseController extends Controller
{

    /**
     * @const integer 成功
     */
    const SUCCESS_CODE = 200;

    /**
     * @const integer 失败
     */
    const FAILED_CODE = 400;

    /**
     * @const integer 需要登录
     */
    const NOT_LOGIN_CODE = 401;

    /**
     * @const integer NOT FOUND
     */
    const NOT_FOUND_CODE = 404;

    /**
     * @const integer SERVER ERROR
     */
    const ERROR_CODE = 500;

    /**
     * @var int 当前页
     */
    protected $_page = 1;

    /**
     * @var int 每页数据条数
     */
    protected $_page_size = 10;

    /**
     * @var int 分页offset
     */
    protected $_offset = 20;

    /**
     * @var bool 关闭csrf验证
     */
    public $enableCsrfValidation = false;

    /**
     * @var 登录用户ID
     */
    protected $login_user_id;

    /**
     * @var 登录用户电话号码
     */
    protected $login_mobile;

    /**
     * 前置操作 登录验证等
     * @param $action
     * @return bool
     * @throws Yii\base\ExitException
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (version_compare(phpversion(), '7.1', '>=')) {
            ini_set( 'serialize_precision', 14 );
        }
        $controller = yii::$app->controller->id;
        $action = yii::$app->controller->action->id;
        if(!in_array('/' . $controller . '/' . $action, LoginUtils::$_no_need_login_url)) {
            $login_info = LoginUtils::checkLogin();
            if($login_info === false && Yii::$app->request->isAjax) {
                $this->errorJson('请先登录', ['login_url' => '/login/login'], self::NOT_LOGIN_CODE);
            }
            if($login_info === false) {
                $this->layout = false;
                $this->redirect(['login/login']);
            }
            $this->login_user_id = (int)$login_info['id'];
            $this->login_mobile = $login_info['mobile'];
            yii::$app->params['login_mobile'] = $login_info['mobile'];
        }

        $_page = (int) Utils::request('page');
        if (!empty($_page) && $_page > 0) {
            $this->_page = $_page;
        }
        $_page_size = (int) Utils::request('pageSize');
        if (!empty($_page_size) && $_page_size > 0 && $_page_size <= 100) {
            $this->_page_size = $_page_size;
        }
        $this->_offset = ($this->_page - 1) * $this->_page_size;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * json 响应
     * @param string $msg
     * @param array|null $data
     * @param int $code
     * @throws yii\base\ExitException
     */
    public function displayJson(string $msg, ?array $data = [], int $code = self::SUCCESS_CODE) : void
    {
        $return = [
            'code' => $code,
            'message'  => $msg,
            'datas' => empty($data) ? null : $data,
        ];
        yii::$app->response->format = Response::FORMAT_JSON;
        yii::$app->response->data = $return;
        yii::$app->response->statusCode = 200;
        yii::$app->end();
    }


    /**
     * layer list返回
     * @param int $code
     * @param int $count
     * @param string $msg
     * @param $data
     * @throws \yii\base\ExitException
     */
    public function layerListDisplayJson($code = 0, $count = 0, $msg = '', $data = []) {
        $return = [
            'code' => $code,
            'count' => $count,
            'msg'  => $msg,
            'data' => empty($data) ? [] : $data,
        ];
        yii::$app->response->format = Response::FORMAT_JSON;
        yii::$app->response->data = $return;
        yii::$app->response->statusCode = 200;
        yii::$app->end();
    }

    /**
     * 成功 json响应
     * @param string $msg 提示信息
     * @param array|null $data 返回数据
     * @param int $code 返回code
     * @throws yii\base\ExitException
     */
    public function successJson(string $msg, ?array $data = [], int $code = self::SUCCESS_CODE) : void
    {
        $this->displayJson($msg, $data, $code);
    }

    /**
     * 错误 json响应
     * @param string $msg 提示信息
     * @param array|null $data 返回数据
     * @param int $code 返回code
     * @throws yii\base\ExitException
     */
    public function errorJson(string $msg, ?array $data = [], int $code = self::FAILED_CODE) : void
    {
        $this->displayJson($msg, $data, $code);
    }

    /**
     * 非Post请求方式
     * @throws yii\base\ExitException
     */
    public function postMethod() {
        if(!yii::$app->request->isPost) {
            $this->displayJson('请求方式错误', null, self::FAILED_CODE);
        }
    }

    /**
     * 非Get请求方式
     * @throws yii\base\ExitException
     */
    public function getMethod() {
        if(!yii::$app->request->isGet) {
            $this->displayJson('请求方式错误', null, self::FAILED_CODE);
        }
    }
}