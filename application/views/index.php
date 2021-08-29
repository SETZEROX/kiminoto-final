<?php $this->load->view('Template/Temp_head'); ?>
<?php $this->load->view('Template/Temp_topbar_mobile'); ?>
<?php $this->load->view('Template/Temp_navbar'); ?>
<!-- PAGE CONTAINER-->
<div class="page-container">
    <?php $this->load->view('Template/Temp_topbar_desktop'); ?>
    <script type="text/javascript">
        function XD_PLAYERS() {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "<?= base_url('Player/get_player?server=XD_STUDIO'); ?>");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    data = JSON.parse(xhr.responseText);
                    if (data.status_en == "online") {
                        $("#player_online").text(data.player);
                    } else {
                        $("#player_online").text(0);
                    }
                }
            }
            xhr.send();
        }


        XD_PLAYERS();
        setInterval(function() {
            XD_PLAYERS();
        }, 1 * 1000);
    </script>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">หน้าแรก</h2>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-circle"></i>
                                    </div>
                                    <div class="text">
                                        <h2 id="player_online"></h2>
                                        <span>คนออนไลน์</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c2">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?= $count_product; ?></h2>
                                        <span>ไอเท็มในร้านค้า</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-accounts"></i>
                                    </div>
                                    <div class="text">
                                        <h2><?= $count_players; ?></h2>
                                        <span>สมาชิกทั้งหมด</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <a href="<?= $setting_info[0]->fb_link; ?>">
                            <img src="https://gamingroom.co/wp-content/uploads/2017/08/Facebook-banner.png">
                        </a>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-8">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <?php
                                $slider = array();
                                $slider_query = $this->db->query("SELECT * FROM `xd_slider`");
                                $slider_q = $slider_query->result();
                                $i = 0;
                                foreach ($slider_q as $slider[0]) {

                                    echo

                                    '
                                    <div class="carousel-item ';
                                    if ($i == 0) {
                                        echo 'active ';
                                    }
                                    echo '">
                                        <img class="d-block w-100" src="' . $slider[0]->img . '" alt="First slide">
                                    </div>
                                ';
                                    $i++;
                                }
                                ?>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <a href="<?=$setting_info[0]->discord;?>" class="btn btn-block btn-warning btn-lg"><i class="fab fa-discord fa-2x"></i>
                                    <center>DISCORD</center>
                                </a>
                                <a href="<?= base_url('download'); ?>" class="btn btn-block btn-primary btn-lg"><i class="fa fa-download fa-2x"></i>
                                    <center>DOWNLOAD</center>
                                </a>
                                <a href="<?= base_url('sign-in'); ?>" class="btn btn-block btn-success btn-lg"><i class="fas fa-sign-in-alt fa-2x"></i>
                                    <center>SIGN-IN</center>
                                </a>
                                <hr>
                                <span>
                                    <i class="fas fa-exclamation"></i> กรุณาเข้าเกมส์ก่อน 1 ครั้งเพื่อให้พบข้อมูลภายในเกมส์และสร้างตัวละครในเมืองก่อนเข้าใช้งานระบบ
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive table--no-card m-b-40">
                            <table class="table table-borderless table-striped table-earning">
                                <thead>
                                    <tr>
                                        <th>ประกาศ</th>
                                        <th>วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $anoc = array();
                                    foreach ($announcement_info as $anoc[0]) {
                                        echo
                                        '
                                        <tr>
                                            <td><a href="' . base_url('Page/announce/' . $anoc[0]->id) . '">' . $anoc[0]->post . '</a></td>
                                            <td>' . $anoc[0]->date . '</td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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