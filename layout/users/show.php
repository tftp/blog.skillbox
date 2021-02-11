<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php'; ?>
<?php if (isset($error)) : ?>
    <div class="alert alert-danger" role="alert" >
        <?= $error ?>
    </div>
<?php endif; ?>

<form  method="post" enctype="multipart/form-data">
<div class="row">
  <div class="col-sm-2">
    <div class="card">
        <img class="card-img-top" width="100" src="<?= $_SESSION['user']->avatar ? '/images/' . $_SESSION['user']->avatar : '/images/noname-avatar.png' ?>" alt="Ваше фото">
      <div class="card-body">
          <input type="file" name="user-avatar" accept="image/gif, image/jpeg, image/png" id="user-avatar" hidden  value=<?= $_SERVER['DOCUMENT_ROOT'] . '/images/noname-avatar.png' ?>>
          <a href="#" id="click-user-avatar" class="card-link">Изменить аватар</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
      <!-- <div class="card" style="height: 18rem;"> -->
      <div class="card">
      <div class="card-body">
        <h5 class="card-title">Профиль пользователя</h5>
        <p class="card-text">Имя: <?= $_SESSION['user']->name; ?></p>
        <p class="card-text">Email: <?= $_SESSION['user']->email; ?></p>
        <p class="card-text">О себе: <?= $_SESSION['user']->annotation ? $_SESSION['user']->annotation : 'ничего не написано' ?></p>
        <div class="form-group  text-area-div" hidden>
            <textarea class="form-control text-area" name="text" rows="6" cols="60"><?= $_SESSION['user']->annotation ? $_SESSION['user']->annotation : '' ?></textarea>
            <small class="form-text text-muted">Ограничение по колличеству символов: 255</small>

        </div>
        <a href="#" class="card-link" id="click-user-text">Добавить что нибудь о себе</a>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card text-center" style="height: 14rem;">

      <div class="card-body">
          <h5 class="card-title">Подписка</h5>
          <h6 class="card-subtitle mb-2 text-muted">Вы можете подписаться или отписаться от рассылки</h6>
          <button class="btn btn-primary btn-subscribe" data-subscribe= <?= $_SESSION['subscribe'] ? "1 >Отписаться" : "0 >Подписаться" ?> </button>
      </div>
    </div>
  </div>
</div>
<div class="row justify-content-end">
    <div class="col-sm-8">
        <button type="submit" class="btn btn-primary btn-save" hidden>Сохранить данные</button>
</div>
</div>
</form>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php'; ?>
