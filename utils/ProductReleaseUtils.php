<?php


namespace app\utils;


use app\models\Task;
use app\models\TaskReleaseTime;

class ProductReleaseUtils
{
    /**
     * 流量单增值服务费单价
     * @var array
     */
    public static $flow_addvalue_fee = [
        'collect_pro' => 0.1,
        'recommend_pro' => 0.1,
        'collect_shop' => 0.1,
        'add_cart' => 0.1,
        'chat' => 0.3,
        'coupon' => 0.1,
        'ask' => 0.5,
    ];

    /**
     * @var int 货比词单价
     */
    public static $vie_keyword_fee = 1;

    /**
     * @var float 平台发货每单费用
     */
    public static $deliver_fee = 2.3;

    /**
     * @var array 任务类型
     */
    public static $task_type = [
        1,//销量任务
        10,//标签任务
        5,//预约任务
        13,//提前购
        16,//AB单
        8,//多链接任务
        7,//猜你喜欢
        11,//微淘/直播任务
    ];

    /**
     * @var array 允许同时发布流量单的流量入口
     */
    public static $allow_same_flow = [
        1,//淘宝APP自然搜索
        3,//淘宝APP淘口令
        4,//淘宝APP直通车
        6,//淘宝APP二维码
        9,//聚划算
    ];

    /**
     * @var array 流量入口类型
     */
    public static $flow_type = [
        1,//淘宝APP自然搜索
        2,//淘宝PC自然搜索
        3,//淘宝APP淘口令
        4,//淘宝APP直通车
        5,//淘宝PC直通车
        6,//淘宝APP二维码
        7,//淘宝APP猜你喜欢
        8,//拍立淘
        9,//聚划算
    ];

    /**
     * @var array 排序类型
     */
    public static $sort_type = [
        1,//综合
        2,//新品
        3,//人气
        4,//销量
        5,//价格从低到高
        6,//价格从高到低
    ];

    /**
     * @var array 发布时间类型
     */
    public static $release_type = [
        0, //立即发布
        1, //今日平均发布
        2, //多天平均发布
        3, //关键词单独发布
    ];

    /**
     * 产品根据拍下件数计算佣金
     * 50=11|100=14|200=15|500=16|1000=20|1500 =22|2000=24|2500 =26|3000 =30|3500=33|4500=35
     * @param $price 单任务成交金额
     * @return int
     */
    public static function commissionPrice($price) {
        switch ($price) {
            case $price < 50:
                $commission = 11;
                break;
            case $price >= 50 && $price < 100:
                $commission = 14;
                break;
            case $price >= 100 && $price < 200:
                $commission = 15;
                break;
            case $price >= 200 && $price < 500:
                $commission = 16;
                break;
            case $price >= 500 && $price <= 1000:
                $commission = 20;
                break;
            case $price >= 1000 && $price < 1500:
                $commission = 22;
                break;
            case $price >= 1500 && $price < 2000:
                $commission = 24;
                break;
            case $price >= 2000 && $price < 2500:
                $commission = 26;
                break;
            case $price >= 2500 && $price < 3000:
                $commission = 30;
                break;
            case $price >= 3000 && $price < 3500:
                $commission = 33;
                break;
            case $price >= 3500:
                $commission = 35;
                break;
            default:
                $commission = 11;
                break;
        }
        return $commission;
    }

    /**
     * 比货词处理
     * @param $vie_keyword
     * @return array
     */
    public static function vieKeyword($vie_keyword) {
        $vie_keyword = explode(',', $vie_keyword);
        if(empty($vie_keyword)) {
            return [];
        }
        $data = [];
        foreach ($vie_keyword as $vie_keyword_li) {
            if(!empty($vie_keyword_li)) {
                $data[] = trim($vie_keyword_li);
            }
        }
        return array_slice($data,0 ,3);
    }

    /**
     * 买家常用分类
     * @param $invert
     * @return string|null\
     */
    public static function usuallyCate($invert) {
        if(!is_array($invert)) {
            return null;
        }

        $data = [];
        foreach ($invert as $invert_li) {
            if(!empty($invert_li)) {
                $data[] = str_replace(' ', '', $invert_li);
            }
        }
        return implode(' ', $data);
    }

    /**
     * 问题处理
     * @param $quiz
     * @return array
     */
    public static function question($quiz) {
        $data = [];
        if(!is_array($quiz)) {
            return $data;
        }
        foreach ($quiz as $quiz_li) {
            if(!empty($quiz_li)) {
                $data[] = $quiz_li;
            }
        }
        return $data;
    }


    /**
     * 任务单号生成
     * @return string
     */
    public static function getAvailableTaskNo() {
        do {
            $task_no = 'T' . date('YmdHis') . str_pad(mt_rand(1, 999999999), 9, '0', STR_PAD_LEFT);
            $day = (int)date('Ymd'); // 订单号都是以日期开头,所以只需要查询当天即可
            $_row = Task::findOne(['task_no' => $task_no, 'create_day' => $day]);
        } while (!empty($_row));
        return $task_no;
    }

    /**
     * 返回产品ID
     * @param $url
     * @return bool|mixed
     */
    public static function getGoodsIdByUrl($url) {
        $parse_array = parse_url($url);
        if(!isset($parse_array['query']) || empty($parse_array['query'])) {
            return false;
        }

        parse_str($parse_array['query'],$query_data);
        if(!isset($query_data['id']) || empty($query_data['id'])) {
            return false;
        }

        $pdd_goods_id = $query_data['id'];
        return $pdd_goods_id;
    }

    /**
     * 流量端
     * @param $flow
     * @return string
     */
    public static function flowType($flow) {
        // 1:淘宝APP自然搜索 2:淘宝PC自然搜索 3:淘宝APP淘口令 4:淘宝APP直通车 5:淘宝PC直通车 6:淘宝APP二维码 7:淘宝APP猜你喜欢 8:拍立淘 9:聚划算
        switch ($flow) {
            case 1:
                $type = '淘宝APP自然搜索';
                break;
            case 2:
                $type = '淘宝PC自然搜索';
                break;
            case 3:
                $type = '淘宝APP淘口令';
                break;
            case 4:
                $type = '淘宝APP直通车';
                break;
            case 5:
                $type = '淘宝PC直通车';
                break;
            case 6:
                $type = '淘宝APP二维码';
                break;
            case 7:
                $type = '淘宝APP猜你喜欢';
                break;
            case 8:
                $type = '拍立淘';
                break;
            case 9:
                $type = '聚划算';
                break;
            default:
                $type = '未知';
                break;
        }
        return $type;
    }
    /**
     * 流量端
     * @param $flow
     * @return string
     */
    public static function flowType_Browser($flow) {
        // 1:淘宝APP自然搜索 2:淘宝PC自然搜索 3:淘宝APP淘口令 4:淘宝APP直通车 5:淘宝PC直通车 6:淘宝APP二维码 7:淘宝APP猜你喜欢 8:拍立淘 9:聚划算
        switch ($flow) {
            case 1:
                $type = '移动端';
                break;
            case 2:
                $type = 'PC端';
                break;
            case 3:
                $type = '移动端';
                break;
            case 4:
                $type = '移动端';
                break;
            case 5:
                $type = 'PC端';
                break;
            case 6:
                $type = '移动端';
                break;
            case 7:
                $type = '移动端';
                break;
            case 8:
                $type = '移动端';
                break;
            case 9:
                $type = 'PC端';
                break;
            default:
                $type = '未知';
                break;
        }
        return $type;
    }

    /**
     * 任务类型
     * @param $task_type
     * @return string
     */
    public static function taskType($task_type) {
        switch ($task_type) {
            case 1:
                $type = '销量任务';
                break;
            case 10:
                $type = '标签任务';
                break;
            case 5:
                $type = '预约任务';
                break;
            case 13:
                $type = '提前购';
                break;
            case 16:
                $type = 'AB单';
                break;
            case 8:
                $type = '多链接任务';
                break;
            case 7:
                $type = '猜你喜欢';
                break;
            case 11:
                $type = '微淘/直播任务';
                break;
            default:
                $type = '未知';
                break;
        }
        return $type;
    }

    /**
     * 时间发布类型
     * @param $release_type
     * @return string
     */
    public static function release_type($release_type) {
        switch ($release_type) {
            case  1:
                $type = '今日平均发布';
                break;
            case  2:
                $type = '多天平均发布';
                break;
            case  3:
                $type = '关键词单独发布';
                break;
            default:
                $type = '立即发布';
                break;
        }
        return $type;
    }

    /**
     * 任务详情
     * @param $task_id
     * @return string
     */
    public static function releaseInfo($task_id) {
        $start = TaskReleaseTime::find()->where(['task_id' => $task_id])->one();
        //发布时间 0:立即发布 1:今日平均发布 2:多天平均发布 3:关键词单独发布
        return $start;
    }

    /**
     * 客户模板渲染
     * @param $setting
     * @return string
     */
    public static function customerSetting($setting) {
        if(empty($setting)) {
            return '';
        }
        $setting = json_decode($setting, true);
        $data = [];

        if(isset($setting['gender']) && $setting['gender'] == 1) {
            $data[] = '<span class="badge badge-yellow">性别比例</span> ' .  '男:' . ($setting['male_percent'] * 100) . '%&nbsp;&nbsp;&nbsp;&nbsp;女:' . ($setting['female_percent'] * 100) . '%';
        }

        if(isset($setting['age']) && $setting['age'] == 1) {
            $data[] = '<span class="badge badge-yellow">年龄比例</span> ' .  '18-24岁:' . ($setting['age18_24'] * 100) . '%&nbsp;&nbsp;&nbsp;&nbsp;25-33岁:' . ($setting['age25_33'] * 100) . '%&nbsp;&nbsp;&nbsp;&nbsp;34-50岁:' . ($setting['age34_50'] * 100) . '%';
        }

        if(isset($setting['exclude_province']) && !empty($setting['exclude_province'])) {
            $data[] = '<span class="badge badge-yellow">排除地区</span> ' . ($setting['exclude_province']);
        }
        return $data;
    }

    /**
     * 渲染购买行为
     * @param $setting
     * @return array|string
     */
    public static function buyerSetting($setting) {
        if(empty($setting)) {
            return '';
        }
        $setting = json_decode($setting, true);

        $data = [];
        if(isset($setting['shop_collection_percent'])) {
            $data[] = '<span class="badge badge-yellow">收藏店铺</span> ' . ($setting['shop_collection_percent'] * 100) . '%';
        }

        if(isset($setting['product_collection_percent'])) {
            $data[] = '<span class="badge badge-yellow">收藏商品</span> ' . ($setting['product_collection_percent'] * 100) . '%';
        }


        if(isset($setting['add_cart_percent'])) {
            $data[] = '<span class="badge badge-yellow">加入购物车</span> ' . ($setting['add_cart_percent'] * 100) . '%';
        }


        if(isset($setting['chat_percent'])) {
            $data[] = '<span class="badge badge-yellow">拍前咨询</span> ' . ($setting['chat_percent'] * 100) . '%';
        }

        if(isset($setting['product_contrast_percent_'])) {
            $data['货比N家'][] = '不货比:' . ($setting['product_contrast_percent_'] * 100) . '%';
        }
        if(isset($setting['product_contrast_percent_1'])) {
            $data['货比N家'][] = '&nbsp;&nbsp;&nbsp;&nbsp;货比一家:' . ($setting['product_contrast_percent_1'] * 100) . '%';
        }
        if(isset($setting['product_contrast_percent_2'])) {
            $data['货比N家'][] = '&nbsp;&nbsp;&nbsp;&nbsp;货比两家:' . ($setting['product_contrast_percent_2'] * 100) . '%';
        }
        if(isset($setting['product_contrast_percent_3'])) {
            $data['货比N家'][] = '&nbsp;&nbsp;&nbsp;&nbsp;货比三家:' . ($setting['product_contrast_percent_3'] * 100) . '%';
        }

        if(isset($setting['scan_percent_0'])) {
            $data['浏览深度'][] = '不浏览:' . ($setting['scan_percent_0'] * 100) . '%';
        }

        if(isset($setting['scan_percent_1'])) {
            $data['浏览深度'][] = '&nbsp;&nbsp;&nbsp;&nbsp;店内一款:' . ($setting['scan_percent_1'] * 100) . '%';
        }
        if(isset($setting['scan_percent_2'])) {
            $data['浏览深度'][] = '&nbsp;&nbsp;&nbsp;&nbsp;店内两款:' . ($setting['scan_percent_2'] * 100) . '%';
        }
        if(isset($setting['scan_percent_3'])) {
            $data['浏览深度'][] = '&nbsp;&nbsp;&nbsp;&nbsp;店内三款:' . ($setting['scan_percent_3'] * 100) . '%';
        }

        if(isset($data['货比N家'])) {
            $data['货比N家'] = '<span class="badge badge-yellow">货比N家</span> ' . implode('  ', $data['浏览深度']);
        }

        if(isset($data['浏览深度'])) {
            $data['浏览深度'] = '<span class="badge badge-yellow">浏览深度</span> ' . implode('  ', $data['浏览深度']);
        }

        return $data;
    }

}