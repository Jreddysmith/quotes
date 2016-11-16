<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quotes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Quote');
	}

	public function index()
	{
		if(!isset($this->session->userdata['user'])){
			redirect('Log_in_Reg');
		}
		$user_id = $this->session->userdata['user']['id'];
		$quotes = $this->Quote->getQuotes($user_id);
		$favorties = $this->Quote->getFavorite($user_id);
		$this->load->view('Quotes', array('quotes' => $quotes, 'favorites' => $favorties));
	}


	public function contribute() {
		$this->load->library("form_validation");
		$this->form_validation->set_rules("quoteBy", "Quoted By", "trim|min_length[3]|required");
		$this->form_validation->set_rules("message", "Message", "trim|min_length[10]|required");


		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata("messages", validation_errors());
			redirect('Quotes/index');
		} 

		else {	
			$input = $this->input->post();
			$user_id = $this->session->userdata['user']['id'];	
			$insert_quote = $this->Quote->insertQuote($input, $user_id);
			if($insert_quote) {
				$this->session->set_flashdata("messages", "You're successfully contribute a Quote");			
				redirect('Quotes/index');
			} 

			else {
				$this->session->set_flashdata("messages", "Unable to submit your Quote, please try again.");
				redirect('Quotes/index');
			}
		}
	}

public function addFavorite($id) {
		$user_id = $this->session->userdata['user']['id'];
		$this->Quote->insertFavorite($user_id, $id);
		redirect('Quotes/index');
	}

	public function removeFavorite($id) {
		$user_id = $this->session->userdata['user']['id'];
		$this->Quote->removeFavorite($user_id, $id);
		redirect('Quotes/index');
	}

	public function users($id) {
		$user_id = $this->session->userdata['user']['id'];
		$quotebyusers= $this->Quote->getQuotesbyUserID($id);
		$user= $this->Quote->getUserByID($id);
		$this->load->view('Users', array('quotebyusers' => $quotebyusers, 'user' => $user));
	}







}
