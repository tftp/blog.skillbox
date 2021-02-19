<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-sm-10">
                <?php foreach ($notes as $note) : ?>
                    <div class="card-group my-3 ">
                        <div class="card border-light" style="max-width: 20rem;">
                            <img class="card-img" src="<?= $note->image ? '/images/' . $note->image : '/images/no-image-note.png' ?>">
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
                
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/pagination.php'; ?>
            </div>
    </div>
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
