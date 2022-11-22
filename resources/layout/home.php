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

        <?php if(Helper::$isLogin) : ?>
        <div class="row justify-content-end">
            <div class="col-md-2">
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Создать тему</button>
            </div>
        </div>
        <?php endif; ?>
        <?=Helper::viewPlug('all-theame', 'services'); ?>
    </div>

</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Создание новой темы</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="group/create" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="group" class="col-form-label">Название темы</label>
                        <input type="text" required name="group" class="form-control" id="group">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="<?=Helper::path()?>js/jquery.min.js"></script>
<script src="<?=Helper::path()?>js/popper.js"></script>
<script src="<?=Helper::path()?>js/bootstrap.min.js"></script>
<script src="<?=Helper::path()?>js/main.js"></script>
</body>
</html>
