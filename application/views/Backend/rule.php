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
                            <a href="<?=base_url('backend/rule_create');?>" class="btn btn-xs btn-outline-primary"><i class="fas fa-plus"></i> สร้างกฏ</a>
                            <hr>
                                <table class="table table-bordered">
                                    <thead>
                                    <th>ลำดับ</th>
                                    <th>หัวข้อ</th>
                                    <th>ตัวเลือก</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $htp = array();
                                        $i=0;
                                        foreach($rules as $rule[0]){
                                        $i++;
                                    
                                echo '  <tr>
                                            <td width="25%">'.$i.'</td>
                                            <td width="50%">'.$rule[0]->title.'</td>
                                            <td width="25%">
                                                <a href="'.base_url('backend/rule_editor/'.$rule[0]->id).'" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i> แก้ไข</a>
                                                <a href="'.base_url('backend/rule_del/'.$rule[0]->id).'" class="btn btn-xs btn-danger"><i class="far fa-trash-alt"></i> ลบ</a>
                                            </td>
                                        </tr>';}
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