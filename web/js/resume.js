function clearValueFromExperienceClone(cln, count) {
	let inputs = cln.getElementsByClassName('dor-input');
	for(let i=0; i < inputs.length; i++) {
		inputs[i].value='';
	}
	
	let checkbox = cln.getElementsByClassName('form-check-input')[0];
	checkbox.checked = false;
	let nameFor = "untilNow"+(count+1);
	checkbox.id = nameFor;
	cln.getElementsByClassName('form-check-label')[0].htmlFor = nameFor;
	cln.getElementsByClassName('job-resolution-checkbox')[0].htmlFor = nameFor;
	
	document.getElementsByClassName("list-job-experience")[0].appendChild(cln);
}
	

function addJobExperience() {
	let itm = document.getElementsByClassName("job-experience");
	let cln = itm[itm.length-1].cloneNode(true);
	
	let jobContainer = document.getElementsByClassName("job-container");
	//let jobNode = jobContainer[jobContainer.length-1].getElementsByClassName("job-node-add")[0].cloneNode(true);
	let jobNodeRemove = document.getElementById("job-node-add");
	//let clnJobNode = jobNode.cloneNode(true);
	jobContainer[jobContainer.length-1].removeChild(jobNodeRemove);
	
	clearValueFromExperienceClone(cln, itm.length);
	
	
	addEventForAddJobExperience();
	addEventForRemoveJobExperience();
}

function removeJobExperience(elem) {
	let clnJobAddNode = document.getElementById("job-node-add").cloneNode(true);
	document.getElementsByClassName("list-job-experience")[0].removeChild(elem);
	//check remove link for add job experience 
	let checkLinkAddJobExperience = document.getElementById("job-node-add");
	if(checkLinkAddJobExperience == null) {
		let jobContainer = document.getElementsByClassName("job-container");
		jobContainer[jobContainer.length-1].appendChild(clnJobAddNode);
		addEventForAddJobExperience();
	}
}


function addEventForAddJobExperience() {
	//add listener for job experience 
	let el = document.getElementById("job-experience-link-add");
	el.addEventListener("click", function(e) {
    	e.preventDefault();
    	addJobExperience();
		}, false);
}

function addEventForRemoveJobExperience() {
	let el = document.getElementsByClassName("job-experience-link-remove");
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

async function uploadFile(file, userId) {
	const url = 'http://localhost/hh-clone/web/resume/upload?user-id='+userId;
    //alert('The file has been uploaded successfully.');
	var statusP = document.getElementById("label-photo");
	statusP.innerText = 'Uploading...';
	// Create a FormData object
	var formData = new FormData();
	// Add the file to the AJAX request
	formData.append('file', file, file.name);
 // Set up the request
    var xhr = new XMLHttpRequest();
    // Open the connection
    xhr.open('POST', url, true);
  // Set up a handler for when the task for the request is complete
    xhr.onload = function () {
      if (xhr.status == 200) {
        statusP.innerHTML = 'Upload copmlete!  Status = '+xhr.responseText;
      } else {
        statusP.innerHTML = 'Upload error. Try again.';
      }
    };

    // Send the data.
    xhr.send(formData);
}

function handleFiles() {
	const fileList = this.files; /* now you can work with the file list */
	const photo = fileList[0];
	uploadFile(photo, userId=4);
	//alert(photo);
}
	
function addEventForInputPhoto(){
	const inputElement = document.getElementById("input-foto");
	inputElement.addEventListener("change", handleFiles, false);
}



function addEventListeners() {
	addEventForAddJobExperience();
	addEventForRemoveJobExperience();
	addEventForInputPhoto();
}

function afterPageLoad() {
	addEventListeners();
}