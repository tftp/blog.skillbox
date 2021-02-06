<?php include 'header.php'; ?>

<div class="container">
    <h1><?= $title; ?></h1>
    Список книг:
    <ul class="list-group">
        <?php foreach ($books as $book) : ?>
            <li class="list-group-item">"<?= $book->title; ?>", Автор: <?= $book->author; ?></li>
        <?php endforeach ?>
    </ul>
</div>

<?php include 'footer.php'; ?>
