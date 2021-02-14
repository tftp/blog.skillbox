<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/base/header.php' ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light my-0 border-bottom">
<!-- <div class="collapse navbar-collapse"> -->
<a class="navbar-brand" href="/">Мой блог</a>

<ul class="nav mr-auto">
    <li class="nav-item">
        <?php if (isSession()) : ?>
            <a class="nav-link active" href="/users/<?= $_SESSION['user']->id; ?>">Мой профиль</a>
        <?php endif; ?>
    </li>
    <?php if (isSession() && $_SESSION['user']->role) : ?>
        <li class="nav-item">
            <a class="nav-link active <?= $title == 'Новая статья' ? 'disabled' : '' ?>" href="/notes/new">Новая статья</a>
        </li>
    <?php endif ?>
</ul>

<ul class="nav justify-content-end">
   <li class="nav-item">
       <?php if (isSession()) { ?>
           <a class="nav-link active" href="/authorization"><?= $_SESSION['user']->email ?></a>
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

<!-- </div> -->
</nav>
<!-- <hr> -->
