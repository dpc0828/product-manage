<?php $_auth_left_menu = \app\utils\MenuUtils::leftMenu(); ?>
<ul class="nav nav-list">
	<li class="">
		<a href="/admin/index/index">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> 首页</span>
		</a>
		<b class="arrow"></b>
	</li>
	<?php if(!empty($_auth_left_menu)) { ?>
		<?php foreach ($_auth_left_menu as $_auth_left_menu_li) { ?>
			<li class="<?php echo \app\utils\MenuUtils::activeMenu('/' . $_auth_left_menu_li["top"]["app"] . '/' . $_auth_left_menu_li["top"]["controller"]); ?>">
				<a href="javascript:;" class="dropdown-toggle">
					<i class="menu-icon <?php echo $_auth_left_menu_li['top']['icon']; ?>"></i>
					<span class="menu-text">
						<?php echo $_auth_left_menu_li['top']['name']; ?>
					</span>
					<b class="arrow fa fa-angle-down"></b>
				</a>
				<b class="arrow"></b>
				<?php if(!empty($_auth_left_menu_li['left'])) { ?>
					<ul class="submenu">
						<?php foreach ($_auth_left_menu_li['left'] as $_auth_left_menu_li_left) { ?>
							<li class="<?php echo \app\utils\MenuUtils::activeMenuList('/' . $_auth_left_menu_li_left["app"] . '/' . $_auth_left_menu_li_left["controller"] . '/' . $_auth_left_menu_li_left["action"]); ?>">
								<a href="/<?php echo $_auth_left_menu_li_left['app']; ?>/<?php echo $_auth_left_menu_li_left['controller']; ?>/<?php echo $_auth_left_menu_li_left['action']; ?>">
									<i class="menu-icon fa fa-caret-right"></i>
									<?php echo $_auth_left_menu_li_left['name']; ?>
								</a>
								<b class="arrow"></b>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</li>
		<?php } ?>
	<?php } ?>
</ul>