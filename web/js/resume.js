

function addJobExperience() {
	let itm = document.getElementsByClassName("job-experience")[0];
	let cln = itm.cloneNode(true);
	
/*	let addJobBlock = document.getElementById("add-job-block");
	document.getElementsByClassName("list-job-experience")[0].removeChild(addJobBlock);*/
	
	document.getElementsByClassName("list-job-experience")[0].appendChild(cln);
	
	addEventForJobExperience();
}



function addEventForJobExperience() {
	//add listener for job experience 
	let el = document.getElementById("add-job-experience");
	el.addEventListener("click", function(e) {
    	e.preventDefault();
    	addJobExperience();
		}, false);
}

function addEventListeners() {
	addEventForJobExperience();
}

function afterPageLoad() {
	addEventListeners();
}