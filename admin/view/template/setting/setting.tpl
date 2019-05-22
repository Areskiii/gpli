<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
  <div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-sm-12" style="margin-bottom: 10px;">
		  <div class="pull-right">
			<button type="submit" form="form-setting" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-success btn-fill"><i class="fa fa-save"></i></button>
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
					<h4 class="title"><i class="fa fa-pencil"></i> <?php echo $heading_title; ?></h4>
					<p class="category"><?php echo $text_edit; ?></p>
				</div>
				<div class="content content-full-width">
					<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-setting" class="form-horizontal">
					<ul role="tablist" class="nav nav-tabs">
						<li role="presentation" class="active">
							<a href="#tab-general" data-toggle="tab" aria-expanded="false"><i class="fa fa-cogs"></i> <?php echo $tab_general; ?></a>
						</li>
						<li class="">
							<a href="#tab-store" data-toggle="tab" aria-expanded="false"><i class="fa fa-desktop"></i> <?php echo $tab_Platform; ?></a>
						</li>
						<li class="">
							<a href="#tab-local" data-toggle="tab" aria-expanded="false"><i class="fa fa-globe"></i> <?php echo $tab_lang; ?></a>
						</li>
						<li class="">
							<a href="#tab-server" data-toggle="tab" aria-expanded="true"><i class="fa fa-server"></i> <?php echo $tab_server; ?></a>
						</li>
						<li class="">
							<a href="#tab-elastic" data-toggle="tab" aria-expanded="true"><i class="fa fa-search"></i> <?php echo $tab_elastic; ?></a>
						</li>
					</ul>

					<div class="tab-content">
						<div id="tab-general" class="tab-pane active">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-name"><?php echo $entry_name; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_name" value="<?php echo $config_name; ?>" placeholder="<?php echo $entry_name; ?>" id="input-name" class="form-control" />
								  <?php if ($error_name) { ?>
								  <div class="text-danger"><?php echo $error_name; ?></div>
								  <?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-owner"><?php echo $entry_owner; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_owner" value="<?php echo $config_owner; ?>" placeholder="<?php echo $entry_owner; ?>" id="input-owner" class="form-control" />
								  <?php if ($error_owner) { ?>
								  <div class="text-danger"><?php echo $error_owner; ?></div>
								  <?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_email" value="<?php echo $config_email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
								  <?php if ($error_email) { ?>
								  <div class="text-danger"><?php echo $error_email; ?></div>
								  <?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-email"><?php echo $entry_limit_admin; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_limit_admin" value="<?php echo $config_limit_admin; ?>" placeholder="<?php echo $entry_limit_admin; ?>" id="input-email" class="form-control" />
								  <?php if ($error_error_limit_admin) { ?>
								  <div class="text-danger"><?php echo $error_error_limit_admin; ?></div>
								  <?php } ?>
								</div>
							</div>
						</div>
						<div id="tab-store" class="tab-pane">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-meta-title"><?php echo $entry_meta_title; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_meta_title" value="<?php echo $config_meta_title; ?>" placeholder="<?php echo $entry_meta_title; ?>" id="input-meta-title" class="form-control" />
								  <?php if ($error_meta_title) { ?>
								  <div class="text-danger"><?php echo $error_meta_title; ?></div>
								  <?php } ?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-meta-description"><?php echo $entry_meta_description; ?></label>
								<div class="col-sm-10">
								  <textarea name="config_meta_description" rows="5" placeholder="<?php echo $entry_meta_description; ?>" id="input-meta-description" class="form-control"><?php echo $config_meta_description; ?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-meta-keyword"><?php echo $entry_meta_keyword; ?></label>
								<div class="col-sm-10">
								  <textarea name="config_meta_keyword" rows="5" placeholder="<?php echo $entry_meta_keyword; ?>" id="input-meta-keyword" class="form-control"><?php echo $config_meta_keyword; ?></textarea>
								</div>
							</div>
						</div>
						<div id="tab-local" class="tab-pane">
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-language"><?php echo $entry_language; ?></label>
								<div class="col-sm-10">
								  <select name="config_language" id="input-language" class="form-control">
									<?php foreach ($languages as $language) { ?>
									<?php if ($language['code'] == $config_language) { ?>
									<option value="<?php echo $language['code']; ?>" selected="selected"><?php echo $language['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></option>
									<?php } ?>
									<?php } ?>
								  </select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label" for="input-admin-language"><?php echo $entry_admin_language; ?></label>
								<div class="col-sm-10">
								  <select name="config_admin_language" id="input-admin-language" class="form-control">
									<?php foreach ($languages as $language) { ?>
									<?php if ($language['code'] == $config_admin_language) { ?>
									<option value="<?php echo $language['code']; ?>" selected="selected"><?php echo $language['name']; ?></option>
									<?php } else { ?>
									<option value="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></option>
									<?php } ?>
									<?php } ?>
								  </select>
								</div>
							</div>
						</div>
						<div id="tab-server" class="tab-pane">
							<div class="form-group">
								<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_secure; ?>"><?php echo $entry_secure; ?></span></label>
								<div class="col-sm-10">
								  <label class="radio-inline">
									<?php if ($config_secure) { ?>
									<input type="radio" name="config_secure" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="config_secure" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								  </label>
								  <label class="radio-inline">
									<?php if (!$config_secure) { ?>
									<input type="radio" name="config_secure" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="config_secure" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								  </label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_seo_url; ?>"><?php echo $entry_seo_url; ?></span></label>
								<div class="col-sm-10">
								  <label class="radio-inline">
									<?php if ($config_seo_url) { ?>
									<input type="radio" name="config_seo_url" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="config_seo_url" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								  </label>
								  <label class="radio-inline">
									<?php if (!$config_seo_url) { ?>
									<input type="radio" name="config_seo_url" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="config_seo_url" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								  </label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><span data-toggle="tooltip" title="<?php echo $help_password; ?>"><?php echo $entry_password; ?></span></label>
								<div class="col-sm-10">
								  <label class="radio-inline">
									<?php if ($config_password) { ?>
									<input type="radio" name="config_password" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="config_password" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								  </label>
								  <label class="radio-inline">
									<?php if (!$config_password) { ?>
									<input type="radio" name="config_password" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="config_password" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								  </label>
								</div>
							</div>              
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_error_display; ?></label>
								<div class="col-sm-10">
								  <label class="radio-inline">
									<?php if ($config_error_display) { ?>
									<input type="radio" name="config_error_display" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="config_error_display" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								  </label>
								  <label class="radio-inline">
									<?php if (!$config_error_display) { ?>
									<input type="radio" name="config_error_display" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="config_error_display" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								  </label>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?php echo $entry_error_log; ?></label>
								<div class="col-sm-10">
								  <label class="radio-inline">
									<?php if ($config_error_log) { ?>
									<input type="radio" name="config_error_log" value="1" checked="checked" />
									<?php echo $text_yes; ?>
									<?php } else { ?>
									<input type="radio" name="config_error_log" value="1" />
									<?php echo $text_yes; ?>
									<?php } ?>
								  </label>
								  <label class="radio-inline">
									<?php if (!$config_error_log) { ?>
									<input type="radio" name="config_error_log" value="0" checked="checked" />
									<?php echo $text_no; ?>
									<?php } else { ?>
									<input type="radio" name="config_error_log" value="0" />
									<?php echo $text_no; ?>
									<?php } ?>
								  </label>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-error-filename"><?php echo $entry_error_filename; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_error_filename" value="<?php echo $config_error_filename; ?>" placeholder="<?php echo $entry_error_filename; ?>" id="input-error-filename" class="form-control" />
								  <?php if ($error_error_filename) { ?>
								  <div class="text-danger"><?php echo $error_error_filename; ?></div>
								  <?php } ?>
								</div>
							</div>
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-sys-log-filename"><?php echo $entry_sys_log_filename; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_sys_log_filename" value="<?php echo $config_sys_log_filename; ?>" placeholder="<?php echo $entry_sys_log_filename; ?>" id="input-sys-log-filename" class="form-control" />
								  <?php if ($error_sys_log_filename) { ?>
								  <div class="text-danger"><?php echo $error_sys_log_filename; ?></div>
								  <?php } ?>
								</div>
							</div>
						</div>
						<div id="tab-elastic" class="tab-pane">
							<div class="form-group required">
								<label class="col-sm-2 control-label" for="input-backup-filename"><?php echo $entry_backup_es_log_filename; ?></label>
								<div class="col-sm-10">
								  <input type="text" name="config_backup_es_log_filename" value="<?php echo $config_backup_es_log_filename; ?>" placeholder="<?php echo $entry_backup_es_log_filename; ?>" id="input-backup-filename" class="form-control" />
								  <?php if ($error_backup_es_log_filename) { ?>
								  <div class="text-danger"><?php echo $error_backup_es_log_filename; ?></div>
								  <?php } ?>
								</div>
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