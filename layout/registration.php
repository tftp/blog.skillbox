<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<h2 align="center"><?= $title; ?></h2>

<div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-md-4">
        <form method='post'>
          <div class="form-group">
              <label for="nickName">Имя</label>
              <input type="text" class="form-control" id="nickName" name="name" placeholder="Введите имя" required>
          </div>

        <div class="form-group">
            <label for="inputEmail1">Email address</label>
            <input type="email" class="form-control" id="inputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            <small id="emailHelp" class="form-text text-muted">Не бойтесь, ваш email с нами не пропадет.</small>
        </div>
        <div class="form-group">
            <label for="inputPass">Пароль</label>
            <input type="password" class="form-control" id="inputPass" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confPass">Повторение пароля</label>
            <input type="password" class="form-control" id="confPass" placeholder="Password" name="conf_password" required>
        </div>
          <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="check" required>
            <label class="form-check-label" for="check">согласен с правилами сайта</label>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
