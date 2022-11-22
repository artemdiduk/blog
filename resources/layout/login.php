<?php
use App\Service\Helper;
?>
<!doctype html>
<html lang="en">
<?=Helper::viewPlug('head', 'services'); ?>

<body class="antialiased">
<?=Helper::viewPlug('header', 'services'); ?>
<div class="container">
    <div style="padding-top: 20px;">

        <?=Helper::viewPlug('form-login', 'auth'); ?>
    </div>

</div>
<script src="<?=Helper::path()?>js/jquery.min.js"></script>
<script src="<?=Helper::path()?>js/popper.js"></script>
<script src="<?=Helper::path()?>js/bootstrap.min.js"></script>
<script src="<?=Helper::path()?>js/main.js"></script>
</body>
</html>