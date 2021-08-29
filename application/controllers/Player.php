<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Player extends CI_Controller {

	public function index()
	{
		$this->load->view('Home');
	}
	public function get_player(){
		if($get = $this->input->get()){

			function GAMERXD_CKPLAYER($url){
			    $ch = curl_init();

			    curl_setopt($ch, CURLOPT_HEADER, 0);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			    curl_setopt($ch, CURLOPT_URL, $url);
			    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

			    if($data = curl_exec($ch)){
			    	return $data;
			    }else{
			    	$datas = array('status' => 'false');
			    	return json_encode($datas);
			    }
			    curl_close($ch);
			}

			$server_info = $this->db->get('xd_setting');
			$xd_setting = $server_info->result();
			$api_player = json_decode(GAMERXD_CKPLAYER("http://".$xd_setting[0]->game_ip."/players.json"));
			$api_server = json_decode(GAMERXD_CKPLAYER("http://".$xd_setting[0]->game_ip."/info.json"));
			/*echo '<pre>';
				print_r($api_server);
			echo '<pre>';*/
			if(isset($api_player->status)){
				$data = $arrayName = array(
					'status' => $api_player->status, 
					'status_en' => 'offline', 
					'game_ip' => $xd_setting[0]->game_ip,
					'webslite_yt' => $xd_setting[0]->webslite_yt,
					'sv_maxclients' => '0'
				);
			}else{
				if(count($api_player) == 0){
					$data = $arrayName = array(
						'status' => 'true', 
						'status_en' => 'online',
						'player' => 0,
						'game_ip' => $xd_setting[0]->game_ip,
						'sv_maxclients' => $api_server->vars->sv_maxClients,
					);
				}else{
					$data = $arrayName = array(
						'status' => 'true', 
						'status_en' => 'online',
						'player' => count($api_player),
						'game_ip' => $xd_setting[0]->game_ip,
						'sv_maxclients' => $api_server->vars->sv_maxClients,
					);
				}
			}
			echo json_encode($data);
		}else{
			echo 'XD-STUDIO | PRODUCT BY <a href="https://www.facebook.com/keattipoomz.poomz">ENGINE-WEB.NET</a>';
		}
	}
}
