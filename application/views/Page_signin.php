<?php $this->load->view('Template/Temp_head'); ?>
<?php $this->load->view('Template/Temp_topbar_mobile'); ?>
<?php $this->load->view('Template/Temp_navbar'); ?>
<!-- PAGE CONTAINER-->
<div class="page-container">
    <?php $this->load->view('Template/Temp_topbar_desktop'); ?>

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">เข้าสู่ระบบ</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <?php
                                    function loginbutton($buttonstyle = "square")
                                    {
                                        $button['rectangle'] = "01";
                                        $button['square'] = "02";
                                        $button = '<a href="?login" class="btn btn-outline-primary btn-lg"><i class="fab fa-steam-square"></i> SIGN-IN WITH STEAM</a>';

                                        echo $button;
                                    }
                                    loginbutton();
                                    if (isset($_GET['login'])) {
                                        try {
                                            $steamauth['loginpage'] = base_url('store');
                                            $steamauth['domainname'] = base_url();
                                            $steamauth['apikey'] = $data[0]->apikey;
                                            $steamauth['logoutpage'] = base_url('sign-in');

                                            $openid = new LightOpenID();
                                            $openid->login($steamauth['domainname']);

                                            if (!$openid->mode) {
                                                $openid->identity = 'https://steamcommunity.com/openid';
                                                header('Location: ' . $openid->authUrl());
                                            } elseif ($openid->mode == 'cancel') {
                                                $notify = array("alert" => 'คุณได้ยกเลิกการตรวจสอบสิทธิเข้าสู่ระบบ', "type" => 'error');
                                            } else {
                                                if ($openid->validate()) {
                                                    $id = $openid->identity;
                                                    $ptn = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
                                                    preg_match($ptn, $id, $matches);
                                                    $_SESSION['steamid'] = $matches[1];
                                                    if (empty($_SESSION['steam_uptodate']) or empty($_SESSION['steam_personaname'])) {
                                                        $url = file_get_contents("https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $steamauth['apikey'] . "&steamids=" . $_SESSION['steamid']);
                                                        $content = json_decode($url, true);
                                                        $_SESSION['steam_steamid'] = $content['response']['players'][0]['steamid'];
                                                        $_SESSION['steam_communityvisibilitystate'] = $content['response']['players'][0]['communityvisibilitystate'];
                                                        $_SESSION['steam_profilestate'] = $content['response']['players'][0]['profilestate'];
                                                        $_SESSION['steam_personaname'] = $content['response']['players'][0]['personaname'];
                                                        $_SESSION['steam_lastlogoff'] = $content['response']['players'][0]['lastlogoff'];
                                                        $_SESSION['steam_profileurl'] = $content['response']['players'][0]['profileurl'];
                                                        $_SESSION['steam_avatar'] = $content['response']['players'][0]['avatar'];
                                                        $_SESSION['steam_avatarmedium'] = $content['response']['players'][0]['avatarmedium'];
                                                        $_SESSION['steam_avatarfull'] = $content['response']['players'][0]['avatarfull'];
                                                        $_SESSION['steam_personastate'] = $content['response']['players'][0]['personastate'];
                                                        if (isset($content['response']['players'][0]['realname'])) {
                                                            $_SESSION['steam_realname'] = $content['response']['players'][0]['realname'];
                                                        } else {
                                                            $_SESSION['steam_realname'] = "Real name not given";
                                                        }
                                                        $_SESSION['steam_primaryclanid'] = $content['response']['players'][0]['primaryclanid'];
                                                        $_SESSION['steam_timecreated'] = $content['response']['players'][0]['timecreated'];
                                                        $_SESSION['steam_uptodate'] = time();
                                                    }

                                                    $steamprofile['steamid'] = $_SESSION['steam_steamid'];
                                                    $steamprofile['communityvisibilitystate'] = $_SESSION['steam_communityvisibilitystate'];
                                                    $steamprofile['profilestate'] = $_SESSION['steam_profilestate'];
                                                    $steamprofile['personaname'] = $_SESSION['steam_personaname'];
                                                    $steamprofile['lastlogoff'] = $_SESSION['steam_lastlogoff'];
                                                    $steamprofile['profileurl'] = $_SESSION['steam_profileurl'];
                                                    $steamprofile['avatar'] = $_SESSION['steam_avatar'];
                                                    $steamprofile['avatarmedium'] = $_SESSION['steam_avatarmedium'];
                                                    $steamprofile['avatarfull'] = $_SESSION['steam_avatarfull'];
                                                    $steamprofile['personastate'] = $_SESSION['steam_personastate'];
                                                    $steamprofile['realname'] = $_SESSION['steam_realname'];
                                                    $steamprofile['primaryclanid'] = $_SESSION['steam_primaryclanid'];
                                                    $steamprofile['timecreated'] = $_SESSION['steam_timecreated'];
                                                    $steamprofile['uptodate'] = $_SESSION['steam_uptodate'];
                                                    $users_info = $Genaral->get_users($_SESSION["steam_personaname"]);
                                                    $user_data = json_decode($users_info);
                                                    //var_dump($user_data);
                                                    if ($user_data->player_info == "NOT_ONLINE") {
                                                        $notify = array(
                                                            "alert" => 'กรุณาอออนไลน์ในเกมส์ก่อนใช้งาน',
                                                            "type" => 'warning',
                                                        );
                                                        $this->session->all_userdata();
                                                        $this->session->unset_userdata("login_state");
                                                        $this->session->sess_destroy();
                                                    } elseif ($user_data->player_info == "SERVER_DOWN") {
                                                        $notify = array(
                                                            "alert" => 'เซิฟเวอร์ไม่ตอบสนอง',
                                                            "type" => 'warning',
                                                        );
                                                        $this->session->all_userdata();
                                                        $this->session->unset_userdata("login_state");
                                                        $this->session->sess_destroy();
                                                    } elseif ($user_data->player_info == "NOT_ONLINE_PLAYERS") {
                                                        $notify = array(
                                                            "alert" => 'กรุณาอออนไลน์ในเกมส์ก่อนใช้งาน',
                                                            "type" => 'warning',
                                                        );
                                                        $this->session->all_userdata();
                                                        $this->session->unset_userdata("login_state");
                                                        $this->session->sess_destroy();
                                                    } else {
                                                        $user_identifiers = $user_data->player_info->identifiers[0];
                                                        $user_backpack = $user_data->player_info->id;
                                                        $_SESSION['login_state'] = true;
                                                        $_SESSION["identifier"] = $user_identifiers;
                                                        $_SESSION["backpack"] = $user_backpack;
                                                        $notify = array("alert" => 'เข้าสู่ระบบสำเร็จ', "type" => 'success');
                                                    }
                                                } else {
                                                    $notify = array("alert" => 'ไม่สามารถเข้าสู่ระบบได้', "type" => 'error');
                                                }
                                            }
                                        } catch (ErrorException $e) {
                                            $this->Genaral->alert($e->getMessage(), 'error', $steamauth['loginpage']);
                                        }
                                        $_SESSION['login_state'] = true;
                                        $_SESSION["identifier"] = 'steam:110000144cc650d';
                                        $_SESSION["backpack"] = 23;
                                        $this->Genaral->alert($notify['alert'], $notify['type'], $steamauth['loginpage']);
                                    }
                                    ?>
                                </center>
                                <center>
                                    <hr>
                                    <span>การเข้าสู่ระบบเพื่อใช้งานเว็บไซต์นั้น ต้องเข้าเกมส์และสร้างตัวละครก่อนที่จะซื้อไอเท็มและการใช้งานระบบทุกครั้งจำเป็นต้องออนไลน์ภายในเซิฟเวอร์ก่อน!</span>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="copyright">
                            <p>Copyright © 2018 Kiminoto Network. All rights reserved. System by <a href="https://xd-studio.net">XD-STUDIO</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->
</div>
<?php $this->load->view('Template/Temp_footer'); ?>