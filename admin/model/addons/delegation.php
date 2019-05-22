<?php
class ModelAddonsDelegation extends Model {
	
	public function getTotalDelegation() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "delegation`");
		return $query->row['total'];
	}
	
	public function getDelegation($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "delegation`";

		$sort_data = array(
			'delegation_id',
			'libelle_delegation',
			'gouvernorat_id',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY delegation_id";
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

	public function addDelegation($data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("INSERT INTO `" . DB_PREFIX . "delegation` SET 
		libelle_delegation = '" . $this->db->escape($data['libelle_delegation']) . "',
		gouvernorat_id = '" . $this->db->escape($data['gouvernoat']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteDelegation($delegation_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "delegation WHERE delegation_id = '" . (int)$delegation_id . "'");
	}
	
	public function editDelegation($delegation_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("UPDATE " . DB_PREFIX . "delegation SET
		libelle_delegation = '" . $this->db->escape($data['libelle_delegation']) . "',
		gouvernorat_id = '" . $this->db->escape($data['gouvernoat']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE delegation_id = '" . (int)$delegation_id . "'");
	}
	
	public function getMatrielByID($delegation_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "delegation WHERE delegation_id = '" . (int)$delegation_id . "'");
		return $query->row;
	}
	
	public function GetGouvernoatNameByID($gouvernorat_id){
		$query = $this->db->query("SELECT libelle_gouvernorat FROM " . DB_PREFIX . "gouvernorat WHERE gouvernorat_id = '" . (int)$gouvernorat_id . "'");
		return $query->row['libelle_gouvernorat'];
	}
	
	public function GetGouvernoat(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gouvernorat WHERE  Actif='1' ");
		return $query->rows;
	}
	
}