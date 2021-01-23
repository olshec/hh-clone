function clearValueFromExperience() {
	let	list = document.getElementsByClassName('nselect__head')[1];
		
		
	let itm = document.getElementsByClassName("job-experience");
	let count = itm.length-1;
	let experientContainer = itm[count];
	
	let inputs = experientContainer.getElementsByClassName('dor-input');
	for(let i=0; i < inputs.length; i++) {
		inputs[i].value='';
	}
	
	let checkbox = experientContainer.getElementsByClassName('form-check-input')[0];
	checkbox.checked = false;
	let nameFor = "jobUntilNow"+(count+1);
	checkbox.id = nameFor;
	experientContainer.getElementsByClassName('form-check-label')[0].htmlFor = nameFor;
	experientContainer.getElementsByClassName('job-resolution-checkbox')[0].htmlFor = nameFor;
	
	
	
	//document.getElementsByClassName("list-job-experience")[0].appendChild(experientContainer);
	

/*let elem1 = document.getElementsByClassName('nselect__head')[1];
cl1 = $('.nselect__head').clone(true, true);
*/

/*let elem1 = document.getElementsByClassName('nselect__head')[1];
let elem2 = document.getElementsByClassName('nselect__head')[3];
cl1 = $('.nselect__head').clone(true, true);
let el = cl1[1];
$(el).clone().appendTo(elem2);*/

/*document.getElementsByClassName('nselect__head')[3] = document.getElementsByClassName('nselect__head')[1];
let vs1 = Object.values(elem1);
let vs2 = Object.values(elem1);*/

// "JSON"
//elem2 = elem1;



//document.getElementsByClassName('nselect__head')[3] =  document.getElementsByClassName('nselect__head')[1];


/*let el1 = JSON.parse(JSON.stringify(elem1));
let el2 = JSON.parse(JSON.stringify(elem2));
el2 = el1;
let attr = el1;
elem2.setAttribute('jQuery321089094437406630881', elem1.getAttribute('jQuery321089094437406630881'));
let x = 5;*/

/*let elem1 = document.getElementsByClassName('nselect__head')[1];
let event1 = window.getEventListeners(elem1);

let event2 = document.getElementsByClassName('nselect__head')[3];
document.getElementsByClassName('nselect__head')[3]['click'] = event1['click'];*/


/*	let newObj = JSON.parse(JSON.stringify(experientContainer));
	let lists = document.getElementsByClassName("job-experience");
	let list = lists[lists.length-1];
	list.innerHTML = newObj.experientContainer;*/
	
	//newObj = Object.assign({},experientContainer);
	//document.getElementsByClassName("list-job-experience")[0] = newObj.innerHTML;
	
	
	/*
	let ht = `
                            <div class="row mb24">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Начало работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="d-flex justify-content-between">
                                        <div class="citizenship-select w100 mr16">
                                            <select class="nselect-1 job-begin-month" data-title="Январь" name="job-begin-month[]">
                                                <option selected="selected" value="01">Январь</option>
                                                <option value="02">Февраль</option>
                                                <option value="03">Март</option>
                                                <option value="04">Апрель</option>
                                                <option value="05">Май</option>
                                                <option value="06">Июнь</option>
                                                <option value="07">Июль</option>
                                                <option value="08">Август</option>
                                                <option value="09">Сентябрь</option>
                                                <option value="10">Октябрь</option>
                                                <option value="11">Ноябрь</option>
                                                <option value="12">Декабрь</option>
                                            </select>
                                        </div>
                                        <div class="citizenship-select w100">
                                            <input placeholder="2006" type="text" name="job-begin-year[]" class="dor-input w100 job-begin-year">
                                        </div>
                                    </div>
                                </div>
                             </div> 
	`;
	
	
	let ht2 = `
	                            <div class="row mb24">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Начало работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="d-flex justify-content-between">
                                        <div class="citizenship-select w100 mr16">
                                            <select class="nselect-1 job-begin-month" data-title="Январь" name="job-begin-month[]">
                                                <option selected="selected" value="01">Январь</option>
                                                <option value="02">Февраль</option>
                                                <option value="03">Март</option>
                                                <option value="04">Апрель</option>
                                                <option value="05">Май</option>
                                                <option value="06">Июнь</option>
                                                <option value="07">Июль</option>
                                                <option value="08">Август</option>
                                                <option value="09">Сентябрь</option>
                                                <option value="10">Октябрь</option>
                                                <option value="11">Ноябрь</option>
                                                <option value="12">Декабрь</option>
                                            </select>
                                        </div>
                                        <div class="citizenship-select w100">
                                            <input placeholder="2006" type="text" name="job-begin-year[]" class="dor-input w100 job-begin-year">
                                        </div>
                                    </div>
                                </div>
                             </div> 
<!--                            </div> -->
                            
                            <div class="row mb8">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Окончание работы</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="d-flex justify-content-between">
                                        <div class="citizenship-select w100 mr16">
                                            <select class="nselect-1 job-end-month" data-title="Январь" name="job-end-month[]">
                                                <option selected="selected" value="01">Январь</option>
                                                <option value="02">Февраль</option>
                                                <option value="03">Март</option>
                                                <option value="04">Апрель</option>
                                                <option value="05">Май</option>
                                                <option value="06">Июнь</option>
                                                <option value="07">Июль</option>
                                                <option value="08">Август</option>
                                                <option value="09">Сентябрь</option>
                                                <option value="10">Октябрь</option>
                                                <option value="11">Ноябрь</option>
                                                <option value="12">Декабрь</option>
                                            </select>
                                        </div>
                                        <div class="citizenship-select w100">
                                            <input placeholder="2006" type="text" name="job-end-year[]" class="dor-input w100 job-end-year">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb32">
                                <div class="col-lg-2 col-md-3">
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <div class="profile-info">
                                        <div class="form-check d-flex">
                                            <input type="checkbox" class="form-check-input job-until-now" id="job-until-now-1" name="job-until-now[]">
                                            <label class="form-check-label" for="job-until-now-1"></label>
                                            <label for="job-until-now-1"
                                                   class="profile-info__check-text job-resolution-checkbox">По настоящее время</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Организация</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <input type="text" name="organisation[]" class="dor-input w100 organisation">
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3 dflex-acenter">
                                    <div class="paragraph">Должность</div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-11">
                                    <input type="text" name="position[]" class="dor-input w100 position">
                                </div>
                            </div>
                            <div class="row mb16">
                                <div class="col-lg-2 col-md-3">
                                    <div class="paragraph">Обязанности, функции, достижения</div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-12 job-container">
                                    <textarea name="about-experient[]" class="dor-input w100 h96 mb8 about-experient"
                                              placeholder="Расскажите о своих обязанностях, функциях и достижениях"></textarea>
                                    <div class="mb24"><a href="#" class="job-experience-link-remove">Удалить место работы</a></div>
                                    <div id="job-node-add"><a href="#" id="job-experience-link-add" >+ Добавить место работы</a></div>
                                </div>
                            </div>
                            <div class="row mb24">
                                <div class="col-lg-2 col-md-3">
                                </div>
                                <div class="col-lg-4 col-md-6 col-12">
                                    <div class="devide-border"></div>
                                </div>
                            </div>
	
	`;
	
	let lists = document.getElementsByClassName("job-experience");
	let list = lists[lists.length-1];
	list.innerHTML = ht2;
	*/
}
	

function addJobExperience() {
	$('.job-experience').clone(true, true).appendTo('.list-job-experience');

	let jobContainer = document.getElementsByClassName("job-container");
	let jobNodeAddingRemove = document.getElementById("job-node-add");
	//jobContainer[jobContainer.length-1].removeChild(jobNodeAddingRemove);
	
	clearValueFromExperience();

	addEventForAddJobExperience();
	addEventForRemoveJobExperience();
}

function removeJobExperience(elem) {
	const jobExperients = document.getElementsByClassName("job-experience");
	if(jobExperients.length > 1){
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
	else {
		document.getElementsByClassName("list-job-experience")[0].style.display = "none";//.innerHTML = '';
		document.getElementsByClassName("list-job-experience")[0].setAttribute("hide","yes");
		document.getElementById("radio-experience-no").checked = true;
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
        //statusP.innerHTML = 'Upload copmlete!  Status = '+xhr.responseText;
		var photoInfo = JSON.parse(xhr.responseText);
		document.getElementById("profile-photo").innerHTML = photoInfo.photo;
		document.getElementById("profile-photo").setAttribute('photo-name', photoInfo.photoName);
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

function changeRadioButtonExperienceYes() {
	const radioButtonExperienceYes = document.getElementById("radio-experience-yes");
	if(radioButtonExperienceYes.checked == true) {
		document.getElementsByClassName("list-job-experience")[0].style.display = "block";//.innerHTML = '';
		document.getElementsByClassName("list-job-experience")[0].setAttribute("hide", "no");
	}
}

function changeRadioButtonExperienceNo() {
	const radioButtonExperienceNo = document.getElementById("radio-experience-no");
	if(radioButtonExperienceNo.checked == true) {
		document.getElementsByClassName("list-job-experience")[0].style.display = "none";
		document.getElementsByClassName("list-job-experience")[0].setAttribute("hide","yes") ;
	}
}


function addEventForRadioButtonsForExperience() {
	const radioButtonExperienceYes = document.getElementById("radio-experience-yes");
	radioButtonExperienceYes.addEventListener("change", changeRadioButtonExperienceYes, false);
	
	const radioButtonExperienceNo = document.getElementById("radio-experience-no");
	radioButtonExperienceNo.addEventListener("change", changeRadioButtonExperienceNo, false);
}

function addEventForSaveFormButton() {
	const saveFormButton = document.getElementById("saveFormButton");
	saveFormButton.addEventListener("click", function() {
		document.getElementsByTagName('form')[0].submit() 
		}, false);
}

function addEventListeners() {
	addEventForAddJobExperience();
	addEventForRemoveJobExperience();
	addEventForInputPhoto();
	addEventForRadioButtonsForExperience();
	addEventForSaveFormButton();
}

function afterPageLoad() {
	addEventListeners();
}