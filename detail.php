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

<body class="detail-page">

    <?php require_once 'layouts/top-nav.php' ?>
    <section class="background-slider">
    <?php
                    global $pdo;
                    $query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `status` = 10";
                    $statement = $pdo->prepare($query);
                    $statement ->execute();
                    $post = $statement->fetch();
                    ?>
        <a class="slide" href="<?= url('detail.php?post_id=' . $post->id) ?>">
            <img src=<?= asset($post->image) ?> alt="">
            <div class="slide-title">
                <div class="title-header">
                    <h1> <?= $post->title ?></h1>
                </div>
                <div class="title-body">
                    تومان<h1><?= $post->price ?></h1>
                </div>
            </div>
        </a>
        
      

    </section>
    
    <section class="estate-info">
        <div class="left">
            <div class="left-header">
                <h1>توضیحات</h1>
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M20 2H4c-1.103 0-2 .894-2 1.992v12.016C2 17.106 2.897 18 4 18h3v4l6.351-4H20c1.103 0 2-.894 2-1.992V3.992A1.998 1.998 0 0 0 20 2zm-6 11H7v-2h7v2zm3-4H7V7h10v2z" />
                </svg>
            </div>
            <div class="left-body">
                <p> <?= $post->body ?></p>
                <span><?= $post->address ?></span>
                <div class="categery">
                <?php 
                        
                    global $pdo;
                    $query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id WHERE `status` = 10";
                    $statement = $pdo->prepare($query);
                    $statement ->execute();
                    $post = $statement->fetch();
                            ?>
                    <h1>از نوع دسته بندی :</h1>
                    <a class="click" href="<?= url('category.php?cat_id='. $post->cat_id) ?>"><?= $post->category_name ?></a>
                </div>

            </div>
        </div>
        <div class="right">
            <div class="right-header">
                <h1>امکانات</h1>
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em"
                    preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20">
                    <path fill="currentColor" d="M9 9V3H3v6h6zm8 0V3h-6v6h6zm-8 8v-6H3v6h6zm8 0v-6h-6v6h6z" />
                </svg>
            </div>
            <div class="right-body">

                <div class="item">
                    <h1>اتاق</h1>
                    <span><?= $post->rooms ?></span>
                </div>

                <div class="item">
                    <h1>بالکن</h1>
                    <span><?php  $post->balcony == 10 ? print 'دارد' : print 'ندارد'; ?></span>
                </div>

                <div class="item">
                    <h1>متراژ</h1>
                    <span><?= $post->area ?></span> متر
                </div>

                <div class="item">
                    <h1>حمام</h1>
                    <span><?= $post->shower ?></span>
                </div>

                <div class="item">
                    <h1>پارکینگ</h1>
                    <span><?php  $post->parking == 10 ? print 'دارد' : print 'ندارد'; ?></span>
                </div>
                
            </div>
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