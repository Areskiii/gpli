<!--footer id="footer"><?php echo $text_footer; ?><br /><?php echo $text_version; ?></footer></div-->

<footer class="footer">
            <div class="container-fluid">
                <p class="copyright pull-right">
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

    <!--  Notifications Plugin    -->
    <script src="view/assets/js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
	<script src="view/assets/js/sweetalert2.js"></script>

	<!-- Wizard Plugin    -->
    <script src="view/assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Bootstrap Table Plugin    -->
    <script src="view/assets/js/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
    <script src="view/assets/js/jquery.datatables.js"></script>


    <!--  Full Calendar Plugin    -->
    <!--script src="view/assets/js/fullcalendar.min.js"></script-->

    <!-- Light Bootstrap Dashboard Core javascript and methods -->
	<script src="view/assets/js/light-bootstrap-dashboard.js"></script>

	<!--   Sharrre Library    -->
    <script src="view/assets/js/jquery.sharrre.js"></script>
	
	<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
	<script src="view/assets/js/demo.js"></script>	
	
	<script>
		$().ready(function(){
			// Set last page opened on the menu
			active_url =  window.location;
			sessionStorage.setItem('menu', active_url);
			// $('#menu a[href]').on('click', function() {
				// sessionStorage.setItem('menu', $(this).attr('href'));
			// });
			if (!sessionStorage.getItem('menu')) {
				$('#menu #dashboard').addClass('active');
			} else {
				// Sets active and open to selected page in the left column menu.
				$('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active');
			}
		});
	</script>
	<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</html>