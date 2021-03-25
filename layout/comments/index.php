<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container py-3 px-0">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <h2>Комментарии</h2>
            <div class="table-responsive-lg">
                <table class="table comment-status-update">
                    <thead>
                        <tr class="">
                            <th scope="col">Дата</th>
                            <th scope="col">Пользователь</th>
                            <th scope="col">Комментарий</th>
                            <th scope="col">Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) { ?>
                            <?php if ($comment->trust == 0) { ?>
                                <tr class="table-warning">
                            <?php } ?>
                            <?php if ($comment->trust > 0) { ?>
                                <tr class="table-success">
                            <?php } ?>
                            <?php if ($comment->trust < 0) { ?>
                                <tr class="table-danger">
                            <?php } ?>
                                <td><?= date('d-m-Y H:i:s', strtotime($comment->create_time)); ?></td>
                                <td><?= $comment->name ?></td>
                                <td class="w-50 p3">
                                        <?= $comment->body ?></td>
                                <td>
                                        <select class="comment-select-status form-control" data-id="<?= $comment->id ?>">
                                            <option value="0" <?= $comment->trust == 0 ? 'selected' : '' ?>>На модерации</option>
                                            <option value="1" <?= $comment->trust > 0 ? 'selected' : '' ?>>Разрешено</option>
                                            <option value="-1" <?= $comment->trust < 0 ? 'selected' : '' ?>>Отклонено</option>
                                        </select>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php if (count($comments) != 0) : ?>
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/admin_pagination.php'; ?>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
