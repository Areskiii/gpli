<?php
class ModelAddonsIntervention extends Model {
	
	public function getTotalIntervention() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "type_ticket`");
		return $query->row['total'];
	}
	
	public function getIntervention($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "type_ticket`";

		$sort_data = array(
			'type_ticket_id',
			'libelle_type_ticket',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY type_ticket_id";
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

	public function addIntervention($data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("INSERT INTO `" . DB_PREFIX . "type_ticket` SET 
		libelle_type_ticket = '" . $this->db->escape($data['libelle_type_ticket']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteIntervention($type_ticket_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "type_ticket WHERE type_ticket_id = '" . (int)$type_ticket_id . "'");
	}
	
	public function editIntervention($type_ticket_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("UPDATE " . DB_PREFIX . "type_ticket SET
		libelle_type_ticket = '" . $this->db->escape($data['libelle_type_ticket']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE type_ticket_id = '" . (int)$type_ticket_id . "'");
	}
	
	public function getMatrielByID($type_ticket_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "type_ticket WHERE type_ticket_id = '" . (int)$type_ticket_id . "'");
		return $query->row;
	}
	
}