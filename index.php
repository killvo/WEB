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
            <a href="">
                <img src="images/logo1.png" alt="logo">
            </a>
        </div>
        <div class="header-text">Домашня бухгалтерія</div>

        <div class="menu">
            <ul>
                <li><a href="login.php#auth_paragraph">Login</a></li>
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
            <li><div>Керування категоріями</div></li>
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
                <th colspan="2">Категорія</th>
                <th>Дата</th>
                <th>Сума</th>
                <th>Коментар</th>
            </tr>
            <tr>
                <td width="5"><input type="checkBox">№1</td>
                <td>категорія1</td>
                <td>дата1</td>
                <td></td>
                <td>коментар1</td>
            </tr>
            <tr>
                <td width="5"><input type="checkBox">№2</td>
                <td>категорія2</td>
                <td>дата2</td>
                <td>сума2</td>
                <td>коментар2</td>
            </tr>
            <tr>
                <td width="5"><input type="checkBox">№3</td>
                <td>категорія3</td>
                <td>дата3</td>
                <td>сума3</td>
                <td>коментар3</td>
            </tr>
        </table>
    </div>

    <div class="sort_block">
        <div class="sort_block_form">
            <form action="" method="get">
                <div class="formHtext">Переглянути за:</div>
                <div class="form__pair">
                    <div class="formText">Категорією</div>
                    <div class="form__select">
                        <select name="showCategory">
                            <option value="select" selected="selected"></option>
                            <option value="cost">Тип:витрати</option>
                            <option value="income">Тип:доходи</option>
                            <option value="all">Всі категорії</option>
                        </select>
                    </div>
                </div>
                <div class="form__pair">
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
                </div>
                <!-- за період -->
                <div class="formText">Певний період</div><br>
                <div class="form__pair">
                    <div class="formText">Від</div>
                    <input type="text" id="datepicker_from" name="showFrom">
                </div>
                <div class="form__pair">
                    <div class="formText">До</div>
                    <input type="text" id="datepicker_to" name="showTo">
                </div>
                <div class="form__submit">
                    <input type="submit" value="Показати">
                </div>
            </form>
        </div>

        <?php
        if ($_GET != null) {
            $from = $_GET["showFrom"];
            $to = $_GET["showTo"];
            echo 'Показ дати за період з: ', $from, 'по: ', $to;
        }
        ?>

        <div class="controll__payments">
            <div class="add__payment">
                <form action="" method="post">
                    <div class="formHtext">Додати платіж</div>
                    <div class="formCat__pair">
                        <div class="formText">Категорія</div>
                        <div class="form__select">
                            <select name="categorySelect">
                                <option value="select" selected="selected"></option>
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
                            <input type="checkBox" class="table__checkBox" name="" value="on">
                        </div>
                    </div>
                    <div class="formCat__pair">
                        <div class="formText">Сума</div>
                        <div class="form__input">
                            <input type="text" autocomplete="off" name="">
                        </div>
                    </div>
                    <div class="formCat__pair">
                        <div class="formText">Коментар</div>
                        <div class="form__input">
                            <input type="text" autocomplete="off" name="">
                        </div>
                    </div>
                    <div class="form__submit">
                        <input type="submit" value="Додати">
                    </div>
                </form>
            </div>
            <div class="edit__payment">
                <form action="" method="get" id="editPayments">
                    <div class="formHtext">Редагувати платіж</div>
                    <div class="formCat__pair">
                        <div class="formText">Номер</div>
                        <div class="form__input">
                            <input type="text" autocomplete="off" name="">
                        </div>
                    </div>
                    <div class="formCat__pair">
                        <div class="formText">Категорія</div>
                        <div class="form__select">
                            <select name="categorySelect">
                                <option value="select" selected="selected"></option>
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
                            <input type="checkBox" class="table__checkBox" name="">
                        </div>
                    </div>
                    <div class="formCat__pair">
                        <div class="formText">Сума</div>
                        <div class="form__input">
                            <input type="text" autocomplete="off" name="">
                        </div>
                    </div>
                    <div class="formCat__pair">
                        <div class="formText">Коментар</div>
                        <div class="form__input">
                            <input type="text" autocomplete="off" name="">
                        </div>
                    </div>
                    <div class="form__submit">
                        <input type="submit" value="Змінити">
                    </div>
                </form>
            </div>
            <div class="delete__payment">
                <form action="" method="post" id="removePayments">
                    <div class="formHtext">Видалити платіж</div>
                    <div class="form__submit_delete">
                        <input type="submit" value="Видалити">
                    </div>
                </form>
            </div>
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