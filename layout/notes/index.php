<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <?php if (count($notes) == 0) : ?>
                <div class="alert alert-success text-center" role="alert" >
                    Ни одной статьи пока нет, но они обязательно появятся.
                </div>
            <?php endif ?>
                <?php foreach ($notes as $note) : ?>
                    <div class="card-group my-3 ">
                        <div class="card border-light" style="max-width: 20rem;">
                            <img class="card-img" src="/images/<?= $note->image ?>">
                        </div>
                        <div class="card border-light">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/notes/note/<?= $note->id ?>" class="card-link"><?= $note->title; ?></a></h5>
                                <p class="card-text"> <?= mb_strimwidth($note->body, 0, 100, '...') ?> </p>
                                <small class="text-muted">
                                    Создан: <?=  date('d-m-Y H:m:s', strtotime($note->create_time)); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
                <?php if ($countPages > 1) : ?>
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination.php'; ?>
                <?php endif ?>
            </div>
    </div>
</div>

<?php if (!isSession() || (isSession() && !$_SESSION['subscribe'])) : ?>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/subscription.php'; ?>
<?php endif ?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
