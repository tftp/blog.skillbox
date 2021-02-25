<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<h2 align="center"><?= $title; ?></h2>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <?php if (isSession()) {?>
            <div class="col-md-4">
                <div class="alert alert-success" role="alert" >
                    Вы уже зарегистрированны.
                </div>
            </div>
        <?php } else {  ?>
    <div class="col-md-4">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert" >
                <?= $error ?>
            </div>
        <?php endif; ?>
        <?php if (isset($success)) : ?>
            <div class="alert alert-success" role="alert" >
                <?= $success ?>
            </div>
        <?php endif; ?>
        <form method='post'>
          <div class="form-group">
              <label for="nickName">Имя</label>
              <input type="text" class="form-control" id="nickName" name="name" placeholder="Введите имя" value="<?= isset($_POST['name']) && isset($error) ? strip_tags($_POST['name']) : '' ?>">
          </div>

        <div class="form-group">
            <label for="inputEmail1">Email address</label>
            <input type="email" class="form-control" id="inputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="<?= isset($_POST['email']) && isset($error) ? strip_tags($_POST['email']) : '' ?>">
            <small id="emailHelp" class="form-text text-muted">Не бойтесь, ваш email с нами не пропадет.</small>
        </div>
        <div class="form-group">
            <label for="inputPass">Пароль</label>
            <input type="password" class="form-control" id="inputPass" placeholder="Password" name="password" >
        </div>
        <div class="form-group">
            <label for="confPass">Повторение пароля</label>
            <input type="password" class="form-control" id="confPass" placeholder="Password" name="conf_password" >
        </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check" name="terms" >
            <label class="form-check-label" for="check">согласен с <a href="/static/terms" class="card-link">правилами</a> сайта</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
          <small class="form-text text-muted">Уже зарегистрирован? <a href="/authorization" class="card-link">Авторизуйся.</a></small>
        </form>
    </div>
    <?php } ?>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
