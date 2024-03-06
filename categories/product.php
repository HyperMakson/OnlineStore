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
                <li><a href="category.php">Категории</a></li>
                <li><a href="../profile/authorization.php">Профиль</a></li>
            </ul>
            <button class="drop-down-btn"><img src="../pictures/drop-down1.png" alt="Выпадающий список"></button>
        </div>
    </div>
    <div class="main">
        <?php
        try {
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
                        <p>Покупка была успешно произведена</p>
                        <div>
                            <button class='btn-del-win'>ОК</button>
                            <button class='btn-go-profile'>Посмотреть</button>
                        </div>
                    </div>
                    <?php
                }
            }
            if (isset($_GET["id"])) {
                $product_id = $conn->real_escape_string($_GET["id"]);
                $sql_product = "select * from products inner join product_desc on products.id = product_desc.idproduct where products.id = '$product_id';";
                if ($result = $conn->query($sql_product)) {
                    if ($result->num_rows > 0) {
                        echo "<div class='product-card'>";
                        foreach ($result as $row) {
                            echo "<div class='product-card-up'>
                                    <div class='product-card-up-left'>
                                        <img class='card-img' src='../" . $row["photo"] . "' alt='Изображение телефона'>
                                    </div>
                                    <form class='product-card-up-right' action='../profile/check_buy.php' method='post'>
                                        <p>" . $row["productname"] . "</p>
                                        <p>Цена: " . $row["price"] . " &#8381</p>
                                        <input type='hidden' class='hidden_id_product' value='" . $row["id"] . "' name='id_product'>
                                        <input type='submit' class='card-btn' value='Купить' name='buy_button'>
                                    </form>
                                </div>
                                <div class='product-card-down'>
                                    <p>Описание:</p>
                                    <p>" . $row["description"] . "</p>
                                    <p>Характеристики:</p>
                                    <p>Производитель: " . $row["manufacturer"] . "</p>
                                    <p>Операционная система: " . $row["os"] . "</p>
                                    <p>Дисплей: " . $row["display"] . "</p>
                                    <p>Процессор: " . $row["processor"] . "</p>
                                    <p>Оперативная память: " . $row["ram_memory"] . "</p>
                                    <p>Флэш-память: " . $row["flash_memory"] . "</p>
                                    <p>Основная камера: " . $row["main_camera"] . "</p>
                                    <p>Фронтальная камера: " . $row["front_camera"] . "</p>
                                </div>";
                        }
                        echo "</div>";
                    } else {
                        echo "<div>Товар закончился</div>";
                    }
                    $result->free();
                } else {
                    echo "Ошибка: " . $conn->error;
                }
                $conn->close();
            } else {
                echo "<div>Такого продукта не существует</div>";
            }
        } catch (Throwable $ex) {
            echo "Сообщение об ошибке: " . $ex->getMessage() . "<br>";
        }
        ?>
    </div>
    <div class="footer">
        <div class="footer-info">
            <p>Данный проект является тестовым для учебных целей</p>
        </div>
    </div>
    <script src="../scripts/script.js"></script>
</body>

</html>