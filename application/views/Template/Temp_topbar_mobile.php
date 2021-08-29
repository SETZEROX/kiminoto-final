<!-- HEADER MOBILE-->
<header class="header-mobile d-block d-lg-none">
    <div class="header-mobile__bar">
        <div class="container-fluid">
            <div class="header-mobile-inner">
                <button class="hamburger hamburger--slider" type="button">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <nav class="navbar-mobile">
        <div class="container-fluid">
            <ul class="navbar-mobile__list list-unstyled">
                <li>
                    <a href="<?= base_url(''); ?>">
                        <i class="fas fa-home"></i>หน้าแรก</a>
                </li>
                <li>
                    <a href="<?= base_url('store'); ?>">
                        <i class="fas fa-shopping-cart"></i>ร้านค้า</a>
                </li>
                <li class="has-sub">
                    <a class="js-arrow" href="#">
                        <i class="fas fa-money-bill-alt"></i>เติมเงิน</a>
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                        <li>
                            <a href="<?= base_url('wallet'); ?>">เติมเงินผ่านทรูมันนี่วอเลต</a>
                        </li>
                        <li>
                            <a href="<?= base_url('topup/banking'); ?>">เติมเงินผ่านธนาคาร</a>
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
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
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
                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
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
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->