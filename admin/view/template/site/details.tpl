<?php echo $header; ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-sm-12" style="margin-bottom: 30px;">
				
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<h4 class="title"><i class="fa fa-list"></i> <?php echo $heading_title_details; ?></h4>
						<p class="category"><?php echo $text_list; ?></p>
					</div>
					<form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-user">
					<div class="content table-responsive table-full-width">
						<table class="table">
						<thead>
							<tr>
								<th style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></th>
								<th class="text-left"><?php if ($sort == 'id') { ?>
									<a href="<?php echo $sort_id; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_id; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_id; ?>"><?php echo $column_id; ?></a>
									<?php } ?></th>
								<th class="text-left"><?php if ($sort == 'title') { ?>
									<a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_title; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_title; ?>"><?php echo $column_title; ?></a>
									<?php } ?></th>
								<th class="text-left"><?php if ($sort == 'title') { ?>
									<a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_code; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_title; ?>"><?php echo $column_code; ?></a>
									<?php } ?></th>		
								<th class="text-left"><?php if ($sort == 'title') { ?>
									<a href="<?php echo $sort_title; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_site; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_title; ?>"><?php echo $column_site; ?></a>
									<?php } ?></th>	
								<th class="text-left"><?php if ($sort == 'Etat') { ?>
									<a href="<?php echo $sort_Etat; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_Etat; ?></a>
									<?php } else { ?>
									<a href="<?php echo $sort_Etat; ?>"><?php echo $column_Etat; ?></a>
									<?php } ?></th>		
								<th class="text-right"><?php echo $column_action; ?></th>
							</tr>
						</thead>
						<tbody>		
							<?php if ($Details) { ?>
							<?php foreach ($Details as $Site) { ?>
							<tr>
								<td class="text-center"><?php if (in_array($Article['id'], $selected)) { ?>
									<input type="checkbox" name="selected[]" value="<?php echo $Site['id']; ?>" checked="checked" />
									<?php } else { ?>
									<input type="checkbox" name="selected[]" value="<?php echo $Site['id']; ?>" />
									<?php } ?>
								</td>

								<td class="text-left"><?php echo $Site['id']; ?></td>
								<td class="text-left"><?php echo $Site['Libelle']; ?></td>
								<td class="text-left"><?php echo $Site['Code']; ?></td>
								<td class="text-left"><?php echo $Site['Site']; ?></td>
								<td class="text-left"><?php echo $Site['Etat']; ?></td>
								<td class="text-right">
									<a href="<?php echo $Site['edit']; ?>" rel="tooltip" title="" class="btn btn-success btn-simple btn-xs" data-original-title="<?php echo $button_edit; ?>">
										<i class="fa fa-edit" style="font-size: 25px;"></i>
									</a>
								</td>
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