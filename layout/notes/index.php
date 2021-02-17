<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<?php $peace = 0; ?>
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-sm-10">
                <?php foreach ($notes as $note) : ?>
                    <?php if ($peace == 0) : ?>
                        <div class="card-deck my-3">
                    <?php endif ?>
                    <div class="card">
                        <img class="card-img-top" src="<?= $note->image ? '/images/' . $note->image : '/images/no-image-note.jpg' ?>">
                        <div class="card-body">
                            <h5 class="card-title"><a href="/notes/note/<?= $note->id ?>" class="card-link"><?= $note->title; ?></a></h5>
                            <p class="card-text"> <?= mb_strimwidth($note->body, 0, 100, '...') ?> </p>
                        </div>
                        <div class="card-footer">
                            <small class="card-text">
                                Создан: <?=  date('d-m-Y H:m:s', strtotime($note->create_time)); ?>
                            </small>
                        </div>
                    </div>
                    <?php $peace += 1; ?>
                    <?php if ($peace == 2) : ?>
                        <?php $peace = 0; ?>
                        </div>
                    <?php endif ?>
                <?php endforeach ?>
                <?php if ($peace < 3) : ?>
                    </div>
                <?php endif ?>
        </div>
    </div>
    <!-- <h1><?= $title; ?></h1> -->
    <ul class="list-group">
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
