<?php
class ControllerGestionTicket extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('gestion/ticket');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/ticket');

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
			'href' => $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['insert'] = $this->url->link('gestion/ticket/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('gestion/ticket/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['Tickets'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$user_total = $this->model_gestion_ticket->getTotalTicket();

		$results = $this->model_gestion_ticket->getTicket($filter_data);

		foreach ($results as $result) 
		{
			$data['Tickets'][] = array(
				'id'=> $result['ticket_id'],
				'user' => $this->model_gestion_ticket->getUserByID($result['user_id']),
				'coupon' => $result['coupon'],
				'type_ticket' => $this->model_gestion_ticket->GetTypeTicket($result['type_ticket_id']),
                'date_ticket_open' => $result['date_ticket_open'],
                'date_ticke_close' =>  ($result['date_ticke_close']!="0000-00-00")? $result['date_ticke_close'] : '',
                'matriel' => $this->model_gestion_ticket->GetTypeMariel($result['matriel_id']),
				'edit'=> $this->url->link('gestion/ticket/edit', 'token=' . $this->session->data['token'] . '&ticket_id=' . $result['ticket_id'] . $url, 'SSL'),
				'transfert'=> $this->url->link('gestion/ticket/transfert', 'token=' . $this->session->data['token'] . '&ticket_id=' . $result['ticket_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['column_id']= $this->language->get('column_id');
		$data['column_text']= $this->language->get('column_text');
		$data['column_user']= $this->language->get('column_user');
		$data['column_date_create']= $this->language->get('column_date_create');
        $data['column_date_cloture']= $this->language->get('column_date_cloture');
        $data['column_matriel']= $this->language->get('column_matriel');
		$data['column_action']= $this->language->get('column_action');
		$data['column_coupon']= $this->language->get('column_coupon');
		$data['column_type_ticket']= $this->language->get('column_type_ticket');
		
		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_transfert'] = $this->language->get('button_transfert');
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
			
		$data['sort_id'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . '&sort=ticket_id' . $url, 'SSL');
		$data['sort_bureau'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . '&sort=bureau_id' . $url, 'SSL');
		$data['sort_user'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . '&sort=user_id' . $url, 'SSL');
        $data['sort_site'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . '&sort=site_id' . $url, 'SSL');

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
		$pagination->url = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * 20) + 1 : 0, ((($page - 1) * 20) > ($user_total - 20)) ? $user_total : ((($page - 1) * 20) + 20), $user_total, ceil($user_total / 20));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('gestion/ticket.tpl', $data));
	}

	protected function getForm() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['ticket_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_user']= $this->language->get('entry_user');
		$data['entry_bureau']= $this->language->get('entry_bureau');
		$data['entry_site']= $this->language->get('entry_site');
		$data['entry_title'] = $this->language->get('entry_title');
        $data['entry_matriel'] = $this->language->get('entry_matriel');
		$data['entry_date_ticket_open'] = $this->language->get('entry_date_ticket_open');
		$data['entry_date_ticke_close'] = $this->language->get('entry_date_ticke_close');
		$data['entry_type_ticket'] = $this->language->get('entry_type_ticket');	
		$data['entry_panne'] = $this->language->get('entry_panne');	
		$data['entry_traveau'] = $this->language->get('entry_traveau');	
		
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
			'href' => $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['ticket_id'])) {
			$data['action'] = $this->url->link('gestion/ticket/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('gestion/ticket/edit', 'token=' . $this->session->data['token'] . '&ticket_id=' . $this->request->get['ticket_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['ticket_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$matriel_Info = $this->model_gestion_ticket->getTicketByID($this->request->get['ticket_id']);
		}

		$data['users']= $this->model_gestion_ticket->getListesUsers();
        $data['matriels']= $this->model_gestion_ticket->getListesMatriels();
		$data['type_tickets']= $this->model_gestion_ticket->getListesTypeTickets();
		
		if (isset($this->request->post['user'])) {
			$data['user'] = $this->request->post['user'];
		} elseif (!empty($matriel_Info)) {
			$data['user'] = $matriel_Info['user_id'];
		} else {
			$data['user'] = '';
		}
		
		if (isset($this->request->post['type_ticket_id'])) {
			$data['type_ticket_id'] = $this->request->post['type_ticket_id'];
		} elseif (!empty($matriel_Info)) {
			$data['type_ticket_id'] = $matriel_Info['type_ticket_id'];
		} else {
			$data['type_ticket_id'] = '';
		}
	
        if (isset($this->request->post['matriel'])) {
            $data['matriel'] = $this->request->post['matriel_id'];
        } elseif (!empty($matriel_Info)) {
            $data['matriel'] = $matriel_Info['matriel_id'];
        } else {
            $data['matriel'] = '';
        }
		
		if (isset($this->request->post['date_ticket_open'])) {
			$data['date_ticket_open'] = $this->request->post['date_ticket_open'];
		} elseif (!empty($matriel_Info)) {
			$data['date_ticket_open'] = $matriel_Info['date_ticket_open'];
		} else {
			$data['date_ticket_open'] = '';
		}
		
		
		if (isset($this->request->post['date_ticke_close'])) {
			$data['date_ticke_close'] = $this->request->post['date_ticke_close'];
		} elseif (!empty($matriel_Info)) {
			$data['date_ticke_close'] = $matriel_Info['date_ticke_close'];
		} else {
			$data['date_ticke_close'] = '';
		}
		
		if (isset($this->request->post['panne'])) {
			$data['panne'] = $this->request->post['panne'];
		} elseif (!empty($matriel_Info)) {
			$data['panne'] = $matriel_Info['panne'];
		} else {
			$data['panne'] = '';
		}
		
		if (isset($this->request->post['traveau'])) {
			$data['traveau'] = $this->request->post['traveau'];
		} elseif (!empty($matriel_Info)) {
			$data['traveau'] = $matriel_Info['traveau'];
		} else {
			$data['traveau'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('gestion/ticket_form.tpl', $data));
	}
	
	public function add() {
		$this->load->language('gestion/ticket');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/ticket');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_gestion_ticket->addTicket($this->request->post);

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

			$this->response->redirect($this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->load->language('gestion/ticket');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/ticket');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_gestion_ticket->editTicket($this->request->get['ticket_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->load->language('gestion/ticket');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/ticket');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $ticket_id) {
				$this->model_gestion_ticket->deleteTicket($ticket_id);
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

			$this->response->redirect($this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	protected function validateForm() {
		
		if (!$this->user->hasPermission('modify', 'gestion/ticket')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ($this->request->post['type_ticket_id']==0) {
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
		if (!$this->user->hasPermission('modify', 'gestion/ticket')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
	
	public function transfert() {

		$this->load->language('gestion/ticket');
		$this->load->model('gestion/ticket');

		$data['heading_title_transfert'] = $this->language->get('heading_title_transfert');
		$this->document->setTitle($this->language->get('heading_title_transfert'));
		
		$data['text_form'] = !isset($this->request->get['ticket_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_user']= $this->language->get('entry_user');
		$data['entry_bureau']= $this->language->get('entry_bureau');
		$data['entry_site']= $this->language->get('entry_site');
		$data['entry_title'] = $this->language->get('entry_title');
        $data['entry_matriel'] = $this->language->get('entry_matriel');
		$data['entry_date_ticket_open'] = $this->language->get('entry_date_ticket_open');
		$data['entry_date_ticke_close'] = $this->language->get('entry_date_ticke_close');
		$data['entry_type_ticket'] = $this->language->get('entry_type_ticket');	
		$data['entry_casse'] = $this->language->get('entry_casse');	
		$data['entry_date_transfert'] = $this->language->get('entry_date_transfert');	
		$data['entry_date_transfert_casse'] = $this->language->get('entry_date_transfert_casse');
		$data['entrty_fax'] = $this->language->get('entrty_fax');
		$data['entrty_fax_joint'] = $this->language->get('entrty_fax_joint');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$url = '';

		if (!isset($this->request->get['ticket_id'])) {
			$data['action'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('gestion/ticket/matriel', 'token=' . $this->session->data['token'] . '&ticket_id=' . $this->request->get['ticket_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['ticket_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$matriel_Info = $this->model_gestion_ticket->getTicketByID($this->request->get['ticket_id']);
		}
	
		$data['users']= $this->model_gestion_ticket->getListesUsers();
        $data['matriels']= $this->model_gestion_ticket->getListesMatriels();
		$data['type_tickets']= $this->model_gestion_ticket->getListesTypeTickets();
		
		if (isset($this->request->post['user'])) {
			$data['user'] = $this->request->post['user'];
		} elseif (!empty($matriel_Info)) {
			$data['user'] = $matriel_Info['user_id'];
		} else {
			$data['user'] = '';
		}
		
		if (isset($this->request->post['type_ticket_id'])) {
			$data['type_ticket_id'] = $this->request->post['type_ticket_id'];
		} elseif (!empty($matriel_Info)) {
			$data['type_ticket_id'] = $matriel_Info['type_ticket_id'];
		} else {
			$data['type_ticket_id'] = '';
		}
	
        if (isset($this->request->post['matriel'])) {
            $data['matriel'] = $this->request->post['matriel_id'];
        } elseif (!empty($matriel_Info)) {
            $data['matriel'] = $matriel_Info['matriel_id'];
        } else {
            $data['matriel'] = '';
        }
		
		if (isset($this->request->post['date_ticket_open'])) {
			$data['date_ticket_open'] = $this->request->post['date_ticket_open'];
		} elseif (!empty($matriel_Info)) {
			$data['date_ticket_open'] = $matriel_Info['date_ticket_open'];
		} else {
			$data['date_ticket_open'] = '';
		}
		
		if (isset($this->request->post['date_transfert_cimf'])) {
			$data['date_transfert_cimf'] = $this->request->post['date_transfert_cimf'];
		} elseif (!empty($matriel_Info)) {
			$data['date_transfert_cimf'] = $matriel_Info['date_transfert_cimf'];
		} else {
			$data['date_transfert_cimf'] = '';
		}
		
		if (isset($this->request->post['date_transfert_casse'])) {
			$data['date_transfert_casse'] = $this->request->post['date_transfert_casse'];
		} elseif (!empty($matriel_Info)) {
			$data['date_transfert_casse'] = $matriel_Info['date_transfert_casse'];
		} else {
			$data['date_transfert_casse'] = '';
		}
		
		if (isset($this->request->post['fax'])) {
			$data['fax'] = $this->request->post['fax'];
		} elseif (!empty($matriel_Info)) {
			$data['fax'] = $matriel_Info['fax'];
		} else {
			$data['fax'] = '';
		}
		
		if (isset($this->request->post['fax_joint'])) {
			$data['fax_joint'] = $this->request->post['fax_joint'];
		} elseif (!empty($matriel_Info)) {
			$data['fax_joint'] = $matriel_Info['fax_joint'];
		} else {
			$data['fax_joint'] = '';
		}
		
		if (isset($this->request->post['date_ticke_close'])) {
			$data['date_ticke_close'] = $this->request->post['date_ticke_close'];
		} elseif (!empty($matriel_Info)) {
			$data['date_ticke_close'] = $matriel_Info['date_ticke_close'];
		} else {
			$data['date_ticke_close'] = '';
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('gestion/transfert.tpl', $data));
	}

	public function matriel() {

		$this->load->language('gestion/ticket');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/ticket');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_gestion_ticket->TransfertTicket($this->request->get['ticket_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('gestion/ticket', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

}