
//
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
		let params = "city="+idCitySerch;
		return params;
    }

	getSerchParams() {
		let params = "city="+this.getIdCity();
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
		let params = "&specialization="+this.getId();
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
		this.salary = salary;
	}
	
	getSalary() {
		return this.salary;
	}
	
	getNewSerchParams(salary) {
		ServiceLocator.salary = new Salary(salary);
		let params = "&salary="+salary;
		return params;
	}
	
	getSerchParams() {
		let params = "&salary="+this.getSalary();
		return params;
	}
}

function afterPageLoad() {
	let params = (new URL(document.location)).searchParams; 
	if(params.has('city')){
		idCity = params.get('city');
        ServiceLocator.city = new City(idCity);
	} else {
        ServiceLocator.city = new City('0');
	}
	
	if(params.has('gender')) {
		genderString = params.get('gender');
    	ServiceLocator.gender = new Gender(genderString);
	} else {
        ServiceLocator.gender = new Gender('all');
	}
	
	if(params.has('specialization')) {
		specializationString = params.get('specialization');
		ServiceLocator.specialization = new Specialization(specializationString);
	} else {
        ServiceLocator.specialization = new Specialization('0');
	}
	
	if(params.has('type_sort')) {
		typeSortString = params.get('type_sort');
		ServiceLocator.typeSort = new TypeSort(typeSortString);
	} else {
        ServiceLocator.typeSort = new TypeSort('new');
	}
	
	if(params.has('salary')) {
		salaryString = params.get('salary');
		ServiceLocator.salary = new Salary(salaryString);
	} else {
        ServiceLocator.salary = new Salary('0');
	}
	
	ServiceLocator.typeEmployment = new TypeEmployment();
	ServiceLocator.typeSchedule = new TypeSchedule();
	ServiceLocator.experience = new Experience();

}



function serchCity() {
	//city.getNewSerchParams(idCitySerch);
	let elements = document.getElementsByClassName("nselect-1");
	idCitySerch = elements[0].value;
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
		window.location.href = serchUrl;
	}
}


function serchSpecialization() {
	let elements = document.getElementsByClassName("nselect-1");
	idSpecializationSerch = elements[1].value;
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
	window.location.href = serchUrl;
	//alert(str);
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
	window.location.href = serchUrl;
}










