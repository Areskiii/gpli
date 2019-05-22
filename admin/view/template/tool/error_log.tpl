<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
  <div class="container-fluid">
  <div class="row">
    <div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;">
      <div class="pull-right">
		<a onclick="confirm('<?php echo $text_confirm; ?>') ? location.href='<?php echo $clear; ?>' : false;" data-toggle="tooltip" title="<?php echo $button_clear; ?>" class="btn btn-danger btn-fill"><i class="fa fa-eraser"></i></a>
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
					<h4 class="title"><i class="fa fa-exclamation-triangle"></i> <?php echo $heading_title; ?></h4>
					<p class="category"><?php echo $text_list; ?></p>
				</div>
				<div class="content">
					<textarea wrap="off" rows="15" readonly="readonly" class="form-control"><?php echo $log; ?></textarea>
				</div>
			</div>
		</div>
    </div>	
  </div>
</div>


<?php echo $footer; ?>