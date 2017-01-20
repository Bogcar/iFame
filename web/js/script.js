$(document).ready(function() {
        var x = $(document).width() * 15 / 100;
        $("#well").css({"width": x});

        var h = $(window).height() - 150;

        $("iframe").css({"height" : h});
});

function add(value) {
    var url = "index/newRecipe.php?user_id=" + value;
    $('#frame').attr({'src' : url});
}
