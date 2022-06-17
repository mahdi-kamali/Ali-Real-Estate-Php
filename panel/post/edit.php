<?php
 require_once '../../functions/helpers.php'; 
 require_once '../../functions/pdo_connection.php'; 
 require_once '../../functions/check-login.php';
 global $pdo;

        if(!isset($_GET['post_id']))
        {
            redirect('panel/post');
        }

        $query = 'SELECT * FROM posts WHERE id = ?';
        $statement = $pdo->prepare($query);
        $statement->execute([$_GET['post_id']]);
        $post = $statement->fetch();
        if($post === false)
        {
            redirect('panel/post');
        }

if (
    isset($_POST['title']) && $_POST['title'] !== ''
 && isset($_POST['cat_id']) && $_POST['cat_id'] !== ''
 && isset($_POST['price']) && $_POST['price'] !== ''
 && isset($_POST['area']) && $_POST['area'] !== ''
 && isset($_POST['rooms']) && $_POST['rooms'] !== ''
 && isset($_POST['shower']) && $_POST['shower'] !== ''
 && isset($_POST['balcony']) && $_POST['balcony'] !== ''
 && isset($_POST['parking']) && $_POST['parking'] !== ''
 && isset($_POST['address']) && $_POST['address'] !== ''
 && isset($_POST['body']) && $_POST['body'] !== ''
 )
 {
    $query = "SELECT * FROM `posts` WHERE `id`= ? ;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['post_id']]);
    $category = $statement->fetch();
 
    if(isset($_FILES['image']) && $_FILES['image']['name'] !== '')
    {
        $allowedMimes = ['png', 'jpeg', 'jpg', 'gif'];
    $imageMime = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    if(!in_array($imageMime, $allowedMimes))
    {
        redirect('panel/post');
    }
    $basePath = dirname(dirname(__DIR__));
    $image = '/assets/images/posts/' . date("Y_m_d_H_i_s") . '.' . $imageMime;
    $image_upload = move_uploaded_file($_FILES['image']['tmp_name'], $basePath . $image);
    
    if($post !== false && $image_upload !== false)
    {
     $query = 'UPDATE posts SET title = ?, cat_id = ?, body = ?, image = ?, rooms = ?, balcony = ?, area = ?, shower = ?, parking = ?, price = ?, address = ?, updated_at = NOW() WHERE id = ? ;';
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $image, $_POST['rooms'], $_POST['balcony'], $_POST['area'], $_POST['shower'], $_POST['parking'], $_POST['price'], $_POST['address']], $_GET['post_id']);
    }
}
 
  else{ 
    if($post !== false)
    {
   $query = 'UPDATE `posts` SET title = ?, cat_id = ?, body = ?,  rooms = ?, balcony = ?, area = ?, shower = ?, parking = ?, price = ?, address = ?, updated_at = NOW() WHERE id = ? ;' ;
  $statement = $pdo->prepare($query);
  $statement->execute([$_POST['title'], $_POST['cat_id'], $_POST['body'], $_POST['rooms'], $_POST['balcony'], $_POST['area'], $_POST['shower'], $_POST['parking'], $_POST['price'], $_POST['address']], $_GET['post_id']);
}
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
                    <form action="<?= url('panel/post/edit.php?post_id=' . $_GET['post_id']) ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image">تصویر</label>
                            <input type="file" class="form-control"
                                name="image" id="image" >
                                <!-- <img src="<?= asset($post->image) ?>" alt=""> -->
                        </div>
                        <div class="form-group">
                            <label for="title">سرفصل</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= $post->title ?>">
                        </div>
                        <div class="form-group">
                            <label for="price">قیمت</label>
                            <input type="number" class="form-control" name="price" id="price" value="<?= $post->price ?>">
                        </div>
                        <div class="form-group">
                            <label for="area">متراژ</label>
                            <input type="number" class="form-control" name="area" id="area" value="<?= $post->area ?>">
                        </div>

                        <div class="form-group">
                            <label for="category">دسته بندی</label>
                            <select name="category" class="form-control" id="category">
                            <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories`";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();
                            foreach($categories as $category){
                                ?>
                                <option value="<?=$category->id ?>"<?php if($category->id == $post->cat_id) echo 'selected' ?>><?=$category->name ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rooms">اتاق</label>
                            <input type="number" class="form-control" name="rooms" id="rooms" value="<?= $post->rooms ?>">
                        </div>
                        <div class="form-group">
                            <label for="shower">حمام</label>
                            <input type="text" class="form-control" name="shower" id="shower" value="<?= $post->shower ?>">
                        </div>
                        <div class="form-group">
                            <label for="parking">پارکینگ</label>
                            <div class="radio">
                                <label for="parking">دارد</label>
                                <input type="radio" name="parking" id="parking" value= 10>

                            </div>
                            <div class="radio">
                                <label for="parking">ندارد</label>
                                <input type="radio" name="parking" id="parking" value= 0>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="balcony">بالکن</label>
                            <div class="radio">
                                <label for="balcony">دارد</label>
                                <input type="radio" name="balcony" id="balcony" value= 10>

                            </div>
                            <div class="radio">
                                <label for="balcony">ندارد</label>
                                <input type="radio" name="balcony" id="balcony" value= 0>
                            </div>
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <label for="body">بدنه</label>
                            <textarea name="body" id="body" rows="5"><?= $post->body ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="address">آدرس</label>
                            <textarea name="address" id="address" rows="5"><?= $post->address ?></textarea>
                        </div>
                        <div class="form-group buttons">
                            <button type="submit" class="btn btn-success">ویرایش</button>
                          
                            <a class="btn btn-danger" href="<?= url('panel/post') ?>">انصراف</a>
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