<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container m-3">
    <div class="col-sm-6">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert" >
                <?= $error ?>
            </div>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titleNote">Заголовок статьи</label>
                <input type="text" name="title" id="titleNote" class="form-control" value="<?= strip_tags($_POST['title'] ?? '') ?>" required>
            </div>
            <div class="form-group">
                <label for="imageNote">Добавить картинку</label>
                <input type="file" name="image-note" id="imgInput" accept="image/gif, image/jpeg, image/png" hidden>
                <img src="/images/no-image-note.png" id="imageNote" class="img-fluid img-note-new" width="500" alt="">
            </div>
            <div class="form-group">
                <label for="bodyNote">Текст статьи</label>
                <textarea class="form-control" id="bodyNote" name="body" rows="8" cols="60" required><?= strip_tags($_POST['body'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-save my-2">Сохранить</button>
        </form>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
