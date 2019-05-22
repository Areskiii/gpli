<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

<!--script type="text/javascript" src="view/javascript/jquery/jquery-2.1.1.min.js"></script-->
	
	<!-- Bootstrap core CSS     -->
    <link href="view/assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="view/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="view/assets/css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="view/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="green" data-image="view/assets/img/full-screen-image-3.jpg">
        <div class="logo">
            <a href="<?php echo $home; ?>" class="logo-text">
                <?php echo $plateforme_slogan; ?>
            </a>
        </div>
		<div class="logo logo-mini">
			<a href="<?php echo $home; ?>" class="logo-text">
				<?php echo $plateforme_slogan_min; ?>
			</a>
		</div>

    	<div class="sidebar-wrapper">
            
			<?php echo $profile; ?>
			<?php echo $menu; ?>
            
    	</div>
    </div>
	    <div class="main-panel">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-minimize">
					<button id="minimizeSidebar" class="btn btn-success btn-fill btn-round btn-icon">
						<i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
						<i class="fa fa-navicon visible-on-sidebar-mini"></i>
					</button>
				</div>
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse">
						<span class="sr-only"><?php echo $text_toggle_navigation; ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#"><?php echo $plateforme; ?></a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="<?php echo $segments_stats; ?>">
								<i class="fa fa-line-chart"></i>
								<p><?php echo $text_stats_segments; ?></p>
							</a>
						</li>

						<li class="dropdown">
							<ul class="dropdown-menu">
								<?php foreach ($stores as $store) { ?>
								<li><a href="<?php echo $store['href']; ?>" target="_blank"><?php echo $store['name']; ?></a></li>
								<?php } ?>
							</ul>
						</li>
						<li class="dropdown dropdown-with-icons">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-list"></i>
								<p class="hidden-md hidden-lg">
									<?php echo $text_more; ?>
									<b class="caret"></b>
								</p>
							</a>
							<ul class="dropdown-menu dropdown-with-icons">
								<li>
									<a href="<?php echo $help_center; ?>">
										<i class="pe-7s-help1"></i> <?php echo $text_help_center; ?>
									</a>
								</li>
								<li>
									<a href="<?php echo $setting; ?>">
										<i class="pe-7s-tools"></i> <?php echo $text_setting; ?>
									</a>
								</li>
								<li>
									<a href="<?php echo $backup_restore_db_plateforme; ?>">
										<i class="pe-7s-shuffle"></i> <?php echo $text_backup_restore_db; ?>
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="<?php echo $logout; ?>" class="text-danger">
										<i class="pe-7s-close-circle"></i>
										<?php echo $text_logout; ?>
									</a>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</div>
		</nav>