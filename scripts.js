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