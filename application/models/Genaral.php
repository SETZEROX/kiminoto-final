<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Genaral extends CI_Model
{

	public function redir($target)
	{
		$url = '<script>window.location.href = "' . base_url($target) . '"</script>';
		return $url;
	}

	public 	function is_stringz($str)
	{
		if (!preg_match("/^[a-zA-Z0-9_-]+$/", $str)) {
			return false;
		} else {
			return true;
		}
	}

	public function incrementalHash($len = 5)
	{
		$charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
		$base = strlen($charset);
		$result = '';

		$now = explode(' ', microtime())[1];
		while ($now >= $base) {
			$i = $now % $base;
			$result = $charset[$i] . $result;
			$now /= $base;
		}
		return substr($result, -5);
	}

	public function website($fields)
	{
		$website_query = $this->db->get("tlb_config");
		$website = $website_query->result();

		return $website[0]->$fields;
	}

	public function cklogin($str)
	{
		if ($str == "member") {
			if (!$this->session->userdata("login_state")) {
				return false;
			} else {
				return true;
			}
		} elseif ($str == "backend") {
			if (!$this->session->userdata("login_state_bk")) {
				return false;
			} else {
				return true;
			}
		}
	}
	public	function gen_transactionid($con_id, $years, $month, $day, $time_hr, $time_m, $money_1, $money_2)
	{
		$transactionid = $con_id . $years . $month . $day . $time_hr . $time_m . $money_1 . $money_2;
		return $transactionid;
	}
	public	function alert($alert = "", $type = "", $target = "")
	{
		echo
		'
		<html>
		<head>
			<title>XD-STUDIO | BY ENGINE-WEB</title>
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
			<link href="'.base_url('assets/sweetalert/dist/sweetalert.css').'" rel="stylesheet">
    <script src="'.base_url('assets/sweetalert/dist/sweetalert.min.js').'"></script>
		</head>
		<body>
		<script>
				swal({
					title: "แจ้งเตือน",
					text: "' . $alert . '",
					type: "' . $type . '",
					showCancelButton: false,
					confirmButtonClass: "btn-primary",
					confirmButtonText: "OK",
					cancelButtonText: "No, cancel plx!",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm) {
					if (isConfirm) {
						window.location.href = "' . $target . '";
					}
				});
					</script>
					</body>
			</html>
		';
	}

	public function get_users($names)
	{
		if ($names) :
			function GAMERXD_CKPLAYER($url)
			{
				$ch = curl_init();

				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

				if ($data = curl_exec($ch)) {
					return $data;
				} else {
					$datas = array('status' => 'false');
					return json_encode($datas);
				}
				curl_close($ch);
			}

			$server_info = $this->db->get('xd_setting');
			$xd_setting = $server_info->result();
			$api_player = json_decode(GAMERXD_CKPLAYER("http://" . $xd_setting[0]->game_ip . "/players.json"));

			if (isset($api_player->status)) {
				$data = array(
					'status' => 'false',
					'player_info' => "SERVER_DOWN",
				);
			} else {
				$i = 0;
				$users = array();
				foreach ($api_player as $users[0]) {
					if ($api_player[$i]->name == $names) {
						$data = array(
							'status' => 'true',
							'player_info' => $api_player[$i],
						);
						break;
					} else {
						$data = array(
							'status' => 'true',
							'player_info' => 'NOT_ONLINE',
						);
					}
					$i++;
				}
				if (count($api_player) == 0) {
					$data = array(
						'status' => 'true',
						'player_info' => "NOT_ONLINE_PLAYERS",
					);
				}
			}
			return json_encode($data);
		endif;
	}
}
