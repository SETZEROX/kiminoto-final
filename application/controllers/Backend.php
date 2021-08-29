<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backend extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Genaral');
		$this->load->library('Rcon/XD_RCON');
		if (!$this->Genaral->cklogin('backend')) {
			redirect("admin");
		}
	}

	public function index()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$backend_info = $this->db->get('xd_backend');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"backend" => $backend_info->result(),
			"active" => "home",
		);
		$this->load->view('Backend/index', $data);
	}

	public function store()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$store_info = $this->db->get('xd_product');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"active" => "Store",
			"product" => $store_info->result(),
		);
		$this->load->view('Backend/store', $data);
	}

	public function redeem()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$redeem_info = $this->db->get('xd_redeem');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"active" => "Redeem",
			"redeem" => $redeem_info->result(),
		);
		$this->load->view('Backend/redeem', $data);
	}


	public function topup()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"active" => "topup",
		);
		$this->load->view('Backend/topup', $data);
	}
	public function whitelist()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$whitelist_info = $this->db->get('whitelist');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"whitelist" => $whitelist_info->result(),
			"active" => "whitelist",
		);
		$this->load->view('Backend/whitelist', $data);
	}


	public function download()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$download_info = $this->db->get('xd_download');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"active" => "download",
			"download" => $download_info->result(),
		);
		$this->load->view('Backend/download', $data);
	}

	public function howtoplay()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$htp_info = $this->db->get('xd_htp');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"htps" => $htp_info->result(),
			"active" => "how to play",
		);
		$this->load->view('Backend/howtoplay', $data);
	}

	public function howtoplay_create()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"active" => "Create-howtoplay",
		);
		$this->load->view('Backend/howtoplay_create', $data);
	}
	public function howtoplay_editor($id)
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$this->db->where('id', $id);
		$htp_info = $this->db->get('xd_htp');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"htps" => $htp_info->result(),
			"active" => "Editor-howtoplay",
		);
		$this->load->view('Backend/howtoplay_editor', $data);
	}

	public function players()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$users_info = $this->db->get('users');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"users" => $users_info->result(),
			"active" => "players",
		);
		$this->load->view('Backend/players', $data);
	}
	public function admins()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$backend_info = $this->db->get('xd_backend');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"backend" => $backend_info->result(),
			"active" => "admins",
		);
		$this->load->view('Backend/admins', $data);
	}

	public function htp_del($id)
	{
		if (!empty($id)) {
			$this->db->where("id", $id);
			if ($this->db->delete("xd_htp")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/howtoplay");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/howtoplay");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function rule_del($id)
	{
		if (!empty($id)) {
			$this->db->where("id", $id);
			if ($this->db->delete("xd_rule")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/rule");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/rule");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function rule()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$rule_info = $this->db->get('xd_rule');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"rules" => $rule_info->result(),
			"active" => "Rule",
		);
		$this->load->view('Backend/rule', $data);
	}

	public function rule_server()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"active" => "Rule",
		);
		$this->load->view('Backend/rule_server', $data);
	}

	public function rule_create()
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"active" => "Create-rule",
		);

		$this->load->view('Backend/rule_create', $data);
	}

	public function rule_editor($id)
	{
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');
		$this->db->where('id', $id);
		$rule_info = $this->db->get('xd_rule');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"rule" => $rule_info->result(),
			"active" => "Editor-rule",
		);
		$this->load->view('Backend/rule_editor', $data);
	}

	//=======================================================


	public function logout()
	{
		$this->session->unset_userdata("login_state_bk");
		$this->session->sess_destroy();
		redirect('Backend');
	}
	public function update_topup_wallet()
	{
		if ($post = $this->input->post()) {
			extract($post);
			if (strlen($tel) != 10) {
				$notify['type'] = "error";
				$notify['alert'] = "รูปแบบเบอร์มือถือไม่ถูกต้อง";
				$notify['target'] = base_url("Backend/topup");
			} else {
				$this->db->set('fullname', $fullname);
				$this->db->set('tel', $tel);
				if ($this->db->update("xd_config")) {
					$notify['type'] = "success";
					$notify['alert'] = "ทำรายการสำเร็จ";
					$notify['target'] = base_url("Backend/topup");
				} else {
					$notify['type'] = "warning";
					$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
					$notify['target'] = base_url("Backend/topup");
				}
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function update_topup_kbank()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set('kbank_account_name', $account_name);
			$this->db->set('kbank_account_number', $account_number);
			$this->db->set('kbank_promptpay_account', $promtpay_account);
			$this->db->set('kbank_con_id', $con_id);
			$this->db->set('kbank_encoder_id', $password_encoder);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/topup");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/topup");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function update_topup_scb()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set('scb_account_name', $account_name);
			$this->db->set('scb_account_number', $account_number);
			$this->db->set('scb_promptpay_account', $promtpay_account);
			$this->db->set('scb_con_id', $con_id);
			$this->db->set('scb_encoder_id', $password_encoder);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/topup");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/topup");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_topup_account()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set('tmapi_user', $tmapi_user);
			$this->db->set('tmpapi_password', $tmpapi_password);
			$this->db->set('truewall_email', $truewall_email);
			$this->db->set('truepassword', $truepassword);

			$this->db->set('kbank_account_name', $kbank_account_name);
			$this->db->set('kbank_account_number', $kbank_account_number);
			$this->db->set('kbank_encoder_id', $kbank_encoder_id);
			$this->db->set('kbank_con_id', $kbank_con_id);

			$this->db->set('scb_account_name', $scb_account_name);
			$this->db->set('scb_account_number', $scb_account_number);
			$this->db->set('scb_encoder_id', $scb_encoder_id);
			$this->db->set('scb_con_id', $scb_con_id);


			if ($this->db->update("xd_setting")) {

				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/topup");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/topup");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_topup_rate()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('topup_x', $topup_x);
			$this->db->set('topup_reword', $topup_reword);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/topup");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/topup");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_video()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('webslite_yt', $url_yt);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_game()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('game_ip', $game_ip);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_backend()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('password', $password_bk);
			if ($this->db->update("xd_backend")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function update_rcon()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('game_rcon', $password_rcon);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function update_key()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('apikey', $apikey);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_announcement()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('website_announcement', $announcement);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_genaral()
	{
		if ($post = $this->input->post()) {
			extract($post);

			$this->db->set('server_names', $name);
			$this->db->set('discord', $discord);
			$this->db->set('website_background', $website_background);
			$this->db->set('fb_link', $fb_link);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function announcement_plus()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$insert_list = array(
				"post" => $announcement_msg,
				"date" => date("Y-m-d"),
				"creating" => "XD-STUDIO",
				"detail" => $detail,
			);
			if ($this->db->insert("xd_announcement", $insert_list)) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function announcement_update()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("post", $announcement_msg);
			$this->db->set("detail", $details);
			$this->db->where("id", $id);
			if ($this->db->update("xd_announcement")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function announcement_delete()
	{
		if ($get = $this->input->get()) {
			extract($get);
			$this->db->where("id", $id);
			if ($this->db->delete("xd_announcement")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function slide_plus()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$insert_list = array(
				"img" => $slide_url,
				"date" => date("Y-m-d"),
			);
			if ($this->db->insert("xd_slider", $insert_list)) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function slide_delete()
	{
		if ($get = $this->input->get()) {
			extract($get);
			$this->db->where("id", $id);
			if ($this->db->delete("xd_slider")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/index");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/index");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}


	public function download_plus()
	{
		if ($post = $this->input->post()) {
			extract($post);
			if ($act == "editor") {
				$this->db->set("name", $name);
				$this->db->set("img", $img);
				$this->db->set("link", $link);
				$this->db->where("id", $id);
				if ($this->db->update("xd_download")) {
					$notify['type'] = "success";
					$notify['alert'] = "ทำรายการสำเร็จ";
					$notify['target'] = base_url("Backend/download");
				} else {
					$notify['type'] = "warning";
					$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
					$notify['target'] = base_url("Backend/download");
				}
			} elseif ($act == "create") {
				$insert_list = array(
					"name" => $name,
					"link" => $link,
					"img" => $img,
				);
				if ($this->db->insert("xd_download", $insert_list)) {
					$notify['type'] = "success";
					$notify['alert'] = "ทำรายการสำเร็จ";
					$notify['target'] = base_url("Backend/download");
				} else {
					$notify['type'] = "warning";
					$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
					$notify['target'] = base_url("Backend/download");
				}
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}
	public function download_delete()
	{
		if ($get = $this->input->get()) {
			extract($get);
			$this->db->where("id", $id);
			if ($this->db->delete("xd_download")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/download");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/download");
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}


	public function products_plus()
	{
		if ($post = $this->input->post()) {
			extract($post);
			if ($act == "editor") {
				$this->db->set("name", $name);
				$this->db->set("amount", $amount);
				$this->db->set("point", $point);
				$this->db->set("img", $img);
				$this->db->set("cmd", $cmd);
				$this->db->set("category", $category);
				$this->db->where("id", $id);
				if ($this->db->update("xd_product")) {
					$notify['type'] = "success";
					$notify['alert'] = "ทำรายการสำเร็จ";
					$notify['target'] = base_url("Backend/store");
				} else {
					$notify['type'] = "warning";
					$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
					$notify['target'] = base_url("Backend/store");
				}
			} elseif ($act == "create") {
				$insert_list = array(
					"name" => $name,
					"amount" => $amount,
					"point" => $point,
					"img" => $img,
					"cmd" => $cmd,
					"category" => $category,
				);
				if ($this->db->insert("xd_product", $insert_list)) {
					$notify['type'] = "success";
					$notify['alert'] = "ทำรายการสำเร็จ";
					$notify['target'] = base_url("Backend/store");
				} else {
					$notify['type'] = "warning";
					$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
					$notify['target'] = base_url("Backend/store");
				}
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}
	public function products_delete()
	{
		if ($get = $this->input->get()) {
			extract($get);
			$this->db->where("id", $id);
			if ($this->db->delete("xd_product")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/store");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/store");
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	public function update_player()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("firstname", $firstname);
			$this->db->set("lastname", $lastname);
			$this->db->set("group", $group);
			$this->db->set("point", $point);
			$this->db->set("money", $money);
			$this->db->set("bank", $bank);
			$this->db->where("id", $id);
			if ($this->db->update("users")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/players");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/players");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function update_admins()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("username", $username);
			$this->db->set("password", md5($password));
			$this->db->where("id", $id);
			if ($this->db->update("xd_backend")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/admins");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/admins");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}
	public function add_admins()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$insert_admins = array(
				"username" => $username,
				"password" => md5($password),
			);
			if ($this->db->insert("xd_backend", $insert_admins)) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/admins");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/admins");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function htp_update($id)
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("title", $title);
			$this->db->set("detail", $editor1);
			$this->db->where('id', $id);
			if ($this->db->update("xd_htp")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/howtoplay_editor/" . $id);
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/howtoplay_editor/" . $id);
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function rule_update($id)
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("title", $title);
			$this->db->set("detail", $editor1);
			$this->db->where('id', $id);
			if ($this->db->update("xd_rule")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/rule_editor/" . $id);
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/rule_editor/" . $id);
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function rule_server_update()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("rule", $editor1);
			if ($this->db->update("xd_setting")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/rule_server/");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/rule_server/");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function htp_plus()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("title", $title);
			$this->db->set("detail", $editor1);
			$insert_list = array(
				"title" => $title,
				"detail" => $editor1,
			);
			if ($this->db->insert("xd_htp", $insert_list)) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/howtoplay");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/howtoplay");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function rule_plus()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("title", $title);
			$this->db->set("detail", $editor1);
			$insert_list = array(
				"title" => $title,
				"detail" => $editor1,
			);
			if ($this->db->insert("xd_rule", $insert_list)) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/rule");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/rule");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function rule_player()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->set("rule", $editor1);
			if ($this->db->update("users")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/howtoplay");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/howtoplay");
			}

			exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
		}
	}

	public function delete_players($id)
	{
		$this->db->where("id", $id);
		if ($this->db->delete("users")) {
			$notify['type'] = "success";
			$notify['alert'] = "ทำรายการสำเร็จ";
			$notify['target'] = base_url("Backend/whitelist");
		} else {
			$notify['type'] = "warning";
			$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
			$notify['target'] = base_url("Backend/whitelist");
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}
	public function delete_admins($id)
	{
		$this->db->where("id", $id);
		if ($this->db->delete("xd_backend")) {
			$notify['type'] = "success";
			$notify['alert'] = "ทำรายการสำเร็จ";
			$notify['target'] = base_url("Backend/admins");
		} else {
			$notify['type'] = "warning";
			$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
			$notify['target'] = base_url("Backend/admins");
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	public function ban($name)
	{
		$setting_info = $this->db->get('xd_setting');
		$setting = $setting_info->result();
		$users_info = $this->Genaral->get_users($name);
		$user_data = json_decode($users_info);
		if ($user_data->player_info == "NOT_ONLINE") {
			$notify['type'] = "warning";
			$notify['alert'] = "กรุณาออนไลน์ในเซิฟเวอร์ด้วย";
			$notify['target'] = base_url("Backend/players");
		} elseif ($user_data->player_info == "SERVER_DOWN") {
			$notify['type'] = "warning";
			$notify['alert'] = "ไม่สามารถเชื่อมต่อกับเซิฟเวอร์ได้";
			$notify['target'] = base_url("Backend/players");
		} elseif ($user_data->player_info == "NOT_ONLINE_PLAYERS") {
			$notify['type'] = "warning";
			$notify['alert'] = "ไม่มีคนออนไลน์ในเซิฟเวอร์";
			$notify['target'] = base_url("Backend/players");
		} else {
			$user_id = $user_data->player_info->id;
			$user_identifiers = $user_data->player_info->identifiers[0];

			$rcon_con = new XD_RCON($_SERVER["SERVER_ADDR"], '30120', $success);
			if (!$success) {
				die("Fehler bei der Verbindungherstellung");
			}
			$rcon_con->setRconpassword($setting[0]->game_rcon);
			$command = "ban id $user_id";
			$rcon_con->rcon($command);

			$insert_list = array(
				"identifier" => $user_identifiers,
				"user_name" => $name,
			);
			if ($this->db->insert("xd_banned", $insert_list)) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/players");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/players");
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	public function unban($name)
	{
		$setting_info = $this->db->get('xd_setting');
		$setting = $setting_info->result();
		$users_info = $this->Genaral->get_users($name);
		$user_data = json_decode($users_info);
		if ($user_data->player_info == "NOT_ONLINE") {
			$notify['type'] = "warning";
			$notify['alert'] = "กรุณาออนไลน์ในเซิฟเวอร์ด้วย";
			$notify['target'] = base_url("Backend/players");
		} elseif ($user_data->player_info == "SERVER_DOWN") {
			$notify['type'] = "warning";
			$notify['alert'] = "ไม่สามารถเชื่อมต่อกับเซิฟเวอร์ได้";
			$notify['target'] = base_url("Backend/players");
		} elseif ($user_data->player_info == "NOT_ONLINE_PLAYERS") {
			$notify['type'] = "warning";
			$notify['alert'] = "ไม่มีคนออนไลน์ในเซิฟเวอร์";
			$notify['target'] = base_url("Backend/players");
		} else {
			$user_id = $user_data->player_info->id;
			$user_identifiers = $user_data->player_info->identifiers[0];

			$rcon_con = new XD_RCON($_SERVER["SERVER_ADDR"], '30120', $success);
			if (!$success) {
				die("Fehler bei der Verbindungherstellung");
			}
			$rcon_con->setRconpassword($setting[0]->game_rcon);
			$command = "unban id $user_id";
			$rcon_con->rcon($command);
			$this->db->where('user_name', $name);
			if ($this->db->delete("xd_banned")) {
				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/players");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/players");
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	public function switcher($type)
	{
		if ($post = $this->input->post()) {
			extract($post);
			if ($type == "sw_wallet") {
				$this->db->where("name", 'sw_topup_wallet');
				$get_switcher = $this->db->get("xd_switcher");
				$switcher = $get_switcher->result();
				if ($switcher[0]->status == 1) {
					$this->db->where("name", 'sw_topup_wallet');
					$this->db->set("status", 0);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_off";
						$notify['id'] = "wallet";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				} else {
					$this->db->where("name", 'sw_topup_wallet');
					$this->db->set("status", 1);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_on";
						$notify['id'] = "wallet";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				}
			} elseif ($type == "sw_scb") {
				$this->db->where("name", 'sw_topup_scb');
				$get_switcher = $this->db->get("xd_switcher");
				$switcher = $get_switcher->result();
				if ($switcher[0]->status == 1) {
					$this->db->where("name", 'sw_topup_scb');
					$this->db->set("status", 0);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_off";
						$notify['id'] = "scb";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				} else {
					$this->db->where("name", 'sw_topup_scb');
					$this->db->set("status", 1);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_on";
						$notify['id'] = "scb";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				}
			} elseif ($type == "sw_kbank") {
				$this->db->where("name", 'sw_topup_kbank');
				$get_switcher = $this->db->get("xd_switcher");
				$switcher = $get_switcher->result();
				if ($switcher[0]->status == 1) {
					$this->db->where("name", 'sw_topup_kbank');
					$this->db->set("status", 0);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_off";
						$notify['id'] = "kbank";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				} else {
					$this->db->where("name", 'sw_topup_kbank');
					$this->db->set("status", 1);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_on";
						$notify['id'] = "kbank";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				}
			} elseif ($type == "sw_wallet_gatway") {
				$this->db->where("name", 'sw_topup_wallet_gateway');
				$get_switcher = $this->db->get("xd_switcher");
				$switcher = $get_switcher->result();
				if ($switcher[0]->status == 1) {
					$this->db->where("name", 'sw_topup_wallet_gateway');
					$this->db->set("status", 0);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_off";
						$notify['id'] = "kbank";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				} else {
					$this->db->where("name", 'sw_topup_wallet_gateway');
					$this->db->set("status", 1);
					if ($get_switcher = $this->db->update("xd_switcher")) {
						$notify['alert'] = "ทำรายการสำเร็จ";
						$notify['status'] = "complete_on";
						$notify['id'] = "kbank";
					} else {
						$notify['alert'] = "เกิดข้อผิดพลาด";
						$notify['status'] = "Error";
					}
				}
			}
			exit(json_encode($notify));
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	public function add_whitelist()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$insert_list = array(
				"identifier" => $identifier,
			);
			if ($this->db->insert("whitelist", $insert_list)) {

				$notify['type'] = "success";
				$notify['alert'] = "ทำรายการสำเร็จ";
				$notify['target'] = base_url("Backend/whitelist");
			} else {
				$notify['type'] = "warning";
				$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
				$notify['target'] = base_url("Backend/whitelist");
			}
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	public function delete_whitelist($identifier)
	{
		$this->db->where("identifier", $identifier);
		if ($this->db->delete("whitelist")) {
			$notify['type'] = "success";
			$notify['alert'] = "ทำรายการสำเร็จ";
			$notify['target'] = base_url("Backend/whitelist");
		} else {
			$notify['type'] = "warning";
			$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
			$notify['target'] = base_url("Backend/whitelist");
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}

	#============================= REDEEM UPDATE =========================================
	public function update_redeem()
	{
		
		if ($post = $this->input->post()) {
			extract($post);
			if ($redeem_query == "update") {
				$this->db->set('code_id', $redeem_code);
				$this->db->set('cmd', $redeem_cmd);
				$this->db->set('type', $redeem_type);
				$this->db->set('multi', $redeem_multi);
				$this->db->where('id', $redeem_id);
				$query = $this->db->update('xd_redeem');
			} else {
				$this->db->where('code_id', $redeem_code);
				$redeem_checker = $this->db->get('xd_redeem');
				if ($redeem_checker->num_rows()) {
					$notify['type'] = "warning";
					$notify['alert'] = 'มีรหัสของขวัญนี้อยู่ในระบบอยู่แล้ว';
					exit(json_encode($notify));
				} else {
					$insert_redeem = array(
						"code_id" => $redeem_code,
						"cmd" => $redeem_cmd,
						"type" => $redeem_type,
						"multi" => $redeem_multi,
						"use_code" => '[]',
					);
					$query = $this->db->insert('xd_redeem', $insert_redeem);
				}
			}
			if ($query) {
				$notify['type'] = "success";
				$notify['alert'] = 'ทำรายการสำเร็จ';
			} else {
				$notify['type'] = "error";
				$notify['alert'] = 'เกิดข้อผิดพลาด';
			}
			exit(json_encode($notify));
		}
	}

	public function delete_redeem()
	{
		//$this->is_login('backend');
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->where('id', $id);
			if ($this->db->delete('xd_redeem')) {
				$notify['type'] = "success";
			} else {
				$notify['type'] = "error";
				$notify['alert'] = 'เกิดข้อผิดพลาด';
			}
			exit(json_encode($notify));
		}
	}
}
