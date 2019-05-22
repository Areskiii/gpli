<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;">
				<div class="pull-right">
					<button type="submit" form="form-user-group" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success btn-fill"><i class="fa fa-save"></i></button>
					<a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-warning btn-fill"><i class="fa fa-reply"></i></a>
				</div>
			</div>
		</div>
		<div class="row">
			<?php if ($error_warning) { ?>
			<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
			  <button type="button" class="close" data-dismiss="alert">&times;</button>
			</div>
			<?php } ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h4>
						<p class="category"><?php echo $text_form; ?></p>
					</div>				
					<div class="content">
						<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user-group" class="form-horizontal">
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo $entry_name; ?></label>
									<div class="col-sm-10">
										<input type="text" name="name" value="<?php echo $name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control">
										<?php if ($error_name) { ?>
										<span class="help-block text-danger"><?php echo $error_name; ?></span>
										<?php  } ?>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo $entry_access; ?></label>
									<div class="col-sm-10">
										<div class="well well-sm" style="height: 150px; overflow: auto;">
											<?php foreach ($permissions as $permission) { ?>
											  <label class="checkbox">
												<?php if (in_array($permission, $access)) { ?> 
												<input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" checked="checked" data-toggle="checkbox" />
												<?php echo $permission; ?>
												<?php } else { ?>
												<input type="checkbox" name="permission[access][]" value="<?php echo $permission; ?>" data-toggle="checkbox" />
												<?php echo $permission; ?>
												<?php } ?>
											  </label>
											<?php } ?>
										</div>
										<a onclick="$(this).parent().children().find(':checkbox').prop('checked', true);$(this).parent().children().find('.checkbox').attr('class', 'checkbox checked');"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().children().find(':checkbox').prop('checked', false);$(this).parent().children().find('.checkbox').attr('class', 'checkbox');"><?php echo $text_unselect_all; ?></a>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo $entry_modify; ?></label>
									<div class="col-sm-10">
										<div class="well well-sm" style="height: 150px; overflow: auto;">
											<?php foreach ($permissions as $permission) { ?>											
											  <label class="checkbox">
												<?php if (in_array($permission, $modify)) { ?> 
												<input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" checked="checked" data-toggle="checkbox" />
												<?php echo $permission; ?>
												<?php } else { ?>
												<input type="checkbox" name="permission[modify][]" value="<?php echo $permission; ?>" data-toggle="checkbox" />
												<?php echo $permission; ?>
												<?php } ?>
											  </label>											
											<?php } ?>
										</div>
										<a onclick="$(this).parent().children().find(':checkbox').prop('checked', true);$(this).parent().children().find('.checkbox').attr('class', 'checkbox checked');"><?php echo $text_select_all; ?></a> / <a onclick="$(this).parent().children().find(':checkbox').prop('checked', false);$(this).parent().children().find('.checkbox').attr('class', 'checkbox');"><?php echo $text_unselect_all; ?></a>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo $footer; ?> 