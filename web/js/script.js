$(document).ready(function() {
        var x = $(document).width() * 15 / 100;
        $("#well").css({"width": x});

        var frame = document.getElementById('frame');
        frame.style.height = (window.innerHeight - 150) + 'px';

        var h = $(window).height() - 150;

        $("iframe").css({"height" : h});
});

function frame(url) {
        $("iframe").attr({'src' : url});
}
