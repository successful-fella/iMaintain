<?php

defined('BASEPATH') or exit();

class Supervisor_model extends CI_Model
{

	function getAllEngineers() {
		$query = $this->db->where('user_type', '1')
						->order_by('user_id', 'DESC')
						->get('user');
		return $query->result();
	}

	function getEngineer($engineer_id) {
		$query = $this->db->select('user_id, user_name, user_phone')
						->where('user_id', $engineer_id)
						->get('user');
		return $query->row();
	}

	function getAllDepartments() {
		$query = $this->db->get('department');
		return $query->result();
	}

	function engineersCount() {
		$query = $this->db->select('user_id')
						->where('user_type', '1')
						->get('user');
		return $query->num_rows();
	}

	function equipmentsCount() {
		$query = $this->db->select('equipment_id')
						->get('equipment');
		return $query->num_rows();
	}

	function departmentsCount() {
		$query = $this->db->select('department_id')
						->get('department');
		return $query->num_rows();
	}

	function servicesCount() {
		$query = $this->db->select('service_id')
						->get('service');
		return $query->num_rows();
	}

	function getServices() {
		$query = $this->db->join('user', 'user.user_id=service.user_id')
						->join('equipment', 'equipment.equipment_id=service.equipment_id')
						->order_by('service_id', 'DESC')
						->get('service');
		return $query->result();
	}

	function addEngineer($name, $id, $phone, $password) {
		$data = array(
			'user_name' => $name,
			'user_id' => $id,
			'user_phone' => $phone,
			'user_password' => password_hash($password, PASSWORD_DEFAULT),
			'user_type' => '1'
		);
		$this->db->insert('user', $data);
		return $this->db->insert_id();
	}

	function updateEngineer($name, $id, $phone, $password) {
		if(!empty($password)) {
			$data['user_password'] = password_hash($password, PASSWORD_DEFAULT);
		}
		$data = array(
			'user_name' => $name,
			'user_phone' => $phone
		);
		$this->db->where('user_id', $id)->update('user', $data);
	}

	function addDepartment($department_name) {
		$data['department_name'] = $department_name;
		$this->db->insert('department', $data);
	}

	function getAllEquipments() {
		$query = $this->db->join('department', 'department.department_id=equipment.department_id')->get('equipment');
		return $query->result();
	}

	function addEquipment($arr) {
		$data = array(
			'equipment_name' => $arr['name'],
			'equipment_doi' => $arr['doi'],
			'department_id' => $arr['dept_id'],
			'equipment_detail' => $arr['details'],
		);
		$this->db->insert('equipment', $data);
	}

	function getAllNotifications() {
		$query = $this->db->join('user', 'user.user_id=notification.user_id', 'left')->order_by('notification_id', 'DESC')->limit(8)->get('notification');
		return $query->result();
	}

	function getAllActivities() {
		$query = $this->db->order_by('activity_tracker_id')->limit(5)->get('activity_tracker');
		return $query->result();
	}

	function sendNotification($arr) {
		$data = array(
			'user_id' => $this->input->post('eng_id'),
			'notification_text' => $this->input->post('notification'),
			'notification_date' => date('Y-m-d'),
			'notification_time' => date('H:i:s')
		);
		$this->db->insert('notification', $data);
	}

}