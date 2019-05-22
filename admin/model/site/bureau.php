<?php
class ModelSiteBureau extends Model {
	
	public function getTotalBureau() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "bureau`");
		return $query->row['total'];
	}
	
	public function getBureau($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "bureau`";

		$sort_data = array(
			'bureau_id',
			'libelle_bureau',
			'code_bureau',
			'gouvernorat_id',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY bureau_id";
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

	public function addBureau($data) {
		if(empty($data['status'])) $status=0; else $status=1;	
		$this->db->query("INSERT INTO `" . DB_PREFIX . "bureau` SET 
		libelle_bureau = '" . $this->db->escape($data['libelle_bureau']) . "',
		code_bureau = '" . $this->db->escape($data['code_bureau']) . "',
		site_id = '" . $this->db->escape($data['gouvernorat']) . "',
		chef_bureau = '" . $this->db->escape($data['chef_bureau']) . "',
		mail_chef = '" . $this->db->escape($data['mail_chef']) . "',
		adresse = '" . $this->db->escape($data['adresse']) . "',
		ip_chef = '" . $this->db->escape($data['ip']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteBureau($bureau_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "bureau WHERE bureau_id = '" . (int)$bureau_id . "'");
	}
	
	public function editBureau($bureau_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;
		$this->db->query("UPDATE " . DB_PREFIX . "bureau SET
		libelle_bureau = '" . $this->db->escape($data['libelle_bureau']) . "',
		code_bureau = '" . $this->db->escape($data['code_bureau']) . "',
		site_id = '" . $this->db->escape($data['gouvernorat']) . "',
		chef_bureau = '" . $this->db->escape($data['chef_bureau']) . "',
		mail_chef = '" . $this->db->escape($data['mail_chef']) . "',
		adresse = '" . $this->db->escape($data['adresse']) . "',
		ip_chef = '" . $this->db->escape($data['ip']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE bureau_id = '" . (int)$bureau_id . "'");
	}
	
	public function getBureauByID($bureau_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bureau WHERE bureau_id = '" . (int)$bureau_id . "'");
		return $query->row;
	}
	
	public function GetGouvernoatNameByID($gouvernorat_id){
		$query = $this->db->query("SELECT libelle_gouvernorat FROM " . DB_PREFIX . "gouvernorat WHERE gouvernorat_id = '" . (int)$gouvernorat_id . "'");
		return $query->row['libelle_gouvernorat'];
	}
	
	public function GetGouvernoat(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "site WHERE  Actif='1' ");
		return $query->rows;
	}
	
	public function GetDelegation(){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "delegation WHERE  Actif='1' ");
		return $query->rows;
	}
	
	public function GetSiteNameByID($site_id){
		$query = $this->db->query("SELECT libelle_site FROM " . DB_PREFIX . "site WHERE site_id = '" . (int)$site_id . "'");
		return $query->row['libelle_site'];
	}
	
	public function GetDelegationNameByID($delegation_id){
		$query = $this->db->query("SELECT libelle_delegation FROM " . DB_PREFIX . "delegation WHERE delegation_id = '" . (int)$delegation_id . "'");
		return $query->row['libelle_delegation'];
	}
	public function PersonnelSite($site_id,$bureau_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "personnel WHERE  status='1' AND site_id = '" . (int)$site_id . "' AND bureau_id='" . (int)$bureau_id . "' ");
		return $query->rows;
	}
	public function MatrielSite($site_id,$bureau_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "matriel WHERE site_id = '" . (int)$site_id . "' AND bureau_id='" . (int)$bureau_id . "' ");
		return $query->rows;
	}
	public function GetMarqueMariel($marque_matriel_id){
		$query = $this->db->query("SELECT libelle_marque_matriel FROM " . DB_PREFIX . "marque_matriel WHERE marque_matriel_id = '" . (int)$marque_matriel_id . "'");
        return $query->row['libelle_marque_matriel'];
    }
	public function GetTypeMariel($marque_matriel_id){
		$query = $this->db->query("SELECT type_matriel_id FROM " . DB_PREFIX . "marque_matriel WHERE marque_matriel_id = '" . (int)$marque_matriel_id . "'");
        $type_matriel_id= $query->row['type_matriel_id'];
		
		$query_type_matriel = $this->db->query("SELECT libelle_type_mariel FROM " . DB_PREFIX . "type_matriel WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
        return $query_type_matriel->row['libelle_type_mariel'];
    }
	
}