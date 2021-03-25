<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>

<?php if (isset($error)) : ?>
    <div class="alert alert-danger" role="alert" >
        <?= $error ?>
    </div>
<?php endif; ?>

<div class="container py-3 px-0">
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <h2>Пользователи</h2>
            <div class="table-responsive-lg">
                <table class="table user-role">
                    <thead>
                        <tr class="">
                            <th scope="col">#id</th>
                            <th scope="col">email</th>
                            <th scope="col">name</th>
                            <th scope="col">role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr>
                                <th scope="row"><?= $user->id ?></th>
                                <td><?= $user->email ?></td>
                                <td><?= $user->name ?></td>
                                <td>
                                    <select  class="form-control" data-id="<?= $user->id ?>">
                                        <option value="0" <?= $user->role == 0 ? "selected" : "" ?>>Пользователь</option>
                                        <option value="1" <?= $user->role == 1 ? "selected" : "" ?>>Администратор</option>
                                        <option value="2" <?= $user->role == 2 ? "selected" : "" ?>>Контент менеджер</option>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <?php if (count($users) != 0) : ?>
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/admin_pagination.php'; ?>
                <?php endif ?>

            </div>
        </div>
    </div>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
