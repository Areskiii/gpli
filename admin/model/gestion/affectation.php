<?php
class ModelGestionAffectation extends Model {
	
	public function getTotalAffectation() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "affectation`");
		return $query->row['total'];
	}
	
	public function getAffectation($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "affectation`";

		$sort_data = array(
			'affectation_id',
			'user_id',
            'bureau_id',
            'site_id',
			'matriel_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY affectation_id";
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

	public function addAffectation($data) {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "affectation` SET 
		site_id = '" . $this->db->escape($data['site']) . "',
		bureau_id = '" . $this->db->escape($data['bureau']) . "',
		user_id = '" . $this->db->escape($data['user']) . "',
		matriel_id = '" . $this->db->escape($data['matriel']) . "'
		");

	}	
	
	public function deleteAffectation($affectation_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "affectation WHERE affectation_id = '" . (int)$affectation_id . "'");
	}
	
	public function editAffectation($affectation_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "affectation SET
		site_id = '" . $this->db->escape($data['site']) . "',
		bureau_id = '" . $this->db->escape($data['bureau']) . "',
		user_id = '" . $this->db->escape($data['user']) . "',
		matriel_id = '" . $this->db->escape($data['matriel']) . "'
		WHERE affectation_id = '" . (int)$affectation_id . "'");
	}
	
	public function getAffectationByID($affectation_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "affectation WHERE affectation_id = '" . (int)$affectation_id . "'");
		return $query->row;
	}

    public function getUserByID($user_id){
        $query = $this->db->query("SELECT CONCAT( firstname,' ',lastname ) as username FROM " . DB_PREFIX . "personnel WHERE personnel_id = '" . (int)$user_id . "'");
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
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "personnel WHERE status=1");
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
		$query = "SELECT * FROM " . DB_PREFIX . "matriel";
		$results = $this->db->query($query)->rows;
        foreach ($results as $row) {
            $result[] = array(
				'matriel_id' => $row["matriel_id"],	
				'libelle' => $row['coupon'].' -- '.$this->GetTypeMariel($row['matriel_id'])
			);
		}
        return $result;
    }
	
	public function GetTypeMariel($matriel_id){
        $query = $this->db->query("SELECT type_matriel_id FROM " . DB_PREFIX . "matriel WHERE matriel_id = '" . (int)$matriel_id . "'");
        $type_matriel_id= $query->row['type_matriel_id'];
		
		$query_type_matriel = $this->db->query("SELECT libelle_type_mariel FROM " . DB_PREFIX . "type_matriel WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
        return $query_type_matriel->row['libelle_type_mariel'];
    }

	public function getTotalMatrielAffecte() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "affectation GROUP BY matriel_id");
		return $query->num_rows;
	}
}