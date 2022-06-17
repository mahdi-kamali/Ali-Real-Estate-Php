<?php
    require_once '../functions/helpers.php';
    require_once '../functions/pdo_connection.php';



    $error = '';
    if(
    isset($_POST['email']) && $_POST['email'] !== '' 
    && isset($_POST['first_name']) && $_POST['first_name'] !== '' 
    &&  isset($_POST['last_name']) && $_POST['last_name'] !== ''
    &&  isset($_POST['password']) && $_POST['password'] !== '' 
    &&  isset($_POST['confirm']) && $_POST['confirm'] !== '' )
    {
        global $pdo;
        if($_POST['password'] === $_POST['confirm'])
        {
            if(strlen($_POST['password']) > 5)
            {
                $query = 'SELECT * FROM php_project.users WHERE email = ?';
                $statement = $pdo->prepare($query);
                $statement->execute([$_POST['email']]);
                $user = $statement->fetch();
                if($user === false)
                {
                    $query = 'INSERT INTO php_project.users SET email = ?, first_name = ?, last_name = ?, password = ?, created_at = NOW() ;';
                    $statement = $pdo->prepare($query);
                    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $statement->execute([$_POST['email'], $_POST['first_name'], $_POST['last_name'], $password]);
                    redirect('auth/login.php');
                }
                else
                {
                    $error = 'ایمیل وارد شده تکراری میباشد';
                }
            }
            else
            {
                $error = 'کلمه ی عبور باید حداقل ۵ کاراکتر باشد';
            }
        }
        else
        {
            $error = 'کلمه ی عبور با تاییدیه کلمه ی عبور مطابقت ندارد';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>

    <link rel="stylesheet" href=<?= asset('assets/css/bootstrap/bootstrap.min.css')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/sign-page/sign-page.css')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/sign-page/sign-page.css.map')?> media="all" type="text/css">

    <!-- Fonts Awesome -->
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
                <li class="click"><a href=<?= url('index.php') ?>>خانه<i class="fa-solid fa-house"></i></a></li>
                <li class="click user-account "><a href=<?= url('auth/login.php') ?>>ورود کاربر <i
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


    <section class="sign-up">


        <form action=<?= url('auth/register.php') ?> method="post"  >
            <div class="form-header">
                <h1>ثبت نام کاربر</h1>
                <p>برای استفاده از امکانات سایت میتوانید ثبت نام کنید  و بصورت کاربر اصلی سایت فعالیت کنید</p>
                <p style="color: red ;"><?php echo $error; ?></p>
            </div>
            <div class="form-body">
                <div class="form-group">
                    <input type="text" name="first_name" id="first_name" required>
                    <label for="first_name">نام</label>
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" id="last_name" required>
                    <label for="last_name">نام خانوادگی</label>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" required>
                    <label for="email">ایمیل</label>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" required>
                    <label for="password">پسوورد</label>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm" id="confirm" required>
                    <label for="password">تاییدیه پسورد</label>
                </div>
            </div>
            <div class="form-buttons">
                <a class="" href=<?= url('index.php') ?>>بازگشت</a>
                <button type="submit" class="">ثبت نام کاربر</button>
            </div>
        </form>
    </section>

  
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>

</body>

</html>