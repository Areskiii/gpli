<?php
class ControllerSiteSite extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('site/site');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('site/site');

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
			'href' => $this->url->link('site/site', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['insert'] = $this->url->link('site/site/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('site/site/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['Matriels'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$user_total = $this->model_site_site->getTotalSite();

		$results = $this->model_site_site->getSite($filter_data);

		foreach ($results as $result) 
		{
			$data['Matriels'][] = array(
				'id'=> $result['site_id'],
				'Libelle' => $result['libelle_site'],
				'Code' => $result['code_site'],
				'Gouvernorat' => $this->model_site_site->GetGouvernoatNameByID($result['gouvernorat_id']),
				'Etat'=> $result['Actif'] ? "Active" : "Désactivé",
				'edit'=> $this->url->link('site/site/edit', 'token=' . $this->session->data['token'] . '&site_id=' . $result['site_id'] . $url, 'SSL'),
				'details'=> $this->url->link('site/site/details', 'token=' . $this->session->data['token'] . '&site_id=' . $result['site_id'] . $url, 'SSL'),
				'matriel'=> $this->url->link('site/site/matriel', 'token=' . $this->session->data['token'] . '&site_id=' . $result['site_id'] . $url, 'SSL'),
				'personnel'=> $this->url->link('site/site/personnel', 'token=' . $this->session->data['token'] . '&site_id=' . $result['site_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['column_id']= $this->language->get('column_id');
		$data['column_text']= $this->language->get('column_text');
		$data['column_title']= $this->language->get('column_title');
		$data['column_code']= $this->language->get('column_code');
		$data['column_Etat']= $this->language->get('column_Etat');
		$data['column_action']= $this->language->get('column_action');
		$data['column_gouvernorat']= $this->language->get('column_gouvernorat');
		
		
		$data['button_insert'] = $this->language->get('button_insert');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_details'] = $this->language->get('button_details');
		$data['button_matriel'] = $this->language->get('button_matriel');
		$data['button_personnel'] = $this->language->get('button_personnel');

		
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
			
		$data['sort_id'] = $this->url->link('site/site', 'token=' . $this->session->data['token'] . '&sort=site_id' . $url, 'SSL');
		$data['sort_text'] = $this->url->link('site/site', 'token=' . $this->session->data['token'] . '&sort=libelle_type_mariel' . $url, 'SSL');
		$data['sort_Etat'] = $this->url->link('site/site', 'token=' . $this->session->data['token'] . '&sort=Actif' . $url, 'SSL');
		
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
		$pagination->url = $this->url->link('site/site', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * 20) + 1 : 0, ((($page - 1) * 20) > ($user_total - 20)) ? $user_total : ((($page - 1) * 20) + 20), $user_total, ceil($user_total / 20));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('site/site.tpl', $data));
	}

	protected function getForm() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['site_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_id']= $this->language->get('entry_id');
		$data['entry_status']= $this->language->get('entry_status');
		$data['entry_text']= $this->language->get('entry_text');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_code'] = $this->language->get('entry_code');
		$data['entry_gouvernorat'] = $this->language->get('entry_gouvernorat');
		$data['entry_analyste'] = $this->language->get('entry_analyste');
		$data['entry_analyste_ip'] = $this->language->get('entry_analyste_ip');
		
		$data['entry_chef'] = $this->language->get('entry_chef');
		$data['entry_adresse'] = $this->language->get('entry_adresse');
		$data['entry_ip'] = $this->language->get('entry_ip');
		$data['entry_mail'] = $this->language->get('entry_mail');
		
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
		
		if (isset($this->error['code'])) {
			$data['error_code'] = $this->error['code'];
		} else {
			$data['error_code'] = '';
		}
		
		if (isset($this->error['adresse'])) {
			$data['error_adresse'] = $this->error['adresse'];
		} else {
			$data['error_adresse'] = '';
		}
		
		if (isset($this->error['chef'])) {
			$data['error_chef'] = $this->error['chef'];
		} else {
			$data['error_chef'] = '';
		}
		
		if (isset($this->error['ip'])) {
			$data['error_ip'] = $this->error['ip'];
		} else {
			$data['error_ip'] = '';
		}

		if (isset($this->error['mail'])) {
			$data['error_mail'] = $this->error['mail'];
		} else {
			$data['error_mail'] = '';
		}		

		if (isset($this->error['analyste'])) {
			$data['error_analyste'] = $this->error['analyste'];
		} else {
			$data['error_analyste'] = '';
		}		
	
		if (isset($this->error['analyste_ip'])) {
			$data['error_analyste_ip'] = $this->error['analyste_ip'];
		} else {
			$data['error_analyste_ip'] = '';
		}	
		
		if (isset($this->error['select'])) {
			$data['error_select'] = $this->error['select'];
		} else {
			$data['error_select'] = '';
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
			'href' => $this->url->link('site/site', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['site_id'])) {
			$data['action'] = $this->url->link('site/site/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('site/site/edit', 'token=' . $this->session->data['token'] . '&site_id=' . $this->request->get['site_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('site/site', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		$data['gouvernoats'] = $this->model_site_site->GetGouvernoat();
		
		if (isset($this->request->get['site_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$matriel_Info = $this->model_site_site->getSiteByID($this->request->get['site_id']);
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($matriel_Info)) {
			$data['status'] = $matriel_Info['Actif'];
		} else {
			$data['status'] = '';
		}
		
		
		if (isset($this->request->post['libelle_site'])) {
			$data['libelle_site'] = $this->request->post['libelle_site'];
		} elseif (!empty($matriel_Info)) {
			$data['libelle_site'] = $matriel_Info['libelle_site'];
		} else {
			$data['libelle_site'] = '';
		}
		
		if (isset($this->request->post['Code'])) {
			$data['Code'] = $this->request->post['Code'];
		} elseif (!empty($matriel_Info)) {
			$data['Code'] = $matriel_Info['code_site'];
		} else {
			$data['Code'] = '';
		}
		
		
		if (isset($this->request->post['gouvernorat_id'])) {
			$data['gouvernorat_id'] = $this->request->post['gouvernorat_id'];
		} elseif (!empty($matriel_Info)) {
			$data['gouvernorat_id'] = $matriel_Info['gouvernorat_id'];
		} else {
			$data['gouvernorat_id'] = '';
		}

		if (isset($this->request->post['adresse'])) {
			$data['adresse'] = $this->request->post['adresse'];
		} elseif (!empty($matriel_Info)) {
			$data['adresse'] = $matriel_Info['adresse'];
		} else {
			$data['adresse'] = '';
		}

		if (isset($this->request->post['chef'])) {
			$data['chef'] = $this->request->post['chef'];
		} elseif (!empty($matriel_Info)) {
			$data['chef'] = $matriel_Info['nom_chef'];
		} else {
			$data['chef'] = '';
		}

		if (isset($this->request->post['ip'])) {
			$data['ip'] = $this->request->post['ip'];
		} elseif (!empty($matriel_Info)) {
			$data['ip'] = $matriel_Info['ip_chef'];
		} else {
			$data['ip'] = '';
		}

		if (isset($this->request->post['mail'])) {
			$data['mail'] = $this->request->post['mail'];
		} elseif (!empty($matriel_Info)) {
			$data['mail'] = $matriel_Info['mail_chef'];
		} else {
			$data['mail'] = '';
		}

		if (isset($this->request->post['analyste'])) {
			$data['analyste'] = $this->request->post['analyste'];
		} elseif (!empty($matriel_Info)) {
			$data['analyste'] = $matriel_Info['analyste'];
		} else {
			$data['analyste'] = '';
		}

		if (isset($this->request->post['analyste_ip'])) {
			$data['analyste_ip'] = $this->request->post['analyste_ip'];
		} elseif (!empty($matriel_Info)) {
			$data['analyste_ip'] = $matriel_Info['analyste_ip'];
		} else {
			$data['analyste_ip'] = '';
		}		
		
			
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('site/site_form.tpl', $data));
	}
	
	public function add() {
		$this->load->language('site/site');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('site/site');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_site_site->addSite($this->request->post);

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

			$this->response->redirect($this->url->link('site/site', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->load->language('site/site');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('site/site');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_site_site->editSite($this->request->get['site_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('site/site', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function details() {
		$this->load->language('site/site');

		$this->document->setTitle($this->language->get('heading_title_details'));
		$data['heading_title_details'] = $this->language->get('heading_title_details');
		$this->load->model('site/site');
		$this->load->model('site/bureau');
		$this->load->language('site/bureau');

		$data['column_id']= $this->language->get('column_id');
		$data['column_text']= $this->language->get('column_text');
		$data['column_title']= $this->language->get('column_title');
		$data['column_code']= $this->language->get('column_code');
		$data['column_Etat']= $this->language->get('column_Etat');
		$data['column_action']= $this->language->get('column_action');
		$data['column_gouvernorat']= $this->language->get('column_gouvernorat');
		$data['column_site']= $this->language->get('column_site');
		$data['column_deleagation']= $this->language->get('column_deleagation');

		$results =$this->model_site_site->DetailsSite($this->request->get['site_id']);;

		foreach ($results as $result) 
		{
			$data['Details'][] = array(
				'id'=> $result['bureau_id'],
				'Libelle' => $result['libelle_bureau'],
				'Code' => $result['code_bureau'],
				'Site' => $this->model_site_bureau->GetSiteNameByID($result['site_id']),
				'Gouvernorat' => $this->model_site_bureau->GetGouvernoatNameByID($result['gouvernorat_id']),
				'Delegation' => $this->model_site_bureau->GetDelegationNameByID($result['delegation_id']),
				'Etat'=> $result['Actif'] ? "Active" : "Désactivé",
				'edit'=> $this->url->link('site/bureau/edit', 'token=' . $this->session->data['token'] . '&bureau_id=' . $result['bureau_id'] . $url, 'SSL')
			);
		}
			

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('site/details.tpl', $data));
	}

	public function delete() {
		$this->load->language('site/site');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('site/site');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $site_id) {
				$this->model_site_site->deleteSite($site_id);
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

			$this->response->redirect($this->url->link('site/site', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	protected function validateForm() {
		
		if (!$this->user->hasPermission('modify', 'site/site')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen(trim($this->request->post['libelle_site'])) < 1) || (utf8_strlen(trim($this->request->post['libelle_site'])) > 25)) {
			$this->error['title'] = $this->language->get('error_title');
		}
		
		if ((utf8_strlen(trim($this->request->post['libelle_site'])) < 1) || (utf8_strlen(trim($this->request->post['libelle_site'])) > 25)) {
			$this->error['code'] = $this->language->get('error_code');
		}
		
		if ((utf8_strlen(trim($this->request->post['adresse'])) < 1) || (utf8_strlen(trim($this->request->post['adresse'])) > 125)) {
			$this->error['adresse'] = $this->language->get('error_adresse');
		}
		
		if ((utf8_strlen(trim($this->request->post['chef'])) < 1) || (utf8_strlen(trim($this->request->post['chef'])) > 45)) {
			$this->error['chef'] = $this->language->get('error_chef');
		}
		
		if ((utf8_strlen(trim($this->request->post['ip'])) < 1) || (utf8_strlen(trim($this->request->post['ip'])) > 15)) {
			$this->error['ip'] = $this->language->get('error_ip');
		}	

		if ((utf8_strlen(trim($this->request->post['mail'])) < 1) || (utf8_strlen(trim($this->request->post['mail'])) > 120)) {
			$this->error['mail'] = $this->language->get('error_mail');
		}	

		if ((utf8_strlen(trim($this->request->post['analyste'])) < 1) || (utf8_strlen(trim($this->request->post['analyste'])) > 45)) {
			$this->error['analyste'] = $this->language->get('error_analyste');
		}
		
		if ((utf8_strlen(trim($this->request->post['analyste_ip'])) < 1) || (utf8_strlen(trim($this->request->post['analyste_ip'])) > 15)) {
			$this->error['analyste_ip'] = $this->language->get('error_analyste_ip');
		}		

		if ($this->request->post['gouvernorat']==0) {
			$this->error['select'] = $this->language->get('error_select');
		}	
	
		return !$this->error;
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'site/site')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		
		return !$this->error;
	}
	
	public function personnel() {
		$this->load->language('site/site');

		$this->document->setTitle($this->language->get('heading_title_personnel'));
		$data['heading_title_personnel'] = $this->language->get('heading_title_personnel');

		$data['column_email']= $this->language->get('column_email');
		$data['column_lastname']= $this->language->get('column_lastname');
		$data['column_firstname']= $this->language->get('column_firstname');
		$data['column_matricule']= $this->language->get('column_matricule');
		$data['column_Etat']= $this->language->get('column_Etat');
		$data['column_action']= $this->language->get('column_action');
		
		$this->load->model('site/site');
		$results =$this->model_site_site->PersonnelSite($this->request->get['site_id']);
		
		foreach ($results as $result) 
		{
			$data['Personnels'][] = array(
				'id'=> $result['bureau_id'],
				'firstname' => $result['firstname'],
				'lastname' => $result['lastname'],
				'email' =>$result['email'],
				'matricule' => $result['matricule'],
				'Etat'=> $result['status'] ? "Active" : "Désactivé"
			);
		}
			

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('site/personnel.tpl', $data));
	}
	
	
	public function matriel() {
		$this->load->language('site/site');

		$this->document->setTitle($this->language->get('heading_title_matriel'));
		$data['heading_title_matriel'] = $this->language->get('heading_title_matriel');
		$this->load->model('site/site');

		$data['column_connecte']= $this->language->get('column_connecte');
		$data['column_internet']= $this->language->get('column_internet');
		$data['column_garantie']= $this->language->get('column_garantie');
		$data['column_marque']= $this->language->get('column_marque');
		$data['column_matriel']= $this->language->get('column_matriel');
		$data['column_coupon']= $this->language->get('column_coupon');
		
		$results =$this->model_site_site->MatrielSite($this->request->get['site_id']);
		
		foreach ($results as $result) 
		{
			$data['Matriels'][] = array(
				'coupon'=> $result['coupon'],
				'matriel' => $this->model_site_site->GetTypeMariel($result['type_matriel_id']),
				'marque' => $this->model_site_site->GetMarqueMariel($result['type_matriel_id']),
				'garantie'=> $result['garantie'] ? "Active" : "Désactivé",
				'internet'=> $result['internet'] ? "Active" : "Désactivé",
				'connecte'=> $result['connecte'] ? "Active" : "Désactivé"
			);
		}
			

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('site/matriel.tpl', $data));
	}
}