<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Авторизація</title>
    <link rel="stylesheet" type="text/css" href="styles/login_style.css">
</head>
<body>
<div class="logo">
    <img src="/images/login-logo.png"/>
</div>

<div class="container">
    <form class="login-form" method="post">
        <h3 class="login-form__header">Авторизація</h3>
        <div class="form-group">
            <label class="login-form__username">Логін</label>
            <input class="login-form__username-input" type="text" placeholder="Логін"
                   name="login" autocomplete="off" value="<?php echo $_SESSION["login"] ?>"/> </div>
        <div class="form-group">
            <label class="login-form__password">Пароль</label>
            <input class="login-form__password-input" type="password" placeholder="Пароль"
                   name="password" value="<?php echo $_SESSION["password"] ?>" /> </div>
        <div class="form-actions">
            <button type="submit" class="login-btn">Увійти</button>
        </div>

        <div class="create-account">
            <p>
                <a href="/register.php" id="" class="">Створити акаунт</a>
            </p>
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
if ($_POST != null) {
    $login = $_POST["login"];
    $password = $_POST["password"];
    echo "<center>Дані, які ми отримали з форми:<br>Логін: $login<br>Пароль: $password</center>";
}
if ($login != "" & $password != "") {
    // Виконуємо запит до БД
    $query = "SELECT NICKNAME, PASS_HASH, ID FROM USERS WHERE NICKNAME='$login'";
    $result = mysqli_query($connection, $query);

    // Отримаємо із результату запиту потрібні дані
    if ($result->num_rows > 0) {
        $row = $result -> fetch_row();
        $db_password = $row[1];
        if ($password == $db_password) {
            // Створюємо сесію та зберігаємо в неї значення
            $_SESSION["login"] = $row[0];
            $_SESSION["password"] = $row[1];
            $_SESSION["id"] = $row[2];
        } else {
            echo "<center>Неправильний пароль!</center>";
        }
    } else {
        echo "<center>Користувача з таким логіном не існує!</center>";
    }
}
?>

</body>
</html>

