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

function fileUpload(file) {
  const reader = new FileReader();
  //this.ctrl = createThrobber(img);
  const xhr = new XMLHttpRequest();
  this.xhr = xhr;

  /*const self = this;
  this.xhr.upload.addEventListener("progress", function(e) {
        if (e.lengthComputable) {
          const percentage = Math.round((e.loaded * 100) / e.total);
          self.ctrl.update(percentage);
        }
      }, false);

  xhr.upload.addEventListener("load", function(e){
          self.ctrl.update(100);
          const canvas = self.ctrl.ctx.canvas;
          canvas.parentNode.removeChild(canvas);
      }, false);*/
  xhr.open("POST", "http://demos.hacks.mozilla.org/paul/demos/resources/webservices/devnull.php");
  xhr.overrideMimeType('text/plain; charset=x-user-defined-binary');
  reader.onload = function(evt) {
    xhr.send(evt.target.result);
  };
  reader.readAsBinaryString(file);
}

function handleFiles() {
	const fileList = this.files; /* now you can work with the file list */
	const photo = fileList[0];
	fileUpload(photo);
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