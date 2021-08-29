<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Topup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Genaral');
	}

	public function index()
	{
		exit("MINETHOST x ENGINE-WEB | XD-FIVEM");
	}

	public function wallet()
	{

		if ($post = $this->input->post()) {

			$config_info = $this->db->get('xd_config');
			$config = $config_info->result();

			$setting_info = $this->db->get('xd_setting');
			$setting = $setting_info->result();

			$status = $_POST['status'];
			$signature = $_POST['signature'];
			$orderId = $_POST['order_id'];
			$orderName = $_POST['order_name'];
			$datePayment = $_POST['date_payment'];
			$transactionId = $_POST['transaction_id'];

			$amount = $_POST['amount'] * $setting[0]->topup_x;

			// Check signature
			$my_signature = hash_hmac('sha256', ($orderId . '|' . $amount . '|' . $transactionId), $config[0]->secret_key);
			if (hash_equals($my_signature, $signature) === false) {
				exit();
			}
			$checkTransaction = $this->db->query("SELECT * FROM `XD_topup` WHERE `transaction_id` = '" . $transactionId . "';");
			$cktran = $checkTransaction->result();
			if ($cktran == false) {
				exit();
			} else {
				// Status payment is success
				if ($status == 'success') {
					// Update point with + amount
					$this->db->query("UPDATE `users` SET `point` = `point + '" . $amount . "',`topup_total` = `topup_total + '" . $amount . "' WHERE `id` = '" . $cktran[0]->identifier . "'; ");

					// Update transaction status is success
					$this->db->query("UPDATE `XD_topup` SET `status` = 'success' , `point` = $amount WHERE `transaction_id` = '" . $cktran[0]->transaction_id . "'; ");
					exit();
				}

				// Status payment is failed
				if ($status == 'failed') {
					// Update transaction status is failed
					$this->db->query("UPDATE `XD_topup` SET `status` = 'failed' , `point` = 0 WHERE `transaction_id` = '" . $cktran[0]->transaction_id . "'; ");
					exit();
				}
			}
		} else {
			exit("MINETHOST x ENGINE-WEB | XD-FIVEM");
		}
	}
}
