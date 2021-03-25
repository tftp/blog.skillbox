<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-sm-7">
            <h2>Новая статическая страница</h2>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger" role="alert" >
                    <?= $error ?>
                </div>
            <?php endif; ?>
            <form method="post">
                <div class="form-group">
                    <label for="aliasPage">Alias</label>
                    <input type="text" name="alias" id="aliasPage" class="form-control" value="<?= $_POST['alias'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="titlePage">Заголовок страницы</label>
                    <input type="text" name="title" id="titlePage" class="form-control" value="<?= $_POST['title'] ?? '' ?>" required>
                </div>
                <div class="form-group">
                    <label for="descriptionPage">Текст страницы</label>
                    <textarea class="form-control" id="descriptionPage" name="description" rows="8" cols="60" required><?= $_POST['description'] ?? '' ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-save my-2">Создать</button>
            </form>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
