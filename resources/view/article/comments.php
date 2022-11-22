<?php

use App\Service\Helper;

$comments = $data;

?>

<?php if ($comments) : ?>
    <div class="col-md-12">
        <h2>Коментарии</h2>
    </div>
    <div class="col-md-9 border-bottom">
        <?php foreach ($comments as $comment) : ?>
            <div class="col-md-12">
                <p class="lead"><?= $comment['user'] ?></p>
            </div>
            <div class="col-md-12">
                <p><?= $comment['text'] ?></p>
            </div>
            <?php if ($comment['img']) : ?>
                <img src="<?= Helper::path() ?>img/coments/<?= $comment['img'] ?>" alt="">
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
