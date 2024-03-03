<?php
include_once "../connection.php";

try {
    if (isset($_POST["buy_button"])) {
        if (isset($_SESSION["user"])) {
            echo "User est<br>";
            echo $_SERVER["HTTP_REFERER"];
            header("Location: " . $_SERVER["HTTP_REFERER"] . "");
        }
    }
} catch (Throwable $ex) {
    echo "<div>Сообщение об ошибке: " . $ex->getMessage() . "</div>";
    $conn->close();
    exit();
}