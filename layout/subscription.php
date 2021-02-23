<!-- <hr> -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-5">
            <form class="form-inline form-subscribe">
            <div class="card w-100 text-center border-light">
                <div class="card-body">
                        <?php if (!isSession()) { ?>
                            <input class="form-control mr-sm-2 input-subscribe" type="email" name='email' placeholder="Email" required>
                            <button class="btn-primary btn-subscribe-main" type="submit">Подписаться</button>
                        <?php } else { ?>
                            <input class="form-control mr-sm-2 input-subscribe" type="email" name='email' placeholder="Email" value="<?= $_SESSION['user']->email ?>" required hidden>
                            <button class="btn-primary btn-subscribe-main" data-id="<?= $_SESSION['user']->id ?>" type="submit">Подписаться</button>
                        <?php } ?>
                    <small class="form-text text-muted text-muted-subscribe">Подпишитесь на появление новых статей</small>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
