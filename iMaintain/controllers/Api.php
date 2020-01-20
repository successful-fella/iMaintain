<?php

class API extends CI_Controller
{

	public function checkLogin() {
		$id = $this->input->post('id');
		$pass = $this->input->post('pass');
		$query = $this->db->where('user_id', $id)
						->where('user_type', '1')
						->get('user');
		if($query->num_rows()) {
			if(password_verify($pass, $query->row()->user_password)) {
				$this->session->set_userdata('eng_id', $id);
				$this->session->set_userdata('eng_name', $query->row()->user_name);
				setcookie('eng_id', $id, time() + (60 * 60 * 24 * 30 * 12), '/');
				setcookie('eng_pass', $query->row()->user_password, time() + (60 * 60 * 24 * 30 * 12), '/');
				echo "1";
			} else {
				echo "3";
			}
		} else {
			echo "2";
		}
	}

	public function checkSupervisorLogin() {
		$id = $this->input->post('phone');
		$pass = $this->input->post('pass');
		$query = $this->db->where('user_phone', $id)
						->where('user_type', '2')
						->get('user');
		if($query->num_rows()) {
			if(password_verify($pass, $query->row()->user_password)) {
				$this->session->set_userdata('sup_id', $id);
				$this->session->set_userdata('sup_name', $query->row()->user_name);
				setcookie('sup_id', $id, time() + (60 * 60 * 24 * 30 * 12), '/');
				setcookie('sup_pass', $query->row()->user_password, time() + (60 * 60 * 24 * 30 * 12), '/');
				echo "1";
			} else {
				echo "3";
			}
		} else {
			echo "2";
		}
	}

	public function getEngineer($eng_id) {
		$query = $this->db->select('user_id, user_name')
							->like('user_id', $eng_id)
							->or_like('user_name', $eng_id)
							->where('user_type', '1')
							->get('user');
		echo json_encode($query->row());
	}

}