<?php
$errorArray = $data;
?>
<form action="registration" method="post" class="col-md-7 border">
    <h3>Регистрация</h3>
    <div class="form-group">
        <label for="name" class="col-form-label">Имя</label>
        <input type="text" required name="name" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="email" class="col-form-label">Email</label>
        <input type="text" required name="email" class="form-control" id="email">
    </div>
    <div class="form-group">
        <label for="password" class="col-form-label">Пароль</label>
        <input type="text" required name="password" class="form-control" id="password">
    </div>
    <div class="form-group">
        <button type="submit" class="btn-primary btn">Войти</button>
    </div>
</form>
<?php if($errorArray) :?>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="form__error">
        <?php foreach ($errorArray as $error) : ?>
            <div class="form__error-item">
                <p><?=$error?></p>
            </div>
        <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>