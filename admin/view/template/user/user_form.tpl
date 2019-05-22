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
									<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username">
									<?php if ($error_username) { ?>
										<div class="text-danger"><?php echo $error_username; ?></div>
									<?php } ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_user_group; ?></label>
									<select name="user_group_id" id="input-user-group" class="form-control">
										<?php foreach ($user_groups as $user_group) { ?>
										<?php if ($user_group['user_group_id'] == $user_group_id) { ?>
										<option value="<?php echo $user_group['user_group_id']; ?>" selected="selected"><?php echo $user_group['name']; ?></option>
										<?php } else { ?>
										<option value="<?php echo $user_group['user_group_id']; ?>"><?php echo $user_group['name']; ?></option>
										<?php } ?>
										<?php } ?>
									</select>
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
									<label><?php echo $entry_password; ?></label>
									<input type="password" class="form-control" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" autocomplete="off">
									<?php if ($error_password) { ?>
									  <div class="text-danger"><?php echo $error_password; ?></div>
									<?php  } ?>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label><?php echo $entry_confirm; ?></label>
									<input type="password" class="form-control" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" id="input-confirm">
									<?php if ($error_confirm) { ?>
									  <div class="text-danger"><?php echo $error_confirm; ?></div>
									<?php  } ?>
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
					</form>
				</div>				
			</div>
		</div>
    </div>
  </div>
</div>
<?php echo $footer; ?>