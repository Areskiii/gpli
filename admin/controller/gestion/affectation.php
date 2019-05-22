<?php
class ControllerGestionAffectation extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('gestion/affectation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/affectation');

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
			'href' => $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['insert'] = $this->url->link('gestion/affectation/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('gestion/affectation/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['Affectations'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$user_total = $this->model_gestion_affectation->getTotalAffectation();

		$results = $this->model_gestion_affectation->getAffectation($filter_data);

		foreach ($results as $result) 
		{
			$data['Affectations'][] = array(
				'id'=> $result['affectation_id'],
				'user' => $this->model_gestion_affectation->getUserByID($result['user_id']),
                'bureau' => $this->model_gestion_affectation->getBureauByID($result['bureau_id']),
                'site' =>  $this->model_gestion_affectation->getSiteByID($result['site_id']),
                'matriel' => $this->model_gestion_affectation->GetTypeMariel($result['matriel_id']),
				'edit'=> $this->url->link('gestion/affectation/edit', 'token=' . $this->session->data['token'] . '&affectation_id=' . $result['affectation_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['column_id']= $this->language->get('column_id');
		$data['column_text']= $this->language->get('column_text');
		$data['column_user']= $this->language->get('column_user');
		$data['column_bureau']= $this->language->get('column_bureau');
        $data['column_site']= $this->language->get('column_site');
        $data['column_matriel']= $this->language->get('column_matriel');
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
			
		$data['sort_id'] = $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . '&sort=affectation_id' . $url, 'SSL');
		$data['sort_bureau'] = $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . '&sort=bureau_id' . $url, 'SSL');
		$data['sort_user'] = $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . '&sort=user_id' . $url, 'SSL');
        $data['sort_site'] = $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . '&sort=site_id' . $url, 'SSL');

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
		$pagination->url = $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * 20) + 1 : 0, ((($page - 1) * 20) > ($user_total - 20)) ? $user_total : ((($page - 1) * 20) + 20), $user_total, ceil($user_total / 20));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('gestion/affectation.tpl', $data));
	}

	protected function getForm() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['affectation_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_user']= $this->language->get('entry_user');
		$data['entry_bureau']= $this->language->get('entry_bureau');
		$data['entry_site']= $this->language->get('entry_site');
		$data['entry_title'] = $this->language->get('entry_title');
        $data['entry_matriel'] = $this->language->get('entry_matriel');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['site'])) {
			$data['error_site'] = $this->error['site'];
		} else {
			$data['error_site'] = '';
		}
		
		if (isset($this->error['user'])) {
			$data['error_user'] = $this->error['user'];
		} else {
			$data['error_user'] = '';
		}
		
		if (isset($this->error['matriel'])) {
			$data['error_matriel'] = $this->error['matriel'];
		} else {
			$data['error_matriel'] = '';
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
			'href' => $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['affectation_id'])) {
			$data['action'] = $this->url->link('gestion/affectation/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('gestion/affectation/edit', 'token=' . $this->session->data['token'] . '&affectation_id=' . $this->request->get['affectation_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['affectation_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$matriel_Info = $this->model_gestion_affectation->getAffectationByID($this->request->get['affectation_id']);
		}
		$data['users']= $this->model_gestion_affectation->getListesUsers();
        $data['bureaux']= $this->model_gestion_affectation->getListesBureaux();
        $data['sites']= $this->model_gestion_affectation->getListesSites();
        $data['matriels']= $this->model_gestion_affectation->getListesMatriels();

		if (isset($this->request->post['user'])) {
			$data['user'] = $this->request->post['user'];
		} elseif (!empty($matriel_Info)) {
			$data['user'] = $matriel_Info['user_id'];
		} else {
			$data['user'] = '';
		}
		
		
		if (isset($this->request->post['bureau'])) {
			$data['bureau'] = $this->request->post['bureau_id'];
		} elseif (!empty($matriel_Info)) {
			$data['bureau'] = $matriel_Info['bureau_id'];
		} else {
			$data['bureau'] = '';
		}

        if (isset($this->request->post['site'])) {
            $data['site'] = $this->request->post['site_id'];
        } elseif (!empty($matriel_Info)) {
            $data['site'] = $matriel_Info['site_id'];
        } else {
            $data['site'] = '';
        }

        if (isset($this->request->post['matriel'])) {
            $data['matriel'] = $this->request->post['matriel_id'];
        } elseif (!empty($matriel_Info)) {
            $data['matriel'] = $matriel_Info['matriel_id'];
        } else {
            $data['matriel'] = '';
        }

			
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('gestion/affectation_form.tpl', $data));
	}
	
	public function add() {
		$this->load->language('gestion/affectation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/affectation');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_gestion_affectation->addAffectation($this->request->post);

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

			$this->response->redirect($this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->load->language('gestion/affectation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/affectation');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_gestion_affectation->editAffectation($this->request->get['affectation_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->load->language('gestion/affectation');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/affectation');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $affectation_id) {
				$this->model_gestion_affectation->deleteAffectation($affectation_id);
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

			$this->response->redirect($this->url->link('gestion/affectation', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	protected function validateForm() {
		
		if (!$this->user->hasPermission('modify', 'gestion/affectation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ($this->request->post['site']==0) {
			$this->error['site'] = $this->language->get('error_site');
		}	
		
		if ($this->request->post['user']==0) {
			$this->error['user'] = $this->language->get('error_user');
		}	
		
		if ($this->request->post['matriel']==0) {
			$this->error['matriel'] = $this->language->get('error_matriel');
		}	
		return !$this->error;
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'gestion/affectation')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
}