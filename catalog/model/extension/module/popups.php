<?php

class ModelExtensionModulePopups extends Model {

	public function getActive(int $city_id = 0) : array
	{
		$curr_date = date('Y-m-d');
		$q = "SELECT * FROM `" . DB_PREFIX . "popups` WHERE city_id = $city_id and date_start <= \"$curr_date\" AND date_end >= \"$curr_date\"";
		$res = $this->db->query($q);
		return $res->row;
	}

}
