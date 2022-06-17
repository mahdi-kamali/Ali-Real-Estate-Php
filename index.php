<?php require_once 'functions/helpers.php'; ?>
<?php require_once 'functions/pdo_connection.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>


 

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        
    <link rel="stylesheet" href=<?= asset('assets/css/main-page/main-page.css') ?>>
    <link rel="stylesheet" href=<?= asset('assets/css/main-page/main-page.css.map') ?>>


       <!-- Slick Slider -->
 <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
 <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
       

</head>
<body class="main-page">

 <?php require_once 'layouts/top-nav.php' ?>
    

 <section class="background-slider">
 <?php
    global $pdo;
                    $query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `status` = 10";
                    $statement = $pdo->prepare($query);
                    $statement ->execute();
                    $posts = $statement->fetchall();
                    foreach($posts as $post){
                    ?>
        <a class="slide" href="<?= url('detail.php?post_id='. $post->id) ?>">
            <img src=<?= asset($post->image) ?> alt="">
            <div class="slide-title">
                <div class="title-header">
                    <h1><?= $post->title ?></h1>
                </div>
                <div class="title-body">
                    تومان<h1><?= $post->price ?></h1>
                </div>
            </div>
        </a>
        <?php } ?>
      
        
    </section>

    <section class="intro">
        <div class="left">
            <img src="assets/images/category/3.jpg" alt="">
        </div>
        <div class="right">
            <h1>دیگه منتظر نمون تا خونه رویاییت پیدا بشه </h1>
            <li>با خونه دات کام میتونی خونه رویاییت رو پیدا کنی و با کمترین زمان وارد معامله با آژانس 24 ساعته بشی</li>
            <li>با سابقه فروش 400 خونه  واقعا شگفت انگیزه</li>
            <li>خونه داری ؟ میتونی تو همینجا بفروشی با کمک آژانس های مترجب ما</li>
            <li>نمیتونی مشتری هاتونو راضی کنید ؟ خوب کاری نداره خونه تون رو با اسم ما بفروشین اینجوری همه بهتون اعتماد دارن</li>
            <li>درصدی از معامله دریافت نمیکنیم برای حق معامله پس خیالت راحت راحت</li>
            <li>پس منتظر نمون همین الان شروع کن !</li>
        </div>
    </section>

    <section class="todays-estates">
        <div class="todays-estates-list">
        <?php
                    global $pdo;
                    $query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `status` = 10 ;";
                    $statement = $pdo->prepare($query);
                    $statement ->execute();
                    $posts = $statement->fetchall();
                    foreach($posts as $post){
                       ?>
        <a class="card click" href=<?= url('detail.php?post_id=' . $post->id) ?>>
                <div class="card-header">
                    <div class="card-image card-row">
                        <img src=<?= asset($post->image) ?> alt="">
                    </div>
                    <div class="card-category card-row">
                       <span><?= $post->category_name ?></span> 
                    </div>
                </div>
                <div class="card-body">
                    <div class="card-name card-row">
                        <h1> <?= $post->title ?></h1>
                    </div>
                    <div class="card-address card-row">
                        <p> <?= $post->address ?></p>
                    </div>
                    <div class="card-options card-row">
                        <div class="sqfr option">
                            <h1>متراژ</h1>
                            <span><?= $post->area ?></span> متر
                        </div>
                        <div class="beds option">
                            <h1>اتاق</h1>
                            <span><?= $post->rooms ?></span>
                        </div>
                        <div class="bath option">
                            <h1>حمام</h1>
                            <span><?= $post->shower ?></span>
                        </div>
                        <div class="bath option">
                            <h1>آدرس</h1>
                            <span><?= $post->address ?></span>
                        </div>
                        <div class="balcony option">
                            <h1>بالکن</h1>
                            <span><?php  $post->balcony == 10 ? print 'دارد' : print 'ندارد'; ?></span>
                        </div>
                        <div class="parking option">
                            <h1>پارکینگ</h1>
                            <span><?php   $post->parking == 10 ? print 'دارد' : print 'ندارد'; ?></span>
                        </div>

                    </div>
                    <div class="card-price card-row">
                        تومان <h1><?= $post->price ?></h1>
                    </div>
                </div>
            </a>
            <?php } ?>
        </div> 
    </section>


    <section class="category-list">

    <div class="category-list-header">
    <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories`";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();
                            foreach($categories as $category){
                            ?>
            <div class="item click selected">
                <a href=<?= url('category.php?cat_id='. $category->id) ?>'selected'><?= $category->name ?></a>
            </div>
            <?php } ?>
        </div>
     
    </section>


    <!-- Jquery And Slick Slider -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src=<?= asset('assets/js/slick-slider/slick.min.js') ?>></script>


    <!-- Main Page Slider Options -->
    <script src=<?= asset('assets/js/main-page/slider.js') ?>></script>
    
    

</body>
</html>