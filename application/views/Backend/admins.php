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
                            <h2 class="title-1">จัดการแอดมิน</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <button style="float: right;" class="btn btn-success" data-toggle="modal" data-target="#backend_add"><i class="fas fa-plus"></i> เพิ่มแอดมิน</button> <!-- backend_add -->
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>ชื่อผู้ใช้งาน</th>
                                        <th>เข้าสู่ระบบล่าสุด</th>
                                        <th>ที่อยู่ไอพี</th>
                                        <th>จัดการ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $players = array();
                                        $i = 0;
                                        foreach ($backend as $admins[0]) {
                                            $i++;
                                            $date = date_create($admins[0]->last_login);
                                            echo
                                            '
											<tr>
												<td>' . $i . '</td>
												<td>' . $admins[0]->username . '</td>
												<td>' . date_format($date,'d-m-Y') . '</td>
												<td>' . $admins[0]->login_ip . '</td>
												<td>
													<button
                                                    data-username="' . $admins[0]->username . '"
                                                    data-id="' . $admins[0]->id . '"
													data-toggle="modal" 
                                                    data-target="#backend_editor" class="btn btn-xs btn-warning open-AddBookDialog"><i class="far fa-edit"></i> แก้ไข</button>
													<a href="' . base_url('backend/delete_admins/' . $admins[0]->id) . '" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i> ลบ</a>
												</td>
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

<!-- Modal -->
<div class="modal fade" id="backend_editor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Admin Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/update_admins/'); ?>" method="POST">
                    <input type="hidden" name="id" id="id">
                    <label>ชื่อผู้ใช้งาน</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <label>รหัสผ่านใหม่</label>
                    <input type="text" name="password" class="form-control">
                    <hr>
                    <button class="btn btn-xs btn-block btn-success"><i class="fas fa-save"></i> บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="backend_add" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Admin Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/add_admins/'); ?>" method="POST">
                    <label>ชื่อผู้ใช้งาน</label>
                    <input type="text" name="username" class="form-control">
                    <label>รหัสผ่านใหม่</label>
                    <input type="text" name="password" class="form-control">
                    <hr>
                    <button class="btn btn-xs btn-block btn-success"><i class="fas fa-save"></i> บันทึก</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('Template/Temp_footer'); ?>
<script type="text/javascript">
    $(document).on("click", ".open-AddBookDialog", function() {
        var id = $(this).data('id');
        var username = $(this).data('username');
        $(".modal-body #id").val(id);
        $(".modal-body #username").val(username);
    });
</script>