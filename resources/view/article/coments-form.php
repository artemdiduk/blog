<?php

use App\Service\Helper;

$post = $data;

?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Написать Коментарий</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/blog/сomment/create" method="post" enctype='multipart/form-data'>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="comments" class="col-form-label">Коментарий</label>
                        <input type="text" required name="text" class="form-control" id="text">
                        <input type="text" hidden name="post" value="<?= $post['url'] ?>">
                        <h4>Картинки</h4>
                        <div class="input-group mb-3">
                            <input type="file" multiple name="images" class="form-check" id="inputGroupFile02">
                        </div>
                        <p>картинка (Не больше 3х мб. и это должна быть картинка jpg/png формата)</p>
                        <p>В противно случаи картинка не загрузиться</p>
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
