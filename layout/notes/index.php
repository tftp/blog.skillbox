<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container">
    <h1><?= $title; ?></h1>
    <ul class="list-group">
        <?php foreach ($notes as $note) : ?>
            <li class="list-group-item">
                <h3><a href="/notes/<?= $note->id ?>"><?= $note->title; ?></a></h3>
                <p> <?= mb_strimwidth($note->body, 0, 100, '...') ?> </p>
                <p>Создан: <?= $note->create_time ?></p>
            </li>
        <?php endforeach ?>
    </ul>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
