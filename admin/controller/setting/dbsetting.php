<?php
class ControllerSettingDbsetting extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('setting/dbsetting');

		$this->document->setTitle($this->language->get('heading_title'));
		$data['text_db_setting'] = $this->language->get('text_db_setting');
		$data['entry_db_driver'] = $this->language->get('entry_db_driver');
		$data['entry_db_hostname'] = $this->language->get('entry_db_hostname');
		$data['entry_db_username'] = $this->language->get('entry_db_username');
		$data['entry_db_password'] = $this->language->get('entry_db_password');
		$data['entry_db_database_name'] = $this->language->get('entry_db_database_name');
		$data['entry_db_port'] = $this->language->get('entry_db_port');
		$data['button_save'] = $this->language->get('button_save');
		$data['text_database_server'] = $this->language->get('text_database_server');
		$data['text_mysql_version'] = $this->language->get('text_mysql_version');
		$data['text_mysql_client'] = $this->language->get('text_mysql_client');
		$data['text_mysql_host'] = $this->language->get('text_mysql_host');
		$data['text_mysql_protocol'] = $this->language->get('text_mysql_protocol');
		$data['text_php_version'] = $this->language->get('text_php_version');
		
		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('dbsetting', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('setting/dbsetting', 'token=' . $this->session->data['token'], 'SSL'));
		}

		if (isset($this->error['drive'])) {
			$data['error_drive'] = $this->error['drive'];
		} else {
			$data['error_drive'] = '';
		}

		if (isset($this->error['hostname'])) {
			$data['error_hostname'] = $this->error['hostname'];
		} else {
			$data['error_hostname'] = '';
		}
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['username'])) {
			$data['error_username'] = $this->error['username'];
		} else {
			$data['error_username'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['database_name'])) {
			$data['error_database_name'] = $this->error['database_name'];
		} else {
			$data['error_database_name'] = '';
		}
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		$data['action'] = $this->url->link('setting/dbsetting', 'token=' . $this->session->data['token'], 'SSL');

		$data['token'] = $this->session->data['token'];
		
		
		if (isset($this->request->post['dbsetting_drive'])) {
			$data['dbsetting_drive'] = $this->request->post['dbsetting_drive'];
		} else {
			$data['dbsetting_drive'] = $this->config->get('dbsetting_drive');
		}
		
		if (isset($this->request->post['dbsetting_hostname'])) {
			$data['dbsetting_hostname'] = $this->request->post['dbsetting_hostname'];
		} else {
			$data['dbsetting_hostname'] = $this->config->get('dbsetting_hostname');
		}
		
		if (isset($this->request->post['dbsetting_username'])) {
			$data['dbsetting_username'] = $this->request->post['dbsetting_username'];
		} else {
			$data['dbsetting_username'] = $this->config->get('dbsetting_username');
		}
		
		if (isset($this->request->post['dbsetting_password'])) {
			$data['dbsetting_password'] = $this->request->post['dbsetting_password'];
		} else {
			$data['dbsetting_password'] = $this->config->get('dbsetting_password');
		}
		
		if (isset($this->request->post['dbsetting_database_name'])) {
			$data['dbsetting_database_name'] = $this->request->post['dbsetting_database_name'];
		} else {
			$data['dbsetting_database_name'] = $this->config->get('dbsetting_database_name');
		}
		
		if (isset($this->request->post['dbsetting_port'])) {
			$data['dbsetting_port'] = $this->request->post['dbsetting_port'];
		} else {
			$data['dbsetting_port'] = $this->config->get('dbsetting_port');
		}
		
		/** get info Server DB **/
		$db_index_connect = new DB($this->config->get('dbsetting_drive'), $this->config->get('dbsetting_hostname'), $this->config->get('dbsetting_username'), $this->config->get('dbsetting_password'), $this->config->get('dbsetting_database_name'));
		$registry = new Registry();
		$registry->set('db_index_connect', $db_index_connect);
		if ($db_index_connect) {
			$data['server_info'] = $db_index_connect->getServerInfo();
			$data['client_info'] =  mysqli_get_client_info();
			$data['host_info'] = $db_index_connect->getHostInfo();
			$data['proto_info'] = $db_index_connect->getProtocolVersion();
			$data['php_version'] = phpversion();			
		}
		
		/** end get info Server DB **/
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('setting/dbsetting.tpl', $data));
		
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'setting/dbsetting')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['dbsetting_drive']) {
			$this->error['drive'] = $this->language->get('error_drive');
		}

		if (!$this->request->post['dbsetting_hostname']) {
			$this->error['hostname'] = $this->language->get('error_hostname');
		}

		if (!$this->request->post['dbsetting_username']) {
			$this->error['username'] = $this->language->get('error_username');
		}

		if (!$this->request->post['dbsetting_password']) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if (!$this->request->post['dbsetting_database_name']) {
			$this->error['database_name'] = $this->language->get('error_database_name');
		}


		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}
	
}