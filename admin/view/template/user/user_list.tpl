<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;">
				<div class="pull-right">
					<a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-info btn-fill"><i class="fa fa-plus"></i></a>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-fill" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
				</div>
			</div>
		</div>
		<div class="row">
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
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title"><i class="fa fa-list"></i> <?php echo $heading_title; ?></h4>
						<p class="category"><?php echo $text_list; ?></p>
					</div>
					<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="content table-responsive table-full-width">
						<table class="table">
							<thead>
								<tr>
								  <th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
								  <th class="text-left"><?php if ($sort == 'username') { ?>
									<a href="<?php echo $sort_username; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_username; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_username; ?>"><?php echo $column_username; ?></a>
									<?php } ?></th>
								  <th class="text-left"><?php if ($sort == 'status') { ?>
									<a href="<?php echo $sort_status; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_status; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_status; ?>"><?php echo $column_status; ?></a>
									<?php } ?></th>
								  <th class="text-left"><?php if ($sort == 'date_added') { ?>
									<a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
									<?php } ?></th>
								  <th class="text-right"><?php echo $column_action; ?></th>
								</tr>
							</thead>
							<tbody>
								<?php if ($users) { ?>
								<?php foreach ($users as $user) { ?>
								<tr>
								  <td class="text-center"><?php if (in_array($user['user_id'], $selected)) { ?>
									<input type="checkbox" name="selected[]" value="<?php echo $user['user_id']; ?>" checked="checked" />
									<?php } else { ?>
									<input type="checkbox" name="selected[]" value="<?php echo $user['user_id']; ?>" />
									<?php } ?></td>
								  <td class="text-left"><?php echo $user['username']; ?></td>
								  <td class="text-left"><?php echo $user['status']; ?></td>
								  <td class="text-left"><?php echo $user['date_added']; ?></td>
								  <td class="text-right">
									<a href="<?php echo $user['edit']; ?>" rel="tooltip" title="" class="btn btn-success btn-simple btn-xs" data-original-title="<?php echo $button_edit; ?>">
										<i class="fa fa-edit" style="font-size: 25px;"></i>
									</a>
								  </td>
								</tr>
								<?php } ?>
								<?php } else { ?>
								<tr>
								  <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					</form>
				</div>
				
				<div class="panel panel-default">			  
				  <div class="panel-body">
					<div class="row">
						<div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
						<div class="col-sm-6 text-right"><?php echo $results; ?></div>
					</div>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?> 