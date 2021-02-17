<a name="comment"></a>
<div class="container m-3">
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert" >
                        <?= $error; ?>
                    </div>
                <?php endif ?>
                <div class="card-header">Комментарии</div>
                <div class="card-body">
                    <?php foreach ($comments as $comment) { ?>
                        <?php if ($comment->trust || (isSession() && $_SESSION['user']->id == $comment->users_id)) { ?>
                            <small class="card-text">
                                <?= $comment->name ?>,
                                <?=  date('d-m-Y H:m:s', strtotime($comment->create_time)); ?>
                                <?= $comment->trust ? '' : ' комментарий на модерации' ?>
                            </small>
                            <p class='card-text'>
                                <?= $comment->body ?>
                            </p>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Добавить свой комментарий</h5>
                    <form class="" action="#comment" method="post">
                        <div class="form-group  text-area-div">
                            <textarea class="form-control text-area" name="body" rows="6" cols="60"></textarea>
                            <small class="form-text text-muted">Ограничение по колличеству символов: 255</small>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary my-2">Отправить</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
