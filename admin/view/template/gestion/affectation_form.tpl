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
									<label><?php echo $entry_site; ?></label>
									<select name="site" id="input-status" class="form-control">
										<option value="0"></option>
										<?php foreach ($sites as $site) { ?>
										<option value="<?php echo $site['site_id']; ?>" <?php if($site['site_id']==$data['site']) echo 'selected="selected"'; ?> ><?php echo $site['libelle_site']; ?></option>
										<?php } ?>
									</select>
									<?php if ($error_site) { ?>
										<div class="text-danger"><?php echo $error_site; ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_bureau; ?></label>
									<select name="bureau" id="input-status" class="form-control">
										<option value="0"></option>
										<?php foreach ($bureaux as $bureau) { ?>
										<option value="<?php echo $bureau['bureau_id']; ?>" <?php if($bureau['bureau_id']==$data['bureau']) echo 'selected="selected"'; ?> ><?php echo $bureau['libelle_bureau']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

						</div>

						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_user; ?></label>
									<select name="user" id="input-status" class="form-control">
										<option value="0"></option>
										<?php foreach ($users as $user) { ?>
										<option value="<?php echo $user['personnel_id']; ?>" <?php if($user['personnel_id']==$data['user']) echo 'selected="selected"'; ?> ><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
										<?php } ?>
									</select>
									<?php if ($error_user) { ?>
										<div class="text-danger"><?php echo $error_user; ?></div>
									<?php } ?>									
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_matriel; ?></label>
									<select name="matriel" id="input-status" class="form-control">
										<option value="0"></option>
										<?php foreach ($matriels as $matriel) { ?>
										<option value="<?php echo $matriel['matriel_id']; ?>" <?php if($matriel['matriel_id']==$data['matriel']) echo 'selected="selected"'; ?> ><?php echo $matriel['libelle']; ?></option>
										<?php } ?>
									</select>
									<?php if ($error_matriel) { ?>
										<div class="text-danger"><?php echo $error_matriel; ?></div>
									<?php } ?>									
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