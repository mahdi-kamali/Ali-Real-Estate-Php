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
    <title>users</title>
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
                <section class="table-container full-size">

                    <section class="table-container-header">
                        <h1>کاربران</h1>
                    </section>

                    <section class="table-container-body">
                        <table class="table-striped table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>نام</th>
                                    <th>نام خانوادگی</th>
                                    <th>ایمیل</th>
                                    <th>ایجاد شده در</th>
                                  
                                </tr>
                            </thead>
                
                            <tbody>
                            <?php
                    global $pdo;
                    $query = "SELECT * FROM `users`;";
                    $statement = $pdo->prepare($query);
                    $statement ->execute();
                    $users = $statement->fetchall();
                    foreach($users as $user) { ?>
                                <tr>
                                    <td><?= $user->id ?></td>
                                    <td><?= $user->first_name ?></td>
                                    <td><?= $user->last_name ?></td>
                                    <td><?= $user->email ?></td>
                                    <td>
                                    <?= $user->created_at ?>
                                    </td>

                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                       
                        </table>
                    </section>
                </section>
            </section>
        </section>

    </section>



    <!-- Iconify -->
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

</body>

</html>