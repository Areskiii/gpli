<?php
class ModelAddonsGouvernorat extends Model {
	
	public function getTotalGouvernorat() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "gouvernorat`");
		return $query->row['total'];
	}
	
	public function getGouvernorat($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "gouvernorat`";

		$sort_data = array(
			'gouvernorat_id',
			'libelle_gouvernorat',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY gouvernorat_id";
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

	public function addGouvernorat($data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("INSERT INTO `" . DB_PREFIX . "gouvernorat` SET 
		libelle_gouvernorat = '" . $this->db->escape($data['libelle_gouvernorat']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteGouvernorat($gouvernorat_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "gouvernorat WHERE gouvernorat_id = '" . (int)$gouvernorat_id . "'");
	}
	
	public function editGouvernorat($gouvernorat_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("UPDATE " . DB_PREFIX . "gouvernorat SET
		libelle_gouvernorat = '" . $this->db->escape($data['libelle_gouvernorat']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE gouvernorat_id = '" . (int)$gouvernorat_id . "'");
	}
	
	public function getMatrielByID($gouvernorat_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "gouvernorat WHERE gouvernorat_id = '" . (int)$gouvernorat_id . "'");
		return $query->row;
	}
	
}