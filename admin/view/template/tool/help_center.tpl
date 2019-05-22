<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
	<div class="container-fluid">	
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title"><i class="pe-7s-help1"></i> <?php echo $heading_title; ?></h4>
					</div>
					<div class="content">
						<!-- content -->
						<div class="panel-group" id="accordion">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title" style="cursor: help;">
										<a data-target="#collapseOne"  data-toggle="collapse" class="collapsed" aria-expanded="false">
											<?php echo $title_PHP_Version_required; ?>
											<b class="caret"></b>
										</a>
									</h4>
								</div>
								<div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
									<div class="panel-body">
										<p><?php echo $text_PHP_Version_required; ?></p> 
									</div>
								</div>
							</div>
		
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<?php echo $footer; ?>