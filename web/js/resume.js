//Full text serch
let el = document.getElementById("btn-serch");
el.addEventListener("click", serchFullText, false);

el = document.getElementById("full-text-serch");
el.addEventListener('keydown', function(e) {
    if (e.keyCode === 13) {
		e.preventDefault();
    	serchFullText();
    }
  }, false);