<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <?php if (!empty($_SESSION['errors']['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['errors']['error'] ?></div>
            <?php unset($_SESSION['errors']['error']) ?>
        <?php endif ?>
        <form action="/register" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="first_name" class="form-label">Имя</label>
            <input name="first_name" value="" type="text" class="form-control">
            <?php if (!empty($_SESSION['errors']['first_name'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['first_name'] ?></div>
                <?php unset($_SESSION['errors']['first_name']) ?>
            <?php endif ?>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Фамилия</label>
            <input name="last_name" type="text" value="" class="form-control">
            <?php if (!empty($_SESSION['errors']['last_name'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['last_name'] ?></div>
                <?php unset($_SESSION['errors']['last_name']) ?>
            <?php endif ?>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" value="" type="text" class="form-control">
            <?php if(!empty($_SESSION['errors']['email'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['email'] ?></div>
                <?php unset($_SESSION['errors']['email']) ?>
            <?php endif ?>
            <?php if (!empty($_SESSION['errors']['invalid_email'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['invalid_email'] ?></div>
                <?php unset($_SESSION['errors']['invalid_email']) ?>
            <?php endif ?>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="1" checked>
            <label class="form-check-label" for="inlineRadio1">М</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="gender" id="gender" value="2">
            <label class="form-check-label" for="inlineRadio2">Ж</label>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input name="password" value="" class="form-control" type="text">
            <?php if (!empty($_SESSION['errors']['password'])): ?>
                <div class="alert alert-danger"><?= $_SESSION['errors']['password'] ?></div>
                <?php unset($_SESSION['errors']['password']) ?>
            <?php endif ?>
        </div>
        <div class="input-group mb-3">
            <label class="input-group-text" for="inputGroupFile01">Upload</label>
            <input name="file" value="" type="file" class="form-control" id="inputGroupFile01">
        </div>
        <?php if (!empty($_SESSION['errors']['error_file'])): ?>
            <?php foreach ($_SESSION['errors']['error_file'] as $value): ?>
                <p class="alert alert-danger"><?= $value ?></p>
            <?php endforeach; ?>
            <?php unset($_SESSION['errors']['error_file']) ?>
        <?php endif ?>
        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>