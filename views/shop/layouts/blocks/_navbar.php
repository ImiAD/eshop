<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Домой</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/register">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth/login">Вход</a>
                </li>
                <?php if (!empty($_SESSION['user'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">ЛК</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout?exit=1">Выход</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>