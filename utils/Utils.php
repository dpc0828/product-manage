<?php

namespace  app\utils;
use yii;
class Utils
{
    /**
     * 返回版本号
     * @return string
     */
    public static function version(){
        return 'v20200821001';
    }

    /**
     * 返回日期
     * @return false|string
     */
    public static function dateYmd() {
        return date('Y-m-d H:i:s');
    }

    /**
     * 返回网站标题
     * @return string
     */
    public static function webSiteTitle() {
        return yii::$app->params['siteTitle'];
    }


    /**
     * @var string $filter 全局过滤规则
     */
    private static $filter = 'trim';

    /**
     * @var 返回带CSRF的meta标签
     * @return string
     */
    public static function getCsrfMeta() {
        $meta = '<meta name="_csrf_name_" content="' . yii::$app->request->csrfParam . '">' . PHP_EOL;
        $meta .= '    <meta name="_csrf_token_" content="' . yii::$app->request->getCsrfToken() . '">' . PHP_EOL;
        return $meta;
    }

    /**
     * @desc 获取GET|POST的值
     * @param null $name
     * @param null $defaultValue
     * @param string $filter
     * @return array|mixed
     * @throws \Exception
     */
    public static function request($name = null, $defaultValue = null, $filter = '') {
        is_string($name) && $type = explode('.', $name);
        if (Yii::$app->request->isPost || (isset($type) && 'post' === $type[0])) {
            $data = self::_handleData(Yii::$app->request->post(), $type[1] ?? $name, $defaultValue, $filter);
        } elseif (Yii::$app->request->isGet) {
            $data = self::_handleData(Yii::$app->request->get(), $type[1] ?? $name, $defaultValue, $filter);
        } elseif (Yii::$app->request->isOptions) {
            $data = [];
        } else {
            throw new \Exception('该方法不支持该请求方式');
        }
        return $data;
    }

    /**
     * 获取变量 支持过滤和默认值
     *
     * @param array        $data    数据源
     * @param string|false $name    字段名
     * @param mixed        $default 默认值
     * @param string|array $filter  过滤函数
     *
     * @return mixed
     */
    private static function _handleData($data = [], $name = '', $default = null, $filter = '') {
        if (false === $name) {
            // 获取原始数据
            return $data;
        }
        $name = (string) $name;
        if ('' !== $name) {

            // 按.拆分成多维数组进行判断
            foreach (explode('.', $name) as $val) {
                if (isset($data[$val])) {
                    $data = $data[$val];
                } else {
                    // 无输入数据，返回默认值
                    return $default;
                }
            }
            if (is_object($data)) {
                return $data;
            }
        }

        // 解析过滤器
        if (is_null($filter)) {
            $filter = [];
        } else {
            $filter = $filter ?: self::$filter;
            if (is_string($filter)) {
                $filter = explode(',', $filter);
            } else {
                $filter = (array) $filter;
            }
        }

        $filter[] = $default;
        if (is_array($data)) {
            array_walk_recursive($data, ['\app\utils\Utils', '_filterValue'], $filter);
            reset($data);
        } else {
            self::_filterValue($data, $name, $filter);
        }

        return $data;
    }

    /**
     * 递归过滤给定的值
     *
     * @param mixed $value   键值
     * @param mixed $key     键名
     * @param array $filters 过滤方法+默认值
     */
    private static function _filterValue(&$value, $key, $filters) {
        $default = array_pop($filters);
        foreach ($filters as $filter) {
            if (is_callable($filter)) {
                // 调用函数或者方法过滤
                $value = call_user_func($filter, $value);
            } elseif (is_scalar($value)) {
                if (strpos($filter, '/')) {
                    // 正则过滤
                    if (!preg_match($filter, $value)) {
                        // 匹配不成功返回默认值
                        $value = $default;
                        break;
                    }
                } elseif (!empty($filter)) {
                    // filter函数不存在时, 则使用filter_var进行过滤
                    // filter为非整形值时, 调用filter_id取得过滤id
                    $value = filter_var($value, is_int($filter) ? $filter : filter_id($filter));
                    if (false === $value) {
                        $value = $default;
                        break;
                    }
                }
            }
        }
    }

    /**
     * 是否POST请求
     * @return bool|mixed
     */
    public static function isPost() {
        return yii::$app->request->isPost;
    }


    /**
     * @desc 获取用户真实ip
     * @return string
     */
    public static function getRealUserIp() {
        $ip = '127.0.0.1';
        if (!empty($_SERVER['HTTP_ALI_CDN_REAL_IP'])) {
            $ip = $_SERVER['HTTP_ALI_CDN_REAL_IP'];
        } elseif (!empty($_SERVER['X_FORWARDED_FOR'])) {
            $ip = trim(explode(',', $_SERVER['X_FORWARDED_FOR'])[0]);
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = trim(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]);
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    /**
     * @var 价格不四舍五入处理
     * @param $price float 价格
     * @param $decimal integer 保留位数
     * @return string
     */
    public static function priceWithOutRounding(float $price, int $decimal = 2) {
        $array = explode('.', $price);
        if(!isset($array[1]) || $decimal <= 0) {
            return $array[0];
        }
        return $array[0] . '.' . substr($array[1], 0, $decimal);
    }

    /**
     * @var 价格四舍五入处理
     * @param $price float 价格
     * @param $decimal integer 保留位数
     * @return float
     */
    public static function priceWithRounding(float $price, int $decimal = 2) {
        return floatval(number_format($price, $decimal, '.', ''));
    }

    /**
     * 入住天数
     * @param $create_time
     * @return float|int
     */
    public static function registerDays($create_time) {
        return floor((time() - strtotime($create_time)) / 86400);
    }

    /**
     * @var 管理员用户名验证
     * @param $username
     * @return bool
     */
    public static function operatorUserName($username) : bool {
        return preg_match("/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{6,15}$/", $username);
    }

    /**
     * @var 管理员密码验证
     * @param $password
     * @return bool
     */
    public static function operatorPassword($password) : bool {
        return preg_match("/^(?![0-9]+$)(?![a-zA-Z]+$)[0-9A-Za-z]{7,15}$/", $password);
    }


    /**
     * 返回图片完成地址
     * @param $image
     * @return string
     */
    public static function fullImageUrl($image) {
        if(empty($image)) {
            return '';
        }
        if(ValidatorUtils::isUrl($image)) {
            return $image;
        }
        return yii::$app->params['upload_image_url'] . $image;
    }
}