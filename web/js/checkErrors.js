
function checkDateEnd() {
	const errors = document.getElementById("errors");
	const objErrors = JSON.parse(errors.value);
	if(objErrors.hasOwnProperty('date_end')) {
		const arrayDateEnd = objErrors['date_end'];
		const jobEndYear = document.getElementsByClassName("job-end-year-error-message");
		for(let i=0; i < arrayDateEnd.length; i++) {
			const numberFieldYear = arrayDateEnd[i][0];
			const message = arrayDateEnd[i][1];
			jobEndYear[numberFieldYear].innerHTML = message;
		}
	}
}

function checkDateStart() {
	const errors = document.getElementById("errors");
	const objErrors = JSON.parse(errors.value);
	if(objErrors.hasOwnProperty('date_start')) {
		const arrayDateBegin = objErrors['date_start'];
		const jobBeginYear = document.getElementsByClassName("job-begin-year-error-message");
		for(let i=0; i < arrayDateBegin.length; i++) {
			const numberFieldYear = arrayDateBegin[i][0];
			const message = arrayDateBegin[i][1];
			jobBeginYear[numberFieldYear].innerHTML = message;
		}
	}
}


function checkErrors() {
	checkDateEnd();
	checkDateStart();
}


checkErrors();