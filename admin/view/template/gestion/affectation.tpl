<?php echo $header; ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px;">
				<div class="pull-right">
					<a href="<?php echo $insert; ?>" data-toggle="tooltip" title="<?php echo $button_insert; ?>" class="btn btn-info btn-fill"><i class="fa fa-plus"></i></a>
					<button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger btn-fill" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-user').submit() : false;"><i class="fa fa-trash-o"></i></button>
				</div>
			</div>	
			<div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;">	
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
								<th class="text-left"><?php if ($sort == 'user') { ?>
									<a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_user; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_user; ?>"><?php echo $column_user; ?></a>
									<?php } ?></th>								
								<th class="text-left"><?php if ($sort == 'bureau') { ?>
									<a href="<?php echo $sort_bureau; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_bureau; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_bureau; ?>"><?php echo $column_bureau; ?></a>
									<?php } ?></th>
								<th class="text-left"><?php if ($sort == 'site') { ?>
									<a href="<?php echo $sort_site; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_site; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_site; ?>"><?php echo $column_site; ?></a>
									<?php } ?></th>
								<th class="text-left"><?php if ($sort == 'matriel') { ?>
									<a href="<?php echo $sort_matriel; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_matriel; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_matriel; ?>"><?php echo $column_matriel; ?></a>
									<?php } ?></th>
								<th class="text-right"><?php echo $column_action; ?></th>
							</tr>
						</thead>
						<tbody>		
							<?php if ($Affectations) { ?>
							<?php foreach ($Affectations as $Affectation) { ?>
							<tr>
								<td class="text-center"><?php if (in_array($Article['id'], $selected)) { ?>
									<input type="checkbox" name="selected[]" value="<?php echo $Affectation['id']; ?>" checked="checked" />
									<?php } else { ?>
									<input type="checkbox" name="selected[]" value="<?php echo $Affectation['id']; ?>" />
									<?php } ?>
								</td>
								<td class="text-left"><?php echo $Affectation['user']; ?></td>
								<td class="text-left"><?php echo $Affectation['bureau']; ?></td>
								<td class="text-left"><?php echo $Affectation['site']; ?></td>
								<td class="text-left"><?php echo $Affectation['matriel']; ?></td>
								<td class="text-right">
									<a href="<?php echo $Affectation['edit']; ?>" rel="tooltip" title="" class="btn btn-success btn-simple btn-xs" data-original-title="<?php echo $button_edit; ?>">
										<i class="fa fa-edit" style="font-size: 25px;"></i>
									</a>
								</td>
							</tr>
							<?php } ?>
							<?php } else { ?>
							<tr>
								<td class="text-center" colspan="14"><?php echo $text_no_results; ?></td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		
				<div class="panel panel-default">			  
				  <div class="panel-body">
					<div class="row">
						<div class="col-sm-8 text-left"><?php echo $pagination; ?></div>
						<div class="col-sm-4 text-right"><?php echo $results; ?></div>
					</div>
				  </div>
				</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>