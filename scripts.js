
function clean() {
    $(".big_load").empty();
    $(".img_view").attr("src", "");
    $(".img_html").attr("src", "");
    $(".img_css").attr("src", "");
}

function showLeft(fileName) {
    $.get(fileName, function (data) {
        $(".left_load").html(data);
    });
}

function show(fileName) {
    $.get(fileName, function (data) {
        $(".show_load").html(data);
    });
}

function showBig(fileName) {
    $.get(fileName, function (data) {
        $(".big_load").html(data);
    });
}

// Для ЛР №2

$(document).ready(function() {
    $(".show_load").append("<style>\n" +
        "    .content {\n" +
        "        width: 1200px;\n" +
        "        text-align: center;\n" +
        "        margin-top: 50px;\n" +
        "        margin-left: 50px;\n" +
        "    }\n" +
        "    .content_view {\n" +
        "        width: 100%;\n" +
        "        text-align: center;\n" +
        "        margin-bottom: 25px;\n" +
        "    }\n" +
        "    .content_html {\n" +
        "        width: 575px;\n" +
        "        float: left;\n" +
        "        margin-left: 0;\n" +
        "\n" +
        "    }\n" +
        "    .content_css {\n" +
        "        width: 575px;\n" +
        "        float: left;\n" +
        "        margin-left: 50px;\n" +
        "\n" +
        "    }\n" +
        "</style>\n" +
        "<div class=\"content\">\n" +
        "    <div class=\"content_view\">\n" +
        "    </div>\n" +
        "    <div class=\"content_html\">\n" +
        "    </div>\n" +
        "    <div class=\"content_css\">\n" +
        "    </div>\n" +
        "</div>\n" +
        "<script>\n" +
        "    $(\".content_view\").append(\"<img class='img_view'>\");\n" +
        "    $(\".content_html\").append(\"<img class='img_html'>\");\n" +
        "    $(\".content_css\").append(\"<img class='img_css'>\");\n" +
        "</script>")
})


function loadView(imgPath) {
    document.getElementsByClassName("img_view")[0].setAttribute("src", imgPath);
    //$(".img_view").attr("src", imgPath);
}
function loadHtml(imgPath) {
    document.getElementsByClassName("img_html")[0].setAttribute("src", imgPath);
    //$(".img_html").attr("src", imgPath);
}
function loadCss(imgPath) {
    document.getElementsByClassName("img_css")[0].setAttribute("src", imgPath);
    //$(".img_css").attr("src", imgPath);
}
function loadViewMain(img_view, img_html, img_css) {
    clean();
    //addBorders();
    loadView(img_view);
    loadHtml(img_html);
    loadCss(img_css);
}


/*
function addBorders() {
    $(".content_view").css("border", "5px solid grey");
    $(".content_html").css("border", "5px solid grey");
    $(".content_css").css("border", "5px solid grey");
}
*/

// Зміна мови
class LangChange {
    constructor(elem) {
        elem.onclick = this.handleEvent.bind(this);
    }

    handleEvent(event) {
        let action = event.target.dataset.lang;
        switch (action) {
            case 'ua':
                this.setUa();
                break;
            case 'ru':
                this.setRu();
                break;
            case 'eng':
                this.setEng();
                break
        }
    }

    setUa() {
        document.location.href = "http://web:81/index.php?lang=ua";
    }

    setRu() {
        document.location.href = "http://web:81/index.php?lang=ru";
    }

    setEng() {
        document.location.href = "http://web:81/index.php?lang=eng";
    }
}

