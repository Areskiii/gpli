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
									<?php if ($error_bureau) { ?>
										<div class="text-danger"><?php echo $error_bureau; ?></div>
									<?php } ?>											
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_matriel; ?></label>
									<select name="marque" id="input-status" class="form-control">
										<option value="0"></option>
										<?php foreach ($matriels as $matriel) { ?>
										<option value="<?php echo $matriel['marque_matriel_id']; ?>" <?php if($matriel['marque_matriel_id']==$data['type']) echo 'selected="selected"'; ?> ><?php echo $matriel['libelle_marque_matriel']; ?></option>
										<?php } ?>
									</select>
									<?php if ($error_matriel) { ?>
										<div class="text-danger"><?php echo $error_matriel; ?></div>
									<?php } ?>		
								</div>
							</div>

						</div>
						
						<div class="row">	
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_mac; ?> <star>*</star></label>
									<input type="text" class="form-control" name="mac" value="<?php echo $mac; ?>" placeholder="<?php echo $entry_mac; ?>" id="input-username">
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_ip; ?> <star>*</star></label>
									<input type="text" class="form-control" name="ip" value="<?php echo $ip; ?>" placeholder="<?php echo $entry_ip; ?>" id="input-username">
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
						</div>
						<div class="row">
						
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_fiche; ?> <star>*</star></label>
									<input type="file" name="fiche" id="input-import" />
								</div>
							</div>	
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_achat; ?> <star>*</star></label>
									<input type="date" class="form-control" name="date_achat" value="<?php echo $date_achat; ?>" placeholder="<?php echo $entry_achat; ?>" id="input-username">
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
						</div>	
						<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label><?php echo $entry_affectation; ?> <star>*</star></label>
										<input type="date" class="form-control" name="date_affectation" value="<?php echo $date_affectation; ?>" placeholder="<?php echo $entry_affectation; ?>" id="input-username">
										<?php if ($error_title) { ?>
											<div class="text-danger"><?php echo $error_title; ?></div>
										<?php } ?>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
										<label><?php echo $entry_prevu; ?> <star>*</star></label>
										<input type="date" class="form-control" name="date_prevu" value="<?php echo $date_prevu; ?>" placeholder="<?php echo $entry_prevu; ?>" id="input-username">
										<?php if ($error_title) { ?>
											<div class="text-danger"><?php echo $error_title; ?></div>
										<?php } ?>
									</div>
								</div>

						</div>

						<div class="row">

								<div class="col-md-6">
									<div class="form-group">
									<label><?php echo $entry_garantie; ?></label><br/>
									<input type="checkbox" data-toggle="toggle" value="<?php echo $garantie;?>"  name="garantie" data-on="Oui" data-off="Non" data-onstyle="success" data-offstyle="danger" <?php if ($garantie == 1) echo "checked"; ?>>
									</div>
								</div>

								<div class="col-md-6">
									<div class="form-group">
									<label><?php echo $entry_internet; ?></label><br/>
									<input type="checkbox" data-toggle="toggle" name="internet" data-on="Oui" data-off="Non" data-onstyle="success" data-offstyle="danger" <?php if ($internet == 1) echo "checked"; ?>>
									</div>
								</div>

						</div>

						<div class="row">

								<div class="col-md-6">
									<div class="form-group">
										<label><?php echo $entry_connecte; ?></label>
										<select name="connecte" id="input-status" class="form-control">
											<option value="0"></option>
											<option value="1" <?php if($data['connecte']==1) echo 'selected="selected"'; ?> >USB</option>
											<option value="2" <?php if($data['connecte']==2) echo 'selected="selected"'; ?> >Réseau</option>
										</select>
									</div>
								</div>

						</div>

						<div class="row">	
							<div class="col-md-12">
								<div class="form-group">
									<label><?php echo $entry_plus; ?> <star>*</star></label>
									<textarea name="plus_info" class="form-control"><?php echo $plus_info; ?></textarea>
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