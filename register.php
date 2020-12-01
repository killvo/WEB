<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
    <link rel="stylesheet" type="text/css" href="styles/login_style.css">
</head>
<body>
<div class="reg_form">
    <form method="post">
        Ім'я<input type="text" name="name" autocomplete="off"><br>
        Прізвище<input type="text" name="surname" autocomplete="off"><br>
        Номер телефону (12 цифр)<input type="text" name="pnum" autocomplete="off"><br>
        E-mail *<input type="text" name="email" autocomplete="off"><br>
        Логін *<input type="text" name="login" autocomplete="off"><br>
        Пароль *<input type="password" name="password" autocomplete="off"><br>
        <button type="submit">Увійти</button>
    </form>
</div>

<?php
    // Підключаємось до БД
    $connection = @mysqli_connect("web", "root", "root")
    or die("З'єднання з БД не встановлено!");
    mysqli_select_db($connection, "web");

    // Отримуємо значення параметрів із запиту
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $pnum = $_POST["pnum"];
    $email = $_POST["email"];
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Скрипт на додавання даних у таблицю
    if ($login != "" & $password != "") {
        $query = "INSERT INTO USERS
        (NAME, SURNAME, NICKNAME, PASS_HASH, PNUM, EMAIL, TYPE, SUBSCR, REG_DATE)
        VALUES ('$name', '$surname', '$login', '$password', '$pnum', '$email', '0', '0', '2020-12-2')";

        mysqli_query($connection, $query) or die(mysqli_error($connection));
    }

    //Скрипт для пошуку даних у БД та їх виведення на екран
    $query1 = "SELECT NAME, SURNAME, EMAIL FROM USERS WHERE TYPE='0'";
    $result = $connection->query($query1);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<br>Ім'я: ". $row["NAME"] . "<br>Прізвище: ". $row["SURNAME"] ."<br>Email: ". $row["EMAIL"];
        }
    }

?>
</body>
</html>

