<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Genaral');
		$this->load->model('Tmweasy');
		if (!isset($_SESSION['steamid'])) {
			exit('ENGINE-WEB X POOMZ');
		}
	}
	public function bank_checker()
	{
		$post = $this->input->post();
		extract($post);
		$this->db->where('name', $_SESSION["steam_personaname"]);
		$player_query = $this->db->get("users");
		$player = $player_query->result();

		$server_info = $this->db->get('xd_setting');
		$xd_setting = $server_info->result();

		$tmapi_user = $xd_setting[0]->tmapi_user;
		$tmpapi_assword = $xd_setting[0]->tmpapi_password;
		$truewall_email = $xd_setting[0]->truewall_email;
		$truepassword = $xd_setting[0]->truepassword;
		$myip = $this->Tmweasy->my_ip();
		$capchar_session = $this->Tmweasy->capchar($myip, $tmapi_user);
		if ($type == "kbank") {
			$con_id = $xd_setting[0]->kbank_con_id;
			$ac_code = $xd_setting[0]->kbank_encoder_id;
			$gateway = 'Kbank_gateway';
			$this->db->where('name', 'sw_topup_kbank');
			$get_sw = $this->db->get('xd_switcher');
			$sw = $get_sw->result();
		} elseif ($type == "scb") {
			$con_id = $xd_setting[0]->scb_con_id;
			$ac_code = $xd_setting[0]->scb_encoder_id;
			$gateway = 'Scb_gateway';
			$this->db->where('name', 'sw_topup_scb');
			$get_sw = $this->db->get('xd_switcher');
			$sw = $get_sw->result();
		}
		if ($sw[0]->status == 0) {
			exit($this->Genaral->alert('ระบบปิดใช้งานชั่วคราว กรุณาติดต่อแอดมิน', 'error', base_url("topup")));
		}
		$transection = $this->Genaral->gen_transactionid($con_id, $year, $month, $day, $time_hr, $time_m, $money_1, $money_2);
		$xd_topup = $this->db->query('SELECT transaction_id FROM xd_topup WHERE transaction_id = ' . $transection);
		if ($xd_topup->num_rows()) {
			$notify['type'] = "error";
			$notify['alert'] = "หมายเลขอ้างอิงนี้ถูกใช้งานไปแล้ว";
			$notify['target'] = base_url("topup");
		} else {
			$returnservers = $this->Tmweasy->bank_connecting($tmapi_user, $tmpapi_assword, $truewall_email, $truepassword, $myip, $capchar_session, $transection, "yes", $player[0]->identifier, $ac_code);
			$returnserver = json_decode($returnservers, true);
			if ($returnserver["Status"] == "ready") {
				if ($returnserver["Status"] == 'ok') {
					$money_total = substr($returnserver, 2); //จำนวนเงินที่ได้รับ
					//-------------------------------------------------กรบวนการเซ็คสำเร็จ สามารถนำไปพัฒนาต่อ อัพเดทยอดบนฐานข้อมูลลูกค้า
					//โดยมี $money_total เป็นค่ายอดเงิน , $_POST[ref1] เป็นตัวอ้างอิง id ลูกค้าที่แจ้งเข้ามา
					$amount = ($money_total * $xd_setting[0]->topup_x) + $xd_setting[0]->topup_reword;
					$notify['type'] = "success";
					$notify['alert'] = "เติมเงินสำเร็จ จำนวน";
					$notify['target'] = base_url("topup");
					$p_update = $player[0]->point + $amount;
					$this->db->query('UPDATE `users` SET `point` = "' . $p_update . '",`topup_total` = topup_total + "' . $money_total . '" WHERE `identifier` = "' . $player[0]->identifier . '"');

					// Update transaction status is success
					$this->db->query("INSERT INTO `xd_topup` (`steam_identifier`,`date`,`amount`,`type`,`transaction_id`,`status`,`point`) VALUES ('" . $player[0]->identifier . "','" . date('Y-m-d') . "','$money_total','" . $gateway . "','" . $transection . "','success','$amount'); ");

					//-------------------------------------------------------------------------------------------
				} else {
					$notify['type'] = "error";
					$notify['alert'] = "เกิดข้อผิดพลาดไม่สามารถเติมเงินได้";
					$notify['target'] = base_url("topup");
				}
			} elseif ($returnserver["Status"] == "noready") {
				//กำลังมีผู้ทำรายการอยู่ โปรดรอประมาณ 20 วินาที
				$notify['type'] = "error";
				$notify['alert'] = "กำลังมีผู้ทำรายการอยู่ โปรดรอประมาณ 20 วินาที";
				$notify['target'] = base_url("topup");
			} elseif ($returnserver["Status"] == "not_connect") {
				//ไม่สามารถติดต่อ Server True Money ได้ โปรดรอสักครู่..
				$notify['type'] = "error";
				$notify['alert'] = "ไม่สามารถติดต่อ Server ได้";
				$notify['target'] = base_url("topup");
			} elseif ($returnserver["Status"] == "block_ip") {
				//ถูก block ip ชั่วคราว เนื่องจากทำรายการไม่ถูกต้อง เกิน 6 ครั้ง
				$notify['type'] = "error";
				$notify['alert'] = "ถูก block ip ชั่วคราว เนื่องจากทำรายการไม่ถูกต้อง เกิน 6 ครั้ง";
				$notify['target'] = base_url("topup");
			} else {

				$error = $returnserver; //ค่าผิดพลาด ที่ส่งกลับมา

				//-------------------------------------------------------------------------------------------
				$notify['type'] = "error";
				$notify['alert'] = $error["Msg"];
				$notify['target'] = base_url("topup");
				//-------------------------------------------------------------------------------------------

				$this->db->query("INSERT INTO `xd_topup` (`steam_identifier`,`date`,`amount`,`type`,`transaction_id`,`status`,`point`) VALUES ('" . $player[0]->identifier . "','" . date('Y-m-d') . "','0','" . $gateway . "','" . $transection . "','failed',0); ");
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	public function Wallet_checker()
	{

		$this->db->where('name', $_SESSION["steam_personaname"]);
		$transection = $_GET["tel"] . $_GET["amount"];
		$player_query = $this->db->get("users");
		$player = $player_query->result();

		$server_info = $this->db->get('xd_setting');
		$xd_setting = $server_info->result();

		$tmapi_user = $xd_setting[0]->tmapi_user;
		$tmpapi_assword = $xd_setting[0]->tmpapi_password;
		$truewall_email = $xd_setting[0]->truewall_email;
		$truepassword = $xd_setting[0]->truepassword;
		$myip = $this->Tmweasy->my_ip();
		$this->db->where('name', 'sw_topup_wallet');
		$get_sw = $this->db->get('xd_switcher');
		$sw = $get_sw->result();
		if ($sw[0]->status == 0) {
			exit($this->Genaral->alert('ระบบปิดใช้งานชั่วคราว กรุณาติดต่อแอดมิน', 'error', base_url("topup")));
		}
		$capchar_session = $this->Tmweasy->capchar($myip, $tmapi_user);
		$xd_topup = $this->db->query('SELECT transaction_id FROM xd_topup WHERE transaction_id = ' . $transection);
		if ($xd_topup->num_rows()) {
			$notify['type'] = "error";
			$notify['alert'] = "หมายเลขอ้างอิงนี้ถูกใช้งานไปแล้ว";
			$notify['target'] = base_url("topup");
		} else {
			if (strlen($transection) < 10) {
				$notify['type'] = "error";
				$notify['alert'] = "เลขอ้างอิงต้องมีจำนวนมากกว่า10ตัว";
				$notify['target'] = base_url("topup");
			} else {
				$returnserver = $this->Tmweasy->wallet_connecting($tmapi_user, $tmpapi_assword, $truewall_email, $truepassword, $myip, $capchar_session, $transection, "yes", $player[0]->identifier);
				if (substr($returnserver, 0, 2) == "ok") {
					$money_total = substr($returnserver, 2); //จำนวนเงินที่ได้รับ
					//-------------------------------------------------กรบวนการเซ็คสำเร็จ สามารถนำไปพัฒนาต่อ อัพเดทยอดบนฐานข้อมูลลูกค้า
					//โดยมี $money_total เป็นค่ายอดเงิน , $_POST[ref1] เป็นตัวอ้างอิง id ลูกค้าที่แจ้งเข้ามา
					$amount = $money_total * $xd_setting[0]->topup_x;
					$notify['type'] = "success";
					$notify['alert'] = "เติมเงินสำเร็จ จำนวน" . " | " . $amount;
					$notify['target'] = base_url("topup");
					$p_update = $player[0]->point + $amount;
					$this->db->query('UPDATE `users` SET `point` = "' . $p_update . '",`topup_total` = topup_total + "' . $money_total . '" WHERE `identifier` = "' . $player[0]->identifier . '"');

					// Update transaction status is success
					$this->db->query("INSERT INTO `xd_topup` (`steam_identifier`,`date`,`amount`,`type`,`transaction_id`,`status`,`point`) VALUES ('" . $player[0]->identifier . "','" . date('Y-m-d') . "','$money_total','tmweasy_wallet','" . $transection . "','success','$amount'); ");

					//-------------------------------------------------------------------------------------------
				} else {
					$error = $returnserver; //ค่าผิดพลาด ที่ส่งกลับมา

					//-------------------------------------------------------------------------------------------
					$notify['type'] = "error";
					$notify['alert'] = $error;
					$notify['target'] = base_url("topup");
					//-------------------------------------------------------------------------------------------

					$this->db->query("INSERT INTO `xd_topup` (`steam_identifier`,`date`,`amount`,`type`,`transaction_id`,`status`,`point`) VALUES ('" . $player[0]->identifier . "','" . date('Y-m-d') . "','0','tmweasy_wallet','" . $transection . "','failed',0); ");
				}
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}
}
