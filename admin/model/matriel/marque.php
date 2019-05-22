<?php
class ModelMatrielMarque extends Model {
	
	public function getTotalMarque() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "marque_matriel`");
		return $query->row['total'];
	}
	
	public function getMarque($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "marque_matriel`";

		$sort_data = array(
			'marque_matriel_id',
			'libelle_marque_matriel',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY marque_matriel_id";
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

	public function addMarque($data) {
		if(empty($data['status'])) $status=0; else $status=1;
		$this->db->query("INSERT INTO `" . DB_PREFIX . "marque_matriel` SET 
		libelle_marque_matriel = '" . $this->db->escape($data['libelle_marque_matriel']) . "',
		type_matriel_id = '" . $this->db->escape($data['type_matriel']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteMarque($marque_matriel_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "marque_matriel WHERE marque_matriel_id = '" . (int)$marque_matriel_id . "'");
	}
	
	public function editMarque($marque_matriel_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;
		$this->db->query("UPDATE " . DB_PREFIX . "marque_matriel SET
		libelle_marque_matriel = '" . $this->db->escape($data['libelle_marque_matriel']) . "',
		type_matriel_id = '" . $this->db->escape($data['type_matriel']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE marque_matriel_id = '" . (int)$marque_matriel_id . "'");
	}
	
	public function getMatrielByID($marque_matriel_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "marque_matriel WHERE marque_matriel_id = '" . (int)$marque_matriel_id . "'");
		return $query->row;
	}
	
	public function getListesTypeMatriels(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "type_matriel WHERE Actif=1");
        return $query->rows;
    }
	
	public function getTypeMatrielByID($type_matriel_id){
		$query_type_matriel = $this->db->query("SELECT libelle_type_mariel FROM " . DB_PREFIX . "type_matriel WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
        return $query_type_matriel->row['libelle_type_mariel'];
	}
}