<?php

defined('BASEPATH') or exit();

class Engineer_model extends CI_Model
{

	function getAllNotifications() {
		$query = $this->db->join('user', 'user.user_id=notification.user_id', 'left')
						->get('notification');
		return $query->result();
	}
	 

	function equipmentExist($equipment_id){
		$query = $this->db->where("equipment_id",$equipment_id)->get('equipment');
		if ($query->num_rows()){
			return true;
		}
		else{
			return false;
		}
	} 

	function getEquipmentDetails($equipment_id) {
		$query = $this->db->where("equipment_id",$equipment_id)
						->join('department','department.department_id=equipment.department_id')
						->get('equipment');
		return $query->row();
	}

	function addService($equipment_id, $date, $eng_id, $status, $service_details) {
		$data = array(
			'equipment_id' => $equipment_id,
			'service_date' => $date,
			'service_status' => $status,
			'service_remark' => $service_details
		);
		# Get last service
		$service = $this->checkStatus($equipment_id);
		# First of all check if engineer is same and service is pending...
		if($service->user_id == $eng_id and $service->service_status == '1') {
			# Just update old service data...
			$this->db->where('user_id', $eng_id)
					->update('service', $data);
			return;
		}
		# No this is different user, insertion will be there for sure.
		$data['user_id'] = $eng_id;
		if($service->service_status == '2') {
			# Let go for insertion
		} else {
			# Okay this means last service was pending... convert last one to Shifted
			$this->db->where('service_id', $service->service_id)
					->update('service', array('service_status' => '3'));
			# Let go for insertion...
		}
		$this->db->insert('service', $data);
	}

	function getService($service_id) {
		$query = $this->db->where('service_id', $service_id)
						->join('equipment', 'equipment.equipment_id=service.equipment_id')
						->join('user', 'user.user_id=service.user_id')
						->get('service');
		return $query->row();
	}

	function getLastThreeService($equipment_id) {
		$query = $this->db->join('user', 'user.user_id=service.user_id')
						->where('equipment_id', $equipment_id)
						->limit('3')
						->order_by('service_id', 'DESC')
						->get('service');
		return $query->result();
	}

	function getAllServicesByEquipmentId($equipment_id) {
		$query = $this->db->join('user', 'user.user_id=service.user_id')
						->where('equipment_id', $equipment_id)
						->order_by('service_id', 'DESC')
						->get('service');
		return $query->result();
	}

	function getAllActivities() {
		$query = $this->db->order_by('activity_date', 'DESC')
						->order_by('activity_time', 'DESC')
						->limit('20')
						->get('activity_tracker');
		return $query->result();
	}

	function pushToActivity($activity) {
		date_default_timezone_set('Asia/Kolkata');
		$data = array(
			'activity_title' => $activity,
			'activity_date' => date('Y-m-d'),
			'activity_time' => date('H:i:s')
		);
		$this->db->insert('activity_tracker', $data);
	}

	function checkStatus($equipment_id) {
		$query = $this->db->select('service_id, service_status, user.user_name, user.user_id, service_remark')
						->where('service.equipment_id', $equipment_id)
						->join('user', 'user.user_id=service.user_id')
						->order_by('service_id', 'DESC')
						->limit('1')
						->get('service');
		return $query->row();
	}

}