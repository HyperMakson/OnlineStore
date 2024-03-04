<?php
include_once "../connection.php";

try {
    if (isset($_POST["buy_button"])) {
        if (isset($_SESSION["user"])) {
            $id_product = $conn->real_escape_string($_POST["id_product"]);
            $sql_get_order = "insert into orders (iduser, idproduct) values (" . $_SESSION["user"]["id"] . ", " . $id_product . ");";
            if ($conn->query($sql_get_order)) {
                ?>
                <script>window.location.replace(document.referrer);</script>
                <?php
                exit();
            } else {
                echo "<div>Произошла ошибка: " . $conn->error . "</div>";
                $conn->close();
                exit();
            }
        } else {
            echo "<div>Для покупки необходимо авторизоваться</div>";
            $conn->close();
            exit();
        }
    }
} catch (Throwable $ex) {
    echo "<div>Сообщение об ошибке: " . $ex->getMessage() . "</div>";
    $conn->close();
    exit();
}
?>