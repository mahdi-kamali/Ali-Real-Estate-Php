<?php
    session_start();
    require_once '../functions/helpers.php';
    require_once '../functions/pdo_connection.php';

    if(isset($_SESSION['user']))
    {
        unset($_SESSION['user']);
    }

    $error = '';

    if(
        isset($_POST['email']) && $_POST['email'] !== '' 
        && isset($_POST['password']) && $_POST['password'] !== '' )
        {
            global $pdo;
            $query = 'SELECT * FROM php_project.users WHERE email = ?';
            $statement = $pdo->prepare($query);
            $statement->execute([$_POST['email']]);
            $user = $statement->fetch();
            if($user !== false)
            {
                if(password_verify($_POST['password'], $user->password))
                {
                    $_SESSION['user'] = $user->email;
                    redirect('panel');
                }
                else
                {
                    $error = 'رمز عبور اشتباه است';
                }
            }
            else
            {
                $error = 'ایمیل وارد شده اشتباه میباشد';
            }
        }
        else
        {
            if(!empty($_POST))
            $error = 'همه فیلد ها اجباری هستند';
        }

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href=<?= asset('assets/css/bootstrap/bootstrap.min.css')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/sign-page/sign-page.css')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/sign-page/sign-page.css.map')?> media="all" type="text/css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <header>

        <div class="right">
            <div class="account">

            </div>
            <ul class="nav-bar">
                <li class="click"><a href=<?= url('index.php')?>>خانه<i class="fa-solid fa-house"></i></a></li>
                <li class="click user-account "><a href=<?= url('auth/register.php') ?>>ثبت نام <i
                            class="fa-solid fa-user"></i></a>
                </li>
    
            </ul>
        </div>
        <div class="left">
            <div class="logo">
                <img src="/images/header/logo.png" alt="">
            </div>

        </div>

    </header>


    <section class="sign-in">


        <form action=<?= url('auth/login.php') ?> method="post">
            <div class="form-header">
                <h1>ورود کاربران</h1>
                <p>برای استفاده از امکانات سایت میتوانید وارد شوید و بصورت کاربر اصلی سایت فعالیت کنید</p>
                <p style="color: red ;"> <?php echo $error ?></p>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <input type="text" name="email" id="email" required>
                    <label for="email">ایمیل</label>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" required>
                    <label for="password">پسوورد</label>
                </div>
            </div>
            <div class="form-buttons">
                <a class="" href=<?= url('index.php') ?>>بازگشت</a>
                <button type="submit" class="">ورود</button>
            </div>
        </form>
    </section>

  

    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
</body>

</html>