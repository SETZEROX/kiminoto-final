<?php $this->load->view('Template/Backend/Temp_head'); ?>
<?php $this->load->view('Template/Backend/Temp_navbar'); ?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>
<!-- PAGE CONTAINER-->
<div class="page-container">
    <?php $this->load->view('Template/Backend/Temp_topbar_desktop'); ?>

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">ทั่วไป</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <h3>ทั่วไป</h3>
                                        <hr>
                                        <form action="<?= base_url('Backend/update_genaral'); ?>" method="POST">
                                            <label>ชื่อเซิฟเวอร์</label>
                                            <input type="text" class="form-control" value="<?= $data[0]->server_names; ?>" name="name">
                                            <label>ภาพพื้นหลังเว็บไม่มีปล่อยว่างไว้</label>
                                            <input type="text" class="form-control" value="<?= $data[0]->website_background; ?>" name="website_background">
                                            <label>ID เพจ หรือ ตัวอักษรก็ได้</label>
                                            <input type="text" class="form-control" value="<?= $data[0]->fb_link; ?>" name="fb_link">
                                            <label>Discord Link</label>
                                            <input type="text" class="form-control" value="<?= $data[0]->discord; ?>" name="discord">
                                            <hr>
                                            <button type="submit" class="btn btn-xs btn-success"><i class="fas fa-save"></i> บันทึก</button>
                                        </form>
                                        <br>
                                        <h3>ประกาศ <button data-toggle="modal" data-target="#announcement_plus" style="float: right;" class="btn btn-xs btn-success"><i class="fas fa-plus"></i> เพิ่มมประกาศ</button></h3>

                                        <table class="table table-bordered">
                                            <tbody>
                                                <?php
                                                $this->db->limit(5);
                                                $announcement_query = $this->db->get('xd_announcement');
                                                $xd_annoc = $announcement_query->result();
                                                $annoce = array();
                                                foreach ($xd_annoc as $annoce) {
                                                    echo '<tr>';
                                                    echo '<td>' . $annoce->post . '</td>';
                                                    echo '<td align="right">
								  		<button data-toggle="modal" data-target="#announcement_plus_' . $annoce->id . '" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></button>
								  		<a href="' . base_url("Backend/announcement_delete/?id=" . $annoce->id) . '" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>

								  		</td>';
                                                    echo '</tr>';

                                                    echo '

                                                    <div class="modal fade" id="announcement_plus_' . $annoce->id . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header modal-lg">
                                                          <h5 class="modal-title" id="exampleModalCenterTitle">แก้ไขประกาศ</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="' . base_url("Backend/announcement_update") . '" method="POST">
                                                        <input type="hidden" value="' . $annoce->id . '" name="id">
                                                        <input type="text" required placeholder="ประกาศของคุณ" value="' . $annoce->post . '" name="announcement_msg" class="form-control">
                                                        <br>
                                                        <textarea name="details"></textarea>
                                                        <script>
                                                            CKEDITOR.replace("details");
                                                        </script>
                                                        </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
                                                        <button type="submit" class="btn btn-primary">บันทึก</button>
                                                    </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                            ';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <h3><i class="fab fa-steam"></i> API KEY STEAM</h3>
                                        <form action="<?= base_url('Backend/update_key'); ?>" method="POST">
                                            <label>กรุณากรอก API KEY STEAM</label>
                                            <input type="text" name="apikey" value="<?= $data[0]->apikey; ?>" class="form-control">
                                            <hr>
                                            <div class="alert alert-info">เข้าเว็บไปขอ Key ได้ที่ <a href="https://steamcommunity.com/dev/apikey" target="_blank">STEAM DEV</a></div>
                                            <button class="btn btn-xs btn-success btn-block"><i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง</button>
                                        </form>
                                    </div>
                                    <div class="col-sm-4">
                                        <h3><i class="fas fa-signal"></i> สถานะเซิฟเวอร์</h3>
                                        <hr>
                                        <p><i class="fas fa-server"></i> SERVER: <font color="green">ปกติ</font> / ( MINETHOST.COM )</p>
                                        <p><i class="fas fa-gamepad"></i> API: <font color="green">ปกติ</font>
                                        </p>
                                        <p><i class="fas fa-store"></i> STORE: <font color="green">ปกติ</font>
                                        </p>
                                        <hr>
                                        <form action="<?= base_url('Backend/update_game'); ?>" method="POST">
                                            <div class="form-group">
                                                <label>ไอพีเซิฟเวอร์</label>
                                                <input type="text" value="<?= $data[0]->game_ip; ?>" class="form-control" name="game_ip">
                                            </div>
                                            <button type="submit" class="btn btn-xs btn-success btn-block"><i class="fas fa-save"></i> บันทึก</button>
                                        </form>
                                        <hr>
                                        <h3><i class="fab fa-slideshare"></i> สไลด์ <button data-toggle="modal" data-target="#slide_plus" style="float: right;" class="btn btn-xs btn-success"><i class="fas fa-plus"></i> เพิ่มสไลด์</button></h3>
                                        <br>
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
                                        <hr>
                                        <button data-toggle="modal" data-target="#slide_edit" class="btn btn-xs btn-warning btn-block"><i class="fas fa-edit"></i> จัดการรูป</button>
                                        <hr>
                                        <h3><i class="fas fa-key"></i> รหัสผ่าน Rcon</h3>
                                        <form action="<?= base_url('Backend/update_rcon'); ?>" method="POST">
                                            <label>รหัสผ่าน Rcon ที่ตั้งใน Server.cfg (กรุณาเปิด rcon_password "xdfivem" ใน server.cfg)</label>
                                            <input type="text" name="password_rcon" value="<?= $data[0]->game_rcon; ?>" class="form-control" maxlength="20">
                                            <hr>
                                            <button class="btn btn-xs btn-success btn-block"><i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง</button>
                                        </form>
                                    </div>
                                </div>
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

<div class="modal fade" id="announcement_plus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มประกาศ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/announcement_plus'); ?>" method="POST">
                    <input type="text" required placeholder="ประกาศของคุณ" name="announcement_msg" class="form-control">
                    <br>
                    <textarea name="detail"></textarea>
                    <script>
                        CKEDITOR.replace("detail");
                    </script>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
                <button type="submit" class="btn btn-primary">เพิ่มประกาศ</button>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="slide_plus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มรูปภาพ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/slide_plus'); ?>" method="POST">
                    <input type="url" required placeholder="ลิงค์รูปภาพ" name="slide_url" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
                <button type="submit" class="btn btn-primary">เพิ่มรูปภาพ</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="slide_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">จัดการภาพแนะนำ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table-bordered table">
                    <thead></thead>
                    <tbody>

                        <?php
                        $xd_slider = $this->db->get('xd_slider');
                        $xd_slide = $xd_slider->result();
                        $slide = array();
                        foreach ($xd_slide as $slide) {

                            echo '<tr>';
                            echo '<td><div><a href="#"><img width="150" src="' . $slide->img . '"></a></div></td>';
                            echo '<td><a href="' . base_url("Backend/slide_delete/?id=" . $slide->id) . '" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
            </div>
        </div>
    </div>
</div>