<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quote extends CI_Model {

	public function insertQuote($input, $user_id) {
		$sql = "INSERT INTO quotes (quoteBy, message, creator, created_at, updated_at)
							VALUES (?, ?, ?, NOW(), NOW())";
		$values = (array($input['quoteBy'], $input['message'], $user_id));
		return $this->db->query($sql, $values);
	}

	public function getQuotes($user_id) {
		$sql = "SELECT quotes.id, quotes.quoteBy AS quoteBy, users.alias AS alias, users.id AS user_id, quotes.message, quotes.created_at AS created_at FROM quotes JOIN users ON users.id = quotes.creator LEFT JOIN favorites ON quotes.id = favorites.quote_id WHERE quotes.id NOT IN(SELECT DISTINCT quotes.id FROM quotes JOIN favorites ON quotes.id = favorites.quote_id WHERE favorites.user_id = ?) ORDER BY favorites.created_at DESC";
		return $this->db->query($sql, $user_id)->result_array();
	}

	public function insertFavorite($user_id, $id) {
		$sql = "INSERT INTO favorites (user_id, quote_id, created_at)
							VALUES (?, ?, NOW())";
		$values = (array($user_id, $id));
		$this->db->query($sql, $values); 
	}

	public function getFavorite($user_id) {
		$sql = "SELECT favorites.quote_id, quotes.quoteBy AS quoteBy, quotes.message AS message, users.alias AS alias, quotes.id, users.id AS user_id FROM favorites JOIN quotes ON quote_id= quotes.id JOIN users ON quotes.creator = users.id WHERE favorites.user_id = ? ORDER BY favorites.created_at DESC";
		return $this->db->query($sql, $user_id)->result_array();
	}

	public function removeFavorite($user_id, $id) {
		$sql = "DELETE FROM favorites WHERE user_id = ? AND quote_id = ?";
		$values = (array($user_id, $id));
		$this->db->query($sql, $values); 
	}

	public function getQuotesbyUserID($id) {
		$sql = "SELECT * FROM quotes JOIN users ON creator=users.id WHERE creator = ?";
		return $this->db->query($sql, $id)->result_array();
	}

	public function getUserByID($id) {
		$sql = "SELECT users.alias FROM users WHERE users.id = ?";
		return $this->db->query($sql, $id)->row_array();
	}





}
