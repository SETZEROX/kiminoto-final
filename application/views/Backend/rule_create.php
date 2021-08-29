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
                            <h2 class="title-1">จัดการหน้ากฏของเซิฟเวอร์</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="<?= base_url('Backend/rule_plus'); ?>" method="POST">
                                ชื่อหัวข้อ
                                    <input class="form-control" type="text" required name="title" placeholder="ชื่อหัวข้อ">
                                    <br>
                                    รายละเอียด
                                    <textarea name="editor1"></textarea>
                                    <hr>
                                    <button class="btn btn-lg btn-outline-primary"><i class="fas fa-plus"></i> สร้าง</button>
                                </form>
                                <script>
                                    CKEDITOR.replace('editor1');
                                </script>
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