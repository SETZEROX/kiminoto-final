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
                            <h2 class="title-1">จัดการผู้เล่น</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="table" class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>ชื่อสตรีม</th>
                                        <th>ชื่อในเกมส์</th>
                                        <th>พ้อย</th>
                                        <th>ตำแหน่ง</th>
                                        <th>จัดการ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $players = array();
                                        $i = 0;
                                        foreach ($users as $players[0]) {
                                            $i++;
                                            echo
                                            '
											<tr>
												<td>' . $i . '</td>
												<td>' . $players[0]->name . '</td>
												<td>' . $players[0]->firstname . " " . $players[0]->lastname . '</td>
												<td>' . $players[0]->point . '</td>
												<td>' . $players[0]->group . '</td>
												<td>
													<button
                                                    data-name="' . $players[0]->name . '"
                                                    data-firstname="' . $players[0]->firstname . '"
                                                    data-point="' . $players[0]->point . '"
                                                    data-group="' . $players[0]->group . '"
                                                    data-lastname="' . $players[0]->lastname . '"
                                                    data-id="' . $players[0]->id . '"
                                                    data-money="' . $players[0]->money . '"
                                                    data-bank="' . $players[0]->bank . '"
													 data-toggle="modal" data-target="#player_editor" class="btn btn-xs btn-warning open-AddBookDialog"><i class="far fa-edit"></i> แก้ไข</button>
                                                     ';
                                                     $this->db->where('user_name',$players[0]->name);
                                                     $banned_q = $this->db->get('xd_banned');
                                                        if($banned_q->num_rows()){
                                                            echo '<a href="'.base_url('backend/ban/'.$players[0]->name).'" class="btn btn-xs btn-info"><i class="fas fa-ban"></i> แบน</a>';
                                                        }else{
                                                            echo '<a href="'.base_url('backend/unban/'.$players[0]->name).'" class="btn btn-xs btn-info"><i class="fas fa-ban"></i> ปลดแบน</a>';
                                                        }
                                                     echo  '
													<a href="' . base_url('backend/delete_players/' . $players[0]->id) . '" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i> ลบ</a>
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
<div class="modal fade" id="player_editor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Admin Manager</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/update_player/'); ?>" method="POST">
                    <label>ชื่อสตรีม</label>
                    <input type="text" readonly id="name" class="form-control">
                    <input type="hidden" name="id" readonly id="id">
                    <label>ชื่อในเกมส์ (ชื่อจริง)</label>
                    <input type="text" name="firstname" id="firstname" class="form-control">
                    <label>ชื่อในเกมส์ (นามสกุล)</label>
                    <input type="text" name="lastname" id="lastname" class="form-control">
                    <label>ตำแหน่ง</label>
                    <input type="text" name="group" id="group" class="form-control">
                    <label>จำนวนพ้อย</label>
                    <input type="number" name="point" id="point" class="form-control">
                    <label>เงินในตัว</label>
                    <input type="number" name="money" id="money" class="form-control">
                    <label>เงินในธนาคาร</label>
                    <input type="number" name="bank" id="bank" class="form-control">
                    <hr>
                    <button class="btn btn-xs btn-block btn-success"><i class="fas fa-save"></i> บันทึกการเปลี่ยนแปลง</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('Template/Temp_footer'); ?>
<script type="text/javascript">
    $(document).on("click", ".open-AddBookDialog", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var firstname = $(this).data('firstname');
        var lastname = $(this).data('lastname');
        var group = $(this).data('group');
        var point = $(this).data('point');
        var money = $(this).data('money');
        var bank = $(this).data('bank');
        $(".modal-body #id").val(id);
        $(".modal-body #name").val(name);
        $(".modal-body #firstname").val(firstname);
        $(".modal-body #lastname").val(lastname);
        $(".modal-body #group").val(group);
        $(".modal-body #point").val(point);
        $(".modal-body #bank").val(bank);
        $(".modal-body #money").val(money);
    });
</script>