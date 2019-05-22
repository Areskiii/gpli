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
					<h4 class="title"><i class="fa fa-pencil"></i> <?php echo $heading_title_transfert; ?></h4>
					<p class="category"><?php echo $text_form; ?></p>
				</div>
				<div class="content">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user">
					
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_user; ?></label>
									<select name="user" id="input-status" class="form-control" disabled>
										<option value="0"></option>
										<?php foreach ($users as $user) { ?>
										<option value="<?php echo $user['user_id']; ?>" <?php if($user['user_id']==$data['user']) echo 'selected="selected"'; ?> ><?php echo $user['firstname'].' '.$user['lastname']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_matriel; ?></label>
									<select name="matriel" id="input-status" class="form-control" disabled>
										<option value="0"></option>
										<?php foreach ($matriels as $matriel) { ?>
										<option value="<?php echo $matriel['matriel_id']; ?>" <?php if($matriel['matriel_id']==$data['matriel']) echo 'selected="selected"'; ?> ><?php echo $matriel['coupon']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>

						</div>
						
						<div class="row">
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_date_ticket_open; ?> <star>*</star></label>
									<input type="date" class="form-control" name="date_ticket_open" value="<?php echo $date_ticket_open; ?>" placeholder="<?php echo $entry_date_ticket_open; ?>" id="input-username" disabled>
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_date_ticke_close; ?> <star>*</star></label>
									<input type="date" class="form-control" name="date_ticke_close" value="<?php echo $date_ticke_close; ?>" placeholder="<?php echo $entry_date_ticke_close; ?>" id="input-username" disabled>
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
						</div>
						
						<div class="row">
						
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_type_ticket; ?></label>
									<select name="type_ticket_id" id="input-status" class="form-control" disabled>
										<option value="0"></option>
										<?php foreach ($type_tickets as $type_ticket) { ?>
										<option value="<?php echo $type_ticket['type_ticket_id']; ?>" <?php if($type_ticket['type_ticket_id']==$data['type_ticket_id']) echo 'selected="selected"'; ?> ><?php echo $type_ticket['libelle_type_ticket']; ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						
						<div class="row">
						
							<div class="col-md-6">
									<div class="form-group">
									<label><?php echo $entry_casse; ?></label><br/>
									<input type="checkbox" data-toggle="toggle" name="casse" data-on="Oui" data-off="Non" data-onstyle="success" data-offstyle="danger" <?php if ($casse == 1) echo "checked"; ?>>
									</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_date_transfert_casse; ?> <star>*</star></label>
									<input type="date" class="form-control" name="date_transfert_casse" value="<?php echo $date_transfert_casse; ?>" placeholder="<?php echo $entry_date_transfert_casse; ?>" id="input-username">
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
						</div>
						
						<?php if($data['type_ticket_id']==2) { ?>
						
						<div class="row">
						
							<div class="col-md-6">
									<div class="form-group">
									<label><?php echo $entrty_fax; ?></label><br/>
									<input type="text" class="form-control" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entrty_fax; ?>" id="input-username" >
									</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_date_transfert; ?> <star>*</star></label>
									<input type="date" class="form-control" name="date_transfert_cimf" value="<?php echo $date_transfert_cimf; ?>" placeholder="<?php echo $entry_date_transfert; ?>" id="input-username">
									<?php if ($error_title) { ?>
										<div class="text-danger"><?php echo $error_title; ?></div>
									<?php } ?>
								</div>
							</div>
							
						</div>
						
						<div class="row">
						
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entrty_fax_joint; ?> <star>*</star></label>
									<input type="file" name="fax_joint" id="input-import" />
								</div>
							</div>	
						</div>
						
						<?php } ?>
	
					</form>
				</div>											
			</div>
		</div>
    </div>
  </div>
</div>
<?php echo $footer; ?>