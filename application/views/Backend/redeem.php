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
                            <h2 class="title-1">จัดการเติมโค๊ดไอเท็ม</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <button data-redeem_query="created" data-toggle="modal" data-target="#redeem" class="btn btn-info open-redeem-editor"><i class="fas fa-plus"></i> เพิ่มรหัสของขวัญ</button>
                                <hr>
                                <div id="alert"></div>
                                <table id="tables" class="table table-hover table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>รหัสโค๊ด</th>
                                        <th>คำสั่ง</th>
                                        <th>ประเภท</th>
                                        <th>การใช้งาน</th>
                                        <th>ตัวเลือก</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $redeems = array();
                                        $i = 0;
                                        foreach ($redeem as $redeems[0]) {
                                            if ($redeems[0]->multi == 1) {
                                                $multi = 'ใช้งานได้หลายครั้ง';
                                            } else {
                                                $multi = 'ใช้งานได้ครั้งเดียว';
                                            }
                                            if ($redeems[0]->type == 'items') {
                                                $type = 'ไอเท็ม';
                                            } else {
                                                $type = 'พ้อย';
                                            }
                                            $i++;
                                            echo '<tr>
                                                                <td>' . $i . '</td>
                                                                <td>' . $redeems[0]->code_id . '</td>
                                                                <td>' . $redeems[0]->cmd . '</td>
                                                                <td>' . $type . '</td>
                                                                <td>' . $multi . '</td>
                                                                <td width="10%">
                                                                <button data-redeem_query="update" data-redeem_id="' . $redeems[0]->id . '" data-redeem_code="' . $redeem[0]->code_id . '" data-redeem_multi="' . $redeem[0]->multi . '" data-redeem_type="' . $redeem[0]->type . '" data-redeem_cmd="' . $redeem[0]->cmd . '" data-toggle="modal" data-target="#redeem" class="btn btn-warning open-redeem-editor"><i class="fas fa-edit"></i></button>
                                                                <button onclick=\'post_delete("' . base_url('Backend/redeem/delete-redeem') . '",' . $redeem[0]->id . ');\' class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                                                </td>
                                                            </tr>';
                                        } ?>
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
<div class="modal fade" id="redeem" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">จัดการรหัสของขวัญ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onSubmit='post_update("<?= base_url('Backend/redeem/update-redeem'); ?>",$(this).serialize());return false;' method="post">
                <div class="modal-body">
                    <input id="redeem_id" name="redeem_id" type="hidden" value="">
                    <input id="redeem_query" name="redeem_query" type="hidden" value="">
                    <div class="input-group mb-3">
                        <span class="input-group-text">รหัสของขวัญ (6 หลัก)</span>
                        <input type="text" maxlength="6" name="redeem_code" id="redeem_code" class="form-control">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">คำสั่งหรือจำนวนเงิน</span>
                        <input type="text" name="redeem_cmd" id="redeem_cmd" class="form-control">
                    </div>
                    <label>ประเภท</label>
                    <select class="form-control" name="redeem_type" id="redeem_type">
                        <option value="items">ไอเท็ม</option>
                        <option value="point">point หน้าเว็บ</option>
                    </select>
                    <label>ใช้งานได้กี่ครั้ง</label>
                    <select class="form-control" name="redeem_multi" id="redeem_multi">
                        <option value="0">ใช้งานได้ครั้งเดียว</option>
                        <option value="1">ใช้งานได้หลายครั้ง</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-window-close"></i> ยกเลิก</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> บันทึก</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".open-redeem-editor", function() {
    $(".modal-body #redeem_id").val($(this).data('redeem_id'));
    $(".modal-body #redeem_code").val($(this).data('redeem_code'));
    $(".modal-body #redeem_cmd").val($(this).data('redeem_cmd'));
    $(".modal-body #redeem_multi").val($(this).data('redeem_multi'));
    $(".modal-body #redeem_type").val($(this).data('redeem_type'));
    $(".modal-body #redeem_query").val($(this).data('redeem_query'));
    console.log($(this).data('redeem_type'));

});
    function post_update(s, c = []) {
        swal({
                title: "แจ้งเตือน",
                text: "คุณแน่ใจหรือไม่ที่จะทำรายการ",
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

        function post_delete(s, c = []) {

        swal({
                title: "แจ้งเตือน",
                text: "คุณแน่ใจหรือไม่ที่จะทำรายการ",
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
                    $.post(s, { id: c }, function(data) {
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

