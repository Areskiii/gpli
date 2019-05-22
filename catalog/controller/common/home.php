<?php

class ControllerCommonHome extends Controller 
{
	private $error = array();

	public function index() {
		header('Location: http://localhost/gpli_pfe/admin/');
		exit();
	}	
	
}