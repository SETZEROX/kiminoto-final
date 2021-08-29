    <!-- HEADER DESKTOP-->
    <header class="header-desktop text-white">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="header-wrap">
                    <form class="form-header" action="" method="POST">

                    </form>
                    <?php if (!isset($_SESSION['login_state'])) : ?>
                        <div class="header-button">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="content">
                                        <a class="js-acc-btn" href="#">ระบบสมาชิก</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="<?= base_url('sign-in'); ?>">
                                                    <i class="fas fa-sign-in-alt"></i>เข้าสู่ระบบ</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="<?= base_url('download'); ?>">
                                                    <i class="fa fa-download"></i>ดาวน์โหลด</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['login_state'])) : ?>
                        <?php 
                            $this->db->where('identifier', $_SESSION["identifier"]);
                            $player_query = $this->db->get("users");
                            $player = $player_query->result();
                        ?>
                        <div class="header-button">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="<?= $_SESSION["steam_avatarfull"]; ?>" alt="John Doe" />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#"><?= $_SESSION["steam_personaname"]; ?> (<?=$player[0]->point;?>)</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="account-dropdown__footer">
                                            <a href="<?= base_url('invse_all'); ?>">
                                                <i class="fas fa-cube"></i>ไอเท็มในตัว</a>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="<?= base_url('invse_cars'); ?>">
                                                <i class="zmdi zmdi-key"></i>กุญแจรถ</a>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="<?= base_url('logout'); ?>">
                                                <i class="zmdi zmdi-power"></i>ออกจากระบบ</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <!-- HEADER DESKTOP-->