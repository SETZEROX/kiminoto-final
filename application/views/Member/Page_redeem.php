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
                            <h2 class="title-1">เติมโค๊ดไอเท็ม <code>Redeem</code></h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <center>
                                    <img width="250" src="https://cdn.dribbble.com/users/1666626/screenshots/10816031/media/c8d8574bcba5a08eb6a817cbb12825b0.gif">
                                </center>
                                <br>
                                <form onSubmit='post_ajax("<?= base_url('redeem/process'); ?>",$(this).serialize());return false;' method="post">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="telephone">โค๊ดไอเท็ม</span>
                                        <input type="text" index="1" maxlength="6" name="code_id" required class="form-control" aria-describedby="basic-addon3">
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-secondary" type="submit">ทำรายการ</button>
                                    </div>
                                </form>

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
<script type="text/javascript">
    function post_ajax(s, c = []) {

        swal({
                title: "แจ้งเตือน",
                text: "คุณยืนยันที่จะทำรายการนี้ต่อไป",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "ตกลง",
                cancelButtonText: "ยกเลิก",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    //alert("ระบบกำลังทำรายการ กรุณารอสักครู่", "alert", "show");
                    $.post(s, c, function(data) {
                        if (data.type == "success") {
                            swal("แจ้งเตือน", data.alert, "success");
                        } else {
                            swal("แจ้งเตือน", data.alert, "error");
                        }
                        //alert("", "alert", "hide");
                    }, 'json');
                } else {
                    swal("แจ้งเตือน", "ยกเลิกรายการสำเร็จ", "error");
                }
            });
    }
</script>