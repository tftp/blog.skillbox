<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<h2 align="center"><?= $title; ?></h2>

<div class="container-fluid">
    <div class="row justify-content-center">
    <!-- <div class="col-md-4"> -->
        <?php if (isSession()) {?>
            <div class="col-md-4">
                <div class="alert alert-success" role="alert" >
                    Вы успешно авторизованы.
                </div>
            </div>
        <?php } else {  ?>
            <div class="col-md-4">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert" >
                    <?= $error ?>
                </div>
            <?php endif; ?>
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
        <?php } ?>
    <!-- </div> -->
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
