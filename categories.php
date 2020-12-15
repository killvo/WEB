<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
if ($_GET != null) {
    if (isset($_GET["lang"])) {
        $lang = $_GET["lang"];
        if ($lang != "") {
            setcookie("lang", $lang, time()+15552000);
        }
    }
}

// Підключаємось до сервера
$connection = @mysqli_connect("web", "root", "root")
or die("З'єднання з БД не встановлено!");
// Встановлюємо з'єднання з БД
mysqli_select_db($connection, "web");
// Отримаємо з БД перелік категорій користувача та запишемо масив у сесію
$user_id = $_SESSION["id"];


function getCats($connection, $user_id) {
    $queryGetCats = "SELECT NAME FROM CATS WHERE ID_USER='$user_id'";
    $resultCats = $connection->query($queryGetCats);


    if ($resultCats->num_rows > 0) {
        $cats = array();
        $i = 0;
        while ($row = $resultCats->fetch_assoc()) {
            $cats[$i] = $row["NAME"];
            $i++;
        }
        $_SESSION["cats"] = $cats;
    }
}

getCats($connection, $user_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Домашня бухгалтерія</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/categories_style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <script src="scripts.js"></script>
</head>
<body>
<script>
    $(function () {
        $("#datepicker_from").datepicker({
            dateFormat: "dd.mm.yy",
            changeYear: true,
            minDate: new Date(2020, 1, 1),
            maxDate: new Date(2050, 12, 18)
        })
        $("#datepicker_to").datepicker({
            dateFormat: "dd.mm.yy",
            changeYear: true,
            minDate: new Date(2020, 1, 1),
            maxDate: new Date(2050, 12, 18)
        })


    })

    $( function() {
        $( "#menu" ).menu();
    } );
</script>

<div class="header">
    <div class="wrapper">
        <div class="header-logo">
            <a href="index.php">
                <img src="images/logo1.png" alt="logo">
            </a>
        </div>
        <div class="header-text">Домашня бухгалтерія</div>

        <div class="langs">
            <img src="images/ua.jpg" data-lang="ua">
            <img src="images/ru.jpg" data-lang="ru">
            <img src="images/eng.jpg" data-lang="eng">
        </div>
        <script>
            let elem = document.querySelector(".langs");
            new LangChange(elem);
        </script>
        <?php
        if (isset($_COOKIE["lang"])) {
            switch ($_COOKIE["lang"]) {
                case 'ua':
                    $l = "Українська";
                    $_COOKIE["l"] = $l;
                    break;
                case 'ru':
                    $l = "Російська";
                    $_COOKIE["l"] = $l;
                    break;
                case 'eng':
                    $l = "Англійська";
                    $_COOKIE["l"] = $l;
                    break;
            }
        }
        ?>
        <script>
            // Оновимо сторінку
            if(document.location.href !== "http://web:81/categories.php")
            {
                document.location.href = "http://web:81/categories.php";
            }

        </script>
        <?php
        echo '<div class="output">Вибрана мова: ', $_COOKIE["l"], '</div>';
        ?>
        <div class="menu">
            <ul>
                <li><a href="login.php">Login</a></li>
                |
                <li><a href="">Logout</a></li>
            </ul>
        </div>

    </div>
</div>

<div class="wrapper">
    <div class="left_block">
        <ul id="menu">
            <li class="ui-state-disabled"><div align="center">Меню</div></li>
            <li><div>Інформація</div></li>
            <li><div><a href="report.html">Звіти</a> </div></li>
            <li><div>Бюджет</div>
                <ul>
                    <li><div>Сформувати бюджет</div></li>
                    <li><div>Редагувати бюджет</div></li>
                </ul>
            </li>
            <li><div>Статистика</div></li>
            <li><div>Накопичення</div>
                <ul>
                    <li><div>Створити</div></li>
                    <li><div>Переглянути</div></li>
                </ul>
            </li>
            <li class="ui-state-disabled"><div>Pro-підписка</div></li>
        </ul>

        <!--Інформер курсу валют-->
        <a href="//finance.i.ua/" target="_blank"><img src="//f.i.ua/fp5_b15_c0_l1.png" alt="Курс долара"></a>
        <div id="SinoptikInformer" style="width:180px;" class="SinoptikInformer type4c1">
            <div class="siHeader">
                <div class="siLh">
                    <div class="siMh"><a onmousedown="siClickCount();" class="siLogo" href="https://ua.sinoptik.ua/"
                                         target="_blank" rel="nofollow" title="Погода"> </a>Погода
                    </div>
                </div>
            </div>
            <!--Інформер погоди-->
            <div class="siBody">
                <div class="siTitle"><span id="siHeader"></span></div>
                <a onmousedown="siClickCount();" href="https://ua.sinoptik.ua/погода-київ" title="Погода у Києві"
                   target="_blank">
                    <div class="siCity">
                        <div class="siCityName"><span>Київ</span></div>
                        <div id="siCont0" class="siBodyContent">
                            <div class="siLeft">
                                <div class="siTerm"></div>
                                <div class="siT" id="siT0"></div>
                                <div id="weatherIco0"></div>
                            </div>
                            <div class="siInf"><p>вологість: <span id="vl0"></span></p>
                                <p>тиск: <span id="dav0"></span></p>
                                <p>вітер: <span id="wind0"></span></p></div>
                        </div>
                    </div>
                </a>
                <div class="siLinks">Погода на 10 днів від <a href="https://ua.sinoptik.ua/погода-київ/10-днів"
                                                              title="Погода на 10 днів" target="_blank"
                                                              onmousedown="siClickCount();">sinoptik.ua</a></div>
            </div>
            <div class="siFooter">
                <div class="siLf">
                    <div class="siMf"></div>
                </div>
            </div>
        </div>
        <script charset="UTF-8"
                src="//sinoptik.ua/informers_js.php?title=3&amp;wind=1&amp;cities=303010783&amp;lang=ua"></script>

        <!-- Інформер годинник -->
        <script type="text/javascript"> var css_file = document.createElement("link");
            css_file.setAttribute("rel", "stylesheet");
            css_file.setAttribute("type", "text/css");
            css_file.setAttribute("href", "//s.bookcdn.com//css/cl/bw-cl-120x45.css");
            document.getElementsByTagName("head")[0].appendChild(css_file); </script>
        <div id="tw_6_154961440">
            <div style="width:130px; height:45px; margin: 0 auto;"><a href="https://hotelmix.com.ua/time/kiev-18881">Київ</a><br/>
            </div>
        </div>
        <script type="text/javascript"> function setWidgetData_154961440(data) {
                if (typeof (data) != 'undefined' && data.results.length > 0) {
                    for (var i = 0; i < data.results.length; ++i) {
                        var objMainBlock = '';
                        var params = data.results[i];
                        objMainBlock = document.getElementById('tw_' + params.widget_type + '_' + params.widget_id);
                        if (objMainBlock !== null) objMainBlock.innerHTML = params.html_code;
                    }
                }
            }
            var clock_timer_154961440 = -1; </script>
        <script type="text/javascript" charset="UTF-8"
                src="https://widgets.booked.net/time/info?ver=2&domid=966&type=6&id=154961440&scode=124&city_id=18881&wlangid=29&mode=1&details=0&background=ffffff&color=333333&add_background=a0a1a1&add_color=08488d&head_color=333333&border=0&transparent=0"></script>
        <!-- clock widget end -->

    </div>


    <div class="controll__category">
        <div class="add__category">
            <form method="post">
                <div class="formHtext">Додати категорію</div>
                <div class="formCat__pair">
                    <div class="formText">Тип</div>
                    <div class="form__select">
                        <select name="type">
                            <option value="cost">Витрата</option>
                            <option value="income">Дохід</option>
                        </select>
                    </div>
                </div>
                <div class="formCat__pair">
                    <div class="formText">Назва</div>
                    <div class="form__input">
                        <input type="text" autocomplete="off" name="name">
                    </div>
                </div>
                <div class="form__submit">
                    <input type="submit" name="add" value="Додати" data-action="add">
                </div>
            </form>
        </div>

        <?php
        // Обробник
        if (isset($_POST["add"])) {
            addCategory($connection, $user_id);
        } elseif (isset($_POST["edit"])) {
            editCategory($connection, $user_id);
        } elseif (isset($_POST["remove"])) {
            removeCategory($connection, $user_id);
        }


        function addCategory($connection, $user_id) {
            $type = $_POST["type"]; // cost/income
            $name = $_POST["name"];
            // Скрипт на додавання даних у таблицю
            if ($type != "" & $name != "") {
                $bType = $type == "cost"?"0":"1"; // 0-cost, 1-income
                $query = "INSERT INTO CATS (ID_USER, NAME, TYPE) VALUES ('$user_id', '$name', '$bType')";
                mysqli_query($connection, $query) or die(mysqli_error($connection));
                getCats($connection, $user_id);
            }
        }

        function editCategory($connection, $user_id) {
            if (isset($_POST)) {
                $select = $_POST["categorySelect"]; // Ім'я категорії для зміни
                $type = $_POST["typeChange"]; // cost/income
                $name = $_POST["nameChange"];
                if ($select != "" & $type != "" & $name != "") {

                    $bType = $type == "cost"?"0":"1"; // 0-cost, 1-income
                    $query = "UPDATE CATS SET NAME='$name', TYPE='$bType' WHERE NAME='$select'";
                    mysqli_query($connection, $query) or die(mysqli_error($connection));
                    getCats($connection, $user_id);
                }
            }
        }

        function removeCategory($connection, $user_id) {
            $select = $_POST["categorySelect"];
            // Скрипт на додавання даних у таблицю
            if ($select != "") {
                $query = "DELETE FROM CATS WHERE NAME='$select'";
                mysqli_query($connection, $query) or die(mysqli_error($connection));
                getCats($connection, $user_id);
            }
        }
        ?>



        <div class="edit__category">
            <form method="post">
                <div class="formHtext">Редагувати категорію</div>
                <div class="formCat__pair">
                    <div class="formText">Категорія</div>
                    <div class="form__select">
                        <select name="categorySelect">
                            <option value="select" selected="selected"></option>
                            <?php
                            $categories = $_SESSION["cats"];
                            foreach ($categories as $c) {
                                echo "<option value='$c'>$c</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="formCat__pair">
                    <div class="formText">Тип</div>
                    <div class="form__select">
                        <select name="typeChange">
                            <option value="cost">Витрата</option>
                            <option value="income">Дохід</option>
                        </select>
                    </div>
                </div>
                <div class="formCat__pair">
                    <div class="formText">Назва</div>
                    <div class="form__input">
                        <input type="text" autocomplete="off" name="nameChange">
                    </div>
                </div>
                <div class="form__submit">
                    <input type="submit" value="Змінити" name="edit" data-action="edit">
                </div>
            </form>
        </div>
        <div class="delete__category">
            <form method="post">
                <div class="formHtext">Видалити категорію</div>
                <div class="form__pair">
                    <div class="formText">Категорія</div>
                    <div class="form__select">
                        <select name="categorySelect">
                            <option value="select" selected="selected"></option>
                            <?php
                            $categories = $_SESSION["cats"];
                            foreach ($categories as $c) {
                                echo "<option value='$c'>$c</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form__submit_delete">
                    <input type="submit" value="Видалити" name="remove" data-action="remove">
                </div>
            </form>
        </div>
    </div>

</div>


<div class="footer">
    <div class="wrapper">
        <p>Copyright: Volodymyr Chumak & Evheniy Volyk
            2020
        </p>
    </div>
    <div class="container">
        <a class="n" href="https://www.instagram.com/?hl=ru"><i id="m" class="fa fa-instagram" aria-hidden="true"></i></a>
        <a class="n" href="https://uk-ua.facebook.com/"><i id="m" class="fa fa-facebook" aria-hidden="true"></i></a>
        <a class="n" href="https://twitter.com/?lang=ru"><i id="m" class="fa fa-twitter" aria-hidden="true"></i></a>
        <a class="n" href="https://www.pinterest.com/"><i id="m" class="fa fa-pinterest" aria-hidden="true"></i></a>
    </div>
</div>


</body>
</html>