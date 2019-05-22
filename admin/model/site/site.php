<?php
class ModelSiteSite extends Model {
	
	public function getTotalSite() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "site`");
		return $query->row['total'];
	}
	
	public function getSite($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "site`";

		$sort_data = array(
			'site_id',
			'libelle_site',
			'code_site',
			'gouvernorat_id',
			'Actif'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY site_id";
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

	public function addSite($data) {
		if(empty($data['status'])) $status=0; else $status=1;
		$this->db->query("INSERT INTO `" . DB_PREFIX . "site` SET 
		libelle_site = '" . $this->db->escape($data['libelle_site']) . "',
		code_site = '" . $this->db->escape($data['code_site']) . "',
		gouvernorat_id = '" . $this->db->escape($data['gouvernorat']) . "',
		adresse = '" . $this->db->escape($data['adresse']) . "',
		nom_chef = '" . $this->db->escape($data['chef']) . "',
		ip_chef = '" . $this->db->escape($data['ip']) . "',
		mail_chef = '" . $this->db->escape($data['mail']) . "',
		analyste = '" . $this->db->escape($data['analyste']) . "',
		analyste_ip = '" . $this->db->escape($data['analyste_ip']) . "',
		Actif = '" . $this->db->escape($status) . "'
		");

	}	
	
	public function deleteSite($site_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "site WHERE site_id = '" . (int)$site_id . "'");
	}
	
	public function editSite($site_id, $data) {
		if(empty($data['status'])) $status=0; else $status=1;
		$this->db->query("UPDATE " . DB_PREFIX . "site SET
		libelle_site = '" . $this->db->escape($data['libelle_site']) . "',
		code_site = '" . $this->db->escape($data['code_site']) . "',
		gouvernorat_id = '" . $this->db->escape($data['gouvernorat']) . "',
		adresse = '" . $this->db->escape($data['adresse']) . "',
		nom_chef = '" . $this->db->escape($data['chef']) . "',
		ip_chef = '" . $this->db->escape($data['ip']) . "',
		mail_chef = '" . $this->db->escape($data['mail']) . "',
		analyste = '" . $this->db->escape($data['analyste']) . "',
		analyste_ip = '" . $this->db->escape($data['analyste_ip']) . "',
		Actif = '" . $this->db->escape($status) . "'
		WHERE site_id = '" . (int)$site_id . "'");
	}
	
	public function getSiteByID($site_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "site WHERE site_id = '" . (int)$site_id . "'");
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
	public function DetailsSite($site_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bureau WHERE  Actif='1' AND site_id = '" . (int)$site_id . "' ");
		return $query->rows;
	}
	public function PersonnelSite($site_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "personnel WHERE  status='1' AND site_id = '" . (int)$site_id . "' AND bureau_id='0' ");
		return $query->rows;
	}
	public function MatrielSite($site_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "matriel WHERE site_id = '" . (int)$site_id . "' AND bureau_id='0' ");
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