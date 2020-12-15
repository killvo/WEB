<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
    <link rel="stylesheet" type="text/css" href="styles/register_style.css">
</head>
<body>
<div class="logo">
    <img src="images/login-logo.png" alt="" />
</div>

<div class="container">
    <form class="register-form" method="post">
        <h3 class="register-form__header">Реєстрація</h3>
        <div class="form-group">
            <label class="register-form__username">Ім'я</label>
            <input class="register-form__username-input" type="text" placeholder="Ім'я" name="name" autocomplete="off"/></div>
        <div class="form-group">
            <label class="register-form__username">Прізвище</label>
            <input class="register-form__username-input" type="text" id="register_password" placeholder="Прізвище" name="surname" /> </div>
        <div class="form-group">
            <label class="register-form__username">Номер телеф.</label>
            <input class="register-form__username-input" type="text" autocomplete="off" placeholder="(380)*********" name="pnum" /> </div>
        <div class="form-group">
            <label class="register-form__username">E-mail</label>
            <input class="register-form__username-input" type="text" id="register_password" placeholder="E-mail" name="email" /> </div>
        <div class="form-group">
            <label class="register-form__username">Логін</label>
            <input class="register-form__username-input" type="text" id="register_password" placeholder="Логін" name="login" /> </div>
        <div class="form-group">
            <label class="register-form__password">Пароль</label>
            <input class="register-form__password-input" type="password" id="register_password" placeholder="Пароль" name="password" /> </div>
        <div class="form-actions">
            <button type="submit" id="register-submit-btn" class="register-btn">Зареєструватися</button>
        </div>
    </form>
</div>

<?php
    // Підключаємось до сервера
    $connection = @mysqli_connect("web", "root", "root")
    or die("З'єднання з БД не встановлено!");
    // Встановлюємо з'єднання з БД
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
        $text = "";
        while ($row = $result->fetch_assoc()) {
            $text .= "Ім'я: ". $row["NAME"] . " Прізвище: " . $row["SURNAME"] ."\n";
            echo "<center><br>Ім'я: ". $row["NAME"] . "<br>Прізвище: "
                . $row["SURNAME"] ."<br>Email: ". $row["EMAIL"]. "</center>";
        }

        //Запишемо у файл
        $f = fopen("reg_text.txt", "w");
        fwrite($f, $text);
        fclose($f);
    }

?>
</body>
</html>

