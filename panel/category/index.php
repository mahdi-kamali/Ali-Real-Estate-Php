<?php
 require_once '../../functions/helpers.php'; 
 require_once '../../functions/pdo_connection.php'; 
 require_once '../../functions/check-login.php';
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
                <section class="table-container">

                    <section class="table-container-header">
                        <h1>دسته بندی ها</h1>
                        <a href="<?=url('/panel/category/create.php');?>" class="click">ایجاد دسته بندی</a>
                    </section>

                    <section class="table-container-body">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم</th>
                                    <th>تنظیمات</th>
                                </tr>
                            </thead>

                            <?php 
                            global $pdo;
                            $query = "SELECT * FROM `categories`";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $categories = $statement->fetchAll();
                            foreach($categories as $category){
                            ?>
                            <tbody>
                                <tr>
                                    <td><?= $category->id ?></td>
                                    <td><?= $category->name ?></td>
                                    <td class="buttons">
                                        <form action="#" name="item-1" method="get">
                                            <a href="<?= url('panel/category/edit.php?cat_id=').$category->id ; ?>" class="btn btn-info btn-sm">ویرایش</a>
                                            <a href="<?= url('panel/category/delete.php?cat_id=').$category->id; ?>" class="btn btn-danger btn-sm">حذف</a>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                                <?php } ?>
                        </table>
                    </section>
                </section>
            </section>
        </section>

    </section>

</body>

<script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
</html>