<?php require_once '../functions/helpers.php'; ?>
<?php require_once '../functions/check-login.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link rel="stylesheet" href=<?= asset('assets/css/bootstrap/bootstrap.min.css')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/admin-panel/admin.panel.css.map')?> media="all" type="text/css">
    <link rel="stylesheet" href=<?= asset('assets/css/admin-panel/admin.panel.css')?> media="all" type="text/css">

</head>
<body>
<?php require_once 'layouts/top-nav.php'; ?>
<?php require_once 'layouts/sidebar.php'; ?>
<section class="app" id="app">
        <section class="container-fluid">
            <section class="row">
                <div class="greeting">
                    <div class="greeting-header">
                        <h1>به بخش مدیریت خوش آمدید </h1>
                    </div>
                    <div class="greeting-body">
                        <h3>پروژه : مسکن</h3>
                        <h3>امید فضل علیزاده</h3>
                    </div>
                </div>
            </section>
        </section>
       
    </section>



</body>
<script src="<?= asset('assets/js/bootstrap.min.js'); ?>"></script>
<script src="<?= asset('assets/js/jquery.min.js'); ?>"></script>
</html>