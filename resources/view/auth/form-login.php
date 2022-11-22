<?php
$errorLogin = $data;
?>
<div class="row justify-content-center">
    <div class="col-md-7 border">
        <h3>Авторизация</h3>
        <form action="login" method="post">
            <div class="form-group">
                <label for="email" class="col-form-label">Email</label>
                <input type="email" required name="email" class="form-control" id="email">
            </div>
            <div class="form-group">
                <label for="password" class="col-form-label">Пароль</label>
                <input type="password" required name="password" class="form-control" id="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn-primary btn">Войти</button>
            </div>
        </form>
        <?php if ($errorLogin) : ?>
            <div class="form__error">
                <?php foreach ($errorLogin as $error) : ?>
                    <div class="form__error-item">
                        <p><?= $error ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
