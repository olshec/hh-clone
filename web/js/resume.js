

function addJobExperience() {
	let itm = document.getElementsByClassName("job-experience");
	let cln = itm[itm.length-1].cloneNode(true);
	
	let jobContainer = document.getElementsByClassName("job-container");
	//let jobNode = jobContainer[jobContainer.length-1].getElementsByClassName("add-job-node")[0].cloneNode(true);
	let jobNodeRemove = jobContainer[jobContainer.length-1].getElementsByClassName("add-job-node")[0];
	//let clnJobNode = jobNode.cloneNode(true);
	jobContainer[jobContainer.length-1].removeChild(jobNodeRemove);
	
	document.getElementsByClassName("list-job-experience")[0].appendChild(cln);
	
	addEventForAddJobExperience();
	addEventForRemoveJobExperience();
}

function removeJobExperience(elem) {
	let linkAddJobExperience = document.getElementById("add-job-experience-link");
	let clnJobAddNode = linkAddJobExperience.cloneNode(true);
	document.getElementsByClassName("list-job-experience")[0].removeChild(elem);
	//check remove link for add job experience 
	let checkLinkAddJobExperience = document.getElementById("add-job-experience-link");
	if(checkLinkAddJobExperience == null) {
		let jobContainer = document.getElementsByClassName("job-container");
		jobContainer[jobContainer.length-1].appendChild(clnJobAddNode);
	}
}


function addEventForAddJobExperience() {
	//add listener for job experience 
	let el = document.getElementById("add-job-experience-link");
	el.addEventListener("click", function(e) {
    	e.preventDefault();
    	addJobExperience();
		}, false);
}

function addEventForRemoveJobExperience() {
	let el = document.getElementsByClassName("remove-job-experience-link");
	index = el.length-1;
	el[index].addEventListener("click", function(e) {
    	e.preventDefault();
		elem = e.target.parentNode;
		while((elem.getAttribute("class").indexOf('job-experience'))==-1) {
			elem = elem.parentNode;
		}
		if (!elem.getAttribute("class").indexOf('job-experience')==-1) return;

    	removeJobExperience(elem);
		}, false);
}

function addEventListeners() {
	addEventForAddJobExperience();
	addEventForRemoveJobExperience();
}

function afterPageLoad() {
	addEventListeners();
}