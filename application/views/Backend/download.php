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
                            <h2 class="title-1">จัดการหน้าดาวน์โหลด</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <button data-id="" data-act="create" data-url="" data-name="" data-img="" data-toggle="modal" data-target="#downloads" class="open-AddBookDialog btn btn-xs btn-success"><i class="fas fa-plus"></i> เพิ่มโปรแกรม</button>
                                <hr>
                                <div id="alert"></div>
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>ชื่อ</th>
                                        <th>จัดการ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $downloads = array();
                                        foreach ($download as $downloads[0]) {
                                            echo
                                            '
							<tr>
								<td><img src="' . $downloads[0]->img . '" height="32" width="32" alt="" style="max-width: 64px; max-height: 64px;"></td>
								<td>' . $downloads[0]->name . '</td>
								<td>
									<button
                          data-id="' . $downloads[0]->id . '"
                          data-act="editor"
                          data-name="' . $downloads[0]->name . '"
                          data-img="' . $downloads[0]->img . '"
                          data-url="' . $downloads[0]->link . '"
                   data-toggle="modal" data-target="#downloads" class="open-AddBookDialog btn btn-warning btn-xs"><i class="fas fa-edit"></i></button>
									<a href="' . base_url("Backend/download_delete/?id=" . $downloads[0]->id) . '" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></a>
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
<?php $this->load->view('Template/Temp_footer'); ?>
<!-- Modal -->
<div class="modal fade" id="downloads" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่ม/แก้ไข โปรแกรมในระบบ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/download_plus'); ?>" method="POST">
                    <input type="hidden" required name="act" id="act" class="form-control">
                    <input type="hidden" required name="id" id="id" class="form-control">
                    <label>ชื่อ</label>
                    <input type="text" required placeholder="ชื่อ" name="name" id="name" class="form-control">
                    <label>ลิงค์รูปภาพ</label>
                    <input type="url" required placeholder="ลิงค์รูปภาพ" name="img" id="img" class="form-control">
                    <label>ลิงค์โหลด</label>
                    <input type="url" required placeholder="ลิงค์โหลด" name="link" id="link" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
                <button type="submit" class="btn btn-primary">เพิ่มโปรแกรม</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".open-AddBookDialog", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var img = $(this).data('img');
        var act = $(this).data('act');
        var url = $(this).data('url');
        $(".modal-body #id").val(id);
        $(".modal-body #name").val(name);
        $(".modal-body #img").val(img);
        $(".modal-body #link").val(url);
        $(".modal-body #act").val(act);
    });
</script>