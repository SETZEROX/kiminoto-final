<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>


<table class="table table-bordered" style="background-color:rgba(255, 255, 255, 0.1); border-color:rgba(23, 23, 23, 0.85);">
    <tbody id="item_list">
        <tr align="center" style="background-color:rgba(255, 255, 255, 0.8);">
            <?php
            $products = array();
            $i = 1;
            foreach ($product as $products[0]) {
                echo
                '
            <td width="25%">
                <a style="display:block;text-decoration:none; color:inherit;" data-toggle="tooltip" title="" href="#">
                    <span class="pull-right badge" style="font-size:18px;background-color:#3ad635c7"><span class="">300P.</span></span>
                    <br><br>
                    <img src="' . $products[0]->img . '" style="max-width:90%; height:200px;">
                    <p></p>
                    <b>' . $products[0]->name . '(<u>x' . $products[0]->amount . '</u>)</b>
                    <p></p>
					<button
                          data-name="' . $products[0]->name . '"
                          data-amount="' . $products[0]->amount . '"
                          data-img="' . $products[0]->img . '"
                          data-point="' . $products[0]->point . '"
                          data-id="' . $products[0]->id . '"
					 data-toggle="modal" data-target="#info_items" class="btn btn-success btn-block open-xd-studio"><i class="fas fa-cart-arrow-down"></i> ' . number_format($products[0]->point, 2) . ' Point</button>
                </a>

            </td>
            ';
            
                if ($i == 4) {
                    echo '</tr>';
                }
                if ($i == 4) {
                    echo '<tr align="center" style="background-color:rgba(255, 255, 255, 0.8);">';
                    $i = 1;
                }
                $i++;
            }
            ?>
    </tbody>
    <tbody>
    </tbody>
</table>
<div class="modal fade" id="info_items" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">ข้อมูลไอเท็ม</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onSubmit='post_ajax("<?= base_url('Member/buy_item/'); ?>",$(this).serialize());return false;' method="POST">
                    <center><img class="img-responsive" id="img" src=""></center>
                    <input type="hidden" id="id" name="id">
                    <center>
                        <h3 id="name"></h3>
                    </center>
                    <p>ราคา: <b id="point"></b></p>
                    <p>จำนวน: <b id="amount"></b></p>
                    เลือกจำนวน
                    <input value="1" type="number" class="form-control" name="amount_sell" id="amount_sell">
                    <hr>
                    <button type="submit" class="btn btn-block btn-primary">ซื้อ</button>
                    <button type="button" class="btn btn-block btn-danger" data-dismiss="modal">ยกเลิก</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on("click", ".open-xd-studio", function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        var amount = $(this).data('amount');
        var point = $(this).data('point');
        var img = $(this).data('img');
        $(".modal-body #id").val(id);
        $(".modal-body #name").text(name);
        $(".modal-body #amount").text(amount);
        $(".modal-body #point").text(point);
        $(".modal-body #img").attr("src", img);

    });
</script>