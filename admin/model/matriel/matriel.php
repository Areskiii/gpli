<?php
class ModelMatrielMatriel extends Model {
	
	public function getTotalMatriel() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "type_matriel`");
		return $query->row['total'];
	}
	
	public function getMatriel($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "type_matriel`";

		$sort_data = array(
			'type_matriel_id',
			'libelle_type_mariel',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY type_matriel_id";
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

	public function addMatriel($data) {
		if(empty($data['status'])) $status=0; else $status=1;
		$this->db->query("INSERT INTO `" . DB_PREFIX . "type_matriel` SET 
		libelle_type_mariel = '" . $this->db->escape($data['libelle_type_mariel']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteMatriel($type_matriel_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "type_matriel WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
	}
	
	public function editMatriel($type_matriel_id, $data) {
		
		if(empty($data['status'])) $status=0; else $status=1;
		$this->db->query("UPDATE " . DB_PREFIX . "type_matriel SET
		libelle_type_mariel = '" . $this->db->escape($data['libelle_type_mariel']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
	}
	
	public function getMatrielByID($type_matriel_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "type_matriel WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
		return $query->row;
	}
	
}