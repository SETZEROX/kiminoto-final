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
                            <h2 class="title-1">ร้านค้า</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <div class="btn-group" role="group">
                                        <button onclick="javascript: load_product(1);" type="button" class="btn btn-default"><i class="fas fa-car"></i> รถ</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button onclick="javascript: load_product(2);" type="button" class="btn btn-default"><i class="fas fa-wrench"></i> ไอเท็ม</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button onclick="javascript: load_product(3);" type="button" class="btn btn-default"><i class="fas fa-pizza-slice"></i> อาหาร</button>
                                    </div>
                                    <div class="btn-group" role="group">
                                        <button onclick="javascript: load_product(4);" type="button" class="btn btn-default"><i class="fas fa-archive"></i> กาชาปอง</button>
                                    </div>
                                </div>

                                <div id="alert"></div>
                                <hr>
                                <div id="display_product"></div>

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
    function alert(message, dev, type) {
        if (type == "show") {
            $("#" + dev).show();
            $("#" + dev).html("<div class='alert alert-info'><i class='fa fa-spinner fa-spin'></i> " + message + "</div>")
        } else {
            $("#" + dev).hide();
        }
    }
    $("form").on("submit", function(event) {
        event.preventDefault();
        console.log($(this).serialize());
    });

    function post_ajax(s, c = []) {

        swal({
                title: "แจ้งเตือน",
                text: "คุณแน่ใจหรือไม่ที่จะสั่งซื้อไอเท็มชิ้นนี้",
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
                    alert("ระบบกำลังทำรายการ กรุณารอสักครู่", "alert", "show");
                    $.post(s, c, function(data) {
                        if (data.type == "success") {
                            swal("แจ้งเตือน", data.alert, "success");
                        } else {
                            swal("แจ้งเตือน", data.alert, "error");
                        }
                        alert("", "alert", "hide");
                    }, 'json');
                } else {
                    swal("แจ้งเตือน", "ยกเลิกรายการสำเร็จ", "error");
                }
            });
    }
    $("#display_product").load('<?= base_url("Member/view_product/"); ?>all');

    function load_product(type) {
        if (type == 1) {
            var cate = '<?= base_url("Member/view_product/"); ?>cars';
        } else if (type == 2) {
            var cate = '<?= base_url("Member/view_product/"); ?>items';
        } else if (type == 3) {
            var cate = '<?= base_url("Member/view_product/"); ?>foods';
        } else if (type == 4) {
            var cate = '<?= base_url("Member/view_product/"); ?>gashapon';
        } else if (type == 5) {
            var cate = '<?= base_url("Member/view_product/"); ?>cash_bank';
        } else if (type == 6) {
            var cate = '<?= base_url("Member/view_product/"); ?>cash_money';
        }
        $("#display_product").load(cate);
    }
</script>