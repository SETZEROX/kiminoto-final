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
                            <h2 class="title-1">จัดการ ไวท์ลิสต์</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                            <div class="alert alert-info">
                                ทุกครั้งที่ทำรายการใส่คำสั่ง <code>ensure Whitelist</code> ที่หน้า คอนโซลด้วยครับ
                            </div>
                                <button style="float: right;" class="btn btn-success" data-toggle="modal" data-target="#backend_add"><i class="fas fa-plus"></i> เพิ่มผู้เล่น</button> <!-- backend_add -->
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
                                        foreach ($whitelist as $players[0]) {
                                            $this->db->where('identifier', $players[0]->identifier);
                                            $user_query = $this->db->get('users');
                                            $user_info = $user_query->result();
                                            $i++;
                                            echo
                                            '
											<tr>
												<td>' . $i . '</td>
												<td>' . $user_info[0]->name . '</td>
												<td>' . $user_info[0]->firstname . " " . $user_info[0]->lastname . '</td>
												<td>' . $user_info[0]->point . '</td>
												<td>' . $user_info[0]->group . '</td>
												<td>
													<button
                                                    data-name="' . $user_info[0]->name . '"
                                                    data-firstname="' . $user_info[0]->firstname . '"
                                                    data-point="' . $user_info[0]->point . '"
                                                    data-group="' . $user_info[0]->group . '"
                                                    data-lastname="' . $user_info[0]->lastname . '"
                                                    data-id="' . $user_info[0]->id . '"
                                                    data-money="' . $user_info[0]->money . '"
                                                    data-bank="' . $user_info[0]->bank . '"
													 data-toggle="modal" data-target="#player_editor" class="btn btn-xs btn-primary open-AddBookDialog"><i class="fas fa-search"></i> ดูข้อมูล</button>
													<a href="' . base_url('Backend/delete_whitelist/' . $players[0]->identifier) . '" class="btn btn-xs btn-danger"><i class="fas fa-ban"></i> ปลดไวท์ลิสต์</a>
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
                <h5 class="modal-title" id="staticBackdropLabel">Whitelist Infomation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST">
                    <label>ชื่อสตรีม</label>
                    <input type="text" readonly id="name" class="form-control">
                    <input type="hidden" name="id" readonly id="id">
                    <label>ชื่อในเกมส์ (ชื่อจริง)</label>
                    <input type="text" name="firstname" readonly id="firstname" class="form-control">
                    <label>ชื่อในเกมส์ (นามสกุล)</label>
                    <input type="text" name="lastname" readonly id="lastname" class="form-control">
                    <label>ตำแหน่ง</label>
                    <input type="text" name="group" readonly id="group" class="form-control">
                    <label>จำนวนพ้อย</label>
                    <input type="number" name="point" readonly id="point" class="form-control">
                    <label>เงินในตัว</label>
                    <input type="number" name="money" readonly id="money" class="form-control">
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
                <h5 class="modal-title" id="staticBackdropLabel">Whitelist Add</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/add_whitelist/'); ?>" method="POST">
                    <label>Steam identifier (ได้จากการเข้าเซิร์ฟแล้วโชว์จากระบบ)</label>
                    <input type="text" name="identifier" class="form-control">
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