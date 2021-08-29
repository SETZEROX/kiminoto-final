<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
            <center><img width="150" src="<?=base_url('assets/images/icon/logo.png');?>"></center>
            <hr>
                <li>
                    <a href="<?= base_url(''); ?>">
                        <i class="fas fa-home"></i>หน้าแรก</a>
                </li>
                <li>
                    <a href="<?= base_url('store'); ?>">
                        <i class="fas fa-shopping-cart"></i>ร้านค้า</a>
                </li>
                <li>
                    <a href="<?= base_url('redeem'); ?>">
                    <i class="fas fa-gift"></i> เติมโค๊ดไอเท็ม</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-money-bill-alt"></i>เติมเงิน</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <li>
                            <a href="<?= base_url('topup/wallet'); ?>">เติมเงินผ่านทรูมันนี่วอเลต</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('download'); ?>">
                        <i class="fas fa-download"></i>ดาวน์โหลดเกมส์</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-question-circle"></i>วิธีการเล่น</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <?php
                        $htp_info = $this->db->get('xd_htp');
                        $htps[0] = array();
                        $htp = $htp_info->result();
                        foreach ($htp as $htps[0]) {
                            echo
                            '
                                <li>
                                    <a href="' . base_url("Page/howtoplay/" . $htps[0]->id) . '">' . $htps[0]->title . '</a>
                                </li>
                                ';
                        }
                        ?>
                    </ul>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-book"></i>กฏหมาย</a>
                    <ul class="list-unstyled navbar__sub-list js-sub-list">
                        <?php
                        $rule_info = $this->db->get('xd_rule');
                        $rules[0] = array();
                        $rule = $rule_info->result();
                        foreach ($rule as $rules[0]) {
                            echo
                            '
                                <li>
                                    <a href="' . base_url("Page/rule/" . $rules[0]->id) . '">' . $rules[0]->title . '</a>
                                </li>
                                ';
                        }
                        ?>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('rule_server'); ?>">
                        <i class="fas fa-book"></i>กฏของเซิร์ฟเวอร์</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->