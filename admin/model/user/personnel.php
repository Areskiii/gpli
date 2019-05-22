<?php
class ModelUserPersonnel extends Model {
	
	public function addPersonnel($data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("INSERT INTO " . DB_PREFIX . "personnel SET 
		matricule = '" . $this->db->escape($data['matricule']) . "', 
		profession_id = '" . (int)$data['fonction_id'] . "', 
		firstname = '" . $this->db->escape($data['firstname']) . "', 
		lastname = '" . $this->db->escape($data['lastname']) . "', 
		email = '" . $this->db->escape($data['email']) . "', 
		ip = '" . $this->db->escape($data['ip']) . "', 
		internet = '" . $this->db->escape($data['internet']) . "',
		site_id = '" . $this->db->escape($data['site']) . "',
		bureau_id = '" . $this->db->escape($data['bureau']) . "',		
		status = '" . (int)$status . "', 
		date_added = NOW()");
	}

	public function editPersonnel($personnel_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("UPDATE " . DB_PREFIX . "personnel SET 
		matricule = '" . $this->db->escape($data['matricule']) . "', 
		profession_id = '" . (int)$data['fonction_id'] . "', 
		firstname = '" . $this->db->escape($data['firstname']) . "', 
		lastname = '" . $this->db->escape($data['lastname']) . "', 
		email = '" . $this->db->escape($data['email']) . "', 
		ip = '" . $this->db->escape($data['ip']) . "', 
		internet = '" . $this->db->escape($data['internet']) . "', 
		site_id = '" . $this->db->escape($data['site']) . "',
		bureau_id = '" . $this->db->escape($data['bureau']) . "',
		status = '" . (int)$status . "' 
		WHERE personnel_id = '" . (int)$personnel_id . "'");
	}

	public function deletePersonnel($personnel_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "personnel WHERE personnel_id = '" . (int)$personnel_id . "'");
	}

	public function getPersonnel($personnel_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "personnel u WHERE u.personnel_id = '" . (int)$personnel_id . "'");
		return $query->row;
	}

	public function getUserByUsername($username) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "personnel WHERE username = '" . $this->db->escape($username) . "'");

		return $query->row;
	}

	public function getUserByCode($code) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "personnel WHERE code = '" . $this->db->escape($code) . "' AND code != ''");

		return $query->row;
	}

	public function getUsers($data = array()) {
		$sql = "SELECT * FROM " . DB_PREFIX . "personnel";

		$sort_data = array(
			'personnel_id',
			'status',
			'date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY personnel_id";
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
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		
		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalUsers() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "personnel");

		return $query->row['total'];
	}


	public function getTotalUsersByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "personnel WHERE LCASE(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}
}