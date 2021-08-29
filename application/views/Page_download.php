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
                            <h2 class="title-1">ดาวน์โหลด</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>#</th>
                                        <th>ชื่อโปรแกรม</th>
                                        <th>ตัวเลือก</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $download_q1 = $this->db->query("SELECT * from xd_download");
                                        $download_q = $download_q1->result();
                                        $download = array();
                                        foreach ($download_q as $download[0]) {
                                            echo
                                            '
                                                <tr>
                                                    <td><img width="64" src="' . $download[0]->img . '"></td>
                                                    <td>' . $download[0]->name . '</td>
                                                    <td><a class="btn btn-sm btn-success" href="' . $download[0]->link . '" target="_blank"><i class="fas fa-download"></i> ดาวน์โหลด</a></td>
                                                </tr>
                                                ';
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
<?php $this->load->view('Template/Temp_footer'); ?>