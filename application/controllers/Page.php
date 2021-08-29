<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Steam/LightOpenID');
		$this->load->model('Genaral');
	}
	public function index()
	{
		$announcement_info = $this->db->get('xd_announcement');
		$count_product = $this->db->get('xd_product');
		$count_players = $this->db->get('users');
		$setting_info = $this->db->get('xd_setting');
		$last_topup = $this->db->query('SELECT * FROM `xd_topup` ORDER BY id DESC LIMIT 1');
		$data = array(
			'title' => 'หน้าแรก',
			"announcement_info" => $announcement_info->result(),
			"count_product" => $count_product->num_rows(),
			"count_players" => $count_players->num_rows(),
			"last_topup" => $last_topup->result(),
			"setting_info" => $setting_info->result(),
		);
		$this->load->view('index', $data);
	}

	public function signin()
	{
		$server_info = $this->db->get('xd_setting');
		$data = array(
			'title' => 'เข้าสู่ระบบ',
			"Genaral" => $this->Genaral,
			"data" => $server_info->result(),
		);
		$this->load->view('Page_signin', $data);
	}

	public function download()
	{
		$server_info = $this->db->get('xd_setting');
		$data = array(
			'title' => 'ดาวน์โหลด',
			"Genaral" => $this->Genaral,
			"data" => $server_info->result(),
		);
		$this->load->view('Page_download', $data);
	}

	public function howtoplay($id)
	{
		$server_info = $this->db->get('xd_setting');
		$this->db->where('id', $id);
		$htp_info = $this->db->get('xd_htp');
		$data = array(
			'title' => 'วิธีเล่น',
			"Genaral" => $this->Genaral,
			"data" => $server_info->result(),
			"htp" => $htp_info->result(),
		);
		$this->load->view('Page_howtoplay', $data);
	}

	public function logout()
	{
		$this->session->all_userdata();
		$this->session->unset_userdata("login_state");
		$this->session->sess_destroy();
		redirect('');
	}

	public function rule($id)
	{
		$server_info = $this->db->get('xd_setting');
		$this->db->where('id', $id);
		$rule_info = $this->db->get('xd_rule');
		$data = array(
			'title' => 'กฏหมาย',
			"Genaral" => $this->Genaral,
			"rule" => $rule_info->result(),
			"data" => $server_info->result(),
		);
		$this->load->view('Page_rule', $data);
	}

	public function rule_server()
	{
		$server_info = $this->db->get('xd_setting');
		$data = array(
			'title' => 'กฏหมายของเซิฟเวอร์',
			"Genaral" => $this->Genaral,
			"data" => $server_info->result(),
		);
		$this->load->view('Page_rule_server', $data);
	}

	public function announce($id)
	{
		$this->db->where("id", $id);
		$announce_info = $this->db->get("xd_announcement");
		$server_info = $this->db->get('xd_setting');
		$data = array(
			'title' => 'กฏหมายของเซิฟเวอร์',
			"Genaral" => $this->Genaral,
			"data" => $server_info->result(),
			"announce_info" => $announce_info->result(),
		);
		$this->load->view('Page_anoc', $data);
	}

	public function invse_all()
	{
		if (!$this->Genaral->cklogin('member')) {
			redirect("sign-in");
		}
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');

		$this->db->where('identifier', $_SESSION["identifier"]);
		$player_query = $this->db->get("users");
		$player = $player_query->result();

		$this->db->where('identifier', $player[0]->identifier);
		$invse_alls = $this->db->get('user_inventory');

		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"invse_alls" => $invse_alls->result(),
			"title" => "invse_all",
		);
		$this->load->view('Page_invse_all', $data);
	}

	public function invse_cars()
	{
		if (!$this->Genaral->cklogin('member')) {
			redirect("sign-in");
		}
		$server_info = $this->db->get('xd_setting');
		$config_info = $this->db->get('xd_config');

		$this->db->where('identifier', $_SESSION["identifier"]);
		$player_query = $this->db->get("users");
		$player = $player_query->result();

		$this->db->where('owner', $player[0]->identifier);
		$invse_cars = $this->db->get('owned_vehicles');
		$data = array(
			"data" => $server_info->result(),
			"conf" => $config_info->result(),
			"invse_cars" => $invse_cars->result(),
			"title" => "invse_cars",
		);
		$this->load->view('Page_invse_cars', $data);
	}

	public function signin_admin()
	{
		$server_info = $this->db->get('xd_setting');
		$data = array(
			'title' => 'เข้าสู่ระบบ',
			"Genaral" => $this->Genaral,
			"data" => $server_info->result(),
		);
		$this->load->view('page_backend', $data);
	}

	public function bk_checker()
	{
		if ($post = $this->input->post()) {
			extract($post);
			$this->db->where('username', $bk_username);
			$backend_info = $this->db->get('xd_backend');
			if (!$backend_info->num_rows()) {
				$notify['type'] = "error";
				$notify['alert'] = "ไม่พบชื่อผู้ใช้งานในระบบ";
				$notify['target'] = base_url("admin");
			} else {
				$backend_users = $backend_info->result();
				if ($bk_password == "") {
					$notify['type'] = "warning";
					$notify['alert'] = "กรุณาอย่าใส่ช่องว่าง";
					$notify['target'] = base_url("admin");
				} else {
					if (md5($bk_password) == $backend_users[0]->password) {
						$userdata = array(
							'admin_username' => $backend_users[0]->username,
							'login_state_bk' => true,
						);
						$this->db->set('last_login',date('Y-m-d'));
						$this->db->set('login_ip',$this->input->ip_address());
						$this->db->where('username', $bk_username);
						$this->db->update('xd_backend');
						$this->session->set_userdata($userdata);
						$notify['type'] = "success";
						$notify['alert'] = "เข้าสู่ระบบสำเร็จ";
						$notify['target'] = base_url("Backend");
					} else {
						$notify['type'] = "warning";
						$notify['alert'] = "รหัสผ่านไม่ถูกต้อง";
						$notify['target'] = base_url("admin");
					}
				}
			}
		} else {
			$notify['type'] = "warning";
			$notify['alert'] = "เกิดข้อผิดพลาดบางอย่าง";
			$notify['target'] = base_url("admin");
		}
		exit($this->Genaral->alert($notify['alert'], $notify['type'], $notify['target']));
	}
}
