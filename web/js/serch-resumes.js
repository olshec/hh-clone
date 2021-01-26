

class ServiceLocator {
	static serchURL =  "http://localhost/hh-clone/web/resume/?";
	static city = '';
	static gender = '';
	static specialization = '';
	static typeSort = '';
	static typeEmployment = '';
	static typeSchedule = '';
	static experience = '';
	static salary = '';
	static ageFrom = '';
	static ageUp = '';
	static page = '';
	static fullTextSercher = '';
}

class City {
    constructor(idCity) {
         this.setIdCity(idCity);
    }
    setIdCity(idCity) {
        this.idCity = idCity;
    }
    getIdCity() {
        return this.idCity;
    }
    
    getNewSerchParams(idCitySerch) {
		ServiceLocator.city = new City(idCitySerch);
		let params = "&city="+idCitySerch;
		return params;
    }

	getSerchParams() {
		let params = "";
		if(this.getIdCity() != 0) {
			params = "&city="+this.getIdCity();
		}
		return params;
	}
}


class Gender {
	constructor(genderName) {
		this.setName(genderName);
	}
	setName(genderName) {
		this.genderName = genderName;
	}
	getName() {
		return this.genderName;
	}
	getNewSerchParams(genderName) {
		ServiceLocator.gender = new Gender(genderName);
		let params = "&gender="+genderName;
		return params;
    }
	getSerchParams() {
		let params = "&gender="+this.getName();
		return params;
	}
}

class Specialization {
    constructor(id) {
         this.setId(id);
    }
    setId(id) {
        this.id = id;
    }
    getId() {
        return this.id;
    }
    
    getNewSerchParams(id) {
		ServiceLocator.specialization = new Specialization(id)
		let params = "&specialization="+id;
		return params;
    }

	getSerchParams() {
		let params = "";
		if(this.getId() != 0) {
			params = "&specialization="+this.getId();
		}
		return params;
	}
}

class TypeSort {
	constructor(sortName) {
		this.setName(sortName);
	}
	setName(sortName) {
		this.sortName = sortName;
	}
	getName() {
		return this.sortName;
	}
	getNewSerchParams(sortName) {
		ServiceLocator.typeSort = new TypeSort(sortName);
		let params = "&type_sort="+sortName;
		return params;
    }
	getSerchParams() {
		let params = "&type_sort="+this.getName();
		return params;
	}
}

class TypeEmployment {
	constructor() {
		let elements = document.getElementsByName("type_employment[]");
		this.elements = elements;
	}
	
	getSerchParams() {
		let params ="";
		for(let i=0; i<this.elements.length; i++) {
			if(this.elements[i].checked == true)
			{
				params += "&type_employment[]="+this.elements[i].value;
			}
		}
		return params;
	}
}

class TypeSchedule {
	constructor() {
		let elements = document.getElementsByName("type_schedule[]");
		this.elements = elements;
	}
	getSerchParams() {
		let params ="";
		for(let i=0; i<this.elements.length; i++) {
			if(this.elements[i].checked == true)
			{
				params += "&type_schedule[]="+this.elements[i].value;
			}
		}
		return params;
	}
}

class Experience {
	constructor() {
		let elements = document.getElementsByName("experience[]");
		this.elements = elements;
	}
	getSerchParams() {
		let params ="";
		for(let i=0; i<this.elements.length; i++) {
			if(this.elements[i].checked == true)
			{
				params += "&experience[]="+this.elements[i].value;
			}
		}
		return params;
	}
}

class Salary {
	constructor(salary) {
		this.setSalary(salary);
	}
	
	setSalary(salary) {
		salary = parseInt(salary);
		if(!Number.isInteger(salary)){
			this.salary = 0;
		} else {
			this.salary = salary;
		}
	}
	
	getSalary() {
		return this.salary;
	}
	
	getNewSerchParams(salary) {
		ServiceLocator.salary = new Salary(salary);
		let params = "&salary=" + ServiceLocator.salary.getSalary();
		return params;
	}
	
	getSerchParams() {
		let params = "&salary="+this.getSalary();
		return params;
	}
}

class AgeFrom {
	constructor(age) {
		this.setAge(age);
	}
	
	setAge(age) {
		age = parseInt(age);
		if(!Number.isInteger(age)){
			this.age = 0;
		} else {
			this.age = age;
		}
	}
	
	getAge() {
		return this.age;
	}
	
	getNewSerchParams(age) {
		ServiceLocator.ageFrom = new AgeFrom(age);
		let params = "&ageFrom=" + ServiceLocator.ageFrom.getAge();
		return params;
	}
	
	getSerchParams() {
		let params = "&ageFrom="+this.getAge();
		return params;
	}
}

class AgeUp {
	constructor(age) {
		this.setAge(age);
	}
	
	setAge(age) {
		age = parseInt(age);
		if(!Number.isInteger(age)){
			this.age = 0;
		} else {
			this.age = age;
		}
	}
	
	getAge() {
		return this.age;
	}
	
	getNewSerchParams(age) {
		ServiceLocator.ageUp = new AgeUp(age);
		let params = "&ageUp=" + ServiceLocator.ageUp.getAge();
		return params;
	}
	
	getSerchParams() {
		let params = "&ageUp="+this.getAge();
		return params;
	}
}

class Page {
    constructor(number) {
         this.setNumber(number);
    }
    setNumber(number) {
		number = parseInt(number);
		if(!Number.isInteger(number)){
			this.number = 1;
		} else {
			this.number = number;
		}
    }
    getNumber() {
        return this.number;
    }
    
    getNewSerchParams(number) {
		ServiceLocator.page = new Page(number);
		let params = "&page="+number;
		return params;
    }

	getSerchParams() {
		let params = "&page="+this.getNumber();
		return params;
	}
}

class FullTextSercher {
	constructor(text) {
		this.setText(text);
	}
	
	setText(text) {
		this.text = text;
	}
	
	getText() {
		return this.text;
	}
	
	getNewSerchParams(text) {
		ServiceLocator.fullTextSercher = new FullTextSercher(text);
		let params = "&serchText=" + ServiceLocator.fullTextSercher.getText();
		return params;
	}
	
	getSerchParams() {
		let params = "&serchText="+this.getText();
		return params;
	}
}

//Serch functions

function serchCity() {
	let elements = document.getElementsByClassName("nselect-1");
	let idCitySerch = elements[0].value;
	if (ServiceLocator.city.getIdCity() != idCitySerch){
		let serchUrl = ServiceLocator.serchURL;
	    serchUrl += ServiceLocator.city.getNewSerchParams(idCitySerch);
		serchUrl += ServiceLocator.gender.getSerchParams();
		serchUrl += ServiceLocator.specialization.getSerchParams();
		serchUrl += ServiceLocator.typeSort.getSerchParams();
		serchUrl += ServiceLocator.typeEmployment.getSerchParams();
		serchUrl += ServiceLocator.typeSchedule.getSerchParams();
		serchUrl += ServiceLocator.experience.getSerchParams();
		serchUrl += ServiceLocator.salary.getSerchParams();
		serchUrl += ServiceLocator.ageFrom.getSerchParams();
		serchUrl += ServiceLocator.ageUp.getSerchParams();
		window.location.href = serchUrl;
	}
	
}

function serchGender(genderName) {
	if(genderName != ServiceLocator.gender.getName()){
		let serchUrl = ServiceLocator.serchURL;
		serchUrl += ServiceLocator.city.getSerchParams();
		serchUrl += ServiceLocator.gender.getNewSerchParams(genderName);
		serchUrl += ServiceLocator.specialization.getSerchParams();
		serchUrl += ServiceLocator.typeSort.getSerchParams();
		serchUrl += ServiceLocator.typeEmployment.getSerchParams();
		serchUrl += ServiceLocator.typeSchedule.getSerchParams();
		serchUrl += ServiceLocator.experience.getSerchParams();
		serchUrl += ServiceLocator.salary.getSerchParams();
		serchUrl += ServiceLocator.ageFrom.getSerchParams();
		serchUrl += ServiceLocator.ageUp.getSerchParams();
		window.location.href = serchUrl;
	}
}


function serchSpecialization() {
	let elements = document.getElementsByClassName("nselect-1");
	let idSpecializationSerch = elements[1].value;
	if(idSpecializationSerch != ServiceLocator.specialization.getId()){
		let serchUrl = ServiceLocator.serchURL;
		serchUrl += ServiceLocator.city.getSerchParams();
		serchUrl += ServiceLocator.gender.getSerchParams();
		serchUrl += ServiceLocator.specialization.getNewSerchParams(idSpecializationSerch);
		serchUrl += ServiceLocator.typeSort.getSerchParams();
		serchUrl += ServiceLocator.typeEmployment.getSerchParams();
		serchUrl += ServiceLocator.typeSchedule.getSerchParams();
		serchUrl += ServiceLocator.experience.getSerchParams();
		serchUrl += ServiceLocator.salary.getSerchParams();
		serchUrl += ServiceLocator.ageFrom.getSerchParams();
		serchUrl += ServiceLocator.ageUp.getSerchParams();
		window.location.href = serchUrl;
	}
}

function serchTypeSort(sortName) {
	if(sortName != ServiceLocator.typeSort.getName()){
		let serchUrl = ServiceLocator.serchURL;
		serchUrl += ServiceLocator.city.getSerchParams();
		serchUrl += ServiceLocator.gender.getSerchParams();
		serchUrl += ServiceLocator.specialization.getSerchParams();
		serchUrl += ServiceLocator.typeSort.getNewSerchParams(sortName);
		serchUrl += ServiceLocator.typeEmployment.getSerchParams();
		serchUrl += ServiceLocator.typeSchedule.getSerchParams();
		serchUrl += ServiceLocator.experience.getSerchParams();
		serchUrl += ServiceLocator.salary.getSerchParams();
		serchUrl += ServiceLocator.ageFrom.getSerchParams();
		serchUrl += ServiceLocator.ageUp.getSerchParams();
		window.location.href = serchUrl;
	}
}

function SerchTypeEmployment() {
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.city.getSerchParams();
	serchUrl += ServiceLocator.gender.getSerchParams();
	serchUrl += ServiceLocator.specialization.getSerchParams();
	serchUrl += ServiceLocator.typeSort.getSerchParams();
	serchUrl += ServiceLocator.typeEmployment.getSerchParams();
	serchUrl += ServiceLocator.typeSchedule.getSerchParams();
	serchUrl += ServiceLocator.experience.getSerchParams();
	serchUrl += ServiceLocator.salary.getSerchParams();
	serchUrl += ServiceLocator.ageFrom.getSerchParams();
	serchUrl += ServiceLocator.ageUp.getSerchParams();
	window.location.href = serchUrl;
}

function SerchSchedule() {
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.city.getSerchParams();
	serchUrl += ServiceLocator.gender.getSerchParams();
	serchUrl += ServiceLocator.specialization.getSerchParams();
	serchUrl += ServiceLocator.typeSort.getSerchParams();
	serchUrl += ServiceLocator.typeEmployment.getSerchParams();
	serchUrl += ServiceLocator.typeSchedule.getSerchParams();
	serchUrl += ServiceLocator.experience.getSerchParams();
	serchUrl += ServiceLocator.salary.getSerchParams();
	serchUrl += ServiceLocator.ageFrom.getSerchParams();
	serchUrl += ServiceLocator.ageUp.getSerchParams();
	window.location.href = serchUrl;
}

function SerchExperience() {
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.city.getSerchParams();
	serchUrl += ServiceLocator.gender.getSerchParams();
	serchUrl += ServiceLocator.specialization.getSerchParams();
	serchUrl += ServiceLocator.typeSort.getSerchParams();
	serchUrl += ServiceLocator.typeEmployment.getSerchParams();
	serchUrl += ServiceLocator.typeSchedule.getSerchParams();
	serchUrl += ServiceLocator.experience.getSerchParams();
	serchUrl += ServiceLocator.salary.getSerchParams();
	serchUrl += ServiceLocator.ageFrom.getSerchParams();
	serchUrl += ServiceLocator.ageUp.getSerchParams();
	window.location.href = serchUrl;
}

function SerchSalary(salary) {
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.city.getSerchParams();
	serchUrl += ServiceLocator.gender.getSerchParams();
	serchUrl += ServiceLocator.specialization.getSerchParams();
	serchUrl += ServiceLocator.typeSort.getSerchParams();
	serchUrl += ServiceLocator.typeEmployment.getSerchParams();
	serchUrl += ServiceLocator.typeSchedule.getSerchParams();
	serchUrl += ServiceLocator.experience.getSerchParams();
	serchUrl += ServiceLocator.salary.getNewSerchParams(salary);
	serchUrl += ServiceLocator.ageFrom.getSerchParams();
	serchUrl += ServiceLocator.ageUp.getSerchParams();
	window.location.href = serchUrl;
}


function SerchAgeFrom(age) {
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.city.getSerchParams();
	serchUrl += ServiceLocator.gender.getSerchParams();
	serchUrl += ServiceLocator.specialization.getSerchParams();
	serchUrl += ServiceLocator.typeSort.getSerchParams();
	serchUrl += ServiceLocator.typeEmployment.getSerchParams();
	serchUrl += ServiceLocator.typeSchedule.getSerchParams();
	serchUrl += ServiceLocator.experience.getSerchParams();
	serchUrl += ServiceLocator.salary.getSerchParams();
	serchUrl += ServiceLocator.ageFrom.getNewSerchParams(age);
	serchUrl += ServiceLocator.ageUp.getSerchParams();
	window.location.href = serchUrl;
}


function SerchAgeUp(age) {
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.city.getSerchParams();
	serchUrl += ServiceLocator.gender.getSerchParams();
	serchUrl += ServiceLocator.specialization.getSerchParams();
	serchUrl += ServiceLocator.typeSort.getSerchParams();
	serchUrl += ServiceLocator.typeEmployment.getSerchParams();
	serchUrl += ServiceLocator.typeSchedule.getSerchParams();
	serchUrl += ServiceLocator.experience.getSerchParams();
	serchUrl += ServiceLocator.salary.getSerchParams();
	serchUrl += ServiceLocator.ageFrom.getSerchParams();
	serchUrl += ServiceLocator.ageUp.getNewSerchParams(age);
	window.location.href = serchUrl;
}

function SerchPage(numberPage) {
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.city.getSerchParams();
	serchUrl += ServiceLocator.gender.getSerchParams();
	serchUrl += ServiceLocator.specialization.getSerchParams();
	serchUrl += ServiceLocator.typeSort.getSerchParams();
	serchUrl += ServiceLocator.typeEmployment.getSerchParams();
	serchUrl += ServiceLocator.typeSchedule.getSerchParams();
	serchUrl += ServiceLocator.experience.getSerchParams();
	serchUrl += ServiceLocator.salary.getSerchParams();
	serchUrl += ServiceLocator.ageFrom.getSerchParams();
	serchUrl += ServiceLocator.ageUp.getSerchParams();
	numPage = parseInt(numberPage);
	serchUrl += ServiceLocator.page.getNewSerchParams(numPage);
	window.location.href = serchUrl;
}

function serchFullText() {
	const el = document.getElementById("full-text-serch");
	let textSerch = el.value;
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += ServiceLocator.fullTextSercher.getNewSerchParams(textSerch);
	window.location.href = serchUrl;
}



//Load events


function afterPageLoad() {
	addEventListeners();
	
	let params = (new URL(document.location)).searchParams; 
	if(params.has('city')){
		let idCity = params.get('city');
        ServiceLocator.city = new City(idCity);
	} else {
        ServiceLocator.city = new City('0');
	}
	
	if(params.has('gender')) {
		let genderString = params.get('gender');
    	ServiceLocator.gender = new Gender(genderString);
	} else {
        ServiceLocator.gender = new Gender('all');
	}
	
	if(params.has('specialization')) {
		let specializationString = params.get('specialization');
		ServiceLocator.specialization = new Specialization(specializationString);
	} else {
        ServiceLocator.specialization = new Specialization('0');
	}
	
	if(params.has('type_sort')) {
		let typeSortString = params.get('type_sort');
		ServiceLocator.typeSort = new TypeSort(typeSortString);
	} else {
        ServiceLocator.typeSort = new TypeSort('new');
	}
	
	if(params.has('salary')) {
		let salaryString = params.get('salary');
		ServiceLocator.salary = new Salary(salaryString);
	} else {
        ServiceLocator.salary = new Salary('0');
	}
	
	if(params.has('ageFrom')) {
		let ageFromString = params.get('ageFrom');
		ServiceLocator.ageFrom = new AgeFrom(ageFromString);
	} else {
        ServiceLocator.ageFrom = new AgeFrom('0');
	}
	
	if(params.has('ageUp')) {
		let ageUpString = params.get('ageUp');
		ServiceLocator.ageUp = new AgeUp(ageUpString);
	} else {
        ServiceLocator.ageUp = new AgeUp('0');
	}
	
	if(params.has('page')) {
		let numberPage = params.get('page');
		ServiceLocator.page = new Page(numberPage);
	} else {
        ServiceLocator.page = new Page('1');
	}
	
	if(params.has('serchText')) {
		let serchText = params.get('serchText');
		ServiceLocator.fullTextSercher = new FullTextSercher(serchText);
	} else {
        ServiceLocator.fullTextSercher = new FullTextSercher('');
	}
	
	ServiceLocator.typeEmployment = new TypeEmployment();
	ServiceLocator.typeSchedule = new TypeSchedule();
	ServiceLocator.experience = new Experience();

}


function addEventListeners() {
 	addEventsForSerchFullText();
	addEventsForTypeSort();
}

function addEventsForSerchFullText() {
	let el = document.getElementById("btn-serch");
	el.addEventListener("click", serchFullText, false);
	
	el = document.getElementById("full-text-serch");
	el.addEventListener('keydown', function(e) {
	    if (e.keyCode === 13) {
			e.preventDefault();
	    	serchFullText();
	    }
	  }, false);
	
	el = document.getElementById("full-text-serch-img");
	el.addEventListener("click", function(e) {
	    	e.preventDefault();
	    	serchFullText();
	    }, false);
}

function addEventsForTypeSort() {
	let el = document.getElementById("type-sort-new");
	el.addEventListener("click", function(e) {
	    	e.preventDefault();
	    	serchTypeSort('new');
	    }, false);

	el = document.getElementById("type-sort-inc-salary");
	el.addEventListener("click", function(e) {
	    	e.preventDefault();
	    	serchTypeSort('inc-salary');
	    }, false);

	el = document.getElementById("type-sort-desc-salary");
	el.addEventListener("click", function(e) {
	    	e.preventDefault();
	    	serchTypeSort('desc-salary');
	    }, false);
}




