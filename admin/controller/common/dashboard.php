<?php
class ControllerCommonDashboard extends Controller {
	public function index() {
		$this->load->language('common/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_statistics'] = $this->language->get('text_statistics');		
		
		$data['text_users'] = $this->language->get('text_users');
		$data['text_article'] = $this->language->get('text_article');
		/**** Get Number User Maintenance EzQuote ***/
		$this->load->model('user/user');
		$data['num_users']=$this->model_user_user->getTotalUsers();
		
		
		/**** Get Number User Maintenance EzQuote ***/
		$this->load->model('user/personnel');
		$data['num_matriels']=$this->model_user_personnel->getTotalUsers();
		
		
		$data['text_size'] = $this->language->get('text_size');
		$size=$this->folderSize('C:/wamp/www/gpli_pfe/');
		$data['num_size']= $this->isa_convert_bytes_to_specified($size, 'M', 2).'Mo';
		
		$data['text_document'] = $this->language->get('text_document');
		$file = basename($_SERVER['PHP_SELF']); 
		$data['num_document']= count(file($file)); 
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);
		
		// Check install directory exists
		if (is_dir(dirname(DIR_APPLICATION) . '/install')) {
			$data['error_install'] = $this->language->get('error_install');
		} else {
			$data['error_install'] = '';
		}

		$data['text_ticket'] = $this->language->get('text_ticket');
		/**** Get Number User Ticket ***/
		$this->load->model('gestion/ticket');
		$data['num_ticket']=$this->model_gestion_ticket->getTotalTicket();

		
		$data['text_structure'] = $this->language->get('text_structure');
		/**** Get Number User Ticket ***/
		$this->load->model('site/site');
		$data['num_structure']=$this->model_site_site->getTotalSite();


		$data['text_bureau'] = $this->language->get('text_bureau');
		/**** Get Number User Bureau ***/
		$this->load->model('site/bureau');
		$data['num_bureau']=$this->model_site_bureau->getTotalBureau();

		$data['num_cpu']= $this->get_server_load().' %';

		$this->load->model('gestion/matriel');
		$data['num_matriel']= $this->model_gestion_matriel->getTotalMatriel();
		$this->load->model('gestion/affectation');
		$data['num_matriel_affecte']= $this->model_gestion_affectation->getTotalMatrielAffecte();

		$data['token'] = $this->session->data['token'];

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('common/dashboard.tpl', $data));
	}	

	public function folderSize ($dir)
	{
		$size = 0;
		foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
			$size += is_file($each) ? filesize($each) : $this->folderSize($each);
		}
		return $size;
	}

	public function isa_convert_bytes_to_specified($bytes, $to, $decimal_places = 1) {
		$formulas = array(
			'K' => number_format($bytes / 1024, $decimal_places),
			'M' => number_format($bytes / 1048576, $decimal_places),
			'G' => number_format($bytes / 1073741824, $decimal_places)
		);
		return isset($formulas[$to]) ? $formulas[$to] : 0;
	}

	function get_server_load() {
		$load = '';
		if (stristr(PHP_OS, 'win')) {
			$cmd = 'wmic cpu get loadpercentage /all';
			@exec($cmd, $output);
			if ($output) {
				foreach($output as $line) {
					if ($line && preg_match('/^[0-9]+$/', $line)) {
						$load = $line;
						break;
					}
				}
			}
	
		} else {
			$sys_load = sys_getloadavg();
			$load = $sys_load[0];
		}
		return $load;
	}

}
