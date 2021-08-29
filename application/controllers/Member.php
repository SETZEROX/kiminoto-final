<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Steam/LightOpenID');
		$this->load->model('Genaral');
		$this->load->library('Rcon/XD_RCON');
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

	public function store()
	{
		$data = array(
			'title' => 'ร้านค้า',
		);
		$this->load->view('Member/Page_store', $data);
	}
	public function redeem()
	{
		$server_info = $this->db->get('xd_setting');
		$data = array(
			"data" => $server_info->result(),
			"icons" => '',
			"title" => 'โค๊ดไอเท็ม',
		);
		$this->load->view('Member/Page_redeem', $data);
	}
	public function topup($type)
	{
		$config_info = $this->db->get('xd_config');
		$setting_info = $this->db->get('xd_setting');
		$data = array(
			'title' => 'เติมเงิน',
			"data" => $config_info->result(),
			"setting_info" => $setting_info->result(),
		);
		if ($type == 'wallet') {
			$this->load->view('Member/Page_topup_wallet', $data);
		} elseif ($type == 'banking') {
			$this->load->view('Member/Page_topup_banking', $data);
		}
	}

	public function view_product($type)
	{
		if ($type != 'all') {
			$this->db->where("category", $type);
		}

		$product_list = $this->db->get('xd_product');
		$data = array(
			"product" => $product_list->result(),
		);
		$this->load->view('Member/onload/onload_product', $data);
	}



	//==================== ITEM =================================
	public function buy_item()
	{
		if(empty($_SESSION["steam_personaname"])){
			exit(json_encode(array("type" => "warning","alert" => "กรุณาเข้าสู่ระบบก่อนใช้งาน")));
		}
		$post = $this->input->post();
		extract($post);
		$setting_info = $this->db->get('xd_setting');
		$setting = $setting_info->result();


		$this->db->where("id", $id);
		$product_sql = $this->db->get("xd_product");

		$users_info = $this->Genaral->get_users($_SESSION["steam_personaname"]);
		$user_data = json_decode($users_info);
		if ($user_data->player_info == "NOT_ONLINE") {
			$data = array(
				"type" => "warning",
				"alert" => "กรุณาออนไลน์ในเซิฟเวอร์ด้วย",
			);
		} elseif ($user_data->player_info == "SERVER_DOWN") {
			$data = array(
				"type" => "warning",
				"alert" => "ไม่สามารถเชื่อมต่อกับเซิฟเวอร์ได้",
			);
		} elseif ($user_data->player_info == "NOT_ONLINE_PLAYERS") {
			$data = array(
				"type" => "warning",
				"alert" => "ไม่มีคนออนไลน์ในเซิฟเวอร์",
			);
		} else {
			if ($product_sql->num_rows() != 1) {
				$data = array(
					"type" => "warning",
					"alert" => "ไม่มีสินค้านี้ภายในคลัง",
				);
			} else {
				$this->db->where("id", $id);
				$product_query = $this->db->get("xd_product");
				$product = $product_query->result();
				$user_id = $user_data->player_info->id;
				$user_identifiers = $user_data->player_info->identifiers[0];
				$this->db->where('identifier', $user_identifiers);
				$player_query = $this->db->get("users");
				$player = $player_query->result();
				if ($player[0]->point < $product[0]->point * $amount_sell) {
					$data = array(
						"type" => "error",
						"alert" => "คุณไม่มีพ้อยพอที่จะซื้อไอเท็ม",
					);
				} else {
					$point_update = (($product[0]->point * $amount_sell) - $player[0]->point);
					if ($product[0]->category == "cars") {
						$data = array("type" => "success", "alert" => "ซื้อไอเท็มเรียบร้อย",);
						$plate = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . " " . rand(0, 999);
						$this->db->where('plate', $plate);
						$insert_list = array(
							"owner" => $player[0]->identifier,
							"plate" => $plate,
							"vehicle" => '{"model":' . $product[0]->cmd . ',"plate":"' . $plate . '"}',
							"type" => 'car',
							"job" => '',
							"stored" => 1,
						);
						$this->db->insert("owned_vehicles", $insert_list);
						$data = array("type" => "success", "alert" => "ซื้อไอเท็มเรียบร้อย");
					} elseif ($product[0]->category == "items" or $product[0]->category == "foods" or $product[0]->category == "gashapon" or $product[0]->category == "Illegal") {
						$this->db->where('item', $product[0]->cmd);
						$server_info = $this->db->get('xd_setting');
						$xd_setting = $server_info->result();
						$get_game_data = explode(":", $xd_setting[0]->game_ip);
						$rcon_con = new XD_RCON();
						$rcon_con->setRconpassword($setting[0]->game_rcon);
						$rcon_con->connector($get_game_data[0], $get_game_data[1], $success);
						if (!$success) {
							$data = array("type" => "success", "alert" => "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้");
						} else {
							$rcon_con->rcon($product[0]->cmd);
							$data = array("type" => "success", "alert" => "ซื้อไอเท็มเรียบร้อย");
						}
					} elseif ($product[0]->category == "cash_money") {
						$this->db->set('money', $product[0]->cmd);
						$this->db->where('identifier', $user_identifiers);
						$this->db->update("users");
						$data = array("type" => "success", "alert" => "ซื้อไอเท็มเรียบร้อย");
					} elseif ($product[0]->category == "cash_bank") {
						$this->db->set('bank', $product[0]->cmd);
						$this->db->where('identifier', $user_identifiers);
						$this->db->update("users");
						$data = array("type" => "success", "alert" => "ซื้อไอเท็มเรียบร้อย");
					} else {
						$data = array("type" => "error", "alert" => "เกิดข้อผิดพลาด");
					}
					$this->db->set('point', $point_update);
					$this->db->where('identifier', $user_identifiers);
					$this->db->update("users");
				}
			}
		}
		exit(json_encode($data));
	}

    public function redeem_process()
    {
		if(empty($_SESSION["steam_personaname"])){
			exit(json_encode(array("type" => "warning","alert" => "กรุณาเข้าสู่ระบบก่อนใช้งาน")));
		}
        //$this->is_login('member');
        if ($post = $this->input->post()) {
            //============================================
            $users_info = $this->Genaral->get_users($_SESSION["steam_personaname"]);
            $user_data = json_decode($users_info);
            //============================================
            if ($user_data->player_info == "NOT_ONLINE") {
                $data = array(
                    "type" => "warning",
                    "alert" => "กรุณาออนไลน์ในเซิร์ฟเวอร์ด้วย",
                );
            } elseif ($user_data->player_info == "SERVER_DOWN") {
                $data = array(
                    "type" => "warning",
                    "alert" => "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์เกมส์ได้",
                );
            } elseif ($user_data->player_info == "NOT_ONLINE_PLAYERS") {
                $data = array(
                    "type" => "warning",
                    "alert" => "ไม่มีคนออนไลน์ในเซิร์ฟเวอร์",
                );
            } else {
                $user_id = $user_data->player_info->id;
                $user_identifiers = $user_data->player_info->identifiers[0];
                extract($post);
                if (strlen($code_id) != 6) {
                    $data = array("type" => "error", "alert" => "รหัสของขวัญไม่ \"6\" ตัวอักษร");
                } else {
                    $this->db->where("code_id", $code_id);
                    $redeem_query = $this->db->get("xd_redeem");
                    if ($redeem_query->num_rows()) {
                        $redeem = $redeem_query->result();
                        $use_code = json_decode($redeem[0]->use_code);
                        if (in_array($user_identifiers, $use_code)) {
                            $data = array("type" => "error", "alert" => "คุณใช้รหัสของขวัญนี้ไปแล้ว");
                        } else {
                            $use_code[] = $user_identifiers;
                            $use_codeupdate = json_encode($use_code);
                            if ($redeem[0]->type == "items") {
                                //============================================
                                $server_info = $this->db->get('xd_config');
                                $xd_setting = $server_info->result();
                                //============================================
                                $success = false;
                                $xdrcon = new XD_RCON();
                                $xdrcon->connector($xd_setting[0]->game_ip, $xd_setting[0]->game_port, $success);
                                //============================================
                                if (!$success) {
                                    $data = array(
                                        "type" => "error",
                                        "alert" => "ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้",
                                    );
                                } else {
                                    $xdrcon->setRconpassword($xd_setting[0]->game_rcon);
                                    $this->db->where('identifier', $user_identifiers);
                                    $cmd_sender = str_replace('[id]', $user_id, $redeem[0]->cmd);
                                    $xdrcon->rcon("$cmd_sender");
                                    if ($redeem[0]->multi == 1) {
                                        $this->db->query("UPDATE `xd_redeem` SET `use_code`= '$use_codeupdate' WHERE `code_id` = '$code_id'");
                                    } else {
                                        $this->db->where("code_id", $code_id);
                                        $this->db->delete('xd_redeem');
                                    }
                                    $data = array("type" => "success", "alert" => "ทำรายการสำเร็จ");
                                }
                            } else {
                                $point = $redeem[0]->cmd;
                                $identifier = $user_identifiers;
                                $this->db->query("UPDATE `users` SET `point`= `point` + $point WHERE `identifier` = '$identifier'");
                                if ($redeem[0]->multi == 1) {
                                    $this->db->query("UPDATE `xd_redeem` SET `use_code`= '$use_codeupdate' WHERE `code_id` = '$code_id'");
                                } else {
                                    $this->db->where("code_id", $code_id);
                                    $this->db->delete('xd_redeem');
                                }
                                $data = array("type" => "success", "alert" => "ทำรายการสำเร็จ");
                            }
                        }
                    } else {
                        $data = array("type" => "error", "alert" => "ไม่พบรหัสของขวัญในระบบ");
                    }
                }
            }
            exit(json_encode($data));
        } else {
            exit("XD-FIVEM | กรุณาเข้าให้ถูกทางด้วย");
        }
    }

}
