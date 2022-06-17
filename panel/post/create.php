<?php
 require_once '../../functions/helpers.php'; 
 require_once '../../functions/pdo_connection.php'; 
 require_once '../../functions/check-login.php';
 if (
    isset($_POST['title']) && $_POST['title'] !== ''
 && isset($_POST['cat_id']) && $_POST['cat_id'] !== ''
 && isset($_POST['price']) && $_POST['price'] !== ''
 && isset($_FILES['image']) && $_FILES['image']['name'] !== ''
 && isset($_POST['area']) && $_POST['area'] !== ''
 && isset($_POST['rooms']) && $_POST['rooms'] !== ''
 && isset($_POST['shower']) && $_POST['shower'] !== ''
 && isset($_POST['balcony']) && $_POST['balcony'] !== ''
 && isset($_POST['parking']) && $_POST['parking'] !== ''
 && isset($_POST['address']) && $_POST['address'] !== ''
 && isset($_POST['body']) && $_POST['body'] !== ''
 )
 {
    global $pdo;
    $query = "SELECT * FROM `categories` WHERE `id`= ? ;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['cat_id']]);
    $category = $statement->fetch();

   
    $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
    $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if(!in_array($imageMime, $allowedMimes))
    {
        redirect('panel/post');
    }
    $basePath = dirname(dirname(__DIR__));
    $image = '/assets/images/posts/' . date("Y_m_d_H_i_s") . '.' . $imageMime;
    $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);

    if($category !== false && $image_upload !== false)
    {
     $query = 'INSERT INTO posts SET title = ?, cat_id = ?, body = ?, image = ?, rooms = ?, balcony = ?, area = ?, shower = ?, parking = ?, price = ?, address = ?, created_at = NOW() ;';
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $image, $_POST['rooms'], $_POST['balcony'], $_POST['area'], $_POST['shower'], $_POST['parking'], $_POST['price'], $_POST['address']]);
    }

    redirect('panel/post');

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>panel posts</title>
    <link rel="stylesheet" href=<?= asset('assets/css/bootstrap/bootstrap.min.css')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/admin-panel/admin.panel.css.map')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/admin-panel/admin.panel.css')?> media="all" type="text/css">
</head>
<body>
<?php require_once '../layouts/top-nav.php'; ?>
<?php require_once '../layouts/sidebar.php'; ?>
    <section class="app" id="app">

        <section class="container-fluid">
            <section class="row">
                <section class="posts-create">
                    <form action="<?= url('panel/post/create.php'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">تصویر</label>
                            <input type="file" class="form-control"
                                name="image" id="image" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="title">سرفصل</label>
                            <input type="text" class="form-control" name="title" id="title" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="price">قیمت</label>
                            <input type="number" class="form-control" name="price" id="price" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="area">متراژ</label>
                            <input type="number" class="form-control" name="area" id="area" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="cat_id">دسته بندی</label>
                            <select name="cat_id" class="form-control" id="cat_id">
                                <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories`";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();
                            foreach($categories as $category){
                                ?>
                                <option value="<?=$category->id ?>"><?=$category->name ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rooms">اتاق</label>
                            <input type="number" class="form-control" name="rooms" id="rooms" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="shower">حمام</label>
                            <input type="text" class="form-control" name="shower" id="shower" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="parking">پارکینگ</label>
                            <div class="radio">
                                <label for="parking">دارد</label>
                                <input type="radio" name="parking" id="parking" value="10">

                            </div>
                            <div class="radio">
                                <label for="parking">ندارد</label>
                                <input type="radio" name="parking" id="parking" value="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="balcony">بالکن</label>
                            <div class="radio">
                                <label for="balcony">دارد</label>
                                <input type="radio" name="balcony" id="balcony" value="10">

                            </div>
                            <div class="radio">
                                <label for="balcony">ندارد</label>
                                <input type="radio" name="balcony" id="balcony" value="0">
                            </div>
                         
                          
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <label for="body">بدنه</label>
                            <textarea name="body" id="body" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="address">آدرس</label>
                            <textarea name="address" id="address" rows="5"></textarea>
                        </div>
                        <div class="form-group buttons">
                            <button type="submit" class="btn btn-success ">ایجاد پست</button>
                            <a class="byn btn-danger" href="#">انصراف</a>
                        </div>

                    </form>
                </section>
            </section>
        </section>

    </section>


    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
   <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
</body>

</html>