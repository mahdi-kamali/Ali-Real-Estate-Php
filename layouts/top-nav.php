<?php session_start() ?>

<header>

    <div class="right">
        <div class="account">
      
        </div>
        <ul class="nav-bar">
            <li class="click"><a href=<?= url('index.php') ?>>خانه<i class="fa-solid fa-house"></i></a></li>
            <?php
        if(!isset($_SESSION['user'])){ ?>
            <li class="click user-account "><a href=<?= url('auth/login.php') ?>>ورود <i
                        class="fa-solid fa-user"></i></a>
            </li>
            <li class="click"><a href="<?= url('auth/register.php') ?>">ثبت نام<i class="fa-solid fa-circle-info"></i></a></li>
            <?php } else{?>
            <li class="click"><a href="<?= url('auth/logout.php') ?>">خروج<i class="fa-solid fa-circle-info"></i></a></li>
            <li class="click"><a href="<?= url('panel/index.php') ?>">پنل ادمین<i class="fa-solid fa-circle-info"></i></a></li>
        </ul>
        <?php } ?>
    </div>
    <div class="left">
        <div class="logo">
            <img src="assets/images/header/logo.png" alt="">
        </div>

    </div>

</header>