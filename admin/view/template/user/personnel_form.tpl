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
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_username; ?> <star>*</star></label>
									<input type="text" class="form-control" name="matricule" value="<?php echo $matricule; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username">
									<?php if ($error_matricle) { ?>
										<div class="text-danger"><?php echo $error_matricle; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_user_group; ?></label>
									<select name="fonction_id" id="input-user-group" class="form-control">
									<option value="0" selected="selected"></option>
										<?php foreach ($fonctions as $fonction) { ?>
										<?php if ($fonction['profession_id'] == $fonction_id) { ?>
										<option value="<?php echo $fonction['profession_id']; ?>" selected="selected"><?php echo $fonction['libelle_profession']; ?></option>
										<?php } else { ?>
										<option value="<?php echo $fonction['profession_id']; ?>"><?php echo $fonction['libelle_profession']; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
									<?php if ($error_fonction) { ?>
									  <div class="text-danger"><?php echo $error_fonction; ?></div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_firstname; ?> <star>*</star></label>
									<input type="text" class="form-control" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname">
									<?php if ($error_firstname) { ?>
									  <div class="text-danger"><?php echo $error_firstname; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_lastname; ?> <star>*</star></label>
									<input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname">
									<?php if ($error_lastname) { ?>
									  <div class="text-danger"><?php echo $error_lastname; ?></div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_email; ?></label>
									<input type="text" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_status; ?></label><br/>
									<input type="checkbox" data-toggle="toggle" name="status" data-on="Oui" data-off="Non" data-onstyle="success" data-offstyle="danger" <?php if ($status == 1) echo "checked"; ?>>
								</div>
							</div>
						</div>
						<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label><?php echo $entry_ip; ?></label>
										<input type="text" class="form-control" name="ip" value="<?php echo $ip; ?>" placeholder="<?php echo $entry_ip; ?>" id="input-ip">
									</div>
								</div>						
								<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_is_network; ?></label>
									<select name="internet" id="input-is_network" class="form-control">
										<?php if ($internet) { ?>
										<option value="0"><?php echo $text_disabled; ?></option>
										<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
										<?php } else { ?>
										<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
										<option value="1"><?php echo $text_enabled; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						
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
									<?php if ($error_bureau) { ?>
									  <div class="text-danger"><?php echo $error_bureau; ?></div>
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