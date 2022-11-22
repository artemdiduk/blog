<?php
$allTheame = $data['group'];
$errorPost = $data['errorPost'];

?>
<div style="padding-top: 20px;">
    <form action="/blog/create/article" method="post" enctype='multipart/form-data'>
        <div class="col-md-12">
            <h4 class="display-6">Создание статьи</h4>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="name">Название</span>
            <input type="text" required name="name" placeholder="Название стати" class="form-control" aria-label="Название статьи" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="description">Описание статьи</span>
            <textarea type="text" required name="description" class="form-control-plaintext border-bottom"></textarea>
        </div>
        <h4>Картинки</h4>
        <div class="input-group mb-3">
            <input type="file" multiple name="images" class="form-check" id="inputGroupFile02">
        </div>
        <h4>К какой теме будет относиться стаття</h4>
        <div class="input-group mb-3">
            <select name="group" id="cars">
                <?php foreach ($allTheame as $thema) : ?>
                    <option value="<?= $thema['url'] ?>"><?= $thema['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="input-group mb-3">
            <button class="btn btn-primary">Создать</button>
        </div>
    </form>
    <?php if($errorPost) : ?>
    <?php foreach ($errorPost as $error) : ?>
        <div class="col-md-12 border-bottom">
            <div class="row">
                <div class="col-4">
                    <div><?=$error?></div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php endif;?>
</div>
