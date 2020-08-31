	<div class="page-content">
		<div class="page-header">
			<h1>
				权限管理
				<small>
					<i class="ace-icon fa fa-angle-double-right"></i>
					角色列表
				</small>
			</h1>
		</div>
		<div class="page-header">
			<h1>
				<a href="/admin/operator/add-role">
					<span class="label label-xlg label-success">添加角色</span>
				</a>
			</h1>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="row">
					<div class="col-xs-12">
						<table id="simple-table" class="table  table-bordered table-hover">
							<thead>
								<tr>
									<th class="center">ID</th>
									<th>角色名称</th>	
									<th>角色描述</th>		
									<th>操作</th>
								</tr>
							</thead>
							<?php if(!empty($list)) { ?>
								<tbody>
									<?php foreach ($list as $key => $vo) { ?>
										<tr class="">
											<td class="center"><?php echo $vo['id']; ?></td>
											<td><?php echo $vo['name']; ?></td>
											<td><?php echo $vo['remark']; ?></td>
											<td>
												<div class="hidden-sm hidden-xs action-buttons">
													<a target="_blank" class="green" href="/admin/operator/edit-role?id=<?php echo $vo['id']; ?>" title="编辑">
														<i class="ace-icon fa fa-pencil bigger-130"></i>
													</a>

													<a target="_blank" class="red" href="/admin/operator/auth-role?id=<?php echo $vo['id']; ?>" title="权限">
														<i class="ace-icon fa fa-lock bigger-130"></i>
													</a>

													<a class="data-delete red" data-title="确认删除？" href="javascript:;" title="删除" data-href="/admin/operator/delete-role?id=<?php echo $vo['id']; ?>">
														<i class="ace-icon fa fa-trash-o bigger-130"></i>
													</a>
												</div>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							<?php } ?>
						</table>
					</div>
				</div>
				<div class="hr hr-18 dotted hr-double"></div>
			</div>
		</div>
	</div>