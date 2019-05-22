<?php
class ControllerAddonsFonction extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('addons/fonction');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('addons/fonction');

		$this->getList();
	}

	protected function getList() {
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'site';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['insert'] = $this->url->link('addons/fonction/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('addons/fonction/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['Gouvernorats'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$user_total = $this->model_addons_fonction->getTotalFonction();

		$results = $this->model_addons_fonction->getFonction($filter_data);

		foreach ($results as $result) 
		{
			$data['Gouvernorats'][] = array(
				'id'=> $result['profession_id'],
				'Libelle' => $result['libelle_profession'],
				'Etat'=> $result['Actif'] ? "Active" : "Désactivé",
				'edit'=> $this->url->link('addons/fonction/edit', 'token=' . $this->session->data['token'] . '&profession_id=' . $result['profession_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['column_id']= $this->language->get('column_id');
		$data['column_text']= $this->language->get('column_text');
		$data['column_title']= $this->language->get('column_title');
		$data['column_Etat']= $this->language->get('column_Etat');
		$data['column_action']= $this->language->get('column_action');
		
		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
			
		$data['sort_id'] = $this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . '&sort=profession_id' . $url, 'SSL');
		$data['sort_title'] = $this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . '&sort=libelle_profession' . $url, 'SSL');
		$data['sort_Etat'] = $this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . '&sort=Actif' . $url, 'SSL');
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $user_total;
		$pagination->page = $page;
		$pagination->limit = 10;
		$pagination->url = $this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * 20) + 1 : 0, ((($page - 1) * 20) > ($user_total - 20)) ? $user_total : ((($page - 1) * 20) + 20), $user_total, ceil($user_total / 20));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('addons/fonction.tpl', $data));
	}

	protected function getForm() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['profession_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_id']= $this->language->get('entry_id');
		$data['entry_status']= $this->language->get('entry_status');
		$data['entry_text']= $this->language->get('entry_text');
		$data['entry_title'] = $this->language->get('entry_title');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = '';
		}
		
		if (isset($this->error['text'])) {
			$data['error_text'] = $this->error['text'];
		} else {
			$data['error_text'] = '';
		}
		
		
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['profession_id'])) {
			$data['action'] = $this->url->link('addons/fonction/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('addons/fonction/edit', 'token=' . $this->session->data['token'] . '&profession_id=' . $this->request->get['profession_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		
		if (isset($this->request->get['profession_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$matriel_Info = $this->model_addons_fonction->getMatrielByID($this->request->get['profession_id']);
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($matriel_Info)) {
			$data['status'] = $matriel_Info['Actif'];
		} else {
			$data['status'] = '';
		}
		
		
		if (isset($this->request->post['libelle_profession'])) {
			$data['libelle_profession'] = $this->request->post['libelle_profession'];
		} elseif (!empty($matriel_Info)) {
			$data['libelle_profession'] = $matriel_Info['libelle_profession'];
		} else {
			$data['libelle_profession'] = '';
		}
		
			
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('addons/fonction_form.tpl', $data));
	}
	
	public function add() {
		$this->load->language('addons/fonction');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('addons/fonction');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_addons_fonction->addFonction($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->load->language('addons/fonction');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('addons/fonction');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_addons_fonction->editFonction($this->request->get['profession_id'], $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->load->language('addons/fonction');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('addons/fonction');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $profession_id) {
				$this->model_addons_fonction->deleteFonction($profession_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			$this->response->redirect($this->url->link('addons/fonction', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	protected function validateForm() {
		
		if (!$this->user->hasPermission('modify', 'addons/fonction')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen(trim($this->request->post['libelle_profession'])) < 1) || (utf8_strlen(trim($this->request->post['libelle_profession'])) > 25)) {
			$this->error['title'] = $this->language->get('error_title');
		}
			
		return !$this->error;
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'addons/fonction')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
}