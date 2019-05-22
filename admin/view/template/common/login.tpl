<?php
$siteKey = GOOGLE_SITE_KEY; // votre clé publique*/
$secret  = GOOGLE_SECRET_KEY; // votre clé secrète*/
?>
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
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="view/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />	
	<!-- Recaptcha -->
	<script src='https://www.google.com/recaptcha/api.js?hl=fr' id="recaptcha"></script>
</head>
<body> 
<nav class="navbar navbar-transparent navbar-absolute">
    <div class="container">    
        <div class="navbar-header"  style="width: 100%;text-align: center;text-transform: uppercase;color: #FFFFFF;opacity: 0.9;font-weight: 400;font-size: 30px;">
            <?php echo $plateforme_slogan; ?>
        </div>
    </div>
</nav>
<div class="wrapper wrapper-full-page">
    <div class="full-page login-page" data-color="green" data-image="view/assets/img/full-screen-image-3.jpg">   
        <div class="content">
            <div class="container">
                <div class="row">                   
                    <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">                 
                            <div class="card card-hidden">
                                <div class="header text-center"><?php echo $text_login; ?></div>
                                <div class="content">
									<?php if ($success) { ?>
									<div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									</div>
									<?php } ?>
									<?php if ($error_warning) { ?>
									<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
									  <button type="button" class="close" data-dismiss="alert">&times;</button>
									</div>
									<?php } ?>
                                    <div class="form-group">
                                        <label><?php echo $entry_username; ?></label>
                                        <input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $entry_password; ?></label>
                                        <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control">
                                    </div>                                    
									<?php if ($forgotten) { ?>
								    <div class="form-group">
                                        <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a> 
                                    </div>
									<?php } ?>
                                </div>
                                <div class="footer text-center">
									<div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"  ></div>
                                    <button type="submit" class="btn btn-fill btn-warning btn-wd"><?php echo $button_login; ?></button>
                                </div>
                            </div>
                            
							  <?php if ($redirect) { ?>
							  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
							  <?php } ?>   
                        </form>
                                
                    </div>                    
                </div>
            </div>
        </div>
    	
    	<footer class="footer footer-transparent">
            <div class="container">
                <p class="copyright pull-center" style="text-align: center;color: #fff;">
                    <?php echo $text_footer; ?>
                </p>
            </div>
        </footer>

    </div>                             
       
</div>
</body>
    
    <!--   Core JS Files and PerfectScrollbar library inside jquery.ui   -->
    <script src="view/assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="view/assets/js/jquery-ui.min.js" type="text/javascript"></script> 
	<script src="view/assets/js/bootstrap.min.js" type="text/javascript"></script>	
	<!--  Forms Validations Plugin -->
	<script src="view/assets/js/jquery.validate.min.js"></script>	
	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="view/assets/js/moment.min.js"></script>	
    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="view/assets/js/bootstrap-datetimepicker.js"></script>    
    <!--  Select Picker Plugin -->
    <script src="view/assets/js/bootstrap-selectpicker.js"></script>    
	<!--  Checkbox, Radio, Switch and Tags Input Plugins -->
	<script src="view/assets/js/bootstrap-checkbox-radio-switch-tags.js"></script>	
	<!--  Charts Plugin -->
	<script src="view/assets/js/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="view/assets/js/bootstrap-notify.js"></script>    
    <!-- Sweet Alert 2 plugin -->
	<script src="view/assets/js/sweetalert2.js"></script>        
    <!-- Vector Map plugin -->
	<script src="view/assets/js/jquery-jvectormap.js"></script>	
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>	
	<!-- Wizard Plugin    -->
    <script src="view/assets/js/jquery.bootstrap.wizard.min.js"></script>
    <!--  Datatable Plugin    -->
    <script src="view/assets/js/bootstrap-table.js"></script>    
    <!--  Full Calendar Plugin    -->
    <script src="view/assets/js/fullcalendar.min.js"></script>    
    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="view/assets/js/light-bootstrap-dashboard.js"></script>	
	<!--   Sharrre Library    -->
    <script src="view/assets/js/jquery.sharrre.js"></script>	
	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="view/assets/js/demo.js"></script>	    
    <script type="text/javascript">
        $().ready(function(){
            lbd.checkFullPageBackgroundImage();            
            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
        });
    </script>
</html>