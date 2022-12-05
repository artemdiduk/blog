<?php

use App\Service\Helper;

$post = $data;

?>
<?php if (Helper::$isLogin) : ?>
    <div class="row justify-content-end">
        <div class="col-md-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Написать Коментарий</button>
        </div>
    </div>
<?php endif; ?>

<?php if (Helper::$isLogin['name'] == $post['author']) : ?>
    <div style="margin-top: 10px" class="row justify-content-end">
        <form method="post" action="/blog/delate/post" class="col-md-3">
            <input type="text" hidden name="post" value="<?= $post['url'] ?>">
            <button class="btn btn-primary">Удалить пост</button>
        </form>
    </div>
    <div style="margin-top: 10px" class="row justify-content-end">
        <div class="col-md-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#postUpdate">Редактировать</button>
        </div>
    </div>
<?php endif; ?>


<div class="col-md-12">
    <h3 class="display-6"><?= $post['name'] ?></h3>
</div>
<div class="col-md-12 border-bottom">
    <div class="row">
        <div class="col-12">
            <?= $post['text'] ?>
        </div>
    </div>
    <?php if ($post['img']) : ?>
        <div class="col-4">
            <img src="<?= Helper::path() ?>img/post/<?= $post['img'] ?>" alt="<?= $post['name'] ?>">
        </div>
    <?php endif; ?>
</div>
