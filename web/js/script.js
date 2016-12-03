function setUp() {
        var frame = document.getElementById('frame');
        frame.style.height = (window.innerHeight - 150) + 'px';

        console.log(frame.contentWindow.document.body.scrollHeight + 'px');
}

function frame(url) {
        document.getElementById('frame').src = url;
}
