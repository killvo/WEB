<?php
header("Content-Type: text/html; charset=UTF-8");
session_start();
if ($_GET != null) {
    $lang = $_GET["lang"];
    if ($lang != "") {
        setcookie("lang", $lang, time()+15552000);
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

function getCatId($connection, $user_id, $cat_name) {
    $queryGetID = "SELECT ID FROM CATS WHERE ID_USER='$user_id' AND NAME='$cat_name'";
    $resultID = $connection->query($queryGetID);

    if ($resultID->num_rows > 0) {
        $row = $resultID->fetch_assoc();
        $id = $row["ID"];
        return $id;
    }
}

function getIDs($connection, $user_id) {
    $queryGetIDs = "SELECT o.ID FROM OPS o, CATS c WHERE c.ID_USER=$user_id AND o.ID_CAT=c.ID ORDER BY o.ID";
    $resultIDs = $connection->query($queryGetIDs);

    if ($resultIDs->num_rows > 0) {
        $ids = array();
        $i = 0;
        while ($row = $resultIDs->fetch_assoc()) {
            $ids[$i] = $row["ID"];
            $i++;
        }
        $_SESSION["ids"] = $ids;
    }
}

getCats($connection, $user_id);
getIDs($connection, $user_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Домашня бухгалтерія</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/index_style.css">
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
            dateFormat: "yy-mm-dd",
            changeYear: true,
            minDate: new Date(2020, 1, 1),
            maxDate: new Date(2050, 12, 18)
        })
        $("#datepicker_to").datepicker({
            dateFormat: "yy-mm-dd",
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
            <a href="">
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
            if(document.location.href !== "http://web:81/index.php")
            {
                document.location.href = "http://web:81/index.php";
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
            <li><div><a href="categories.php">Керування категоріями</a></div></li>
            <li><div><a href="labs/laba9/task3/index.php">Лаба9 варіант 3</a></div></li>
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

    <div class="table_block">
        <table>
            <tr>
                <th>ID</th>
                <th>Категорія</th>
                <th>Дата</th>
                <th>Сума</th>
                <th>Коментар</th>
            </tr>
            <?php
            $payments = $_SESSION["payments"];
            $i = 0;
            foreach ($payments as $key => $value) {
                echo "<tr>";
                echo "<td>".$value['id']. "</td>";
                echo "<td>".$value['category']. "</td>";
                echo "<td>".$value['date']. "</td>";
                echo "<td>".$value['sum']. "</td>";
                echo "<td>".$value['comment']. "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
        </table>
    </div>



    <?php
    // Обробник

    if ($_POST["categorySelectAdd"] != '') {
        addPayment($connection, $user_id);
    } elseif (isset($_POST["edit"])) {
        editPayment($connection, $user_id);
    } elseif ($_POST["paymentDeleteSelect"] != '') {
        removePayment($connection, $user_id);
    }



    function addPayment($connection, $user_id) {
        $select = $_POST["categorySelectAdd"];
        $date = $_POST["date"];
        $sum = $_POST["sum"];
        $comment = $_POST["comment"];
        // Скрипт на додавання даних у таблицю
        if ($select != "" & $date != "" & $comment != "" & $sum != "") {
            $cat_id = (int) getCatId($connection, $user_id, $select);
            $query = "INSERT INTO OPS (ID_CAT, SUM, OP_DATE, COMMENT)
                VALUES ('$cat_id', '$sum', '$date', '$comment')";
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            $_POST["categorySelect"] = "";
            getCats($connection, $user_id);
        }
    }

    function editPayment($connection, $user_id) {
        $select = $_POST["paymentEditSelect"];
        $catSelect = $_POST["categorySelect"];
        $date = $_POST["date"];
        $sum = $_POST["sum"];
        $comment = $_POST["comment"];

        if ($select != "" & $date != "" & $sum != "" & $comment != "") {
            $pID = (int)$select;
            $cat_id = (int)getCatId($connection, $user_id, $catSelect);
            $query = "UPDATE OPS SET ID_CAT='$cat_id', SUM='$sum', OP_DATE='$date', COMMENT='$comment'
                    WHERE ID='$pID'";
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            getCats($connection, $user_id);
        }
        getIDs($connection, $user_id);
    }

    function removePayment($connection, $user_id) {
        $select = $_POST["paymentDeleteSelect"];
        if ($select != "") {
            $query = "DELETE FROM OPS WHERE ID='$select'";
            mysqli_query($connection, $query) or die(mysqli_error($connection));
            getCats($connection, $user_id);
        }
        getIDs($connection, $user_id);
    }
    ?>

    <div class="sort_block">
        <div class="sort_block_form">
            <form name="showForm">
                <div class="formHtext">Переглянути за:</div>
                <div class="form__pair">
                    <div class="formText">Категорією</div>
                    <div class="form__select">
                        <select name="showCategory">
                            <option value="select" selected="selected"></option>
                            <option value="cost">Тип:витрати</option>
                            <option value="income">Тип:доходи</option>
                            <option value="all">Всі категорії</option>
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
                <!--<div class="form__pair">
                    <div class="formText">Місяцем</div>
                    <div class="form__select">
                        <select name="showMonth">
                            <option value="select" selected="selected"></option>
                            <option value="1">Січень</option>
                            <option value="2">Лютий</option>
                            <option value="3">Березень</option>
                            <option value="4">Квітень</option>
                            <option value="5">Травень</option>
                            <option value="6">Червень</option>
                            <option value="7">Липень</option>
                            <option value="8">Серпень</option>
                            <option value="9">Вересень</option>
                            <option value="10">Жовтень</option>
                            <option value="11">Листопад</option>
                            <option value="12">Грудень</option>
                        </select>
                    </div>
                </div>-->
                <!-- за період -->
                <div class="formText">Певний період</div><br>
                <div class="form__pair">
                    <div class="formText">Від</div>
                    <input type="text" id="datepicker_from" name="showFrom" autocomplete="off">
                </div>
                <div class="form__pair">
                    <div class="formText">До</div>
                    <input type="text" id="datepicker_to" name="showTo" autocomplete="off">
                </div>
                <div class="form__submit">
                    <input id="show" type="submit" value="Показати">
                </div>
            </form>
        </div>

        <script>
            document.forms.showForm.onsubmit = function (e) {
                e.preventDefault();

                let xhr = new XMLHttpRequest();
                xhr.open('POST', 'index.php');
                let formData = new FormData(document.forms.showForm);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.location.href = "http://web:81/index.php";
                    }
                }

                xhr.send(formData);
            }
        </script>

        <?php

        $catName = $_POST["showCategory"];
        if ($catName === 'cost') {
            getByType($connection, $user_id, '0');
        } elseif ($catName === 'income') {
            getByType($connection, $user_id, '1');
        } elseif ($catName === 'all') {
            getAll($connection, $user_id);
        } else {
            getByName($connection, $user_id, $catName);
        }
        if ($_POST["showFrom"] != "") {
            $from = $_POST["showFrom"];
            $to = $_POST["showTo"];
            getByDate($connection, $user_id, $from, $to);
        }
        function getCatNameById($connection, $user_id, $id) {
            $queryGetName = "SELECT NAME FROM CATS WHERE ID_USER='$user_id' AND ID='$id'";
            $resultName = $connection->query($queryGetName);

            if ($resultName->num_rows > 0) {
                $row = $resultName->fetch_assoc();
                return $row["NAME"];
            }
        }

        function getByType($connection, $user_id, $type) {
            $queryGetPayments = "SELECT o.* FROM OPS o, CATS c 
                WHERE c.ID_USER=$user_id AND o.ID_CAT=c.ID AND c.TYPE='$type' ORDER BY o.ID";
            $resultPayments = $connection->query($queryGetPayments);

            if ($resultPayments->num_rows > 0) {
                $payments = array(array());
                $i = 0;
                while ($row = $resultPayments->fetch_assoc()) {
                    $payments[$i]["id"] = $row["ID"];
                    $catName = getCatNameById($connection, $user_id, $row["ID_CAT"]);
                    $payments[$i]["category"] = $catName;
                    $payments[$i]["sum"] = $row["SUM"];
                    $payments[$i]["date"] = $row["OP_DATE"];
                    $payments[$i]["comment"] = $row["COMMENT"];
                    $i++;
                }
                $_SESSION["payments"] = $payments;
            }
        }

        function getByName($connection, $user_id, $name) {
            $queryGetPayments = "SELECT o.* FROM OPS o, CATS c 
                WHERE c.ID_USER=$user_id AND o.ID_CAT=c.ID AND c.NAME='$name' ORDER BY o.ID";
            $resultPayments = $connection->query($queryGetPayments);

            if ($resultPayments->num_rows > 0) {
                $payments = array(array());
                $i = 0;
                while ($row = $resultPayments->fetch_assoc()) {
                    $payments[$i]["id"] = $row["ID"];
                    $payments[$i]["category"] = $name;
                    $payments[$i]["sum"] = $row["SUM"];
                    $payments[$i]["date"] = $row["OP_DATE"];
                    $payments[$i]["comment"] = $row["COMMENT"];
                    $i++;
                }
                $_SESSION["payments"] = $payments;
            }
        }

        function getAll($connection, $user_id) {
            $queryGetPayments = "SELECT o.* FROM OPS o, CATS c 
                WHERE c.ID_USER=$user_id AND o.ID_CAT=c.ID ORDER BY o.ID";
            $resultPayments = $connection->query($queryGetPayments);

            if ($resultPayments->num_rows > 0) {
                $payments = array(array());
                $i = 0;
                while ($row = $resultPayments->fetch_assoc()) {
                    $payments[$i]["id"] = $row["ID"];
                    $catName = getCatNameById($connection, $user_id, $row["ID_CAT"]);
                    $payments[$i]["category"] = $catName;
                    $payments[$i]["sum"] = $row["SUM"];
                    $payments[$i]["date"] = $row["OP_DATE"];
                    $payments[$i]["comment"] = $row["COMMENT"];
                    $text .= "ID: ". $row["ID"] . " CATEGORY: " . $catName ."\n";
                    $i++;
                }
                $_SESSION["payments"] = $payments;
                //Запишемо у файл
                $f = fopen("getAll_text.txt", "w");
                fwrite($f, $text);
                fclose($f);
            }
        }

        function getByDate($connection, $user_id, $from, $to) {
            $queryGetPayments = "SELECT o.* FROM OPS o, CATS c
                WHERE c.ID_USER=$user_id AND o.ID_CAT=c.ID AND o.OP_DATE<='$to' AND o.OP_DATE>=$from ORDER BY o.OP_DATE";

            $resultPayments = $connection->query($queryGetPayments);

            if ($resultPayments->num_rows > 0) {
                $payments = array(array());
                $i = 0;
                while ($row = $resultPayments->fetch_assoc()) {
                    $payments[$i]["id"] = $row["ID"];
                    $catName = getCatNameById($connection, $user_id, $row["ID_CAT"]);
                    $payments[$i]["category"] = $catName;
                    $payments[$i]["sum"] = $row["SUM"];
                    $payments[$i]["date"] = $row["OP_DATE"];
                    $payments[$i]["comment"] = $row["COMMENT"];
                    $i++;
                }
                $_SESSION["payments"] = $payments;
            }
        }
        ?>
    </div>




    <div class="controll__payments">
        <div class="add__payment">
            <form name="addP">
                <div class="formHtext">Додати платіж</div>
                <div class="formCat__pair">
                    <div class="formText">Категорія</div>
                    <div class="form__select">
                        <select name="categorySelectAdd">
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
                    <div class="formText">Дата</div>
                    <div class="form__input">
                        <input type="date" name="date">
                    </div>
                </div>
                <div class="formCat__pair">
                    <div class="formText">Повторювати</div>
                    <div class="form__input-checkBox">
                        <input type="checkBox" class="table__checkBox" name="repeat" value="on">
                    </div>
                </div>
                <div class="formCat__pair">
                    <div class="formText">Сума</div>
                    <div class="form__input">
                        <input type="text" autocomplete="off" name="sum">
                    </div>
                </div>
                <div class="formCat__pair">
                    <div class="formText">Коментар</div>
                    <div class="form__input">
                        <input type="text" autocomplete="off" name="comment">
                    </div>
                </div>
                <div class="form__submit">
                    <input type="submit" value="Додати" name="add">
                </div>
            </form>
            <script>
                document.forms.addP.onsubmit = function (e) {
                    e.preventDefault();

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', 'index.php');
                    let formData = new FormData(document.forms.addP);

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.location.href = "http://web:81/index.php";
                        }
                    }

                    xhr.send(formData);
                }
            </script>
        </div>
        <div class="edit__payment">
            <form method="post">
                <div class="formHtext">Редагувати платіж</div>
                <div class="formCat__pair">
                    <div class="formText">Номер платежу</div>
                    <div class="form__select">
                        <select name="paymentEditSelect">
                            <option value="select" selected="selected"></option>
                            <?php
                            $ids = $_SESSION["ids"];
                            foreach ($ids as $id) {
                                echo "<option value='$id'>$id</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
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
                    <div class="formText">Дата</div>
                    <div class="form__input">
                        <input type="date" name="date">
                    </div>
                </div>
                <!--<div class="formCat__pair">
                    <div class="formText">Повторювати</div>
                    <div class="form__input-checkBox">
                        <input type="checkBox" class="table__checkBox" name="">
                    </div>
                </div>-->
                <div class="formCat__pair">
                    <div class="formText">Сума</div>
                    <div class="form__input">
                        <input type="text" autocomplete="off" name="sum">
                    </div>
                </div>
                <div class="formCat__pair">
                    <div class="formText">Коментар</div>
                    <div class="form__input">
                        <input type="text" autocomplete="off" name="comment">
                    </div>
                </div>
                <div class="form__submit">
                    <input type="submit" value="Змінити"  name="edit">
                </div>
            </form>
        </div>
        <div class="delete__payment">
            <form name="deleteP">
                <div class="formHtext">Видалити платіж</div>
                <div class="form__select">
                    <select name="paymentDeleteSelect">
                        <option value="select" selected="selected"></option>
                        <?php
                        $ids = $_SESSION["ids"];
                        foreach ($ids as $id) {
                            echo "<option value='$id'>$id</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form__submit_delete">
                    <input type="submit" value="Видалити" name="remove">
                </div>
            </form>
            <script>
                document.forms.deleteP.onsubmit = function (e) {
                    e.preventDefault();

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', 'index.php');
                    let formData = new FormData(document.forms.deleteP);

                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.location.href = "http://web:81/index.php";
                        }
                    }

                    xhr.send(formData);
                }
            </script>
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