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
                            <h2 class="title-1">ไอเท็มในตัวของคุณ</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    $invse_all = array();
                                    foreach ($invse_alls as $invse_all[0]) {
                                        $this->db->where('name', $invse_all[0]->item);
                                        $item_sel = $this->db->get("items");
                                        if($item = $item_sel->result()){

                                        echo
                                        '
                                            <div class="card" style="width: 17.4rem;">
                                            <center><img width="64px" src="' . base_url('assets/images/items/' . $invse_all[0]->item . '.png') . '" alt="Card image cap">
                                            <div class="card-body">
                                                <h5 class="card-title">' . $item[0]->label . '</h5>
                                                <b>จำนวน:</b> (<u>x' . $invse_all[0]->count . '</u>) ชิ้น<br>
                                            </div>
                                            </center>
                                            </div>
                                                    ';
                                        }
                                    }

                                    ?>
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