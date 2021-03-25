<nav class="navbar navbar-expand-lg navbar-light bg-light my-0 border-bottom">
    <ul class="nav mr-auto">
        <li class="nav-item">
            <a class="nav-link active <?= $title == 'Новая статья' ? 'disabled' : '' ?>" href="/notes/new">Новая статья</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active <?= $title == 'Комментарии' ? 'disabled' : '' ?>" href="/comments">Комментарии</a>
        </li>
        <?php if (isAdmin()) { ?>
            <li class="nav-item">
                <a class="nav-link active <?= $title == 'Пользователи' ? 'disabled' : '' ?>" href="/admin/users">Пользователи</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active <?= $title == 'Подписки' ? 'disabled' : '' ?>" href="/admin/subscribers">Подписки</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active <?= $title == 'Настройки' ? 'disabled' : '' ?>" href="/admin/options">Настройки</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Редактирование страниц
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <?php if ($aliases) { ?>
                            <?php foreach($aliases as $id => $alias) { ?>
                                <a class="dropdown-item" href="/admin/static/update/<?= $id ?>"><?= $alias; ?></a>
                            <?php } ?>
                        <div class="dropdown-divider"></div>
                    <?php } ?>
                    <a class="dropdown-item" href="/admin/static/new">Создание новой страницы</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</nav>
