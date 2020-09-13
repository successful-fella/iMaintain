<?php

defined('BASEPATH') or exit();

class Supervisor extends CI_Controller
{

	public function index() {
		$this->login();
	}

	function sessionExists() {
		if($this->session->sup_id) {
			return true;
		} else {
			if(isset($_COOKIE['sup_id'])) {
				$query = $this->db->where('supervisor_id', $_COOKIE['sup_id'])
							->where('supervisor_password', $_COOKIE['sup_pass'])
							->get('supervisor');
				if($query->num_rows()) {
					$this->session->set_userdata('sup_id', $_COOKIE['sup_id']);
					$this->session->set_userdata('sup_name', $query->row()->supervisor_name);
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}
	}

	public function login() {
		if($this->sessionExists()) {
			redirect('supervisor/home');
		}
		$this->load->view('supervisor/login');
	}

	public function home() {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		$this->load->model('Supervisor_model');
		$data['engineer_count'] = $this->Supervisor_model->engineersCount();
		$data['equipment_count'] = $this->Supervisor_model->equipmentsCount();
		$data['department_count'] = $this->Supervisor_model->departmentsCount();
		$data['notifications'] = $this->Supervisor_model->getAllNotifications();
		$data['activities'] = $this->Supervisor_model->getAllActivities();
		$data['services'] = $this->Supervisor_model->getServices();
		$data['selected'] = ['home'];
		$this->load->view('supervisor/home', $data);
	}

	public function engineers() {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		$this->load->model('Supervisor_model');
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->Supervisor_model->addEngineer($this->input->post('eng_name'), $this->input->post('eng_id'), $this->input->post('phone'), $this->input->post('password'));
			return;
		}
		$data['selected'] = ['engineer'];
		$data['engineers'] = $this->Supervisor_model->getAllEngineers();
		$this->load->view('supervisor/add_engineer', $data);	
	}

	public function engineer($engineer_id = '') {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		$this->load->model('Supervisor_model');
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->Supervisor_model->updateEngineer($this->input->post('eng_name'), $this->input->post('eng_id'), $this->input->post('eng_phone'), $this->input->post('eng_password'));
			redirect('supervisor/engineers?success=Engineer Record Updated');
		} else {
			echo json_encode($this->Supervisor_model->getEngineer($engineer_id));
		}
	}

	public function deleteEngineer() {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->db->where('user_id', $this->input->post('eng_id'))
					->delete('user');
		}
	}

	public function departments() {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		$this->load->model('Supervisor_model');
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->Supervisor_model->addDepartment($this->input->post('dept_name'));
			redirect('supervisor/departments?success=Department Added');
		}
		$data['selected'] = ['department'];
		$data['departments'] = $this->Supervisor_model->getAllDepartments();
		$this->load->view('supervisor/add_department', $data);	
	}

	public function updateDepartment() {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->db->where('department_id', $this->input->post('dept_id'))
					->update('department', array('department_name' => $this->input->post('dept_name')));
			redirect('supervisor/departments?success=Department name updated');
		}
	}

	public function equipments() {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		$this->load->model('Supervisor_model');
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->Supervisor_model->addEquipment($_POST);
			redirect('supervisor/equipments?success=Equipment Added');
		}
		$data['selected'] = ['equipment'];
		$data['departments'] = $this->Supervisor_model->getAllDepartments();
		$data['equipments'] = $this->Supervisor_model->getAllEquipments();
		$this->load->view('supervisor/add_equipment', $data);	
	}
	
	public function updateEquipment() {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
		}
		$this->load->model('Supervisor_model');
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->Supervisor_model->updateEquipment($_POST);
			redirect('supervisor/equipments?success=Equipment Updated');
		}
	}
	
	public function deleteEquipment($id) {
		if(!$this->sessionExists()) {
			redirect('supervisor/login');
			exit;
		}
		$this->db->where('equipment_id', $id)
				->delete('equipment');
		redirect('supervisor/equipments?success=Equipment Deleted!');
	}

	public function sendNotification() {
		if($_SERVER['REQUEST_METHOD'] === 'POST') {
			$this->load->model('Supervisor_model');
			$this->Supervisor_model->sendNotification($_POST);
			redirect('supervisor/home?success=Notification Pushed!');
		}
	}

	public function logout() {
		session_destroy();
		setcookie('sup_id', '', time() -3600, '/');
		setcookie('sup_pass', '', time() -3600, '/');
		redirect('supervisor/login');
	}

}