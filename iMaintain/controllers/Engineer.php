<?php

defined('BASEPATH') or exit();

class Engineer extends CI_Controller
{

	public function index() {
		$this->login();
	}

	public function isLoggedIn() {
		if($this->session->eng_id) {
			return true;
		} else if(isset($_COOKIE['eng_id'])) {
			$query = $this->db->where('user_id', $_COOKIE['eng_id'])
							->where('user_type', '1')
							->where('user_password', $_COOKIE['eng_pass'])
							->get('user');
			if($query->num_rows()) {
				$this->session->set_userdata('eng_id', $_COOKIE['eng_id']);
				$this->session->set_userdata('eng_name', $query->row()->user_name);
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function login() {
		if($this->isLoggedIn()) {
			redirect('engineer/home');
			exit;
		}
		$this->load->view('engineer/login');
	}	

	public function home() {
		if(!$this->isLoggedIn()) {
			redirect('engineer/login');
			exit;
		}
		$this->load->model('Engineer_model');
		$data['notifications'] = $this->Engineer_model->getAllNotifications();
		$this->load->view('engineer/home', $data);
	}

	public function scanner() {
		if(!$this->isLoggedIn()) {
			redirect('engineer/login');
			exit;
		}
		$this->load->view('engineer/scanner.php');
	}

	public function equipment($equipment_id = '0') {
		if(!$this->isLoggedIn()) {
			redirect('engineer/login');
			exit;
		}
		$this->load->model('Engineer_model');
		if(!$this->Engineer_model->equipmentExist($equipment_id)){
			$this->session->set_flashdata('error', 'Invalid Equipment ID');
			redirect('engineer/home');
		}
		$data['equipment'] = $this->Engineer_model->getEquipmentDetails($equipment_id);
		$data['services'] = $this->Engineer_model->getLastThreeService($equipment_id);
		$status = $this->Engineer_model->checkStatus($equipment_id);
		if(isset($status->service_status)) {
			if($status->service_status == '1') {
				$data['pending'] = true;
				$data['pending_by'] = $status->user_name;
				$data['pending_by_id'] = $status->user_id;
				$data['pending_remark'] = $status->service_remark;
			}
		}
		$this->load->view('engineer/equipment', $data);
		$text = $this->session->eng_name." (ID ".$this->session->eng_id.") scanned QR Code of ".$data['equipment']->equipment_name." (Equipment ID ".$equipment_id.")";
		$this->Engineer_model->pushToActivity($text);
	}

	public function addService() {
		if(!$this->isLoggedIn()) {
			redirect('engineer/login');
			exit;
		}
		if($this->input->post('service_details') == null) {
			redirect('engineer/equipment/'.$this->input->post('equipment_id'));
			exit;
		} 
		$this->load->model('Engineer_model');
		$this->Engineer_model->addService($this->input->post('equipment_id'), date('Y/m/d'), $this->session->eng_id, $this->input->post('status'), $this->input->post('service_details'));
		$equipment_name = $this->db->where('equipment_id', $this->input->post('equipment_id'))
									->get('equipment')
									->row()
									->equipment_name;
		$text = $this->session->eng_name." (ID ".$this->session->eng_id.") updated service history of ".$equipment_name." (Equipment ID ".$this->input->post('equipment_id').")";
		$this->Engineer_model->pushToActivity($text);
		$this->session->set_flashdata('success', 'Servicing Added');
		redirect('engineer/equipment/'.$this->input->post('equipment_id'));
	}

	public function activity() {
		if(!$this->isLoggedIn()) {
			redirect('engineer/login');
			exit;
		}
		$this->load->model('Engineer_model');
		$data['activities'] = $this->Engineer_model->getAllActivities();
		$this->load->view('engineer/activity', $data);
	}

	public function history($equipment_id = '0')
	{
		if(!$this->isLoggedIn()) {
			redirect('engineer/login');
			exit;
		}
		$this->load->model('Engineer_model');
		$data['services'] = $this->Engineer_model->getAllServicesByEquipmentId($equipment_id);
		$data['equipment_id'] = $equipment_id;
		$this->load->view('engineer/history', $data);
	}

	public function downloadSingleReport($service_id) {
		$this->load->model('Engineer_model');
		$service = $this->Engineer_model->getService($service_id);
		$data = array(
			'engineer_name' => $service->user_name,
			'engineer_id' => $service->user_id,
			'date' => $service->service_date,
			'equipment_name' => $service->equipment_name,
			'service_status' => $service->service_status,
			'service_remark' => $service->service_remark
		);
		$this->load->model('Report_model');
		$this->Report_model->singleReport($data);
	}

	public function logout() {
		session_destroy();
		setcookie('eng_id', '', time() -3600, '/');
		setcookie('eng_pass', '', time() -3600, '/');
		redirect('engineer/login');
	}

}