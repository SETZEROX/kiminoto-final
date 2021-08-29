<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <center>
            <a href="#">
                <h3>ADMIN-KIMINOTO</h3>
            </a>
        </center>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
                <li>
                    <a href="<?= base_url('Backend'); ?>">
                        <i class="fas fa-home"></i>ทั่วไป</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/store'); ?>">
                        <i class="fas fa-shopping-cart"></i>จัดการร้านค้า</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/redeem'); ?>">
                        <i class="fas fa-gift"></i>จัดการเติมโค๊ดไอเท็ม</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/topup'); ?>">
                        <i class="fas fa-money-bill-alt"></i>จัดการหน้าเติมเงิน</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/players'); ?>">
                        <i class="fas fa-users"></i>จัดการผู้เล่น</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/admins'); ?>">
                        <i class="fas fa-user-secret"></i>จัดการแอดมิน</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/whitelist'); ?>">
                    <i class="fas fa-user"></i>จัดการไวท์ลิสต์</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/download'); ?>">
                        <i class="fas fa-download"></i>จัดการดาวน์โหลด</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/howtoplay'); ?>">
                        <i class="fas fa-question-circle"></i> จัดการวิธีการเล่น</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/rule'); ?>">
                        <i class="fas fa-book"></i> จัดการกฏหมาย</a>
                </li>
                <li>
                    <a href="<?= base_url('Backend/rule_server'); ?>">
                        <i class="fas fa-book"></i> จัดการกฏของเซิฟเวอร์</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->