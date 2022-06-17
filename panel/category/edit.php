<?php
 require_once '../../functions/helpers.php'; 
 require_once '../../functions/pdo_connection.php'; 
 require_once '../../functions/check-login.php';
 global $pdo;
if(!isset($_GET['cat_id'])){
    redirect('panel/category');
}
$query = "SELECT * FROM `categories` WHERE `id`= ? ;";
$statement = $pdo->prepare($query);
$statement->execute([$_GET['cat_id']]);
$category = $statement->fetch();
if($category === false){
    redirect('panel/category');
}
 if (isset($_POST['name']) && $_POST['name'] !== ''){
    $query = "UPDATE `categories` SET `name`= ? , `updated_at`= NOW() WHERE `id` = ? ;";
    $statement = $pdo->prepare($query);
    $statement->execute([$_POST['name'],$_GET['cat_id']]);
    redirect('panel/category');

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel Create</title>
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
                <section class="category-create">
                    <form action="<?= url('panel/category/edit.php?cat_id=').$_GET['cat_id'] ?>" method="post">
                        <section class="form-group">
                            <label for="name">نام دسته بندی</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $category->name ;?>">
                        </section>
                        <section class="form-group">
                            <button type="submit" class="btn btn-success ">ویرایش</button>
                            <!-- <a class="byn btn-danger" href="#">انصراف</a> -->
                        </section>

                    </form>
                </section>
            </section>
        </section>

    </section>



</body>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
</html>