<?php


namespace app\utils;

use app\models\User;
use yii;
use yii\base\Exception;

class LoginUtils
{
    /**
     * @var int 登录信息保存时长
     */
    protected static $login_expire_time = 864000;

    /**
     * @var string 登录信息保存COOKIE
     */
    protected static $login_cookie_name = 'DSY';


    /**
     * @var string 登陆信息保存key前缀
     */
    protected static $login_redis_prefix = 'dsy:login:';

    /**
     * @var array 不需要登录访问的URL
     */
    public static $_no_need_login_url = [
        '/login/login',
        '/login/logout',
    ];


    /**
     * redis保存登陆 返回Token
     * @param $account
     * @param $last_logintime
     * @param $last_loginip
     * @return string
     */
    public static function Login($account, $last_logintime, $last_loginip) {
        $cookie_encrypt_data = [
            'last_logintime' => $last_logintime,
            'last_loginip' => $last_loginip,
            'expire' => strtotime($last_logintime) + self::$login_expire_time,
            'id' => $account['id'],
            'password' => $account['password'],
        ];
        $encryptedData = Yii::$app->getSecurity()->encryptByPassword(
            http_build_query($cookie_encrypt_data),
            yii::$app->params['password_encrypt_prefix']
        );
        $token = md5($encryptedData);
        yii::$app->redis->set(self::$login_redis_prefix . $token, json_encode($cookie_encrypt_data));
        yii::$app->redis->expire(self::$login_redis_prefix . $token, self::$login_expire_time);

        $cookies = Yii::$app->response->cookies;
        if ($cookies->has(self::$login_cookie_name)) {
            $cookies->remove(self::$login_cookie_name);
        }
        $cookies->add(new \yii\web\Cookie([
            'name' => self::$login_cookie_name,
            'value' => $token,
            'expire' => time() + self::$login_expire_time,
        ]));
        return $token;
    }


    /**
     * 用户登陆校验  返回用户信息
     * @return bool
     * @throws \Exception
     */
    public static function checkLogin() {
        if(Yii::$app->request->cookies->has(self::$login_cookie_name)) {
            $token = yii::$app->request->cookies->get(self::$login_cookie_name);
            if(empty($token)) {
                return false;
            }
        }
        if(empty($token)) {
            return false;
        }
        if(!yii::$app->redis->exists(self::$login_redis_prefix . $token)) {
            return false;
        }

        $data = yii::$app->redis->get(self::$login_redis_prefix . $token);
        $data = json_decode($data, true);

        if(!isset($data['id']) || !isset($data['password']) || !isset($data['last_logintime']) || !isset($data['last_loginip']) || !isset($data['expire'])) {
            return false;
        }


        if(time() >= $data['expire']) {
            return false;
        }

        $loginInfo = User::findOne([
            'id' => (int) $data['id'],
        ]);

        // 改过密码
        if($loginInfo['password'] != $data['password']) {
            return false;
        }

        if(empty($loginInfo)) {
            return false;
        }
        return $loginInfo;
    }

    /**
     * 退出登陆
     * @return bool
     * @throws \Exception
     */
    public static function logout() {
        if(Yii::$app->request->cookies->has(self::$login_cookie_name)) {
            $token = yii::$app->request->cookies->get(self::$login_cookie_name);
            Yii::$app->response->cookies->remove(self::$login_cookie_name);
            if(yii::$app->redis->exists(self::$login_redis_prefix . $token)) {
                yii::$app->redis->del(self::$login_redis_prefix . $token);
            }
        }
        return true;
    }


    /**
     * 返回注册加密密码
     * @param $password
     * @return string
     * @throws Exception
     */
    public static function getEncryptPassword($password) {
        return Yii::$app->getSecurity()->generatePasswordHash(yii::$app->params['password_encrypt_prefix'] . $password);
    }

    /**
     * 登陆密码验证
     * @param $input_password 用户输入的密码
     * @param $account_password 帐号现在的密码
     * @return bool
     */
    public static function validatePassword($input_password, $account_password) {
        return Yii::$app->getSecurity()->validatePassword(yii::$app->params['password_encrypt_prefix'] . $input_password, $account_password);
    }
}