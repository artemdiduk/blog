<?php
use App\Service\Helper;
?>
<?=Helper::viewPlug('head', 'services'); ?>
<body class="antialiased">
<?=Helper::viewPlug('header', 'services'); ?>



<div class="container">
    <div style="padding-top: 20px;">
        <div class="row justify-content-center">
            <?=Helper::viewPlug('form-registr', 'auth'); ?>
        </div>
    </div>
 
</div>



<script src="<?=Helper::path()?>js/jquery.min.js"></script>
<script src="<?=Helper::path()?>js/popper.js"></script>
<script src="<?=Helper::path()?>js/bootstrap.min.js"></script>
<script src="<?=Helper::path()?>js/main.js"></script>
</body>
</html>
