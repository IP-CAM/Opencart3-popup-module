<?php

class ModelExtensionModulePopups extends Model {


	public function install()
	{
		$query = "CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "popups` (
		  `id` int(11) DEFAULT NULL,
		  `city_id` int(11) DEFAULT NULL,
		  `title` varchar(255) DEFAULT NULL,
		  `text` text DEFAULT NULL,
		  `date_start` date DEFAULT NULL,
		  `date_end` date DEFAULT NULL
		) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"; 

		$this->db->query($query);

		$query = "ALTER TABLE `" . DB_PREFIX . "popups` ADD PRIMARY KEY (`id`);";
		$this->db->query($query);
		$query = "ALTER TABLE `" . DB_PREFIX . "popups` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
		$this->db->query($query);
		$query = "ALTER TABLE `" . DB_PREFIX . "popups` ADD FOREIGN KEY ( `city_id` ) REFERENCES `" . DB_PREFIX . "cities` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT ;";
		$this->db->query($query);
	}

	public function getAll() : array
	{
		$query = "SELECT p.*,c.title as city FROM `" . DB_PREFIX . "popups` p LEFT JOIN `oc_cities` c ON c.id = p.city_id ORDER BY p.id DESC";
		$r = $this->db->query($query);
		return $r->rows;
	}

	public function getOne(int $id = 0) : array
	{
		$query = "SELECT * FROM `" . DB_PREFIX . "popups` WHERE id = ".$id;
		$r = $this->db->query($query);
		return $r->row;
	}

	public function getCities() : array
	{
		$query = "SELECT * FROM `" . DB_PREFIX . "cities` ORDER BY title";
		$r = $this->db->query($query);
		return $r->rows;
	}

	public function add()
	{
		$result = 0;
		$title = $this->db->escape(trim($this->request->post['title']));
		$text = $this->db->escape(trim($this->request->post['text']));
		$date_start = $this->db->escape(trim($this->request->post['date_start']));
		$date_end = $this->db->escape(trim($this->request->post['date_end']));
		$city = $this->db->escape((int)trim($this->request->post['city']));
		$q = "INSERT INTO `" . DB_PREFIX . "popups` SET `title` = \"$title\", `text` = \"$text\", `date_start` = \"$date_start\", `date_end` = \"$date_end\", `city_id` = $city";
		$this->db->query($q);
	}
	public function save() : int
	{
		$result = 0;
		$id = $this->db->escape((int)trim($this->request->post['id']));
		$title = $this->db->escape(trim($this->request->post['title']));
		$text = $this->db->escape(trim($this->request->post['text']));
		$date_start = $this->db->escape(trim($this->request->post['date_start']));
		$date_end = $this->db->escape(trim($this->request->post['date_end']));
		$city = $this->db->escape((int)trim($this->request->post['city']));
		$q = "UPDATE `" . DB_PREFIX . "popups` SET `title` = \"$title\", `text` = \"$text\", `date_start` = \"$date_start\", `date_end` = \"$date_end\", `city_id` = $city WHERE `id` = $id";
        if($this->db->query($q))
        {
        	$result = 1;
        }
        return $result;
	}

	public function delete(int $id)
	{
		$q = "DELETE FROM `" . DB_PREFIX . "popups` WHERE id = $id";
		$this->db->query($q);
	}
}
