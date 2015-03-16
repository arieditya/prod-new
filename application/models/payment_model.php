<?php

/**
 * Class Payment_model
 * property Vendor_class_model $vendor_class_model
 * property MY_Controller $CI
 */
class Payment_model extends MY_Model {

	var $CI;
    function __construct() {
        parent::__construct();
        $this->load->database();
		$this->CI = &get_instance();
    }
    
    function get_table($name){
        return $this->db->get($name);
    }
    
     function add_transaction($type, $order_id, $status){
        $this->db->set('payment_type',$type);
        $this->db->set('order_id',$order_id);
        $this->db->set('status_payment',$status);
        $this->db->set('transaction_date',date("Y-m-d H:i:s"));
	   $this->db->insert('payment');
        return $this->db->insert_id();
    }
	
	function admin_confirm_transfer_payment($code) {
		$admin_id = $this->session->userdata('admin_id');
		if(!$admin_id) return FALSE;
		$now = date('Y-m-d H:i:s');
		$this->db->update('vendor_class_transaction', 
				array(
					'status_4'			=> $now,
					'status_4_approval'	=> $admin_id
				),
				array(
					'code'				=> $code
				)
		);
		if(!! $this->db->affected_rows()) {
			$this->create_ticket($code);
		}
	}
	
	public function create_ticket($code) {
		$this->CI->load->model('vendor_class_model');
		$trx_invoice = $this->CI->vendor_class_model->create_invoice($code);
		
		$kelas = $this->db
				->select('code, class_id')
				->distinct()
				->from('vendor_class_participant')
				->where('code', $code)
				->get()->result();
//		var_dump($this->db->last_query());exit;
		$tickets = array();
		
		foreach($kelas as $kls) {
			
			$check = $this->db->from('vendor_class_ticket')->where(array('class_id'=>$kls->class_id,'invoice_code'=>$code))->get()->result();
			if(count($check) > 0) {
				foreach($check as $chk){
					$path1 = substr($chk->ticket_code, 0,1);
					$path2 = substr($chk->ticket_code, 1,1);
					$docs_path = "documents/ticket/{$path1}/{$path2}/";
					$tickets[] = $docs_path.$chk->ticket_code.'.pdf';
				}
				continue;
			}
			//
			$ticket_code = hashgenerator(12, 'safe', 1);
			$ticket_code = $ticket_code[1];
			
			$this->db->insert('vendor_class_ticket', array(
				'ticket_code'		=> $ticket_code,
				'class_id'			=> $kls->class_id,
				'invoice_code'		=> $code
			));
			
			$class = $this->CI->vendor_class_model->get_class(array(
					'id'	=> $kls->class_id,
				'class_status >='	=> NULL,
				'active'		=> NULL,
			))->row();
			
			$data_kelas = array(
				'ticket_code'			=> $ticket_code,
				'class_name'			=> $class->class_nama,
				'murid'					=> $trx_invoice[$class->id]['murid'],
				'jadwal'				=> array()
			);
			
			$scheds = $this->CI->vendor_class_model->get_class_schedule(array('class_id'=>$class->id));
			foreach($scheds->result() as $sched ) {
				$data_kelas['jadwal'][$sched->jadwal_id] = array(
					'date'			=> $sched->class_tanggal,
					'start_time'	=> $sched->class_jam_mulai.':'.$sched->class_menit_mulai,
					'end_time'		=> $sched->class_jam_selesai.':'.$sched->class_menit_selesai,
					'topic'			=> $sched->class_jadwal_topik,
					'attending'		=> FALSE
				);
			}
			
			$attendance_scheds = $this->CI->vendor_class_model->get_class_schedule_participant(array(
				'code'		=> $code,
				'class_id'	=> $class->id
			));
			
			foreach($attendance_scheds->result() as $attendance_sched) {
				$data_kelas['jadwal'][$attendance_sched->jadwal_id]['attending'] = TRUE;
			}
			

			$path1 = substr($ticket_code, 0,1);
			$path2 = substr($ticket_code, 1,1);
			$docs_path = "documents/ticket/{$path1}/{$path2}/";
			$content = $this->CI->load->view('email/class_ticket_to_pdf', $data_kelas, TRUE);
//			echo $content;exit;
			try {
				if(!is_dir(FCPATH.$docs_path))
					mkdir(FCPATH.$docs_path, 0777, TRUE);
				$this->CI->load->library('html2pdf');
				$this->CI->html2pdf->pdf->SetTitle('TICKET - '.$ticket_code);
				$this->CI->html2pdf->pdf->SetAuthor('Ruangguru.com');
				$this->CI->html2pdf->WriteHTML($content);
				
				$this->CI->html2pdf->Output(FCPATH.$docs_path.$ticket_code.'.pdf', 'F');
			} catch(Exception $e) {
				echo "ERROR!<br /><pre>";
				var_dump($e->getMessage());
				exit;
			}

			$tickets[] = $docs_path.$ticket_code.'.pdf';
		}
		
		return $tickets;
	}
   
}