<?php
include_once "../connection.php";

try {
    if (isset($_POST["reg_button"])) {
        $username = $conn->real_escape_string($_POST["username"]);
        $email = $conn->real_escape_string($_POST["email"]);
        $password = $conn->real_escape_string($_POST["password"]);

        $password = md5($password . "hafuhsibf263");
        $sql_add_user = "insert into users (username, email, password) values ('$username', '$email', '$password');";
        if ($conn->query($sql_add_user)) {
            $sql_select_user = "select * from users where email = '$email' and password = '$password';";
            if ($result = $conn->query($sql_select_user)) {
                if ($result->num_rows > 0) {
                    $user = $result->fetch_assoc();
                    $_SESSION["user"] = [
                        'id' => $user["id"],
                        'username' => $user["username"],
                        'email' => $user["email"]
                    ];
                    //setcookie('user', $username, time() + 30, "/");
                    $result->free();
                    $conn->close();
                    ?>
                    <script>window.location.replace("http://onlinestore/profile/authorization.php");</script>
                    <?php
                } else {
                    $conn->close();
                    ?>
                    <script>window.location.replace("http://onlinestore/profile/authorization.php");</script>
                    <?php
                    exit();
                }
            } else {
                echo "<div>Ошибка: " . $conn->error . "</div>";
                $conn->close();
                exit();
            }
        } else {
            echo "<div>Ошибка: " . $conn->error . "</div>";
            $conn->close();
            exit();
        }
    }
    if (isset($_POST["log_button"])) {
        $email = $conn->real_escape_string($_POST["email"]);
        $password = $conn->real_escape_string($_POST["password"]);

        $password = md5($password . "hafuhsibf263");
        $sql_select_user = "select * from users where email = '$email' and password = '$password';";
        if ($result = $conn->query($sql_select_user)) {
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                $_SESSION["user"] = [
                    'id' => $user["id"],
                    'username' => $user["username"],
                    'email' => $user["email"]
                ];
                //setcookie('user', $user["username"], time() + 30, "/");
                $result->free();
                $conn->close();
                ?>
                <script>window.location.replace("http://onlinestore/profile/authorization.php");</script>
                <?php
            } else {
                $conn->close();
                ?>
                <script>window.location.replace("http://onlinestore/profile/authorization.php");</script>
                <?php
                exit();
            }
        } else {
            echo "<div>Ошибка: " . $conn->error . "</div>";
            $conn->close();
            exit();
        }
    }
} catch (Throwable $ex) {
    echo "<div>Сообщение об ошибке: " . $ex->getMessage() . "</div>";
    $conn->close();
    exit();
}