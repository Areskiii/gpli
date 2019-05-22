<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<?php if ($error_warning) { ?>
				<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
				<?php } ?>
				<?php if ($success) { ?>
				<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
				  <button type="button" class="close" data-dismiss="alert">&times;</button>
				</div>
				<?php } ?>
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="header"><?php echo $text_db_setting; ?></div>
					<div class="content">
						<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo $entry_db_driver; ?> <star>*</star></label>
								<div class="col-md-9">
									<input type="text" name="dbsetting_drive" value="<?php echo $dbsetting_drive; ?>" placeholder="<?php echo $entry_db_driver; ?>" class="form-control">
									<?php if ($error_drive) { ?>
										<div class="text-danger"><?php echo $error_drive; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo $entry_db_hostname; ?> <star>*</star></label>
								<div class="col-md-9">
									<input type="text" name="dbsetting_hostname" value="<?php echo $dbsetting_hostname; ?>" placeholder="<?php echo $entry_db_hostname; ?>" class="form-control">
									<?php if ($error_hostname) { ?>
										<div class="text-danger"><?php echo $error_hostname; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo $entry_db_username; ?> <star>*</star></label>
								<div class="col-md-9">
									<input type="text" name="dbsetting_username" value="<?php echo $dbsetting_username; ?>" placeholder="<?php echo $entry_db_username; ?>" class="form-control">
									<?php if ($error_username) { ?>
										<div class="text-danger"><?php echo $error_username; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo $entry_db_password; ?> <star>*</star></label>
								<div class="col-md-9">
									<input type="password" name="dbsetting_password" value="<?php echo $dbsetting_password; ?>" class="form-control">
									<?php if ($error_password) { ?>
										<div class="text-danger"><?php echo $error_password; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo $entry_db_database_name; ?> <star>*</star></label>
								<div class="col-md-9">
									<input type="text" name="dbsetting_database_name" value="<?php echo $dbsetting_database_name; ?>" placeholder="<?php echo $entry_db_database_name; ?>" class="form-control">
									<?php if ($error_database_name) { ?>
										<div class="text-danger"><?php echo $error_database_name; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label"><?php echo $entry_db_port; ?></label>
								<div class="col-md-9">
									<input type="text" name="dbsetting_port" value="<?php echo $dbsetting_port; ?>" placeholder="<?php echo $entry_db_port; ?>" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3"></label>
								<div class="col-md-9">
									<button type="submit" class="btn btn-fill btn-info"><?php echo $button_save; ?></button>
								</div>
							</div>
						</form>
					</div>
				</div> <!-- end card -->
			</div>
			<div class="col-md-6">
				<div class="card">
					<div class="header"><?php echo $text_database_server; ?></div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<tbody>
								<tr>
									<td width="30%"><?php echo $text_mysql_version; ?></td>
									<td><?php echo $server_info; ?></td>
								</tr>
								<tr>
									<td><?php echo $text_mysql_client; ?></td>
									<td><?php echo $client_info; ?></td>
								</tr>
								<tr>
									<td><?php echo $text_mysql_host; ?></td>
									<td><?php echo $host_info; ?></td>
								</tr>
								<tr>
									<td><?php echo $text_mysql_protocol; ?></td>
									<td><?php echo $proto_info; ?></td>
								</tr>
								<tr>
									<td><?php echo $text_php_version; ?></td>
									<td><?php echo $php_version; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div> <!-- end card -->
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>