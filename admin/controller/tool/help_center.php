<?php
class ControllerToolHelpCenter extends Controller {
	public function index() {
		$this->load->language('tool/help_center');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['title_PHP_Version_required'] = $this->language->get('title_PHP_Version_required');
		$data['text_PHP_Version_required'] = $this->language->get('text_PHP_Version_required');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('tool/help_center', 'token=' . $this->session->data['token'], 'SSL')
		);


		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('tool/help_center.tpl', $data));
	}
}