<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container py-3 px-0">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h2>Комментарии</h2>
            <div class="table-responsive-lg">
                <table class="table user-role comment-status-update">
                    <thead>
                        <tr class="">
                            <th scope="col">date</th>
                            <th scope="col">user</th>
                            <th scope="col">body</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment) { ?>
                            <tr>
                                <td><?= date('d-m-Y H:m:s', strtotime($comment->create_time)); ?></td>
                                <td><?= $comment->name ?></td>
                                <td><?= $comment->body ?></td>
                                <td>
                                    <a class="card-link text-danger" data-id="<?= $comment->id ?>" href="#">На модерации</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
