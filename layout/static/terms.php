<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<?php $paragraphs = explode("\n", $terms) ?>
<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Правила сайта</h5>
                    <?php foreach ($paragraphs as $paragraph) { ?>
                        <p class="card-text"><?= $paragraph ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
