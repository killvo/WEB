$(document).ready(function () {
    $("#password").keyup(function() {

        const pass = $("#password").val();
        $("#result").text(check(pass));

    });
    function check(pass) {
        let protect = 0;
        if(pass.length < 8) {
            $("#bg_res").removeClass();
            $("#bg_res").addClass('red');
            return "Слабкий пароль";
        }
        //a,s,d,f
        const small = "([a-z]+)";
        if(pass.match(small)) {
            protect++;
        }
        //A,B,C,D
        const big = "([A-Z]+)";
        if(pass.match(big)) {
            protect++;
        }
        //1,2,3,4,5 ... 0
        const numb = "([0-9]+)";
        if(pass.match(numb)) {
            protect++;
        }
        //!@#$
        const vv = /\W/;
        if(pass.match(vv)) {
            protect++;
        }
        if(protect == 2) {
            $("#bg_res").removeClass();
            $("#bg_res").addClass('yellow');
            return "Середній пароль";
        }
        if(protect == 3) {
            $("#bg_res").removeClass();
            $("#bg_res").addClass('green');
            return "Надійний пароль";
        }
        if(protect == 4) {
            $("#bg_res").removeClass();
            $("#bg_res").addClass('green_v');
            return "Дуже надійний пароль";
        }
    }
});