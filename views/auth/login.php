<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <?php if (!empty($_SESSION['errors']['error'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['errors']['error'] ?></div>
            <?php unset($_SESSION['errors']['error']) ?>
        <?php endif ?>
        <form action="/login" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="text" value="" class="form-control">
                <?php if (!empty($_SESSION['errors']['email'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['email'] ?></div>
                    <?php unset($_SESSION['errors']['email']) ?>
                <?php endif ?>
                <?php if (!empty($_SESSION['errors']['invalid_email'])): ?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['invalid_email'] ?></div>
                    <?php unset($_SESSION['errors']['invalid_email']) ?>
                <?php endif ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input name="password" type="text" value="" class="form-control">
                <?php if (!empty($_SESSION['errors']['password'])):?>
                    <div class="alert alert-danger"><?= $_SESSION['errors']['password'] ?></div>
                    <?php unset($_SESSION['errors']['password']) ?>
                <?php endif ?>
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>