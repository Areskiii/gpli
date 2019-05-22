<?php
class ModelAddonsFonction extends Model {
	
	public function getTotalFonction() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "profession`");
		return $query->row['total'];
	}
	
	public function getFonction($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "profession`";

		$sort_data = array(
			'profession_id',
			'libelle_profession',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY profession_id";
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

	public function addFonction($data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("INSERT INTO `" . DB_PREFIX . "profession` SET 
		libelle_profession = '" . $this->db->escape($data['libelle_profession']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteFonction($profession_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "profession WHERE profession_id = '" . (int)$profession_id . "'");
	}
	
	public function editFonction($profession_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("UPDATE " . DB_PREFIX . "profession SET
		libelle_profession = '" . $this->db->escape($data['libelle_profession']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE profession_id = '" . (int)$profession_id . "'");
	}
	
	public function getMatrielByID($profession_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "profession WHERE profession_id = '" . (int)$profession_id . "'");
		return $query->row;
	}
	
	public function getListFonctions() {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "profession");
		return $query->rows;
	}
}