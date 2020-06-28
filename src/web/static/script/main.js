$(function a(){
		$('aside span.expand').click(function(){
			$('aside nav').slideToggle();
		})
}
);
$(function b(){
		$( "#age").datepicker();
}
);
$( function c() {
    $( "#choice" ).selectable();
  } );
    
 function mod(){
	var img = document.getElementById("mainpic");
	img.parentNode.removeChild(img);
	var a = document.createElement('a');
	var mes = document.createTextNode("Usunales obrazek");
	a.appendChild(mes);
	document.getElementById("sec").appendChild(a);
	a.style.color= "red";
}
function load(obj){
 document.getElementById("mainpicgal").src = obj.src;

}

function saveForm(){
	var name = document.getElementsByName("name")[0].value;
	var email = document.getElementsByName("email")[0].value;
	var age = document.getElementsByName("age")[0].value;
	var note = document.getElementsByName("note")[0].value;
	
		localStorage.age = age;
		localStorage.name = name;
		localStorage.email = email;
		sessionStorage.note = note;	
}

function lastData(){
	if(localStorage.name && localStorage.email && localStorage.age){
			document.getElementsByName("name")[0].value =localStorage.name;
			document.getElementsByName("email")[0].value =localStorage.email;
			document.getElementsByName("age")[0].value =localStorage.age;
	}else{
			var p = document.createElement('p');
			var mes = document.createTextNode("Brak ostatnich wiadomosci");
			p.appendChild(mes);
			document.getElementById("res").appendChild(p);
	}
}

function lastMes(){
	if(sessionStorage.note){
	document.getElementsByName("note")[0].value = sessionStorage.note;
	}else{
	var p = document.createElement('p');
	var mes = document.createTextNode("Brak ostatnich wiadomosci w tej sesji");
	p.appendChild(mes);
		document.getElementById("res").appendChild(p);
	}
}
function result(name){
	if(document.getElementsByName("name")[0].value == "" || document.getElementsByName("email")[0].value == "" ){
		var p = document.createElement('p');
		var mes = document.createTextNode("Wypelnij wszystkie pola!");

		p.appendChild(mes);
		document.getElementById("res").appendChild(p);
	}
	else{
		var p = document.createElement('p');
		var mes = document.createTextNode("Zapisano wiadomosc od "+ name);

		p.appendChild(mes);
		document.getElementById("res").appendChild(p);
	}
}
function search_func(str){

	$.ajax({
		type: "POST",
		url: '/search',
		dataType: 'html',
		data: {search: str},
		success: function (data) {

			$('#search').html(data);
		}
	});

}