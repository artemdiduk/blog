<?php

use App\Service\Helper;

$allTheame = $data['article'];
$nameCategor = $data['name-categor'];
?>
<div class="col-md-12">
    <h3 class="display-5">Тема статей <?= ucfirst($nameCategor['name']) ?></h3>
</div>
<?php if (!is_null($allTheame)) : ?>
    <?php foreach ($allTheame as $thema) : ?>
        <div class="col-md-12 border-bottom">
            <div class="row">
                <div class="col-12">
                    <a href="<?= $thema['url'] ?>"><?= $thema['name'] ?></a>
                </div>
                <div class="col-3">
                    <?php if($thema['img']) : ?>
                    <img height="300" src="<?= Helper::path() ?>img/post/<?= $thema['img'] ?>" alt="<?= $thema['name'] ?>">
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<?php endif ?>
