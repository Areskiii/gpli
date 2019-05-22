<?php
class ControllerGestionMatriel extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('gestion/matriel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/matriel');

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
			'href' => $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['insert'] = $this->url->link('gestion/matriel/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('gestion/matriel/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['Matriels'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * 10,
			'limit' => 10
		);

		$user_total = $this->model_gestion_matriel->getTotalMatriel();

		$results = $this->model_gestion_matriel->getMatriel($filter_data);

		foreach ($results as $result) 
		{
			$data['Matriels'][] = array(
				'id'=> $result['matriel_id'],
                'bureau' => $this->model_gestion_matriel->getBureauByID($result['bureau_id']),
                'site' =>  $this->model_gestion_matriel->getSiteByID($result['site_id']),
                'marque_matriel' => $this->model_gestion_matriel->getMarqueMatrielByID($result['type_matriel_id']),
				'type_matriel' => $this->model_gestion_matriel->getTypeMatrielByID($result['type_matriel_id']),
				'edit'=> $this->url->link('gestion/matriel/edit', 'token=' . $this->session->data['token'] . '&matriel_id=' . $result['matriel_id'] . $url, 'SSL')
			);
		}
		

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['column_id']= $this->language->get('column_id');
		$data['column_text']= $this->language->get('column_text');
		$data['column_marque_matriel']= $this->language->get('column_marque_matriel');
		$data['column_bureau']= $this->language->get('column_bureau');
        $data['column_site']= $this->language->get('column_site');
        $data['column_type_matriel']= $this->language->get('column_type_matriel');
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
			
		$data['sort_id'] = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . '&sort=matriel_id' . $url, 'SSL');
		$data['sort_bureau'] = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . '&sort=bureau_id' . $url, 'SSL');
		$data['sort_type_matriel'] = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . '&sort=type_matriel' . $url, 'SSL');
		$data['sort_marque_matriel'] = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . '&sort=marque_matriel' . $url, 'SSL');
        $data['sort_site'] = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . '&sort=site_id' . $url, 'SSL');

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
		$pagination->url = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($user_total) ? (($page - 1) * 20) + 1 : 0, ((($page - 1) * 20) > ($user_total - 20)) ? $user_total : ((($page - 1) * 20) + 20), $user_total, ceil($user_total / 20));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('gestion/matriel.tpl', $data));
	}

	protected function getForm() {
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_form'] = !isset($this->request->get['matriel_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');

		$data['entry_user']= $this->language->get('entry_user');
		$data['entry_bureau']= $this->language->get('entry_bureau');
		$data['entry_site']= $this->language->get('entry_site');
		$data['entry_title'] = $this->language->get('entry_title');
        $data['entry_matriel'] = $this->language->get('entry_matriel');
		$data['entry_mac'] = $this->language->get('entry_mac');
		$data['entry_ip'] = $this->language->get('entry_ip');
		$data['entry_fiche'] = $this->language->get('entry_fiche');
		$data['entry_plus'] = $this->language->get('entry_plus');
		$data['entry_achat'] = $this->language->get('entry_achat');
		$data['entry_affectation'] = $this->language->get('entry_affectation');
		$data['entry_garantie'] = $this->language->get('entry_garantie');
		$data['entry_prevu'] = $this->language->get('entry_prevu');
		$data['entry_internet'] = $this->language->get('entry_internet');
		$data['entry_connecte'] = $this->language->get('entry_connecte');
		
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
		
		if (isset($this->error['bureau'])) {
			$data['error_bureau'] = $this->error['bureau'];
		} else {
			$data['error_bureau'] = '';
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
			'href' => $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['matriel_id'])) {
			$data['action'] = $this->url->link('gestion/matriel/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('gestion/matriel/edit', 'token=' . $this->session->data['token'] . '&matriel_id=' . $this->request->get['matriel_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . $url, 'SSL');
		
		if (isset($this->request->get['matriel_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$matriel_Info = $this->model_gestion_matriel->getMatrielByID($this->request->get['matriel_id']);
		}
		
		$data['users']= $this->model_gestion_matriel->getListesTypeMatriels();
        $data['bureaux']= $this->model_gestion_matriel->getListesBureaux();
        $data['sites']= $this->model_gestion_matriel->getListesSites();
        $data['matriels']= $this->model_gestion_matriel->getListesMatriels();

		
		if (isset($this->request->post['type'])) {
			$data['type'] = $this->request->post['type'];
		} elseif (!empty($matriel_Info)) {
			$data['type'] = $matriel_Info['type_matriel_id'];
		} else {
			$data['type'] = '';
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
	
        
		if (isset($this->request->post['mac'])) {
            $data['mac'] = $this->request->post['mac'];
        } elseif (!empty($matriel_Info)) {
            $data['mac'] = $matriel_Info['mac'];
        } else {
            $data['mac'] = '';
        }
		
		if (isset($this->request->post['ip'])) {
            $data['ip'] = $this->request->post['ip'];
        } elseif (!empty($matriel_Info)) {
            $data['ip'] = $matriel_Info['ip'];
        } else {
            $data['ip'] = '';
        }
		
		if (isset($this->request->post['plus_info'])) {
            $data['plus_info'] = $this->request->post['plus_info'];
        } elseif (!empty($matriel_Info)) {
            $data['plus_info'] = $matriel_Info['plus_info'];
        } else {
            $data['plus_info'] = '';
        }	

		if (isset($this->request->post['date_achat'])) {
            $data['date_achat'] = $this->request->post['date_achat'];
        } elseif (!empty($matriel_Info)) {
            $data['date_achat'] = $matriel_Info['date_achat'];
        } else {
            $data['date_achat'] = '';
		}	
		
		if (isset($this->request->post['date_affectation'])) {
            $data['date_affectation'] = $this->request->post['date_affectation'];
        } elseif (!empty($matriel_Info)) {
            $data['date_affectation'] = $matriel_Info['date_affectation'];
        } else {
            $data['date_affectation'] = '';
		}	
		
		if (isset($this->request->post['date_prevu'])) {
            $data['date_prevu'] = $this->request->post['date_prevu'];
        } elseif (!empty($matriel_Info)) {
            $data['date_prevu'] = $matriel_Info['date_prevu'];
        } else {
            $data['date_prevu'] = '';
		}	
		
		if (isset($this->request->post['garantie'])) {
            $data['garantie'] = $this->request->post['garantie'];
        } elseif (!empty($matriel_Info)) {
            $data['garantie'] = $matriel_Info['garantie'];
        } else {
            $data['garantie'] = '';
		}	
		
		if (isset($this->request->post['internet'])) {
            $data['internet'] = $this->request->post['internet'];
        } elseif (!empty($matriel_Info)) {
            $data['internet'] = $matriel_Info['internet'];
        } else {
            $data['internet'] = '';
		}	
		
		if (isset($this->request->post['connecte'])) {
            $data['connecte'] = $this->request->post['connecte'];
        } elseif (!empty($matriel_Info)) {
            $data['connecte'] = $matriel_Info['connecte'];
        } else {
            $data['connecte'] = '';
        }	

		if (isset($this->request->post['fiche'])) {
            $data['fiche'] = $this->request->post['fiche'];
        } elseif (!empty($matriel_Info)) {
            $data['fiche'] = $matriel_Info['fiche'];
        } else {
            $data['fiche'] = '';
        }			
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('gestion/matriel_form.tpl', $data));
	}
	
	public function add() {
		$this->load->language('gestion/matriel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/matriel');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_gestion_matriel->addMatriel($this->request->post);

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

			$this->response->redirect($this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function edit() {
		$this->load->language('gestion/matriel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/matriel');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_gestion_matriel->editMatriel($this->request->get['matriel_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}
	
	public function delete() {
		$this->load->language('gestion/matriel');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('gestion/matriel');
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $matriel_id) {
				$this->model_gestion_matriel->deleteMatriel($matriel_id);
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

			$this->response->redirect($this->url->link('gestion/matriel', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}
	
	protected function validateForm() {
		
		if (!$this->user->hasPermission('modify', 'gestion/matriel')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ($this->request->post['site']==0) {
			$this->error['site'] = $this->language->get('error_site');
		}	
		
		if ($this->request->post['bureau']==0) {
			$this->error['bureau'] = $this->language->get('error_bureau');
		}	
		
		if ($this->request->post['marque']==0) {
			$this->error['matriel'] = $this->language->get('error_matriel');
		}	
		
		return !$this->error;
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'gestion/matriel')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
}