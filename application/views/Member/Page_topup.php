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
                                    <div class="col-sm-4">
                                        <img src="https://cdn.truemoney.com/wp-content/uploads/2018/09/logo-truemoneywallet-300x300.jpg">
                                        <h4>เรทการเติมเงินจะคูณ : <?= $setting_info[0]->topup_x; ?></h4>
                                    </div>
                                    <div class="col-sm-8">

                                        <form onSubmit='post_ajax("<?= base_url('Topup/wallet'); ?>",$(this).serialize());return false;' method="POST">
                                            <div class="form-group">
                                                <label>หมายเลขโทรศัพท์มือถือ</label>
                                                <input class="form-control" value="<?= $data[0]->tel; ?>" readonly type="number" required>
                                            </div>
                                            <hr>
                                            <div class="form-group">
                                                <label>กรุณาใส่เบอร์ที่ใช้โอนเงิน</label>
                                                <input class="form-control" name="telephone" id="telephone" placeholder="หมายเลขอ้างอิง" type="number" required>
                                            </div>
                                            <div class="form-group">
                                                <label>กรุณาใส่จำนวนที่โอน</label>
                                                <input class="form-control" name="amount" id="amount" placeholder="หมายเลขอ้างอิง" type="number" required>
                                            </div>
                                            <div class="form-group">
                                                <?php
                                                if (isset($_SESSION['steamid'])) {
                                                    echo '
								  					<button id="btn_topup" class="btn btn-lg btn-success btn-block"><i class="fas fa-money-bill"></i> เติมเงิน</button>
								  					';
                                                } else {
                                                    echo '<a href="' . base_url('sign-in') . '" id="btn_topup" class="btn btn-lg btn-warning btn-block"><i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ</a>';
                                                }
                                                ?>
                                            </div>
                                        </form>
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