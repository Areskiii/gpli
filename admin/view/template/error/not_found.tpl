<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
  <div class="container-fluid">
	<div class="row">
		<div class="col-lg-12 col-sm-12">
			<h4 class="title"><i class="fa fa-exclamation-circle"></i><?php echo $heading_title; ?></h4> 
		</div>
	</div>	
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="header">
					<h2 class="title text-danger" style="text-align: center;"><i class="fa fa-exclamation-triangle" style="margin-right: 20px;"></i> <?php echo $heading_title; ?></h2>
				</div>
				<div class="content"style="text-align: center;">
					<span style="font-size:100px;">404</span>
					<h3><?php echo $text_not_found; ?></h3>
				</div>				
			</div>
		</div>
    </div>
  </div>
</div>
<?php echo $footer; ?>