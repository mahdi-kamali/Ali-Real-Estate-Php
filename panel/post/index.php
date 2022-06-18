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
    <title>panel posts</title>
    <link rel="stylesheet" href=<?= asset('assets/css/bootstrap/bootstrap.min.css') ?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/admin-panel/admin.panel.css.map') ?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/admin-panel/admin.panel.css') ?> media="all" type="text/css">

</head>

<body>
    <?php require_once '../layouts/top-nav.php'; ?>
    <?php require_once '../layouts/sidebar.php'; ?>
    <section class="app" id="app">

        <section class="container-fluid">
            <section class="row">
                <section class="table-container full-size">

                    <section class="table-container-header">
                        <h1>پست ها</h1>
                        <a href="<?= url('panel/post/create.php'); ?>" class="click">ایجاد پست جدید</a>
                    </section>

                    <section class="table-container-body">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تصویر</th>
                                    <th>سرفصل</th>
                                    <th style="width: 10ch;">دسته بندی</th>
                                    <th>بدنه</th>
                                    <th>اتاق</th>
                                    <th>بالکن</th>
                                    <th>متراژ</th>
                                    <th>حمام</th>
                                    <th>پارکینگ</th>
                                    <th>قیمت</th>
                                    <th>آدرس</th>
                                    <th>وضعیت</th>
                                    <th>تنظیمات</th>
                                </tr>
                            </thead>

                            <?php
                            global $pdo;
                            $query = "SELECT `posts`.*, categories.name AS category_name From posts LEFT JOIN categories ON posts.cat_id = categories.id";
                            $statement = $pdo->prepare($query);
                            $statement->execute();
                            $posts = $statement->fetchall();
                            foreach ($posts as $post) {
                            ?>
                                <tbody>
                                    <tr>
                                        <td><?= $post->id ?></td>
                                        <td class="image"><img src="<?= asset($post->image) ?>" alt=""></td>
                                        <td><?= $post->title ?></td>
                                        <td><?= $post->category_name ?></td>
                                        <td>
                                            <p><?= $post->body ?></p>
                                        </td>
                                        <td><?= $post->rooms ?></td>
                                        <td><?php
                                            if ($post->balcony == 10) {
                                                echo 'دارد';
                                            } else {
                                                echo 'ندارد';
                                            }
                                            ?></td>
                                        <td><?= $post->area ?></td>
                                        <td><?= $post->shower ?>
                                        </td>
                                        <td><?php if ($post->parking == 10) {
                                                echo 'دارد';
                                            } else {
                                                echo 'ندارد';
                                            } ?></td>
                                        <td><?= $post->price ?></td>
                                        <td>
                                            <p><?= $post->address ?></p>
                                        </td>
                                        <td>
                                            <p><?php if ($post->status == 10) {
                                                    echo 'فعال';
                                                } else {
                                                    echo 'غیر فعال';
                                                } ?></p>
                                        </td>

                                        <td class="buttons">
                                            <form>
                                            <a href="<?= url('panel/post/edit.php?post_id=' . $post->id); ?>" class="btn btn-info btn-sm">ویرایش</a>
                                            <a href="<?= url('panel/post/delete.php?post_id=' . $post->id); ?>" class="btn btn-danger btn-sm">حذف</a>
                                            <a href="<?= url('panel/post/change-status.php?post_id=' . $post->id); ?>" class="btn btn-warning btn-sm">وضعیت</a>
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
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>
    <script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
</body>


</html>