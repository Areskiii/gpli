<?php
class ModelGestionTicket extends Model {
	
	public function getTotalTicket() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "ticket`");
		return $query->row['total'];
	}
	
	public function getTicket($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "ticket`";

		$sort_data = array(
			'ticket_id',
			'user_id',
            'bureau_id',
            'site_id',
			'matriel_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY ticket_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 10;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
	
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function addTicket($data) {
		$code=$this->genRandomString();
		$this->db->query("INSERT INTO `" . DB_PREFIX . "ticket` SET 
		coupon = '" . $this->db->escape($code) . "',
		user_id = '" . $this->db->escape($data['user']) . "',
		matriel_id = '" . $this->db->escape($data['matriel']) . "',
		date_ticket_open = '" . $this->db->escape($data['date_ticket_open']) . "',
		date_ticke_close = '" . $this->db->escape($data['date_ticke_close']) . "',
		panne = '" . $this->db->escape($data['panne']) . "',
		traveau = '" . $this->db->escape($data['traveau']) . "',
		type_ticket_id = '" . $this->db->escape($data['type_ticket_id']) . "'
		");

	}	
	
	public function deleteTicket($ticket_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "ticket WHERE ticket_id = '" . (int)$ticket_id . "'");
	}
	
	public function editTicket($ticket_id, $data) {
		
		$code=$this->genRandomString();
		if($data['date_ticke_close']=='') $data['date_ticke_close']='0000-00-00';
		$this->db->query("UPDATE " . DB_PREFIX . "ticket SET
		coupon = '" . $this->db->escape($code) . "',
		user_id = '" . $this->db->escape($data['user']) . "',
		matriel_id = '" . $this->db->escape($data['matriel']) . "',
		date_ticket_open = '" . $this->db->escape($data['date_ticket_open']) . "',
		date_ticke_close = '" . $this->db->escape($data['date_ticke_close']) . "',
		panne = '" . $this->db->escape($data['panne']) . "',
		traveau = '" . $this->db->escape($data['traveau']) . "',
		type_ticket_id = '" . $this->db->escape($data['type_ticket_id']) . "'
		WHERE ticket_id = '" . (int)$ticket_id . "'");
	}
	
	public function getTicketByID($ticket_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "ticket WHERE ticket_id = '" . (int)$ticket_id . "'");
		return $query->row;
	}

    public function getUserByID($user_id){
        $query = $this->db->query("SELECT CONCAT( firstname, lastname ) as username FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
        return $query->row['username'];
    }

    public function getBureauByID($bureau_id){
        $query = $this->db->query("SELECT libelle_bureau FROM " . DB_PREFIX . "bureau WHERE bureau_id = '" . (int)$bureau_id . "'");
        return $query->row['libelle_bureau'];
    }

    public function getSiteByID($site_id){
        $query = $this->db->query("SELECT libelle_site FROM " . DB_PREFIX . "site WHERE site_id = '" . (int)$site_id . "'");
        return $query->row['libelle_site'];
    }

    public function getMatrielByID($matriel_id){
        $query = $this->db->query("SELECT libelle_site FROM " . DB_PREFIX . "matriel WHERE site_id = '" . (int)$matriel_id . "'");
        return $query->row['libelle_site'];
    }

    public function getListesUsers(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "user WHERE status=1");
        return $query->rows;
    }

    public function getListesBureaux(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bureau WHERE Actif=1");
        return $query->rows;
    }
    public function getListesSites(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "site WHERE Actif=1");
        return $query->rows;
    }
    public function getListesMatriels(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "matriel");
        return $query->rows;
    }
	
	public function GetTypeMariel($matriel_id){
		
        $query = $this->db->query("SELECT type_matriel_id FROM " . DB_PREFIX . "matriel WHERE matriel_id = '" . (int)$matriel_id . "'");
        $type_matriel_id= $query->row['type_matriel_id'];
		
		$query_type_matriel = $this->db->query("SELECT libelle_type_mariel FROM " . DB_PREFIX . "type_matriel WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
        return $query_type_matriel->row['libelle_type_mariel'];
    }
	
	public function GetTypeTicket($type_ticket_id){
		$query = $this->db->query("SELECT libelle_type_ticket FROM " . DB_PREFIX . "type_ticket WHERE type_ticket_id = '" . (int)$type_ticket_id . "'");
        return $query->row['libelle_type_ticket'];
	}
	
	public function getListesTypeTickets(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "type_ticket");
        return $query->rows;
    }
	
	public function genRandomString() {
		$length = 10;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';    

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}

		return 'Ticket-'.$string;
	}

	public function TransfertTicket($ticket_id, $data) {
		if(empty($data['casse'])) $casse=0; else $casse=1;	
		
		if($data['date_transfert_casse']!=''){			
			$this->db->query("UPDATE " . DB_PREFIX . "ticket SET
			casse = '" . $this->db->escape($casse) . "',
			date_transfert_casse = '" . $this->db->escape($data['date_transfert_casse']) . "',
			fax_joint = '" . $this->db->escape($data['fax_joint']) . "',
			fax = '" . $this->db->escape($data['fax']) . "'
			WHERE ticket_id = '" . (int)$ticket_id . "'");
		}
		
		if($data['date_transfert_cimf']!=''){
			$this->db->query("UPDATE " . DB_PREFIX . "ticket SET
			casse = '" . $this->db->escape($casse) . "',
			date_transfert_cimf = '" . $this->db->escape($data['date_transfert_cimf']) . "',
			fax_joint = '" . $this->db->escape($data['fax_joint']) . "',
			fax = '" . $this->db->escape($data['fax']) . "'
			WHERE ticket_id = '" . (int)$ticket_id . "'");
		}

	}

}