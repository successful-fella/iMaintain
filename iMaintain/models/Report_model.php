<?php

use Dompdf\Dompdf;

defined('BASEPATH') or exit();

class Report_model extends CI_Model
{

	function singleReport($data) {
		$dompdf = new Dompdf();
		$html = $this->load->view('template/report', $data, true);
		$dompdf->loadHtml($html);
		$dompdf->render();
		$dompdf->stream();
	}

}