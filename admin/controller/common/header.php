<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		$data['title'] = $this->document->getTitle();
		

		if ($this->request->server['HTTPS']) {
			$data['base'] = HTTPS_SERVER;
		} else {
			$data['base'] = HTTP_SERVER;
		}

		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		$data['lang'] = $this->language->get('code');
		$data['direction'] = $this->language->get('direction');

		$this->load->language('common/header');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_store'] = $this->language->get('text_store');
		$data['text_front'] = $this->language->get('text_front');
		$data['text_help'] = $this->language->get('text_help');
		$data['text_homepage'] = $this->language->get('text_homepage');
		$data['text_documentation'] = $this->language->get('text_documentation');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->user->getUserName());
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_toggle_navigation'] = $this->language->get('text_toggle_navigation');
		$data['text_stats_segments'] = $this->language->get('text_stats_segments');
		$data['text_more'] = $this->language->get('text_more');
		
		$data['plateforme_slogan'] = $this->language->get('plateforme_slogan');
		$data['plateforme_slogan_min'] = $this->language->get('plateforme_slogan_min');
		$data['plateforme'] = $this->language->get('plateforme');
		
		$data['text_setting'] = $this->language->get('text_setting');		
		$data['setting'] = $this->url->link('setting/store', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['text_backup_restore_db'] = $this->language->get('text_backup_restore_db');
		$data['backup_restore_db_plateforme'] = $this->url->link('tool/backup', 'token=' . $this->session->data['token'], 'SSL');
		
		$data['text_help_center'] = $this->language->get('text_help_center');
		$data['help_center'] = $this->url->link('tool/help_center', 'token=' . $this->session->data['token'], 'SSL');

		if (!isset($this->request->get['token']) || !isset($this->session->data['token']) && ($this->request->get['token'] != $this->session->data['token'])) {
			$data['logged'] = '';

			$data['home'] = $this->url->link('common/dashboard', '', 'SSL');
		} else {
			$data['logged'] = true;

			$data['home'] = $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL');
			$data['segments_stats'] = $this->url->link('report/segments', 'token=' . $this->session->data['token'], 'SSL');
			$data['logout'] = $this->url->link('common/logout', 'token=' . $this->session->data['token'], 'SSL');


			// Online Stores
			$data['stores'] = array();

			$data['stores'][] = array(
				'name' => $this->config->get('config_name'),
				'href' => HTTP_CATALOG
			);
		}
		
		$data['profile'] = $this->load->controller('common/profile');
		$data['menu'] = $this->load->controller('common/menu');

		return $this->load->view('common/header.tpl', $data);
	}
}