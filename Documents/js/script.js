function setUp() {
        var frame = document.getElementById('frame');
        frame.style.height = (window.innerHeight - 150) + 'px';

        console.log(frame.contentWindow.document.body.scrollHeight + 'px');
}

function frame(url) {
        document.getElementById('frame').src = url;
}

$(document).ready(function(){

$("#ingredients").focus(function() {
	if(document.getElementById('ingredients').value === ''){ 
        document.getElementById('ingredients').value +='• ';
}});
	
$("#ingredients").keyup(function(event)
{
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		document.getElementById('ingredients').value +='• ';
	}
	else if(keycode == '8' && document.getElementById('ingredients').value !=null){
		document.getElementById('ingredients').value = '• ';
	}
	var txtval = document.getElementById('ingredients').value;
	if(txtval.substr(txtval.length - 1) == '\n'){
		document.getElementById('ingredients').value = txtval.substring(0,txtval.length - 1);
	}
});

var cnt = 1;

$("#procedure").focus(function() {
	if(document.getElementById('procedure').value === ''){ 
        document.getElementById('procedure').value += cnt + '. ';
		cnt ++;
}});
	
$("#procedure").keyup(function(event)
{
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		document.getElementById('procedure').value += cnt + '. ';
		cnt++;
	}
	else if(keycode == '8' && document.getElementById('procedure').value == 0 || document.getElementById('procedure').value == 1){
		cnt = 1;
		document.getElementById('procedure').value = cnt + '. ';
		cnt++;
	}
	var txtval = document.getElementById('procedure').value;
	if(txtval.substr(txtval.length - 1) == '\n'){
		document.getElementById('procedure').value = txtval.substring(0,txtval.length - 1);
	}
});

});

