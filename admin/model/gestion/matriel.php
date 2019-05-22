<?php
class ModelGestionMatriel extends Model {
	
	public function getTotalMatriel() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "matriel`");
		return $query->row['total'];
	}
	
	public function getMatriel($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "matriel`";

		$sort_data = array(
			'matriel_id',
			'site_id',
            'gouvernorat_id',
            'marque_matriel_id',
			'type_matriel_id',
            'bureau_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY Matriel_id";
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
		
		$code=$this->genRandomString();
		
		if(empty($data['garantie'])) $garantie=0; else $garantie=1;
		if(empty($data['internet'])) $internet=0; else $internet=1;
		
		$this->db->query("INSERT INTO `" . DB_PREFIX . "matriel` SET 
		site_id = '" . $this->db->escape($data['site']) . "',
		bureau_id = '" . $this->db->escape($data['bureau']) . "',
		mac = '" . $this->db->escape($data['mac']) . "',
		ip = '" . $this->db->escape($data['ip']) . "',
		plus_info = '" . $this->db->escape($data['plus_info']) . "',
		fiche = '" . $this->db->escape($data['fiche']) . "',
		date_achat = '" . $this->db->escape($data['date_achat']) . "',
		date_affectation = '" . $this->db->escape($data['date_affectation']) . "',
		date_prevu = '" . $this->db->escape($data['date_prevu']) . "',
		garantie = '" . $this->db->escape($garantie) . "',
		internet = '" . $this->db->escape($internet) . "',
		connecte = '" . $this->db->escape($data['connecte']) . "',
		coupon = '" . $this->db->escape($code) . "',
		type_matriel_id = '" . $this->db->escape($data['type']) . "'
		");

	}	
	
	public function deleteMatriel($Matriel_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "matriel WHERE Matriel_id = '" . (int)$Matriel_id . "'");
	}
	
	public function editMatriel($matriel_id, $data) {
		
		if(empty($data['garantie'])) $garantie=0; else $garantie=1;
		if(empty($data['internet'])) $internet=0; else $internet=1;
		
		$this->db->query("UPDATE " . DB_PREFIX . "matriel SET
		site_id = '" . $this->db->escape($data['site']) . "',
		bureau_id = '" . $this->db->escape($data['bureau']) . "',
		mac = '" . $this->db->escape($data['mac']) . "',
		ip = '" . $this->db->escape($data['ip']) . "',
		plus_info = '" . $this->db->escape($data['plus_info']) . "',
		fiche = '" . $this->db->escape($data['fiche']) . "',
		date_achat = '" . $this->db->escape($data['date_achat']) . "',
		date_affectation = '" . $this->db->escape($data['date_affectation']) . "',
		date_prevu = '" . $this->db->escape($data['date_prevu']) . "',
		garantie = '" . $this->db->escape($garantie) . "',
		internet = '" . $this->db->escape($internet) . "',
		connecte = '" . $this->db->escape($data['connecte']) . "',
		type_matriel_id = '" . $this->db->escape($data['type']) . "'
		WHERE matriel_id = '" . (int)$matriel_id . "'");
	}

    public function getUserByID($user_id){
        $query = $this->db->query("SELECT CONCAT( firstname, lastname ) as username FROM " . DB_PREFIX . "user WHERE user_id = '" . (int)$user_id . "'");
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
	
	public function getMarqueMatrielByID($marque_matriel_id){
        $query = $this->db->query("SELECT libelle_marque_matriel FROM " . DB_PREFIX . "marque_matriel WHERE marque_matriel_id = '" . (int)$marque_matriel_id . "'");
        return $query->row['libelle_marque_matriel'];
    }
	
	public function getTypeMatrielByID($marque_matriel_id){
        
		$query = $this->db->query("SELECT type_matriel_id FROM " . DB_PREFIX . "marque_matriel WHERE marque_matriel_id = '" . (int)$marque_matriel_id . "'");
		$type_matriel_id=$query->row['type_matriel_id'];
		$querys = $this->db->query("SELECT libelle_type_mariel FROM " . DB_PREFIX . "type_matriel WHERE type_matriel_id = '" . (int)$type_matriel_id . "'");
		return $querys->row['libelle_type_mariel'];
    }

    public function getMatrielByID($matriel_id){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "matriel WHERE matriel_id = '" . (int)$matriel_id . "'");
        return $query->row;
    }

    public function getListesTypeMatriels(){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "type_matriel WHERE Actif=1");
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
        $results = $this->db->query("SELECT * FROM " . DB_PREFIX . "marque_matriel WHERE Actif=1");
		foreach($results->rows as $row){
			$result[]=array(
				'marque_matriel_id' => $row['marque_matriel_id'],
				'libelle_marque_matriel' =>  $this->getTypeMatrielByID($row['marque_matriel_id']).' '.$row['libelle_marque_matriel']
			);
		}
        return $result;
    }
	
	public function genRandomString() {
		$length = 10;
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string = '';    

		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters))];
		}

		return $string;
	}

}