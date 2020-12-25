var city = '1';

function afterPageLoad() {
	elements = document.getElementsByClassName("nselect-1");
	
	elements[0].value =3;
	city = elements[0].value;
}

function serchCity() {
	elements = document.getElementsByClassName("nselect-1");
	citySerch = elements[0].value;
	if (citySerch != city) {
		// Simulate a mouse click:
		window.location.href = "http://localhost/hh-clone/web/resume/?city="+citySerch;
	}
	
	//alert(city);
	
	//var x = elm.getAttribute('value');
  	//console.log(x)
  	
	//let x;
	//     		//Object.keys(obj).forEach((prop)=> x += prop);
	
	//console.log(elements[0].value);
	//alert(elements);
}