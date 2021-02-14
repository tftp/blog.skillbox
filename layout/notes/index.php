<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container py-3">
    <h1><?= $title; ?></h1>
    <ul class="list-group">
        <?php foreach ($notes as $note) : ?>
            <li class="list-group-item">
                <h3><a href="/notes/note/<?= $note->id ?>"><?= $note->title; ?></a></h3>
                <p> <?= mb_strimwidth($note->body, 0, 100, '...') ?> </p>
                <p>Создан: <?= $note->create_time ?></p>
            </li>
        <?php endforeach ?>
    </ul>
</div>
<?php if (!isSession()) : ?>
    <hr>
    <div class="container py-2">
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <form class="form-inline form-subscribe">
                  <input class="form-control mr-sm-2 input-subscribe" type="email" name='email' placeholder="Email" required>
                  <button class="btn-primary btn-subscribe-main" type="submit">Подписаться</button>
                </form>
                <small class="form-text text-muted">Подпишитесь на появление новых статей</small>
            </div>
        </div>
    </div>
<?php endif ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
