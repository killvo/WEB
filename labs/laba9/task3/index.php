<? header("Content-Type:text/html;charset=UTF-8");?>

<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Форма реєстрації</title>
    <script src="js/jquery-1.10.1.min.js" type="text/javascript"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
<div class="wrap">
    <h1>Форма реєстрації</h1>

    <form name="loginForm">
        Логін:
        <input type="text" name="login" placeholder="Введіть email" required maxlength="10">

        Пароль:
        <input name="password" id="password" placeholder="Введіть пароль" type="password"/>
        <div class="buttons">
            <input type="submit" name="submit" value="Зареєструватися">
            <input type="reset" value="Стерти">
        </div>
        <div class="messages"></div>
    </form>
    <p id="result"></p>
    <p id="bg_res"></p>
    <script>


    </script>
    <script>
        document.forms.loginForm.onsubmit = function (e) {
            e.preventDefault();

            let xhr = new XMLHttpRequest();
            xhr.open('POST', 'index.php');
            let formData = new FormData(document.forms.loginForm);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // document.location.href = "http://web:81/labs/laba9/task3/index.php";
                    let elem = document.querySelector('.messages');
                    elem.innerHTML = xhr.responseText;
                }
            }

            xhr.send(formData);
        }
    </script>

</div>


<?php

// Підключаємось до сервера
$connection = @mysqli_connect("web", "root", "root")
or die("З'єднання з БД не встановлено!");
// Встановлюємо з'єднання з БД
mysqli_select_db($connection, "web");

if ($_POST["login"] != '') {
    // Отримуємо значення параметрів із запиту
    $login = $_POST["login"];
    $password = $_POST["password"];

// Скрипт на додавання даних у таблицю
    if ($login != "" & $password != "") {
        $query = "SELECT NICKNAME, PASS_HASH, ID FROM USERS WHERE NICKNAME='$login'";
        $result = mysqli_query($connection, $query);

        // Отримаємо із результату запиту потрібні дані
        if ($result->num_rows > 0) {
            $row = $result -> fetch_row();
            $db_login = $row[0];
            $db_pass = $row[1];
            if ($login == $db_login) {
                echo "<center>Користувач з таким логіном уже існує!</center>";
            } else if ($password == $db_pass) {
                echo "<center>Успішна реєстрація!</center>";
                $query = "INSERT INTO USERS
                (NAME, SURNAME, NICKNAME, PASS_HASH, PNUM, EMAIL, TYPE, SUBSCR, REG_DATE)
                VALUES ('Тест', 'Тест', '$login', '$password', '380965367852', 'Пошта', '0', '0', '2020-09-23')";
                mysqli_query($connection, $query) or die(mysqli_error($connection));
            }
        }
    }

//Скрипт для пошуку даних у БД
    $query1 = "SELECT NICKNAME, PASS_HASH FROM USERS WHERE TYPE='0'";
    $result = $connection->query($query1);
    if ($result->num_rows > 0) {
        $text = "";
        while ($row = $result->fetch_assoc()) {
            $text .= "Логін: ". $row["NICKNAME"] . " Пароль: " . $row["PASS_HASH"] ."\n";

        }

        //Запишемо у файл
        $f = fopen("reg_text_task3.txt", "w");
        fwrite($f, $text);
        fclose($f);
    }
}


?>
</body>
</html>