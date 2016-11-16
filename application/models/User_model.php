<?php 
class User_model extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function create_user($input)
	{
		$sql = "INSERT INTO users (name, alias, email, password, dob) VALUES (?, ?, ?, ?, ?)";
		$values = (array($input['name'], $input['alias'], $input['email'], $input['password'], $input['dob']));
		return $this->db->query($sql, $values);
	}

	public function get_user($email)
	{
		$query = $this->db->get_where('users', array('email' => $email));
		return $query-> row_array();
	}

}
