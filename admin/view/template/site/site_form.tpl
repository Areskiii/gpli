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
									<input type="text" class="form-control" name="libelle_site" value="<?php echo $libelle_site; ?>" placeholder="<?php echo $entry_title; ?>" id="input-username">
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_gouvernorat; ?></label>
									<select name="gouvernorat" id="input-status" class="form-control">
										<option value="0"></option>
										<?php if ($gouvernoats) { ?>
											<?php foreach ($gouvernoats as $gouvernoat) { ?>
												<option value="<?php echo $gouvernoat['gouvernorat_id']; ?>"  <?php if($gouvernoat['gouvernorat_id']==$gouvernorat_id ) echo 'selected="selected"'; ?> ><?php echo $gouvernoat['libelle_gouvernorat']; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
									<?php if ($error_select) { ?>
										<div class="text-danger"><?php echo $error_select; ?></div>
									<?php } ?>
								</div>
							</div>
						</div>
						
						<div class="row">	
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_code; ?> <star>*</star></label>
									<input type="text" class="form-control" name="code_site" value="<?php echo $Code; ?>" placeholder="<?php echo $entry_code; ?>" id="input-username">
									<?php if ($error_code) { ?>
										<div class="text-danger"><?php echo $error_code; ?></div>
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

						<div class="row">	
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_adresse; ?> <star>*</star></label>
									<input type="text" class="form-control" name="adresse" value="<?php echo $adresse; ?>" placeholder="<?php echo $entry_adresse; ?>" id="input-username">
									<?php if ($error_adresse) { ?>
										<div class="text-danger"><?php echo $error_adresse; ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_chef; ?> <star>*</star></label>
									<input type="text" class="form-control" name="chef" value="<?php echo $chef; ?>" placeholder="<?php echo $entry_chef; ?>" id="input-username">
									<?php if ($error_chef) { ?>
										<div class="text-danger"><?php echo $error_chef; ?></div>
									<?php } ?>
								</div>
							</div>
						</div>

						
						<div class="row">	
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_ip; ?> <star>*</star></label>
									<input type="text" class="form-control" name="ip" value="<?php echo $ip; ?>" placeholder="<?php echo $entry_ip; ?>" id="input-username">
									<?php if ($error_ip) { ?>
										<div class="text-danger"><?php echo $error_ip; ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_mail; ?> <star>*</star></label>
									<input type="text" class="form-control" name="mail" value="<?php echo $mail; ?>" placeholder="<?php echo $entry_mail; ?>" id="input-username">
									<?php if ($error_mail) { ?>
										<div class="text-danger"><?php echo $error_mail; ?></div>
									<?php } ?>
								</div>
							</div>

						</div>	
						
						<div class="row">	
						
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_analyste; ?> <star>*</star></label>
									<input type="text" class="form-control" name="analyste" value="<?php echo $analyste; ?>" placeholder="<?php echo $entry_analyste; ?>" id="input-username">
									<?php if ($error_analyste) { ?>
										<div class="text-danger"><?php echo $error_analyste; ?></div>
									<?php } ?>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_analyste_ip; ?> <star>*</star></label>
									<input type="text" class="form-control" name="analyste_ip" value="<?php echo $analyste_ip; ?>" placeholder="<?php echo $entry_analyste_ip; ?>" id="input-username">
									<?php if ($error_analyste_ip) { ?>
										<div class="text-danger"><?php echo $error_analyste_ip; ?></div>
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