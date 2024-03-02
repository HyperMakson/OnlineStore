<?php
include_once "../connection.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Online Store</title>
</head>

<body>
    <div class="header">
        <div class="header-logo">
            <h1>Online Store</h1>
        </div>
        <div class="header-nav">
            <ul>
                <li><a href="../index.php">Главная</a></li>
                <li><a href="../categories/category.php">Категории</a></li>
                <li><a href="authorization.php">Профиль</a></li>
            </ul>
            <button class="drop-down-btn"><img src="../pictures/drop-down1.png" alt="Выпадающий список"></button>
        </div>
    </div>
    <div class="main">
        <div class="main-catalog">
            <?php
            if (isset($_SESSION["user"])) {
                ?>
                <div class="profile-container">
                    <?php
                    echo "<div>Вы авторизованы как " . $_SESSION["user"]["username"] . "</div>
                    <div>Выйти: <a href='exit_auth.php'>здесь</a></div>";
                    ?>
                </div>
                <?php
            } else {
                ?>
                <div class="auth-block" id="container">
                    <div class="form-container sign-up">
                        <form action="check_auth.php" method="post">
                            <h1>Зарегистрироваться</h1>
                            <input type="text" name="username" class="input-style" placeholder="Имя">
                            <input type="email" name="email" class="input-style" placeholder="Email">
                            <input type="password" name="password" class="input-style" placeholder="Пароль">
                            <input type="submit" name="reg_button" value="Зарегистрироваться">
                        </form>
                    </div>
                    <div class="form-container sign-in">
                        <form action="check_auth.php" method="post">
                            <h1>Войти в профиль</h1>
                            <input type="email" name="email" class="input-style" placeholder="Email">
                            <input type="password" name="password" class="input-style" placeholder="Пароль">
                            <a href="#">Забыли пароль?</a>
                            <input type="submit" name="log_button" value="Войти">
                        </form>
                    </div>
                    <div class="toggle-container">
                        <div class="toggle">
                            <div class="toggle-panel toggle-left">
                                <h1>С возвращением</h1>
                                <p>Чтобы использовать полный функционал сайта, необходимо войти в аккаунт</p>
                                <button class="hidden" id="login">Войти</button>
                            </div>
                            <div class="toggle-panel toggle-right">
                                <h1>Добро пожаловать</h1>
                                <p>Чтобы использовать полный функционал сайта, необходимо зарегистрироваться</p>
                                <button class="hidden" id="register">Зарегистрироваться</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="footer">
        <div class="footer-info">
            <p>Данный проект является тестовым для учебных целей</p>
        </div>
    </div>
    <script src="../scripts/script.js"></script>
    <script src="../scripts/script_auth.js"></script>
</body>

</html>