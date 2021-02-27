<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<?php $paragraphs = explode("\n", $note->body) ?>
<div class="container m-3">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <?php if (isModerator()) { ?>
                    <div class="card-header text-right">
                        <a class="card-link" href="/notes/update/<?= $note->id ?>">Редактировать статью</a>
                    </div>
                <?php } ?>
                <img class="card-img-top" src="/images/<?= $note->image ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= $note->title ?></h5>
                    <?php foreach ($paragraphs as $paragraph) { ?>
                        <p class="card-text"><?= $paragraph ?></p>
                    <?php } ?>
                </div>
                <div class="card-footer text-muted text-center">
                    Дата создания: <?=  date('d-m-Y H:m:s', strtotime($note->create_time)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/comments/show.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
