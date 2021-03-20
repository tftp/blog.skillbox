<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/base/header.php' ?>

<?php if (isModerator()) : ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/admin_header.php' ?>
<?php endif ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light my-0 border-bottom">
    <a class="navbar-brand" href="/">Мой блог</a>
    <ul class="nav mr-auto">
        <li class="nav-item">
            <?php if (isSession()) : ?>
                <a class="nav-link active" href="/users/<?= $_SESSION['user']->id; ?>">Мой профиль</a>
            <?php endif; ?>
        </li>

        <?php if ($aliases) { ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Информация
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php foreach($aliases as $id => $alias) { ?>
                        <a class="dropdown-item" href="/static/<?= $id; ?>"><?= $alias; ?></a>
                    <?php } ?>
                </div>
            </li>
        <?php } ?>
    </ul>

    <ul class="nav justify-content-end">
        <li class="nav-item">
            <?php if (isSession()) { ?>
                <a class="nav-link active" href="/users/<?= $_SESSION['user']->id; ?>"><?= $_SESSION['user']->email ?></a>
            <?php } else { ?>
                <a class="nav-link active" href="/authorization">Войти</a>
            <?php } ?>
        </li>
        <li class="nav-item">
            <?php if (isSession()) { ?>
                <a class="nav-link" href="/exit">Выйти</a>
            <?php } else { ?>
                <a class="nav-link" href="/registration">Зарегистрироваться</a>
            <?php } ?>
        </li>
    </ul>
</nav>
