<?php
namespace app\controllers\admin;
use Yii;
use app\models\Operator AS DpcOperator;
use app\models\AuthAccess AS DpcAuthAccess;
use app\models\AuthMenu AS DpcAuthMenu;
use app\models\AuthRole AS DpcAuthRole;
use app\models\AuthRoleUser AS DpcAuthRoleUser;
use app\models\AuthRule AS DpcAuthRule;
use app\utils\Utils AS UtilsHelper;
use app\utils\MenuUtils AS MenuHelper;
use app\utils\TreeUtils AS TreeHelper;
use yii\data\Pagination;
use yii\widgets\LinkPager;
class OperatorController extends AdminBaseController {


    /**
     * 用户登陆 同一用户同一时刻只能有一个登陆,后登陆用户挤掉之前登陆的
     * @return Json|string
     * @throws \yii\base\ExitException
     */
	public function actionLogin() {
		if (Yii::$app->request->isPost) {
			try {
				$username = trim(yii::$app->request->post('username'));
				$password = trim(yii::$app->request->post('password'));
				$userInfo = DpcOperator::findOne(['username' => $username]); 
				if(empty($userInfo)) {
					return $this->errorJson('登录失败，用户名或密码错误');
				}

				if($userInfo['state'] != 1) {
					return $this->errorJson('用户已禁止使用，请联系管理员');
				}
				if (!Yii::$app->getSecurity()->validatePassword(self::PASSWORD_PREFIX . $password, $userInfo['password'])) {
//					return $this->errorJson('登录失败，用户名或密码错误');
				}
				$salt = Yii::$app->getSecurity()->generateRandomString(32);
				$last_logintime = date('Y-m-d H:i:s');
				$last_loginip = Yii::$app->request->getUserIP();
				$expire = strtotime($last_logintime) + self::LOGIN_EXPIRE_TIME;
				$userInfo->salt = $salt;
				$userInfo->last_logintime = $last_logintime;
				$userInfo->last_loginip = $last_loginip;
				if($userInfo->save()) {
					$cookie_encrypt_data = [
						'salt' => $salt,
						'last_logintime' => $last_logintime,
						'last_loginip' => $last_loginip,
						'expire' =>  $expire,
						'id' => $userInfo['id'],
					];
					$encryptedData = Yii::$app->getSecurity()->encryptByPassword(http_build_query($cookie_encrypt_data), self::PASSWORD_PREFIX);
					$cookies = Yii::$app->response->cookies;
					if ($cookies->has(yii::$app->params['admin_cookie_name'])) {
						$cookies->remove(yii::$app->params['admin_cookie_name']);
					}
					$cookies->add(new \yii\web\Cookie([
					    'name' => yii::$app->params['admin_cookie_name'],
					    'value' => $encryptedData,
					    'expire' => $expire,
					]));
					return $this->successJson('登录成功');
				}
				return $this->errorJson('登录失败');
			} catch (\Exception $e) {
				return $this->errorJson('登录失败，用户名或密码错误');
			}
		} else {
			$this->layout = false;
			return $this->render('login');
		}
	}

    /**
     * 退出登录
     * @return \yii\web\Response
     */
	public function actionLoginout() {
		if(Yii::$app->request->cookies->has(yii::$app->params['admin_cookie_name'])) {
			Yii::$app->response->cookies->remove(yii::$app->params['admin_cookie_name']);
		}
		return $this->redirect('/admin/operator/login');
	}

    /**
     * 添加管理员
     * @return Json|string
     * @throws \yii\base\Exception
     * @throws \yii\base\ExitException
     */
	public function actionAdd() {
		if (Yii::$app->request->isPost) {
			$username = trim(Yii::$app->request->post('username'));
			$title = trim(Yii::$app->request->post('title'));
			$password = trim(Yii::$app->request->post('password'));
			$confirm_password = trim(Yii::$app->request->post('confirm_password'));
			$state = Yii::$app->request->post('state');
			$user = DpcOperator::findOne(['username' => $username]);
			if (empty($username)) {
				return $this->errorJson('请输入登录用户名');
			}

			if (UtilsHelper::operatorUserName($username) === false) {
				return $this->errorJson('登录用户名由数字+字母组成，长度6-15位');
			}

			if (empty($title)) {
				return $this->errorJson('请输入姓名');
			}

			if (empty($password)) {
				return $this->errorJson('请输入登录密码');
			}

			if (UtilsHelper::operatorPassword($password) === false) {
				return $this->errorJson('登录密码用户名由数字+字母组成，长度8-15位');
			}

			if ($password != $confirm_password) {
				return $this->errorJson('两次输入密码不一致');
			}

			if (!empty($user)) {
				return $this->errorJson('用户名已存在');
			}

			$user = new DpcOperator();
			$user->username = $username;
			$user->title = $title;
			$user->password = Yii::$app->getSecurity()->generatePasswordHash(self::PASSWORD_PREFIX . $password);
			$user->salt = Yii::$app->getSecurity()->generateRandomString(32);
			$user->state = $state;
			if ($user->save()) {
				return $this->successJson('添加成功');
			} else {
				return $this->errorJson('管理员添加失败,请重试');
			}
		} else {
			return $this->render('add');
		}
	}

    /**
     * 编辑管理员
     * @return Json|string|\yii\web\Response
     * @throws \yii\base\Exception
     * @throws \yii\base\ExitException
     */
	public function actionEdit() {
		$id = (int) yii::$app->request->get('id');
		$info = DpcOperator::findOne($id);
		if (Yii::$app->request->isPost) {
			$username = trim(Yii::$app->request->post('username'));
			$title = trim(Yii::$app->request->post('title'));
			$password = trim(Yii::$app->request->post('password'));
			$confirm_password = trim(Yii::$app->request->post('confirm_password'));
			$state = Yii::$app->request->post('state');
			$role = Yii::$app->request->post('role');
			if (empty($username)) {
				return $this->errorJson('请输入登录用户名');
			}

			if(empty($info)) {
				return $this->errorJson('信息不存在');
			}

			if (UtilsHelper::operatorUserName($username) === false) {
				return $this->errorJson('登录用户名由数字+字母组成，长度6-15位');
			}

			if (empty($title)) {
				return $this->errorJson('请输入姓名');
			}

			if(!empty($password)) {
				if (empty($password)) {
					return $this->errorJson('请输入登录密码');
				}
				if (UtilsHelper::operatorPassword($password) === false) {
					return $this->errorJson('登录密码用户名由数字+字母组成，长度8-15位');
				}
				if ($password != $confirm_password) {
					return $this->errorJson('两次输入密码不一致');
				}
			}
			$user = DpcOperator::find()->where(['!=', 'id', $id])->andWhere(['username' => $username])->one();
			if (!empty($user)) {
				return $this->errorJson('用户名已存在');
			}
			$roles = array_filter($role);
			$info->username = $username;
			$info->title = $title;
			$info->role = implode(",", $roles);
            $user->salt = Yii::$app->getSecurity()->generateRandomString(32);
			if(!empty($password)) {
				$info->password = Yii::$app->getSecurity()->generatePasswordHash(self::PASSWORD_PREFIX . $password);
			}
			$info->state = $state;
			if ($info->save()) {
				# 保存角色ID
				DpcAuthRoleUser::deleteAll(["user_id" => $id]);
				if(!empty($roles)){
					foreach ($roles as $key => $value) {
						$models = new DpcAuthRoleUser();
						$models->role_id = $value;
						$models->user_id = $id;
						$models->save();
						unset($models);
					}
				}
				return $this->successJson();
			} else {
				return $this->errorJson();
			}
		} else {
			if(empty($info)) {
				return $this->redirect('/admin/operator/menu');
			}
			$role = self::role($info['role']);
			return $this->render('edit', [
				'info' => $info,
				'role' => $role,
			]);
		}
	}

    /**
     * 角色选择
     * @param string $roleid
     * @return string
     */
	private static function role($roleid = '') {
		$roleid = explode(',', $roleid);
		$role = DpcAuthRole::find()->all();
		$html = '';
		foreach ($role as $k => $v) {
			$selected = in_array($v['id'], $roleid) ? 'selected' : '';
			$html .= ' <option ' . $selected . ' value="' . $v['id'] . '">' . $v['name'] . '</option>';
		}
		return $html;
	}

    /**
     * 管理员列表
     * @return string
     * @throws \Exception
     */
	public function actionIndex() {
		$state = yii::$app->request->get('state');
		$keyword = yii::$app->request->get('keyword');
		$list = (new \yii\db\Query())->from(DpcOperator::tableName());
		if(!empty($keyword)) {
			$list = $list->where(['like', 'username', $keyword]);
		}

		if ($state != '') {
			$list = $list->andWhere(['state' => $state]);
		}

		$count = $list->count();
		$pagination = new Pagination([
			'totalCount' => $count,
			'defaultPageSize' => $this->pageSize,
		]);

		$list = $list->orderBy('id DESC')->limit($pagination->pageSize)->offset($pagination->offset)->all();
		return $this->render('index', [
			'state' => $state,
			'keyword' => $keyword,
			'page' => LinkPager::widget([
				'pagination' => $pagination,
			]),
			'list' => $list,
		]);
	}

    /**
     * 菜单列表
     * @return string
     */
	public function actionMenu() {
		$result = DpcAuthMenu::find()->orderBy('id asc')->asArray()->all();

		$result_revert = [];
		if(!empty($result)) {
			foreach ($result as $key => $value) {
				$result_revert[$value['id']] = $value;
			}
		}

		$tree = new TreeHelper();
		$tree->nbsp = '&nbsp;&nbsp;&nbsp;';
		foreach ($result as $n => $r) {
			$result[$n]['level'] = $tree->get_level($r['id'], $result_revert);
			$result[$n]['parent_id_node'] = ($r['parent_id']) ? ' class="child-of-node-' . $r['parent_id'] . '"' : '';
			$result[$n]['str_manage'] = '<div class="hidden-sm hidden-xs action-buttons"><a class="blue" title="添加子菜单" href="/admin/operator/add-menu?parent_id=' . $r['id'] . '"><i class="ace-icon fa fa-search-plus bigger-130"></i></a>';
			$result[$n]['str_manage'] .= '<a class="green" title="编辑" href="/admin/operator/edit-menu?id=' . $r['id'] . '"><i class="ace-icon fa fa-pencil bigger-130"></i></a>';
			$result[$n]['str_manage'] .= '<a class="red data-delete" data-title="确认删除？" href="javascript:;" title="删除" data-href="/admin/operator/delete-menu?id=' . $r['id'] . '"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></div>';
			$result[$n]['status'] = $r['status'] ? '开启' : '隐藏';
		}
		$str = "<tr id='node-\$id' \$parent_id_node>
                    <td>\$id</td>
                    <td>\$spacer  \$name</td>
                    <td>\$app</td>
                    <td>\$controller</td>
                    <td>\$action</td>
                    <td>\$status</td>
                    <td>\$str_manage</td>
                </tr>";
		$tree->init($result);
		$info = $tree->get_tree(0, $str);
		return $this->render('menu', [
			'info' => $info,
		]);
	}

    /**
     * 添加菜单
     * @return Json|string
     * @throws \yii\base\ExitException
     */
	public function actionAddMenu() {
		$parent_id = (int)yii::$app->request->get('parent_id');
		if(yii::$app->request->isPost) {
			$name = trim(yii::$app->request->post('name'));
			$app = trim(yii::$app->request->post('app'));
			$controller = trim(yii::$app->request->post('controller'));
			$action = trim(yii::$app->request->post('action'));

			$status = (int)yii::$app->request->post('status');
			$type = (int)yii::$app->request->post('type');
			$parent_id = (int)yii::$app->request->post('parent_id');

			$icon = trim(yii::$app->request->post('icon'));

			$remark = trim(yii::$app->request->post('remark'));

			if(empty($name)) {
				return $this->errorJson('请填写功能名');
			}

			if(empty($app)) {
				return $this->errorJson('请填写应用名');
			}

			if(empty($controller)) {
				return $this->errorJson('请填写控制器名');
			}

			if(empty($action)) {
				return $this->errorJson('请填写方法名');
			}

			if(!in_array($status, [1, 2])) {
				return $this->errorJson('参数错误');
			}

			if(!in_array($type, [1, 2, 3])) {
				return $this->errorJson('参数错误');
			}
			$models = new DpcAuthMenu();
			$models->parent_id = $parent_id;
			$models->name = $name;
			$models->app = $app;
			$models->controller = $controller;
			$models->action = $action;
			$models->type = $type;
			$models->status = $status;
			$models->remark = $remark;
			$models->icon = $icon;
			if($models->save()) {
				return $this->successJson();
			}
			return $this->errorJson();
		} else {
			$selectCategorys = MenuHelper::menu($parent_id);
			return $this->render('add-menu', [
				'selectCategorys' => $selectCategorys,
			]);
		}
	}

    /**
     * 编辑菜单
     * @return Json|string|\yii\web\Response
     * @throws \yii\base\ExitException
     */
	public function actionEditMenu() {
		$id = yii::$app->request->get('id');
		$info = DpcAuthMenu::findOne($id);
		if(yii::$app->request->isPost) {
			$name = trim(yii::$app->request->post('name'));
			$app = trim(yii::$app->request->post('app'));
			$controller = trim(yii::$app->request->post('controller'));
			$action = trim(yii::$app->request->post('action'));
			$icon = trim(yii::$app->request->post('icon'));

			$status = (int)yii::$app->request->post('status');
			$type = (int)yii::$app->request->post('type');
			$parent_id = (int)yii::$app->request->post('parent_id');

			$remark = trim(yii::$app->request->post('remark'));

			if(empty($info)) {
				return $this->errorJson('信息不存在');
			}

			if(empty($name)) {
				return $this->errorJson('请填写功能名');
			}

			if(empty($app)) {
				return $this->errorJson('请填写应用名');
			}

			if(empty($controller)) {
				return $this->errorJson('请填写控制器名');
			}

			if(empty($action)) {
				return $this->errorJson('请填写方法名');
			}

			if(!in_array($status, [1, 2])) {
				return $this->errorJson('参数错误');
			}

			if(!in_array($type, [1, 2, 3])) {
				return $this->errorJson('参数错误');
			}
			$info->parent_id = $parent_id;
			$info->name = $name;
			$info->app = $app;
			$info->controller = $controller;
			$info->action = $action;
			$info->type = $type;
			$info->status = $status;
			$info->remark = $remark;
			$info->icon = $icon;
			if($info->save()) {
				return $this->successJson();
			}
			return $this->errorJson();
		} else {
			if(empty($info)) {
				return $this->redirect('/admin/operator/menu');
			}
			$selectCategorys = MenuHelper::menu($info['parent_id']);
			return $this->render('edit-menu', [
				'selectCategorys' => $selectCategorys,
				'info' => $info,
			]);
		}
	}

    /**
     * 删除菜单
     * @return Json
     * @throws \yii\base\ExitException
     */
	public function actionDeleteMenu() {
		if(yii::$app->request->isPost) {
			$id = (int) yii::$app->request->get('id');
			$info = DpcAuthMenu::findOne($id);
			if(empty($info)) {
				return $this->errorJson("信息不存在");
			}
			$hasChild = DpcAuthMenu::find()->where(['parent_id' => $id])->count();
			if($hasChild > 0) {
				return $this->errorJson("有子菜单不可删除");
			}
			$db = Yii::$app->db;
			$transaction = $db->beginTransaction();
			try {
				$transaction->commit();
				# 删除菜单
				$db->createCommand("DELETE FROM " . DpcAuthMenu::tableName() . " WHERE id = " . $id)->execute();

				# 删除规则菜单
				$db->createCommand("DELETE FROM " . DpcAuthRule::tableName() . " WHERE menu_id = " . $id)->execute();

				# 删除菜单角色权限 && 删除用户分配权限
				$db->createCommand("DELETE FROM " . DpcAuthAccess::tableName() . " WHERE menu_id = " . $id)->execute();
			} catch (\Exception $e) {
				$transaction->rollBack();
				return $this->errorJson();
			}
			return $this->successJson();
		}
	}

    /**
     * 角色列表
     * @return string
     */
	public function actionRole() {
		$data = DpcAuthRole::find()->all();
		return $this->render('role', [
			'list' => $data,
		]);
	}
    /**
     * 添加角色
     * @return Json|string
     * @throws \yii\base\ExitException
     */
	public function actionAddRole() {
		if(yii::$app->request->isPost) {
			$name = trim(yii::$app->request->post('name'));
			$remark = trim(yii::$app->request->post('remark'));
			$status = (int)yii::$app->request->post('status');
			if(empty($name)) {
				return $this->errorJson('请填写角色名称');
			}
			if(!in_array($status, [1, 2])) {
				return $this->errorJson('参数错误');
			}
			$models = new DpcAuthRole();
			$models->name = $name;
			$models->pid = 0;
			$models->status = $status;
			$models->remark = $remark;
			$models->create_time = date('Y-m-d H:i:s');
			$models->update_time = date('Y-m-d H:i:s');
			if($models->save()){
				return $this->successJson();
			}
			return $this->errorJson();
		} else {
			return $this->render('add-role');
		}
	}

    /**
     * 编辑角色
     * @return Json|string|\yii\web\Response
     * @throws \yii\base\ExitException
     */
	public function actionEditRole() {
		$id = (int) yii::$app->request->get('id');
		$info = DpcAuthRole::findOne($id);
		if(yii::$app->request->isPost) {
			$name = trim(yii::$app->request->post('name'));
			$remark = trim(yii::$app->request->post('remark'));
			$status = (int)yii::$app->request->post('status');

			if(empty($info)) {
				return $this->errorJson('信息不存在');
			}

			if(empty($name)) {
				return $this->errorJson('请填写角色名称');
			}

			if(!in_array($status, [1, 2])) {
				return $this->errorJson('参数错误');
			}

			$info->name = $name;
			$info->pid = 0;
			$info->status = $status;
			$info->remark = $remark;
			$info->create_time = date('Y-m-d H:i:s');
			$info->update_time = date('Y-m-d H:i:s');
			if($info->save()){
				return $this->successJson();
			}
			return $this->errorJson();
		} else {
			if(empty($info)) {
				return $this->redirect('/admin/operator/role');
			}
			return $this->render('edit-role', [
				'info' => $info
			]);
		}
	}

    /**
     * 删除角色
     * @return Json
     * @throws \yii\base\ExitException
     */
	public function actionDeleteRole() {
		if(yii::$app->request->isPost) {
			$id = (int) yii::$app->request->get('id');
			if($id == self::SUPER_ADMIN_ID) {
				return $this->errorJson("超级管理员不能删除");
			}
			$info = DpcAuthRole::findOne($id);
			if(empty($info)) {
				return $this->errorJson("信息不存在");
			}
			$db = Yii::$app->db;
			$transaction = $db->beginTransaction();
			try {
				$transaction->commit();
				# 删除角色表
				$db->createCommand("DELETE FROM " . DpcAuthRole::tableName() . " WHERE id = " . $id)->execute();
				# 删除用户角色表
				$db->createCommand("DELETE FROM " . DpcAuthRoleUser::tableName() . " WHERE role_id = " . $id)->execute();
				# 删除角色权限
				$db->createCommand("DELETE FROM " . DpcAuthAccess::tableName() . " WHERE role_id = " . $id . " AND type = 'admin_url'")->execute();
			} catch (\Exception $e) {
				$transaction->rollBack();
				return $this->errorJson();
			}
			return $this->successJson();
		}
	}

    /**
     * 角色权限分配
     * @return Json|string|\yii\web\Response
     * @throws \yii\base\ExitException
     * @throws \yii\db\Exception
     */
	public function actionAuthRole() {
		$id = (int)yii::$app->request->get('id');
		$roleInfo = DpcAuthRole::findOne($id);
		$menu_temp = DpcAuthMenu::find()->orderBy("id ASC")->asArray()->all();
		$menu = [];
		if(!empty($menu_temp)) {
			foreach ($menu_temp as $key => $value) {
				$menu[$value['id']] = $value;
			}
		}
		if(yii::$app->request->isPost) {
			if(empty($roleInfo)) {
				return $this->errorJson('需要授权的角色不存在');
			}
			$menuid = yii::$app->request->post('menuid');
			DpcAuthAccess::deleteAll(["role_id" => $id, 'type' => 'admin_url']);
			if (is_array($menuid) && count($menuid) > 0) {
				foreach ($menuid as $v) {
					$menus = isset($menu[$v]) ? $menu[$v] : '';
					if ($menus) {
						$name = strtolower("/{$menus['app']}/{$menus['controller']}/{$menus['action']}");
						$data[] = [
							"role_id" => $id,
							"rule_name" => $name,
							'type' => 'admin_url',
							'menu_id' => $v,
						];
					}
				}
				if (!empty($data)) {
					if (Yii::$app->db->createCommand()->batchInsert(DpcAuthAccess::tableName(), ['role_id', 'rule_name', 'type', 'menu_id'], $data)->execute()) {
						return $this->successJson();
					}
					return $this->errorJson();
				}
			}
			return $this->errorJson();
		} else {
			if (empty($roleInfo)) {
				return $this->redirect('/admin/operator/role');
			}
			$info = MenuHelper::authorizeHtml($id, $menu, 'admin_url');
			return $this->render('auth-role', [
				'info' => $info,
				'id' => $id,
			]);
		}
	}

    /**
     * 管理员权限分配
     * @return Json|string|\yii\web\Response
     * @throws \yii\base\ExitException
     * @throws \yii\db\Exception
     */
	public function actionAuth() {
		$id = (int)yii::$app->request->get('id');
		$name = yii::$app->request->get('name');
		$opInfo = DpcOperator::findOne($id);
		$menu_temp = DpcAuthMenu::find()->orderBy("id ASC")->asArray()->all();
		$menu = [];
		if(!empty($menu_temp)) {
			foreach ($menu_temp as $key => $value) {
				$menu[$value['id']] = $value;
			}
		}

		if(yii::$app->request->isPost) {
			if(empty($opInfo)) {
				return $this->errorJson('需要授权的用户不存在');
			}
			$menuid = yii::$app->request->post('menuid');
			DpcAuthAccess::deleteAll(["role_id" => $id, 'type' => 'admin']);
			if (is_array($menuid) && count($menuid) > 0) {
				foreach ($menuid as $v) {
					$menus = isset($menu[$v]) ? $menu[$v] : '';
					if ($menus) {
						$name = strtolower("/{$menus['app']}/{$menus['controller']}/{$menus['action']}");
						$data[] = [
							"role_id" => $id,
							"rule_name" => $name,
							'type' => 'admin',
							'menu_id' => $v,
						];
					}
				}
				if (!empty($data)) {
					if (Yii::$app->db->createCommand()->batchInsert(DpcAuthAccess::tableName(), ['role_id', 'rule_name', 'type', 'menu_id'], $data)->execute()) {
						return $this->successJson();
					}
					return $this->errorJson();
				}
			}
			return $this->errorJson();
		} else {
			if (empty($opInfo)) {
				return $this->redirect('/admin/operator/index');
			}
			$roleIdTmp = DpcAuthRoleUser::find()->where(['user_id' => $id])->all();
			$roleId = [];
			if(!empty($roleIdTmp)) {
				foreach ($roleIdTmp as $key => $value) {
					$roleId[] = $value['role_id'];
				}
			}

			if (in_array(self::SUPER_ADMIN_ID, $roleId)) {
				$AuthAccess = true;
			} else if (empty($roleId)) {
				$AuthAccess = [];
			} else {
				$AuthAccessTmp = DpcAuthAccess::find()->where(['in', "role_id", $roleId])->asArray()->all();
				$AuthAccess = [];
				if(!empty($AuthAccessTmp)) {
					foreach ($AuthAccessTmp as $key => $value) {
						$AuthAccess[$value['menu_id']] = $value;
					}
				}
			}
			$info = MenuHelper::authorizeHtml($id, $menu, 'admin', $AuthAccess);
			return $this->render('auth', [
				'info' => $info, 
				'id' => $id, 
				'name' => $name
			]);
		}
	}
}