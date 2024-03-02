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
        <div class="main-catalog">
            <?php
            try {
                $sql_category = "select * from category;";
                if ($result = $conn->query($sql_category)) {
                    if ($result->num_rows > 0) {
                        foreach ($result as $row) {
                            echo "<div class='main-catalog-card main-category-card'>
                                    <a href='products_category.php?id=" . $row["id"] . "'>
                                        <img class='category-img' src='../" . $row["photo"] . "' alt='Изображение категории товаров'>
                                    </a>
                                    <p>" . $row["category_name"] . "</p>
                                </div>";
                        }
                    } else {
                        echo "<div>Нет ни одной категории</div>";
                    }
                    $result->free();
                } else {
                    echo "Ошибка: " . $conn->error;
                }
                $conn->close();
            } catch (Throwable $ex) {
                echo "Сообщение об ошибке: " . $ex->getMessage() . "<br>";
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
</body>

</html>