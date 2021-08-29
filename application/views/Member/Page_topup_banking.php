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
                            <h2 class="title-1">เติมเงิน</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div id="alert"></div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover">
                                            <thead>
                                                <th>ช่องทาง</th>
                                                <th>รูป</th>
                                                <th>เลขที่บัญชี</th>
                                                <th>ชื่อบัญชี</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>กสิกรไทย</td>
                                                    <td><img width="32" src="<?= base_url('assets/images/favicon/kbank.png'); ?>"></td>
                                                    <td><?= $setting_info[0]->kbank_account_number; ?></td>
                                                    <td><?= $setting_info[0]->kbank_account_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>ไทยพาณิชย์</td>
                                                    <td><img width="32" src="<?= base_url('assets/images/favicon/scb.png'); ?>"></td>
                                                    <td><?= $setting_info[0]->scb_account_number; ?></td>
                                                    <td><?= $setting_info[0]->scb_account_name; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>
                                        <form action="<?= base_url('Payment/bank_checker'); ?>" enctype="multipart/form-data" method="POST">
                                            <h3>ช่องทางการชำระเงิน</h3>
                                            <select class="form-control" name="type">
                                                <option value="kbank">ชำระเงินผ่านธนาคารกสิกรไทย</option>
                                                <option value="scb">ชำระเงินผ่านธนาคารไทยพาณิชย์</option>
                                            </select>
                                            <input readonly style="text-align: center;" class="form-control" type="text" value="X <?= $setting_info[0]->topup_x; ?> เท่า">
                                            <br>
                                            <center>
                                                <h3>แจ้งโอนเงิน</h3>
                                            </center>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>จำนวนเงิน</label>
                                                    <input class="form-control" type="number" name="money_1">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label>สตางค์</label>
                                                    <input class="form-control" type="number" name="money_2">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>วันที่</label>
                                                    <input class="form-control" type="number" name="day">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>เดือน</label>
                                                    <input class="form-control" type="number" name="month">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>ปี คศ.</label>
                                                    <input class="form-control" type="number" name="year">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>เวลา (ชั่วโมง ใส่เลขตามสลิป)</label>
                                                    <input class="form-control" type="number" name="time_hr">
                                                </div>
                                                <div class="col-sm-4">
                                                    <label>เวลา (นาที ใส่เลขตามสลิป)</label>
                                                    <input class="form-control" type="number" name="time_m">
                                                </div>
                                            </div>
                                            <br>
                                            <?php
                                            if (isset($_SESSION['steamid'])) {
                                                echo '
							  					<button type="submit" class="btn btn-lg btn-success btn-block"><i class="fas fa-money-bill"></i> เติมเงิน</button>
							  					';
                                            } else {
                                                echo '<a href="'.base_url("sign-in").'" id="btn_topup" class="btn btn-lg btn-warning btn-block"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>';
                                            }
                                            ?>
                                        </form>
                                        <br>
                                        <div class="alert alert-warning">
                                            หากเลขเดือน หรือ วันมีเพียงตัวเดียวให้ใส่ 0 นำหน้าเช่น วันที่ 01 เดือน 05 ปี 2020 เวลาก็เช่นกัน มีตัวเดียวให้ใส่ 0 นำหน้า
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <?php if (isset($_SESSION["steam_personaname"])) : ?>
                                            <div class="col-sm-12">
                                                <hr>
                                                <center>
                                                    <h3>ประวัติรายการเติมเงิน</h3>
                                                </center>
                                                <table id="example" class="table-bordered table">
                                                    <thead>
                                                        <th>#</th>
                                                        <th>เลขที่อ้างอิง</th>
                                                        <th>สถานะ</th>
                                                        <th>ช่องทาง</th>
                                                        <th>จำนวน</th>
                                                        <th>วันที่</th>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (isset($_SESSION["steam_personaname"])) {
                                                            $this->db->where('name', $_SESSION["steam_personaname"]);
                                                            $player_query = $this->db->get("users");
                                                            $player = $player_query->result();
                                                        }
                                                        $this->db->where('steam_identifier', $player[0]->identifier);
                                                        $topup_his = $this->db->get('xd_topup');
                                                        $topup = array();
                                                        $i = 0;
                                                        foreach ($topup_his->result() as $topup[0]) {
                                                            $i++;
                                                            echo

                                                            '
						  					<tr>
						  						<td>' . $i . '</td>
						  						<td>' . $topup[0]->transaction_id . '</td>
						  						<td>';
                                                            if ($topup[0]->status == 'failed') {
                                                                echo '<font color="red">ไม่สำเร็จ</font>';
                                                            } else {
                                                                echo "<font color='green'>สำเร็จ</font>";
                                                            }
                                                            echo '</td>
						  						<td>';
                                                            if ($topup[0]->type == "tmweasy_wallet") {
                                                                echo '<img class="img-responsive" width="26" src="' . base_url('assets/images/favicon/wallet.jpg') . '">';
                                                            } elseif ($topup[0]->type == "Kbank_gateway") {
                                                                echo '<img class="img-responsive" width="26" src="' . base_url('assets/images/favicon/kbank.png') . '">';
                                                            } elseif ($topup[0]->type == "Scb_gateway") {
                                                                echo '<img class="img-responsive" width="26" src="' . base_url('assets/images/favicon/scb.png') . '">';
                                                            }
                                                            echo '</td>
						  						<td>' . $topup[0]->amount . '</td>
						  						<td>';
                                                            $date = date_create($topup[0]->date);
                                                            echo date_format($date, "d/m/Y") . '</td>
						  					</tr>
';    # code...
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php endif; ?>
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
<script>
    $("#btn_topup").click(function() {
        window.location.href = "<?= base_url('Payment/Wallet_checker/?tel='); ?>" + $("#telephone").val() + "&amount=" + $("#amount").val();
    });
</script>