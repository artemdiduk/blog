<?php

use App\Service\Helper;
$post = $data['post'];
$allTheame = $data['group'];

?>

<div class="modal fade" id="postUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabell" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактирувать <?= $post['name'] ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/blog/update/post" method="post" enctype='multipart/form-data'>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="name">Название</span>
                            <input type="text" required name="name" value="<?= $post['name'] ?>" placeholder="Название стати" class="form-control" aria-label="Название статьи" aria-describedby="inputGroup-sizing-default">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="description">Описание статьи</span>
                            <textarea type="text" required name="description" class="form-control-plaintext border-bottom"><?= strip_tags($post['text']) ?></textarea>
                        </div>
                        <h4>Изменить картинку</h4>
                        <div class="input-group mb-3">
                            <input type="file" multiple name="images" value="" class="form-check" id="inputGroupFile02">
                        </div>
                        <p>картинка (Не больше 3х мб. и это должна быть картинка jpg/png формата)</p>
                        <p>В противно случаи картинка не загрузиться</p>
                        <h4>К какой теме будет относиться стаття</h4>
                        <div class="input-group mb-3">
                            <select name="group" id="cars">
                                <?php foreach ($allTheame as $thema) : ?>
                                    <option value="<?= $thema['url'] ?>"><?= $thema['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input hidden name="id" value="<?= $post['id'] ?>" type="text">
                        <input hidden name="old-url" value="<?= $post['url'] ?>" type="text">
                        <div class="input-group mb-3">
                            <button class="btn btn-primary">Обновить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
