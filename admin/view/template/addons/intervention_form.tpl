<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
  <div class="container-fluid">
  <div class="row">
  
    <div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;">
      <div class="pull-right">
		<button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success btn-fill"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-warning btn-fill"><i class="fa fa-reply"></i></a>
	  </div>
    </div>
  
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
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user">
						
						<div class="row">	
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_title; ?> <star>*</star></label>
									<input type="text" class="form-control" name="libelle_type_ticket" value="<?php echo $libelle_type_ticket; ?>" placeholder="<?php echo $entry_title; ?>" id="input-username">
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_status; ?></label><br/>
									<input type="checkbox" data-toggle="toggle" name="status" data-on="Oui" data-off="Non" data-onstyle="success" data-offstyle="danger" <?php if ($status == 1) echo "checked"; ?>>
								</div>
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