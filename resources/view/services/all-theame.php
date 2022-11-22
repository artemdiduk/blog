<?php
$allTheame = $data;
?>
<?php if ($allTheame): ?>
<?php foreach ($allTheame as $thema) : ?>
    <div class="col-md-12 border-bottom">
        <div class="row">
            <div class="col-4">
                <a href="<?= $thema['url'] ?>"><?= $thema['name'] ?></a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php endif; ?>
