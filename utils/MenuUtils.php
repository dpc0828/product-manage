<?php


namespace app\utils;
use yii;
use app\models\AuthMenu AS DpcAuthMenu;
use app\models\AuthAccess AS DpcAuthAccess;
use app\models\AuthRoleUser AS DpcAuthRoleUser;
use app\utils\TreeUtils AS TreeHelper;
class MenuUtils
{
    /**
     * @var 左侧子菜单active处理
     * @param string $url
     * @return string
     */
    public static function activeMenuList(string $url) : string {
        $controller_id = Yii::$app->controller->id;
        $action_id = Yii::$app->controller->action->id;
        if('/' . $controller_id . '/' . $action_id == $url) {
            return "active";
        }
        return "";
    }


    /**
     * @var 左侧父菜单active处理
     * @param string $controller_id
     * @return string
     */
    public static function activeMenu(string $controller_id) : string {
        $current_controller_id = Yii::$app->controller->id;
        if($controller_id == '/' . $current_controller_id) {
            return "active open";
        }
        return "";
    }

    /**
     * 菜单分级展示
     * @param int $selected
     * @return string
     */
    public static function menu($selected = 1) {
        $result = DpcAuthMenu::find()->orderBy('id ASC')->asArray()->all();
        if(empty($result)) {
            return "";
        }
        $array = [];
        $tree = new TreeHelper();
        foreach ($result as $k => $r) {
            @$result[$k]['selected'] = $r['id'] == $selected ? 'selected' : '';
            $array[] = $result[$k];
        }
        $str = "<option value='\$id' \$selected>\$spacer \$name</option>";
        $tree->init($array);
        $parentid = isset($where['parentid']) ? $where['parentid'] : 0;
        return $tree->get_tree($parentid, $str);
    }

    /**
     * 根据用户权限进行菜单控制
     * @param $op_user_id 登陆用户ID
     * @param $super_admin_id 超管角色ID
     * @return array
     */
    public static function leftMenu() {
        $op_user_id = yii::$app->params['op_user_id'];
        $super_admin_id = yii::$app->params['super_admin_id'];
        $roleIdTmp = DpcAuthRoleUser::find()->where(['user_id' => $op_user_id])->all();
        $roleId = [];
        if(!empty($roleIdTmp)) {
            foreach ($roleIdTmp as $key => $value) {
                $roleId[] = $value['role_id'];
            }
        }

        $menu = [];
        if(in_array($super_admin_id, $roleId)) {
            $topMenu = DpcAuthMenu::find()->where(['type' => 1, 'status' => 1])->orderBy('id asc')->asArray()->all();
            if(!empty($topMenu)) {
                foreach ($topMenu as $key => $value) {
                    $list = DpcAuthMenu::find()->where(['type' => 2, 'parent_id' => $value['id'], 'status' => 1])->asArray()->all();
                    $menu[] = [
                        'top' => $value,
                        'left' => $list,
                    ];
                }
            }
        } else {
            $menu_table_name = DpcAuthMenu::tableName();
            $access_table_name = DpcAuthAccess::tableName();
            $topMenuAccess = DpcAuthMenu::find()->select($menu_table_name . '.*')
                ->innerJoin($access_table_name, $access_table_name . '.menu_id = ' . $menu_table_name . '.id')
                ->where([$menu_table_name. '.type' => 1])
                ->groupBy($menu_table_name . '.id')
                ->asArray()->all();
            $left = [];
            if(!empty($topMenuAccess)) {
                foreach ($topMenuAccess as $key => $value) {
                    # 角色权限
                    $roleAuth = [];
                    if(!empty($roleId)) {
                        $roleAuth = DpcAuthMenu::find()->select($menu_table_name . '.*')
                            ->innerJoin($access_table_name, $access_table_name . '.menu_id = ' . $menu_table_name . '.id')
                            ->where([
                                $menu_table_name . '.type' => 2,
                                $access_table_name . '.type' => 'admin_url',
                                $menu_table_name . '.parent_id' => $value['id']
                            ])
                            ->andWhere(['in', $access_table_name . ".role_id", $roleId])
                            ->groupBy($menu_table_name . '.id')
                            ->asArray()->all();
                    }
                    #独立分配用户权限
                    $accessAuth = DpcAuthMenu::find()->select($menu_table_name . '.*')
                        ->innerJoin($access_table_name, $access_table_name . '.menu_id = ' . $menu_table_name . '.id')
                        ->where([
                            $menu_table_name . '.type' => 2,
                            $access_table_name . '.type' => 'admin',
                            $menu_table_name . '.parent_id' => $value['id'],
                            $access_table_name . '.role_id' => $op_user_id,
                        ])
                        ->groupBy($menu_table_name . '.id')
                        ->asArray()->all();
                    if(!empty($roleAuth) || !empty($accessAuth)) {
                        $menu[] = [
                            'top' => $value,
                            'left' => array_merge($roleAuth, $accessAuth),
                        ];
                    }
                }
            }
        }
        return $menu;
    }

    /**
     * @param $id
     * @param $menu
     * @param $type
     * @param array $authMenu
     * @return mixed
     */
    public static function authorizeHtml($id, $menu, $type, $authMenu = []) {
        $priv_data_temp = DpcAuthAccess::find()->where(['role_id' => $id, 'type' => $type])->all();
        $priv_data = [];
        if(!empty($priv_data_temp)) {
            foreach ($priv_data_temp as $key => $value) {
                $priv_data[$value['menu_id']] = $value['rule_name'];
            }
        }
        $tree = new TreeHelper();
        foreach ($menu as $n => $t) {
            $menu[$n]['checked'] = isset($priv_data[$t['id']]) ? ' checked' : '';
            $menu[$n]['level'] = $tree->get_level($t['id'], $menu);
            $menu[$n]['width'] = 100 - $menu[$n]['level'];
            $menu[$n]['disabled'] = isset($authMenu[$t['id']]) || $authMenu === true ? [0 => "style='display: none;'disabled=''", 1 => '★'] :
                [0 => '', 1 => ''];
        }
        $tree->init($menu);
        $tree->text = [
            'other' => "<label class='checkbox' data-original-title='' data-toggle='' >
                        <input \$checked \$disabled[0] name='menuid[]' value='\$id' level='\$level' onclick='javascript:checknode(this);'type='checkbox'> \$disabled[1] \$name
                   </label>",
            '0' => [
                '0' => "<dl class='checkmod'>
                    <dt class='hd'>
                        <label class='checkbox' data-original-title='' data-toggle='tooltip'>
                            <input \$checked \$disabled[0] name='menuid[]' value='\$id' level='\$level' onclick='javascript:checknode(this);' type='checkbox'> \$disabled[1] \$name
                        </label>
                    </dt>
                    <dd class='bd'>",
                '1' => "</dd></dl>",
            ],
            '1' => [
                '0' => "
                        <div class='menu_parent'>
                            <label class='checkbox' data-original-title='' data-toggle='tooltip'>
                                <input \$checked \$disabled[0] name='menuid[]' value='\$id' level='\$level' onclick='javascript:checknode(this);' type='checkbox'> \$disabled[1] \$name
                            </label>
                        </div>
                        <div class='rule_check' style='width: \$width%;'>",
                '1' => "</div><span class='child_row'></span>",
            ],
        ];
        $info['html'] = $tree->get_authTree(0);
        $info['id'] = $id;
        return $info;
    }
}