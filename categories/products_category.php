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
    <div class="main main-products-category">
        <div class="product-filters">
            <p>Фильтры</p>
            <form action="" method="post">
                <div class="filter-manufacturer">
                    <label for="manufacturer-select">Производитель:</label>
                    <select name="manufacturer" id="manufacturer-select">
                        <option value="">Выберите производителя</option>
                        <?php
                        try {
                            $sql_manufacturer = "select distinct manufacturer from product_desc;";
                            if ($result = $conn->query($sql_manufacturer)) {
                                if ($result->num_rows > 0) {
                                    foreach ($result as $row) {
                                        echo "<option value='" . strtolower($row["manufacturer"]) . "'>" . $row["manufacturer"] . "</option>";
                                    }
                                } else {
                                    echo "<option value=''>Нет производителей</option>";
                                }
                            } else {
                                echo "<option value=''>Произошла ошибка</option>";
                            }
                        } catch (Throwable $ex) {
                            echo "Сообщение об ошибке: " . $ex->getMessage() . "<br>";
                        }
                        ?>
                    </select>
                </div>
                <div class="filter-price">
                    <p>Цена:</p>
                    <div class="price-min">
                        <p>Min</p>
                        <input type="number" class="inputNumber" name="min-price" value="0">
                        <input type="range" class="inputRange" min="0" max="250000" value="0" step="1000">
                    </div>
                    <div class="price-max">
                        <p>Max</p>
                        <input type="number" class="inputNumber" name="max-price" value="250000">
                        <input type="range" class="inputRange" min="0" max="250000" value="250000" step="1000">
                    </div>
                </div>
                <div class="filters-button">
                    <input type="submit" name="submit_filters" value="Применить">
                    <input type="submit" name="reset_filters" value="Сбросить">
                </div>
            </form>
        </div>
        <div class="main-catalog main-catalog-category">
            <?php
            try {
                if (isset($_GET["id"])) {
                    $category_id = $conn->real_escape_string($_GET["id"]);
                    if (!empty($_POST)) {
                        if (isset($_POST["submit_filters"])) {
                            $sql_products_category = "select * from products inner join product_desc on products.id = product_desc.idproduct
                            where idcategory = '$category_id'";
                            if (isset($_POST["manufacturer"]) and $_POST["manufacturer"] !== "") {
                                $manufacturer = $conn->real_escape_string($_POST["manufacturer"]);
                                $sql_products_category .= " and product_desc.manufacturer = '$manufacturer'";
                            }
                            if (isset($_POST["min-price"]) and isset($_POST["max-price"]) and $_POST["min-price"] !== "" and $_POST["max-price"] !== "") {
                                $min_price = $conn->real_escape_string($_POST["min-price"]);
                                $max_price = $conn->real_escape_string($_POST["max-price"]);
                                if ($max_price > $min_price) {
                                    $sql_products_category .= " and products.price > $min_price and products.price < $max_price";
                                } else {
                                    $sql_products_category = "select * from products where idcategory = '$category_id';";
                                    ?>
                                    <script>alert("Фильтры указаны неверно");</script>
                                    <?php
                                }
                            }
                        } else {
                            $sql_products_category = "select * from products where idcategory = '$category_id';";
                        }
                    } else {
                        $sql_products_category = "select * from products where idcategory = '$category_id';";
                    }
                    if ($result = $conn->query($sql_products_category)) {
                        if ($result->num_rows > 0) {
                            foreach ($result as $row) {
                                echo "<div class='main-catalog-card'>
                                        <a href='product.php?id=" . $row["id"] . "'>
                                            <img class='card-img' src='../" . $row["photo"] . "' alt='Изображение телефона'>
                                        </a>
                                        <p>" . $row["productname"] . "</p>
                                        <p>Цена: " . $row["price"] . " &#8381</p>
                                        <button class='card-btn'>Купить</button>
                                    </div>";
                            }
                        } else {
                            echo "<div>Нет ни одного товара в категории</div>";
                        }
                        $result->free();
                    } else {
                        echo "Ошибка: " . $conn->error;
                    }
                    $conn->close();
                } else {
                    echo "<div>Такой категории не существует</div>";
                }
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