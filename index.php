<?php
include_once "connection.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Online Store</title>
</head>

<body>
    <div class="header">
        <div class="header-logo">
            <h1>Online Store</h1>
        </div>
        <div class="header-nav">
            <ul>
                <li><a href="index.php">Главная</a></li>
                <li><a href="categories/category.php">Категории</a></li>
                <li><a href="profile/authorization.php">Профиль</a></li>
            </ul>
            <button class="drop-down-btn"><img src="pictures/drop-down1.png" alt="Выпадающий список"></button>
        </div>
    </div>
    <div class="main">
        <div class="hero">
            <div class="hero-label">
                <h1>Интернет-магазин</h1>
                <p>Большой выбор различной техники, такой как смартфоны и ноутбуки</p>
            </div>
        </div>
        <div class="main-catalog-label">
            <p>Последние модели телефонов</p>
        </div>
        <div class="main-catalog">
            <?php
            try {
                // Немного не то, надо додумать
                if (isset($_SERVER["HTTP_REFERER"])) {
                    if ($_SERVER["HTTP_REFERER"] == "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]) {
                        echo "YESS";
                    }
                }
                // .
                $sql_products = "select * from products order by id desc limit 10;";
                if ($result = $conn->query($sql_products)) {
                    if ($result->num_rows > 0) {
                        foreach ($result as $row) {
                            echo "<form class='main-catalog-card' action='profile/check_buy.php' method='post'>
                                    <a href='categories/product.php?id=" . $row["id"] . "'>
                                        <img class='card-img' src='" . $row["photo"] . "' alt='Изображение телефона'>
                                    </a>
                                    <p>" . $row["productname"] . "</p>
                                    <p>Цена: " . $row["price"] . " &#8381</p>
                                    <input type='submit' class='card-btn' value='Купить' name='buy_button'>
                                </form>";
                        }
                    } else {
                        echo "<div>Весь товар закончился</div>";
                    }
                    $result->free();
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
    <div class="footer">
        <div class="footer-info">
            <p>Данный проект является тестовым для учебных целей</p>
        </div>
    </div>
    <script src="scripts/script.js"></script>
</body>

</html>