	<div class="page-content">
		<div class="page-header">
			<h1>
				权限管理
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					菜单管理
				</small>
			</h1>
		</div>
		<div class="page-header">
			<h1>
				<a href="/admin/operator/add-menu">
					<span class="label label-xlg label-success">添加菜单</span>
				</a>
			</h1>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table table-bordered table-hover">
						    <thead>
							    <tr>
							        <th width="50">ID</th>
							        <th>菜单名称</th>
							        <th>应用</th>
							        <th>控制器</th>
							        <th>方法</th>
							        <th width="80">状态</th>
							        <th width="180">操作</th>
							    </tr>
						    </thead>
						    <tbody>
						    	<?php echo $info; ?>
						    </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>