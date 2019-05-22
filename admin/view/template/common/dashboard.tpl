<?php echo $header; ?><?php /*echo $column_left;*/ ?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-sm-12">
				<h4 class="title"><?php echo $text_statistics; ?></h4>
			</div>
		</div>
		<div class="row">
		
			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-users" style="font-weight: bold;font-size: 77px;color: black;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo $text_users; ?></p>
									<?php echo $num_users; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-users" style="font-weight: bold;font-size: 77px;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo $text_article; ?></p>
									<?php echo $num_matriels; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info2 text-center">
									<i class="pe-7s-graph1" style="font-weight: bold;font-size: 77px;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-weight: bold;"><?php echo $text_size; ?></p>
									<?php  echo $num_size; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-warning2 text-center">
									<i class="pe-7s-folder" style="font-weight: bold;font-size: 77px;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-weight: bold;"><?php echo $text_document; ?></p>
									<?php echo $num_document;  ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-bookmarks" style="font-weight: bold;font-size: 77px;color: black;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo $text_ticket; ?></p>
									<?php echo $num_ticket; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-culture" style="font-weight: bold;font-size: 77px;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo $text_structure; ?></p>
									<?php echo $num_structure; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-home" style="font-weight: bold;font-size: 77px;color: black;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo $text_bureau; ?></p>
									<?php echo $num_bureau; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-server" style="font-weight: bold;font-size: 77px;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo "CPU"; ?></p>
									<?php echo $num_cpu; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-pendrive" style="font-weight: bold;font-size: 77px;color:black"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo "Total Matériels"; ?></p>
									<?php echo $num_matriel; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-pendrive" style="font-weight: bold;font-size: 77px;"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo "Total Matériels Affecté"; ?></p>
									<?php echo ($num_matriel-$num_matriel_affecte); ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>

						<div class="col-lg-3 col-sm-6">
				<div class="card">
					<div class="content">
						<div class="row">
							<div class="col-xs-5">
								<div class="icon-big icon-info text-center">
									<i class="pe-7s-pendrive" style="font-weight: bold;font-size: 77px;color:black"></i>
								</div>
							</div>
							<div class="col-xs-7">
								<div class="numbers">
									<p style="font-size:13px"><?php echo "Total Matériels Non Affecté"; ?></p>
									<?php echo $num_matriel_affecte; ?>
								</div>
							</div>
						</div>
						<div class="footer">
							<hr>
						</div>
					</div>
				</div>
			</div>

		</div>					

	</div>
</div> 	
<?php echo $footer; ?>