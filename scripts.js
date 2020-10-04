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

// Для ЛР №2
$(document).ready(function() {
    $(".show_load").append("<img class='img_elem'>");
})

function openImgByPath(imgPath) {
    $(".img_elem").attr("src", imgPath);
}

$('select2').change(function() {
    switch ($("#select2 option:selected").getVal()) {
        case "0":
            openImgByPath('images/precDiagram.jpg');
        case "1":
            openImgByPath('images/precDiagram.jpg');
        case "2":
            openImgByPath('images/precDiagram.jpg');
    }
})