<?php

use App\Service\Helper;

?>
<!doctype html>
<?= Helper::viewPlug('head', 'services'); ?>

<?= Helper::viewPlug('header', 'services'); ?>

<body class="antialiased">


    <div class="container">
        <div style="padding-top: 20px;">
            <?php if (Helper::$isLogin) : ?>
                <div class="row justify-content-end">
                    <div class="col-md-2">
                        <a class="btn btn-primary" href="create/article">Написать статью</a>
                    </div>
                </div>
            <?php endif; ?>
            <?= Helper::viewPlug('article-theme', 'categor'); ?>
        </div>

    </div>


    <script src="<?= Helper::path() ?>js/jquery.min.js"></script>
    <script src="<?= Helper::path() ?>js/popper.js"></script>
    <script src="<?= Helper::path() ?>js/bootstrap.min.js"></script>
    <script src="<?= Helper::path() ?>js/main.js"></script>
</body>

</html>
