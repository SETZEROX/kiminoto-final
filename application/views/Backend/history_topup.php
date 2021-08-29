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
                            <h2 class="title-1">ประวัติการเติมเงิน</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <table id="example" class="table-bordered table">
                                    <thead>
                                        <th>#</th>
                                        <th>เลขที่อ้างอิง</th>
                                        <th>ผู้เติม</th>
                                        <th>สถานะ</th>
                                        <th>ช่องทาง</th>
                                        <th>จำนวน</th>
                                        <th>วันที่</th>
                                        <th>ตัวเลือก</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $topup_his = $this->db->get('xd_topup');
                                        $topup = array();
                                        $i = 0;
                                        foreach ($topup_his->result() as $topup[0]) {
                                            $this->db->where("identifier",$topup[0]->steam_identifier);
                                            $players = $this->db->get('users');
                                            $player = $players->result();
                                            $i++;
                                            echo

                                            '
						  					<tr>
						  						<td>' . $i . '</td>
						  						<td>' . $topup[0]->transaction_id . '</td>
                                                <td>'.$player[0]->name.'</td>
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
                                            <td><button 
                                            data-name="'.$player[0]->name.'"
                                            data-img="' . base_url('assets/images/slip/' . $topup[0]->slip_img) . '"
                                            data-toggle="modal" data-target="#info" class="btn btn-block btn-primary open-info"><i class="fa fa-eye"></i> View</button></td>
						  					</tr>
';    # code...
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
<!-- Modal -->
<div class="modal fade" id="info" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">SLIP - IMAGE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <h3>ผู้เติม: <b id="name"></b></h3>
            <hr>
                    <img id="img" src="">
                    <hr>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('Template/Temp_footer'); ?>
<script type="text/javascript">
    $(document).on("click", ".open-info", function() {
        var img = $(this).data('img');
        var name = $(this).data('name');
        $('.modal-body #name').text(name);
        $('.modal-body #img').attr('src', img);
    });
</script>