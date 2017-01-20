$(document).ready(function() {
        var x = $(document).width() * 15 / 100;
        $("#well").css({"width": x});

        var h = $(window).height() - 150;

        $("iframe").css({"height" : h});


        $("#add").click(function() {
            $('#frame').attr({'src' : 'http://samtinfo.ch/i3_ifame/index/newRecipe.php'});
        });

});
