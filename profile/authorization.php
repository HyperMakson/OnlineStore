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
        <div class="side-nav">
            <button class="drop-down-btn-close">&#10006;</button>
            <ul>
                <li><a href="../index.php">Главная</a></li>
                <li><a href="../categories/category.php">Категории</a></li>
                <li><a href="authorization.php">Профиль</a></li>
            </ul>
        </div>
    </div>
    <div class="main">
        <div class="main-catalog">
            <?php
            if (isset($_SESSION["user"])) {
                ?>
                <div class="profile-container">
                    <div class="profile-info">
                        <?php
                        echo "<div>
                            <p>Вы авторизованы как " . $_SESSION["user"]["username"] . "</p>
                            <p>Выйти: <a href='exit_auth.php'>здесь</a></p>
                        </div>";
                        ?>
                    </div>
                    <div class="orders-label">
                        <p>Заказы</p>
                    </div>
                    <div class="profile-orders">
                        <?php
                        try {
                            if ($_SESSION["user"]["role"] === "admin") {
                                echo "<div class='orders-list-none'>Its admin</div>";
                                $sql_orders = "select users.username, products.productname, products.price, products.photo, orders.date_purchase
                                from (users inner join orders on users.id = orders.iduser) inner join products on products.id =
                                orders.idproduct order by orders.date_purchase DESC;";
                            } else {
                                $sql_orders = "select users.username, products.productname, products.price, products.photo, orders.date_purchase
                                from (users inner join orders on users.id = orders.iduser) inner join products on products.id =
                                orders.idproduct where users.id = " . $_SESSION["user"]["id"] . " order by orders.date_purchase DESC;";
                            }
                            if ($result = $conn->query($sql_orders)) {
                                if ($result->num_rows > 0) {
                                    foreach ($result as $order) {
                                        echo "<div class='orders-list'>
                                                <div>
                                                    <p>Имя пользователя: " . $order["username"] . "</p>
                                                    <p>Товар: " . $order["productname"] . "</p>
                                                    <p>Цена: " . $order["price"] . " &#8381</p>
                                                    <p>Дата покупки: " . $order["date_purchase"] . "</p>
                                                </div>
                                                <div>
                                                    <p><img class='card-img' src='../" . $order["photo"] . "'></p>
                                                </div>
                                        </div>";
                                    }
                                } else {
                                    echo "<div class='orders-list-none'>Заказов не найдено</div>";
                                }
                            } else {
                                echo "<div>Ошибка: " . $conn->error . "</div>";
                            }
                            $conn->close();
                        } catch (Throwable $ex) {
                            echo "<div>Сообщение об ошибке: " . $ex->getMessage() . "</div>";
                            $conn->close();
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
                if (isset($_SERVER["HTTP_REFERER"])) {
                    if ($_SERVER["HTTP_REFERER"] === "http://onlinestore/profile/check_buy.php") {
                        ?>
                        <div class='overlay'>
                            <script>
                                var bodyStop = document.querySelector("body");
                                bodyStop.classList.add("stop");
                            </script>
                        </div>
                        <div class='confirm-buy-win'>
                            <p>Для покупки необходимо авторизоваться</p>
                            <div>
                                <button class='btn-del-win'>ОК</button>
                            </div>
                        </div>
                        <?php
                    }
                    if ($_SERVER["HTTP_REFERER"] === "http://onlinestore/profile/check_auth.php") {
                        ?>
                        <div class='overlay'>
                            <script>
                                var bodyStop = document.querySelector("body");
                                bodyStop.classList.add("stop");
                            </script>
                        </div>
                        <div class='confirm-buy-win confirm-user-not'>
                            <p>Пользователь не найден</p>
                            <div>
                                <button class='btn-del-win'>ОК</button>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
                <div class="auth-block" id="container">
                    <div class="form-container sign-up">
                        <form action="check_auth.php" method="post" class="form-reg">
                            <h1>Зарегистрироваться</h1>
                            <input type="text" name="username" class="input-style input-name" placeholder="Имя" required>
                            <input type="email" name="email" class="input-style input-email" placeholder="Email" required>
                            <input type="password" name="password" class="input-style input-pass" placeholder="Пароль"
                                required>
                            <input type="submit" name="reg_button" class="auth-btn" value="Зарегистрироваться">
                        </form>
                    </div>
                    <div class="form-container sign-in">
                        <form action="check_auth.php" method="post" class="form-log">
                            <h1>Войти в профиль</h1>
                            <input type="email" name="email" class="input-style input-email" placeholder="Email" required>
                            <input type="password" name="password" class="input-style input-pass" placeholder="Пароль"
                                required>
                            <a href="#">Забыли пароль?</a>
                            <input type="submit" name="log_button" class="auth-btn" value="Войти">
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