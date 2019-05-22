<?php echo $header; ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px;">
				
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title"><i class="fa fa-list"></i> <?php echo $heading_title_matriel; ?></h4>
						<p class="category"><?php echo $text_list; ?></p>
					</div>
					<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="content table-responsive table-full-width">
						<table class="table">
						<thead>
							<tr>	
								<th class="text-left"><?php if ($sort == 'title') { ?>
									<a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_coupon; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_title; ?>"><?php echo $column_coupon; ?></a>
									<?php } ?></th>
								<th class="text-left"><?php if ($sort == 'title') { ?>
									<a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_matriel; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_title; ?>"><?php echo $column_matriel; ?></a>
									<?php } ?></th>		
								<th class="text-left"><?php if ($sort == 'title') { ?>
									<a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_marque; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_title; ?>"><?php echo $column_marque; ?></a>
									<?php } ?></th>	
								<th class="text-left"><?php if ($sort == 'Etat') { ?>
									<a href="<?php echo $sort_Etat; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_garantie; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_Etat; ?>"><?php echo $column_garantie; ?></a>
									<?php } ?></th>		
								<th class="text-left"><?php if ($sort == 'Etat') { ?>
									<a href="<?php echo $sort_Etat; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_internet; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_Etat; ?>"><?php echo $column_internet; ?></a>
									<?php } ?></th>	
								<th class="text-left"><?php if ($sort == 'Etat') { ?>
									<a href="<?php echo $sort_Etat; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_connecte; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_Etat; ?>"><?php echo $column_connecte; ?></a>
									<?php } ?></th>	
							</tr>
						</thead>
						<tbody>		
							<?php if ($Matriels) { ?>
							<?php foreach ($Matriels as $Matriel) { ?>
								<td class="text-left"><?php echo $Matriel['coupon']; ?></td>
								<td class="text-left"><?php echo $Matriel['matriel']; ?></td>
								<td class="text-left"><?php echo $Matriel['marque']; ?></td>
								<td class="text-left"><?php echo $Matriel['garantie']; ?></td>
								<td class="text-left"><?php echo $Matriel['internet']; ?></td>
								<td class="text-left"><?php echo $Matriel['connecte']; ?></td>
							</tr>
							<?php } ?>
							<?php } else { ?>
							<tr>
								<td class="text-center" colspan="14"><?php echo $text_no_results; ?></td>
							</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		
				<div class="panel panel-default">			  
				  <div class="panel-body">
					<div class="row">
						<div class="col-sm-8 text-left"><?php echo $pagination; ?></div>
						<div class="col-sm-4 text-right"><?php echo $results; ?></div>
					</div>
				  </div>
				</div>
		</div>
	</div>
</div>
<?php echo $footer; ?>