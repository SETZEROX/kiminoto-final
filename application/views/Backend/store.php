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
                            <h2 class="title-1">จัดการร้านค้า</h2>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <button data-id="" data-act="create" data-name="" data-amount="" data-point="" data-img="" data-cmd="" data-category="" data-toggle="modal" data-target="#products" class="open-AddBookDialog btn btn-xs btn-success"><i class="fas fa-plus"></i> เพิ่มสินค้า</button>
                                <hr>
                                <div id="alert"></div>
                                <table id="tables" class="table table-bordered">
                                    <thead>
                                        <th>#</th>
                                        <th>ชื่อ</th>
                                        <th>จำนวน</th>
                                        <th>ราคา</th>
                                        <th>จัดการ</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $products = array();
                                        foreach ($product as $products[0]) {
                                            echo
                                            '
							<tr>
								<td><img src="' . $products[0]->img . '" height="32" width="32" alt="" style="max-width: 64px; max-height: 64px;"></td>
								<td>' . $products[0]->name . '</td>
								<td>' . $products[0]->amount . '</td>
								<td>' . number_format($products[0]->point, 2) . '</td>
								<td>
									<button
                          data-id="' . $products[0]->id . '"
                          data-act="editor"
                          data-name="' . $products[0]->name . '"
                          data-amount="' . $products[0]->amount . '"
                          data-point="' . $products[0]->point . '"
                          data-img="' . $products[0]->img . '"
                          data-cmd="' . $products[0]->cmd . '"
                          data-category="' . $products[0]->category . '"
                   data-toggle="modal" data-target="#products" class="open-AddBookDialog btn btn-warning btn-xs"><i class="fas fa-edit"></i></button>
									<a href="' . base_url("Backend/products_delete/?id=" . $products[0]->id) . '" class="btn btn-danger btn-xs"><i class="fas fa-trash-alt"></i></a>
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
<div class="modal fade" id="products" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่ม/แก้ไข สินค้าในระบบ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('Backend/products_plus'); ?>" method="POST">
                    <input type="hidden" required name="act" id="act" class="form-control">
                    <input type="hidden" required name="id" id="id" class="form-control">
                    <label>ชื่อ</label>
                    <input type="text" required placeholder="ชื่อ" name="name" id="name" class="form-control">
                    <label>จำนวน</label>
                    <input type="number" required placeholder="จำนวน" name="amount" id="amount" class="form-control">
                    <label>ราคา</label>
                    <input type="number" required placeholder="ราคา" name="point" id="point" class="form-control">
                    <label>รูป</label>
                    <input type="url" required placeholder="รูป" name="img" id="img" class="form-control">
                    <label>คำสั่งไอเท็ม</label>
                    <input type="text" required placeholder="ชื่อไอเท็ม" name="cmd" id="cmd" class="form-control">
                    <div class="alert alert-success">
                        <li>หากเป็นรถให้ใส่หมายเลข Hash ไป หากเป็นรถมอดให้แอดมินซื้อก่อน1รอบละไปดูเลข Hash ที่ฐานข้อมูลซื้อรถเอาอยู่ในช่อง Model</li>
                        <li>หากเป็นไอเท็มหรืออาหารให้ใช้คำสั่งเช่น giveitem [id] taco [amount]
                        </li>
                        <li>
                            [id] = แทนไอดีผู้เล่น [amount] = จำนวนสินค้า
                        </li>
                        <li>หากเป็นเงินสดหรือเงินในธนาคารให้ใส่จำนวนไปเลย</li>
                        <li>หากไม่เข้าใจให้ดูคลิปสอนในยูทูปหรือแฟนเพจ</li>
                    </div>
                    <label>ประเภท</label>
                    <select name="category" id="category" class="form-control">
                        <option id="cate_cars" value="cars">รถ</option>
                        <option id="cate_items" value="items">ไอเท็ม</option>
                        <option id="cate_foods" value="foods">อาหาร</option>
                        <option id="cate_gashapon" value="gashapon">กาชาปอง</option>
                    </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ออก</button>
                <button type="submit" class="btn btn-primary">เพิ่มสินค้า</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".open-AddBookDialog", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var amount = $(this).data('amount');
        var point = $(this).data('point');
        var img = $(this).data('img');
        var cmd = $(this).data('cmd');
        var category = $(this).data('category');
        var act = $(this).data('act');
        $(".modal-body #id").val(id);
        $(".modal-body #name").val(name);
        $(".modal-body #amount").val(amount);
        $(".modal-body #point").val(point);
        $(".modal-body #img").val(img);
        $(".modal-body #cmd").val(cmd);
        $(".modal-body #act").val(act);
        $('.modal-body #category').val(category);
    });
</script>