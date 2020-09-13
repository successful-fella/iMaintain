<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Init extends CI_Controller
{

	public function index() {
		redirect('engineer/login');
	}

}
