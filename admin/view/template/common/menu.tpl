			<ul class="nav" id="menu">
			
                <li id="dashboard">
                    <a href="<?php echo $home; ?>">
                        <i class="fa fa-laptop"></i>
                        <p><?php echo $text_dashboard; ?></p>
                    </a>
                </li>
				
				<li id="elFinder" style="margin-bottom: 5px">
					<a href="<?php echo $elFinder; ?>">
						<i class="pe-7s-server"></i>
						<p><?php echo $text_elFinder; ?></p>
					</a>
				</li>
				
				<li id="matriels">
					<a data-toggle="collapse" href="#matriel">
                        <i class="pe-7s-calculator"></i>
                        <p><?php echo $text_typematriel; ?>
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="matriel">
                        <ul class="nav">
                            <li><a href="<?php echo $matriel; ?>"><?php echo $text_matriel; ?></a></li>
                            <li><a href="<?php echo $marque; ?>"><?php echo $text_marque; ?></a></li>
                        </ul>
                    </div>
				</li>
				
				<li id="sites">
					<a data-toggle="collapse" href="#site">
                        <i class="pe-7s-home"></i>
                        <p><?php echo $text_sites; ?>
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="site">
                        <ul class="nav">
                            <li><a href="<?php echo $site; ?>"><?php echo $text_site; ?></a></li>
                            <li><a href="<?php echo $bureau; ?>"><?php echo $text_bureau; ?></a></li>
                        </ul>
                    </div>
				</li>

                <li id="parcs">
                    <a data-toggle="collapse" href="#parc">
                        <i class="pe-7s-calculator"></i>
                        <p><?php echo $text_parc; ?>
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="parc">
                        <ul class="nav">
                            <li><a href="<?php echo $parcs; ?>"><?php echo $text_parcs; ?></a></li>
                            <li><a href="<?php echo $martiel; ?>"><?php echo $text_matriels; ?></a></li>
							<li><a href="<?php echo $ticket; ?>"><?php echo $text_tikcet; ?></a></li>
                        </ul>
                    </div>
                </li>

				<li id="addons" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                    <a data-toggle="collapse" href="#addon">
                        <i class="pe-7s-config"></i>
                        <p><?php echo $text_addons; ?>
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="addon">
                        <ul class="nav">
                            <li><a href="<?php echo $gouvernorat; ?>"><?php echo $text_gouvernorat; ?></a></li>
                            <li><a href="<?php echo $delegation; ?>"><?php echo $text_delegation; ?></a></li>
							<li><a href="<?php echo $fonction; ?>"><?php echo $text_fonction; ?></a></li>
							<li><a href="<?php echo $intervention; ?>"><?php echo $text_intervention; ?></a></li>
                        </ul>
                    </div>
                </li>
				
				<li id="users" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                    <a data-toggle="collapse" href="#user">
                        <i class="pe-7s-id"></i>
                        <p><?php echo $text_users; ?>
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav">
                            <li><a href="<?php echo $user; ?>"><?php echo $text_user; ?></a></li>
                            <li><a href="<?php echo $user_group; ?>"><?php echo $text_user_group; ?></a></li>
                        </ul>
                    </div>
                </li>

                <li id="personnels" style="border-top: 1px solid rgba(255, 255, 255, 0.2);">
                    <a data-toggle="collapse" href="#personnel">
                        <i class="pe-7s-id"></i>
                        <p><?php echo $text_personnels; ?>
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="personnel">
                        <ul class="nav">
                            <li><a href="<?php echo $personnels; ?>"><?php echo $text_personnels; ?></a></li>
                        </ul>
                    </div>
                </li>

				<li id="logs">
                    <a data-toggle="collapse" href="#log">
                        <i class="pe-7s-note2"></i>
                        <p><?php echo $text_logs_platforme; ?>
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="log">
                        <ul class="nav">
                            <li><a href="<?php echo $admin_log; ?>"><?php echo $text_admin_log; ?></a></li>
                            <li><a href="<?php echo $system_log; ?>"><?php echo $text_system_log; ?></a></li>
                        </ul>
                    </div>
                </li>
            
			</ul>