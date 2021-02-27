<nav class="navbar navbar-expand-lg navbar-light bg-light my-0 border-bottom">
    <ul class="nav mr-auto">
        <li class="nav-item">
            <a class="nav-link active <?= $title == 'Новая статья' ? 'disabled' : '' ?>" href="/notes/new">Новая статья</a>
        </li>
        <?php if (isAdmin()) { ?>
            <li class="nav-item">
                <a class="nav-link active <?= $title == 'Пользователи' ? 'disabled' : '' ?>" href="/admin/users">Пользователи</a>
            </li>
        <?php } ?>
    </ul>
</nav>
