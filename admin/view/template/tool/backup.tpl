<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
  <div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;">
		<div class="pull-right">
			<button type="submit" form="form-backup" data-toggle="tooltip" title="<?php echo $button_backup; ?>" class="btn btn-info btn-fill"><i class="fa fa-download"></i></button>
			<button type="submit" form="form-restore" data-toggle="tooltip" title="<?php echo $button_restore; ?>" class="btn btn-danger btn-fill"><i class="fa fa-upload"></i></button>
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
					<h4 class="title"><i class="fa fa-exchange"></i> <?php echo $heading_title; ?></h4>
				</div>
				<div class="content">
					<form action="<?php echo $restore; ?>" method="post" enctype="multipart/form-data" id="form-restore" class="form-horizontal">					
						<div class="form-group">
							<label class="col-sm-2 control-label" for="input-import"><?php echo $entry_restore; ?></label>
							<div class="col-sm-10">
							  <input type="file" name="import" id="input-import" />
							</div>
						</div>					
					</form>
					<form action="<?php echo $backup; ?>" method="post" enctype="multipart/form-data" id="form-backup" class="form-horizontal">					
						<div class="form-group">
							<label class="col-sm-2 control-label"><?php echo $entry_backup; ?></label>
							<div class="col-sm-10">
								<div class="well well-sm" style="height: 150px; overflow: auto;">
								<?php foreach ($tables as $table) { ?>
									<div class="checkbox">
										<label>
											<input type="checkbox" name="backup[]" value="<?php echo $table; ?>" checked="checked" data-toggle="checkbox" />
											<?php echo $table; ?>
										</label>
									</div>
								<?php } ?>
								</div>
							  <a onclick="$(this).parent().children().find(':checkbox').prop('checked', true);$(this).parent().children().find('.checkbox').attr('class', 'checkbox checked');" style="cursor: pointer;"><?php echo $text_select_all; ?></a> / 
							  <a onclick="$(this).parent().children().find(':checkbox').prop('checked', false);$(this).parent().children().find('.checkbox').attr('class', 'checkbox');" style="cursor: pointer;"><?php echo $text_unselect_all; ?></a>
							</div>
						</div>					
					</form>
				</div>
			</div>
		</div>
    </div>	
  </div>
</div>

<?php echo $footer; ?>