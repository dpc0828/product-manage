<?php


namespace app\utils;


class ValidatorUtils
{

    /**
     * 验证 是否是 手机号码
     * @param string $mobile 手机号码
     * @return  bool
     */
    public static function isMobile(string $mobile) : bool
    {
        return (bool) preg_match('/^1[3-9]\d{9}$/', $mobile);
    }

    /**
     * @desc 验证是否是Email
     * @param string $email
     * @return bool
     */
    public static function isEmail(string $email) : bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/', $email);
    }

    /**
     * 验证 是否是 qq号码
     * @param string $qq qq号码
     * @return  bool
     */
    public static function isQq(string $qq) : bool
    {
        return (bool) preg_match('/^[1-9]\d{4,20}$/', $qq);
    }


    /**
     * @desc 验证是否是url
     * @param string $url
     * @return bool
     */
    public static function isUrl(string $url) : bool
    {
        return (bool) preg_match('/^((http|https):\/\/)?(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(?::\d{1,5})?(?:$|[?\/#])/i', $url);
    }



    /**
     * 是否是时间  Y-m-d H:i:s 格式
     * @param string $date 时间
     * @return bool
     */
    public static function isDate(string $date) : bool {
        return  strtotime($date) ? true : false;
    }

    /**
     * 密码格式验证 数字字母和下划线 长度 6 ~ 24 位
     * @param $password
     * @return bool
     */
    public static function isPassword($password) : bool {
        return (bool) preg_match("/^[a-zA-Z0-9_]{6,18}$/", $password);
    }

    /**
     * 是否是百分比 20% 28.56%
     * @param $percent 百分比
     * @return bool
     */
    public static function isPercent($percent) {
        return (bool) preg_match("/^[1-9]{1}\d*(.\d{1,2})?$|^0.\d{1,2}$/", $percent) && $percent <= 100;
    }

    /**
     * 是否有效价格 传入价格最多小数点后两位 不允许0
     * @param float $price 价格
     * @return bool
     */
    public static function isPrice(float $price) : bool {
        return (bool) preg_match("/^[1-9]{1}\d*(.\d{1,2})?$|^0.\d{1,2}$/", $price);
    }


    /**
     * 是否是有效金额 最多两位有效小树 允许为0
     * @param $val
     * @return bool
     */
    public static function isMoney($val) {
        if (preg_match("/^[0-9]{1,}$/", $val)) {
            return true;
        }

        if (preg_match("/^[0-9]{1,}\.[0-9]{1,2}$/", $val)) {
            return true;
        }
        return false;
    }
}