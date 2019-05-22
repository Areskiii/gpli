<?php
class ControllerUserPersonnel extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('user/personnel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/personnel');

		$this->getList();
	}

	public function add() {
		$this->load->language('user/personnel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/personnel');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_personnel->addPersonnel($this->request->post);

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

			$this->response->redirect($this->url->link('user/personnel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('user/personnel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/personnel');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_user_personnel->editPersonnel($this->request->get['personnel_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('user/personnel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('user/personnel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('user/personnel');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $personnel_id) {
				$this->model_user_personnel->deletePersonnel($personnel_id);
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

			$this->response->redirect($this->url->link('user/personnel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'username';
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
			'href' => $this->url->link('user/personnel', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['insert'] = $this->url->link('user/personnel/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('user/personnel/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['users'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 20,
			'limit' => 20
		);

		$user_total = $this->model_user_personnel->getTotalUsers();

		$results = $this->model_user_personnel->getUsers($filter_data);
		
		foreach ($results as $result) {
			$data['users'][] = array(
				'personnel_id'    => $result['personnel_id'],
				'username'   => $result['firstname'].' '.$result['lastname'],
				'status'     => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
				'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
				'edit'       => $this->url->link('user/personnel/edit', 'token=' . $this->session->data['token'] . '&personnel_id=' . $result['personnel_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_username'] = $this->language->get('column_username');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_date_added'] = $this->language->get('column_date_added');
		$data['column_action'] = $this->language->get('column_action');

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

		$data['sort_username'] = $this->url->link('user/personnel', 'token=' . $this->session->data['token'] . '&sort=username' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('user/personnel', 'token=' . $this->session->data['token'] . '&sort=status' . $url, 'SSL');
		$data['sort_date_added'] = $this->url->link('user/personnel', 'token=' . $this->session->data['token'] . '&sort=date_added' . $url, 'SSL');

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
		$pagination->limit = 20;
		$pagination->url = $this->url->link('user/personnel', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		// $data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * 20) + 1 : 0, ((($page - 1) * 20) > ($user_total - 20)) ? $user_total : ((($page - 1) * 20) + 20), $user_total, ceil($user_total / 20));
		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * 20) + 1 : 0, ((($page - 1) * 20) > ($user_total - 20)) ? $user_total : ((($page - 1) * 20) + 20), $user_total, ceil($user_total / 20));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/personnel_list.tpl', $data));
	}

	protected function getForm() {

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['personnel_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_username'] = $this->language->get('entry_username');
		$data['entry_user_group'] = $this->language->get('entry_user_group');
		$data['entry_password'] = $this->language->get('entry_password');
		$data['entry_confirm'] = $this->language->get('entry_confirm');
		$data['entry_firstname'] = $this->language->get('entry_firstname');
		$data['entry_lastname'] = $this->language->get('entry_lastname');
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_is_network'] = $this->language->get('entry_is_network');
		$data['entry_ip'] = $this->language->get('entry_ip');
		$data['entry_site'] = $this->language->get('entry_site');
		$data['entry_bureau'] = $this->language->get('entry_bureau');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

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

		if (isset($this->error['matricle'])) {
			$data['error_matricle'] = $this->error['matricle'];
		} else {
			$data['error_matricle'] = '';
		}
		
		if (isset($this->error['firstname'])) {
			$data['error_firstname'] = $this->error['firstname'];
		} else {
			$data['error_firstname'] = '';
		}

		if (isset($this->error['lastname'])) {
			$data['error_lastname'] = $this->error['lastname'];
		} else {
			$data['error_lastname'] = '';
		}

		if (isset($this->error['site'])) {
			$data['error_site'] = $this->error['site'];
		} else {
			$data['error_site'] = '';
		}
		
		if (isset($this->error['bureau'])) {
			$data['error_bureau'] = $this->error['bureau'];
		} else {
			$data['error_bureau'] = '';
		}
		
		if (isset($this->error['fonction'])) {
			$data['error_fonction'] = $this->error['fonction'];
		} else {
			$data['error_fonction'] = '';
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
			'href' => $this->url->link('user/personnel', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['personnel_id'])) {
			$data['action'] = $this->url->link('user/personnel/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('user/personnel/edit', 'token=' . $this->session->data['token'] . '&personnel_id=' . $this->request->get['personnel_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('user/personnel', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['personnel_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $this->model_user_personnel->getPersonnel($this->request->get['personnel_id']);
		}
		
		$this->load->model('gestion/affectation');
		$data['bureaux']= $this->model_gestion_affectation->getListesBureaux();
        $data['sites']= $this->model_gestion_affectation->getListesSites();

		if (isset($this->request->post['matricule'])) {
			$data['matricule'] = $this->request->post['matricule'];
		} elseif (!empty($user_info)) {
			$data['matricule'] = $user_info['matricule'];
		} else {
			$data['matricule'] = '';
		}

		$this->load->model('addons/fonction');

		$data['fonctions'] = $this->model_addons_fonction->getListFonctions();
		
		if (isset($this->request->post['fonction_id'])) {
			$data['fonction_id'] = $this->request->post['fonction_id'];
		} elseif (!empty($user_info)) {
			$data['fonction_id'] = $user_info['profession_id'];
		} else {
			$data['fonction_id'] = '';
		}

		if (isset($this->request->post['firstname'])) {
			$data['firstname'] = $this->request->post['firstname'];
		} elseif (!empty($user_info)) {
			$data['firstname'] = $user_info['firstname'];
		} else {
			$data['firstname'] = '';
		}

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} elseif (!empty($user_info)) {
			$data['lastname'] = $user_info['lastname'];
		} else {
			$data['lastname'] = '';
		}

		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (!empty($user_info)) {
			$data['email'] = $user_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['ip'])) {
			$data['ip'] = $this->request->post['ip'];
		} elseif (!empty($user_info)) {
			$data['ip'] = $user_info['ip'];
		} else {
			$data['ip'] = '';
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($user_info)) {
			$data['status'] = $user_info['status'];
		} else {
			$data['status'] = 0;
		}

		if (isset($this->request->post['internet'])) {
			$data['internet'] = $this->request->post['internet'];
		} elseif (!empty($user_info)) {
			$data['internet'] = $user_info['internet'];
		} else {
			$data['internet'] = 0;
		}
		
		if (isset($this->request->post['bureau'])) {
			$data['bureau'] = $this->request->post['bureau_id'];
		} elseif (!empty($user_info)) {
			$data['bureau'] = $user_info['bureau_id'];
		} else {
			$data['bureau'] = '';
		}

        if (isset($this->request->post['site'])) {
            $data['site'] = $this->request->post['site_id'];
        } elseif (!empty($user_info)) {
            $data['site'] = $user_info['site_id'];
        } else {
            $data['site'] = '';
        }
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('user/personnel_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'user/personnel')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if ((utf8_strlen($this->request->post['matricule']) < 3) || (utf8_strlen($this->request->post['matricule']) > 20)) {
			$this->error['matricle'] = $this->language->get('error_matricle');
		}
		
		if ($this->request->post['sit']==0) {
			$this->error['site'] = $this->language->get('error_site');
		}

		if ($this->request->post['bureau']==0) {
			$this->error['bureau'] = $this->language->get('error_bureau');
		}

		if ($this->request->post['fonction_id']==0) {
			$this->error['fonction'] = $this->language->get('error_fonction');
		}		
		
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}

		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'user/personnel')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['selected'] as $personnel_id) {
			if ($this->user->getId() == $personnel_id) {
				$this->error['warning'] = $this->language->get('error_account');
			}
		}

		return !$this->error;
	}
}