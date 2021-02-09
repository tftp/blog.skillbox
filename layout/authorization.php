<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<h2 align="center"><?= $title; ?></h2>

<div class="container-fluid">
    <div class="row justify-content-center">
    <div class="col-md-4">
        <form method='post'>
        <div class="form-group">
            <label for="inputEmail1">Email address</label>
            <input type="email" class="form-control" id="inputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="inputPass">Пароль</label>
            <input type="password" class="form-control" id="inputPass" placeholder="Password" name="password" required>
        </div>
        <div class="form-group">
            <p><a href="/registration">Зарегистрируйтесь</a>, если вы не зарегистрированны.</p>
        </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
