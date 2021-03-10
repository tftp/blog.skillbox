<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h2>Настройки</h2>
            <?php if (isset($success)) : ?>
                <div class="alert alert-success" role="alert">
                    <?= $success ?>
                </div>
            <?php endif; ?>
            <?php if (isset($errors)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errors ?>
                </div>
            <?php endif; ?>
            <form method="post" class="update-terms">
                <div class="form-group">
                    <label for="numberNotes">Количество статей на главной странице</label>
                    <input type="number" min="1" class="form-control" id="numberNotes" name="numberNotes" value="<?= $numberNotes ?>" required>
                </div>
                <div class="form-group">
                    <label for="bodyTerms">Правила пользования сайта</label>
                    <textarea class="form-control" id="bodyTerms" name="terms" rows="8" cols="60" required><?= $terms ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-update-terms my-2">Сохранить</button>
            </form>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
