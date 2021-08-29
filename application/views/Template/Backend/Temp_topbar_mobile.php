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
                    <a href="<?= base_url('backend/'); ?>">
                        <i class="fas fa-home"></i>หน้าแรก</a>
                </li>
                <li>
                    <a href="<?= base_url('backend/store'); ?>">
                        <i class="fas fa-shopping-cart"></i>จัดการสินค้า</a>
                </li>
                <li>
                    <a href="<?= base_url('backend/topup'); ?>">
                    <i class="fas fa-money-bill-alt"></i>จัดการหน้าเติมเงิน</a>
                </li>
                <li>
                    <a href="<?= base_url('backend/download'); ?>">
                        <i class="fas fa-download"></i>จัดการหน้าดาวน์โหลดเกมส์</a>
                </li>
                <li>
                    <a href="<?= base_url('backend/howtoplay'); ?>">
                        <i class="fas fa-shopping-cart"></i>จัดการวิธีการเล่น</a>
                </li>
                <li>
                    <a href="<?= base_url('backend/rule'); ?>">
                    <i class="fas fa-book"></i>จัดการกฏหมาย</a>
                </li>
                <li>
                    <a href="<?= base_url('backend/rule_server'); ?>">
                    <i class="fas fa-book"></i>กฏของเซิร์ฟเวอร์</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- END HEADER MOBILE-->