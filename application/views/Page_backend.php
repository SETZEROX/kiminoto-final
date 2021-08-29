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
                                <!-- เนื้อหา -->


                                <form action="<?= base_url('backend/sign-in'); ?>" method="POST">
                                    <center>
                                        <input type="text" class="form-control" name="bk_username" required placeholder="ชื่อผู้ใช้">
                                    </center>
                                    <center>
                                        <input type="password" class="form-control" name="bk_password" required placeholder="รหัสผ่าน">

                                        <br>
                                        <button type="submit" class="btn btn-block btn-success"><i class="fas fa-users-cog"></i> เข้าสู่ระบบ</button>
                                        <hr>
                                        <span><b>
                                                <font color="red">คำเตือน!</font>
                                            </b> การเข้าสู่ระบบหลังบ้านจะจัดการได้ทุกอย่าง ไม่ควรบอกรหัสผ่านให้กับใคร</span>
                                    </center>
                                </form>

                                <!-- เนื้อหา -->
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