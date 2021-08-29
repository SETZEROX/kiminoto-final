<?php $this->load->view('Template/Backend/Temp_head'); ?>
<?php $this->load->view('Template/Backend/Temp_navbar'); ?>
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
                            <h2 class="title-1">จัดการหน้าเติมเงิน</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <center>
                                            <h2>จัดการบัญชี</h2>
                                        </center>
                                        <form action="<?= base_url('Backend/update_topup_account'); ?>" method="POST">
                                            <div class="form-group">
                                                <code><label>ชื่อผู้ใช้งาน TMWEASY</label></code>
                                                <input placeholder="ชื่อผู้ใช้งาน TMWEASY" class="form-control" type="text" value="<?= $data[0]->tmapi_user; ?>" name="tmapi_user">
                                            </div>
                                            <div class="form-group">
                                                <code><label>รหัสผ่าน TMWEASY</label></code>
                                                <input placeholder="รหัสผ่าน TMWEASY" class="form-control" type="text" value="<?= $data[0]->tmpapi_password; ?>" name="tmpapi_password">
                                            </div>
                                            <div class="form-group">
                                                <code><label>อีเมล์ ทรูมันนี่วอเลต</label></code>
                                                <input placeholder="อีเมล์ ทรูมันนี่วอเลต" class="form-control" type="text" value="<?= $data[0]->truewall_email; ?>" name="truewall_email">
                                            </div>
                                            <div class="form-group">
                                                <code><label>รหัสผ่านของบัญชีวอเลตไม่ใช่ PIN (ต้องนำไปเข้ารหัสในเว็บ Tmweasy ก่อน <a href="https://www.tmweasy.com/encode.php" target="_blank">Click</a>)</label></code>
                                                <input placeholder="รหัสผ่าน 6 หลัก (ต้องนำไปเข้ารหัสในเว็บ Tmweasy ก่อน)" class="form-control" type="text" value="<?= $data[0]->truepassword; ?>" name="truepassword">
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <code><label>ชื่อบัญชี ธนาคารกสิกรไทย</label></code>
                                                <input placeholder="ชื่อบัญชี ธนาคารกสิกรไทย" class="form-control" type="text" value="<?= $data[0]->kbank_account_name; ?>" name="kbank_account_name">
                                            </div>
                                            <div class="form-group">
                                                <code><label>เลขบัญชี ธนาคารกสิกรไทย</label></code>
                                                <input placeholder="เลขบัญชี ธนาคารกสิกรไทย" class="form-control" type="text" value="<?= $data[0]->kbank_account_number; ?>" name="kbank_account_number">
                                            </div>
                                            <div class="form-group">
                                                <code><label>encoder id ธนาคารกสิกรไทย</label></code>
                                                <input placeholder="encoder id ธนาคารกสิกรไทย" class="form-control" type="text" value="<?= $data[0]->kbank_encoder_id; ?>" name="kbank_encoder_id">
                                            </div>
                                            <div class="form-group">
                                                <code><label>con id ธนาคารกสิกรไทย</label></code>
                                                <input placeholder="con id ธนาคารกสิกรไทย" class="form-control" type="text" value="<?= $data[0]->kbank_con_id; ?>" name="kbank_con_id">
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <code><label>ชื่อบัญชี ธนาคารไทยพาณิชย์</label></code>
                                                <input placeholder="ชื่อบัญชี ธนาคารไทยพาณิชย์" class="form-control" type="text" value="<?= $data[0]->scb_account_name; ?>" name="scb_account_name">
                                            </div>
                                            <div class="form-group">
                                                <code><label>เลขบัญชี ธนาคารไทยพาณิชย์</label></code>
                                                <input placeholder="เลขบัญชี ธนาคารไทยพาณิชย์" class="form-control" type="text" value="<?= $data[0]->scb_account_number; ?>" name="scb_account_number">
                                            </div>
                                            <div class="form-group">
                                                <code><label>encoder id ธนาคารไทยพาณิชย์</label></code>
                                                <input placeholder="encoder id ธนาคารไทยพาณิชย์" class="form-control" type="text" value="<?= $data[0]->scb_encoder_id; ?>" name="scb_encoder_id">
                                            </div>
                                            <div class="form-group">
                                                <code><label>con id ธนาคารไทยพาณิชย์</label></code>
                                                <input placeholder="con id ธนาคารไทยพาณิชย์" class="form-control" type="text" value="<?= $data[0]->scb_con_id; ?>" name="scb_con_id">
                                            </div>
                                            <button type="submit" id="btn_topup" class="btn btn-lg btn-success btn-block"><i class="fas fa-save"></i> บันทึก</button>
                                            <a href="https://www.tmweasy.com/" target="_blank" class="btn btn-lg btn-danger btn-block"><i class="fas fa-cube"></i> ไปยังเว็บ TMWEASY.COM</a>
                                            <hr>
                                            <div class="alert alert-info"><label class="label label-danger">แนะนำ</label> ทางเราไม่มีส่วนเกี่ยวข่องในการพัฒนาระบบ Wallet Api </div>
                                        </form>
                                    </div>
                                    <div class="col-sm-6">
                                        <center>
                                            <h2>จัดการเรทเติมเงิน</h2>
                                        </center>
                                        <form action="<?= base_url('Backend/update_topup_rate'); ?>" method="POST">
                                            <div class="form-group">
                                                <code>จำนวนการคุณของการเติมเงิน</code>
                                                <div class="input-group">
                                                    <input type="number" value="<?= $data[0]->topup_x; ?>" class="form-control" name="topup_x">
                                                    <div class="input-group-addon">$</div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <code>จำนวนโบนัสการเติม</code>
                                                    <input type="number" value="<?= $data[0]->topup_reword; ?>" class="form-control" name="topup_reword">
                                            </div>
                                            <button type="submit" id="btn_topup" class="btn btn-lg btn-success btn-block"><i class="fas fa-save"></i> บันทึก</button>
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
<script>
    function switcher(types) {
        if (types == 1) {
            var url = 'sw_wallet';
        } else if (types == 2) {
            var url = 'sw_kbank';
        } else if (types == 3) {
            var url = 'sw_scb';
        }
        $.ajax({
            type: "POST",
            data: {
                data: "switcher_wallet"
            },
            url: "<?= base_url('Backend/switcher/'); ?>" + url,
            dataType: 'json',
            success: function(data) {
                if (data.status == "complete_on") {
                    $("#display_status_" + data.id).html('<font color="green">เปิดการใช้งาน</font>');
                } else {
                    $("#display_status_" + data.id).html('<font color="red">ปิดการใช้งาน</font>');
                }
            }
        });
    };
</script>

<?php $this->load->view('Template/Temp_footer'); ?>