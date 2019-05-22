<?php
class ControllerCommonMenu extends Controller {
	public function index() {
		$this->load->language('common/menu');

		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_users'] = $this->language->get('text_users');
		$data['text_user'] = $this->language->get('text_user');
		$data['text_user_group'] = $this->language->get('text_user_group');
		$data['text_db_setting'] = $this->language->get('text_db_setting');
		$data['text_data_config'] = $this->language->get('text_data_config');
		$data['text_manager_service'] = $this->language->get('text_manager_service');
		$data['text_logs_files'] = $this->language->get('text_logs_files');
		$data['text_logs_platforme'] = $this->language->get('text_logs_platforme');
		$data['text_admin_log'] = $this->language->get('text_admin_log');
		$data['text_system_log'] = $this->language->get('text_system_log');
		$data['text_matriel'] = $this->language->get('text_matriel');
		$data['text_marque'] = $this->language->get('text_marque');
		$data['text_typematriel'] = $this->language->get('text_typematriel');
		$data['text_addons'] = $this->language->get('text_addons');
		$data['text_gouvernorat'] = $this->language->get('text_gouvernorat');
		$data['text_delegation'] = $this->language->get('text_delegation');
		$data['text_fonction'] = $this->language->get('text_fonction');
		$data['text_elFinder'] = $this->language->get('text_elFinder');
		$data['text_sites'] = $this->language->get('text_sites');
		$data['text_site'] = $this->language->get('text_site');
		$data['text_bureau'] = $this->language->get('text_bureau');
        $data['text_parc'] = $this->language->get('text_parc');
        $data['text_parcs'] = $this->language->get('text_parcs');
        $data['text_matriels'] = $this->language->get('text_matriels');
		$data['text_tikcet'] = $this->language->get('text_tikcet');
		$data['text_intervention'] = $this->language->get('text_intervention');
		$data['text_personnels'] = $this->language->get('text_personnels');	

		$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
		$data['db_setting'] = $this->url->link('elastic/many_database_setting', 'token=' . $this->session->data['token'], 'SSL');
		$data['data_config'] = $this->url->link('elastic/dataconfig', 'token=' . $this->session->data['token'], 'SSL');
		$data['user_group'] = $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], 'SSL');
		$data['user'] = $this->url->link('user/user', 'token=' . $this->session->data['token'], 'SSL');
		$data['logs_files'] = $this->url->link('report/logs', 'token=' . $this->session->data['token'], 'SSL');
		$data['admin_log'] = $this->url->link('tool/error_log', 'token=' . $this->session->data['token'], 'SSL');
		$data['system_log'] = $this->url->link('tool/sys_log', 'token=' . $this->session->data['token'], 'SSL');
		$data['backup_log'] = $this->url->link('tool/backup_es_log', 'token=' . $this->session->data['token'], 'SSL');
		$data['config_search_engines'] = $this->url->link('setting/search_engines', 'token=' . $this->session->data['token'], 'SSL');
		$data['matriel'] = $this->url->link('matriel/matriel', 'token=' . $this->session->data['token'], 'SSL');
		$data['marque'] = $this->url->link('matriel/marque', 'token=' . $this->session->data['token'], 'SSL');
		$data['delegation'] = $this->url->link('addons/delegation', 'token=' . $this->session->data['token'], 'SSL');
		$data['gouvernorat'] = $this->url->link('addons/gouvernorat', 'token=' . $this->session->data['token'], 'SSL');
		$data['fonction'] = $this->url->link('addons/fonction', 'token=' . $this->session->data['token'], 'SSL');
		$data['elFinder'] = $this->url->link('file/elfinder', 'token=' . $this->session->data['token'], 'SSL');
		$data['site'] = $this->url->link('site/site', 'token=' . $this->session->data['token'], 'SSL');
		$data['bureau'] = $this->url->link('site/bureau', 'token=' . $this->session->data['token'], 'SSL');
        $data['parcs'] = $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'], 'SSL');
        $data['martiel'] = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'], 'SSL');
		$data['ticket'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'], 'SSL');
		$data['intervention'] = $this->url->link('addons/intervention', 'token=' . $this->session->data['token'], 'SSL');
		$data['personnels'] = $this->url->link('user/personnel', 'token=' . $this->session->data['token'], 'SSL');

		return $this->load->view('common/menu.tpl', $data);
	}
}