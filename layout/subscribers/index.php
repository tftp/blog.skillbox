<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<div class="container py-3 px-0">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <h2>Подписки</h2>

            <form class="form-inline form-subscribe">
                <div class="card w-100 border-light">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <label for="email">Добавить email для подписки:</label>
                                </td>
                                <td>
                                    <input class="form-control mr-sm-2 input-subscribe" type="email" name='email' placeholder="Email" required>
                                    <button class="btn-primary btn-subscribe-main admin" type="submit">Подписать</button>
                                    <small class="form-text text-muted text-muted-subscribe">Добавить новый email</small>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>

            <div class="alert text-center" role="alert" ></div>
            <div class="table-responsive-lg">
                <table class="table table-subscribers">
                    <thead>
                        <tr class="">
                            <th scope="col">Email</th>
                            <th scope="col">Дата подписки</th>
                            <th scope="col">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscribers as $subscriber) { ?>
                            <tr>
                                <td><?= $subscriber->email ?></td>
                                <td><?= date('d-m-Y H:i:s', strtotime($subscriber->create_time)); ?></td>
                                <td>
                                    <button type="button" class="btn btn-light subscriber-delete-button" data-secret="<?= $subscriber->secret ?>">Удалить</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php if (count($subscribers) != 0) : ?>
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/admin_pagination.php'; ?>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
