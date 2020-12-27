
//
city = '';
gender = '';
specialization = '';
typeSort = '';
typeEmployment = '';

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
		city = new City(idCitySerch);
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
		gender = new Gender(genderName);
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
		specialization = new Specialization(id)
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
		typeSort = new TypeSort(sortName);
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


function afterPageLoad() {
	let params = (new URL(document.location)).searchParams; 
	if(params.has('city')){
		idCity = params.get('city');
        city = new City(idCity);
	} else {
        city = new City('0');
	}
	
	if(params.has('gender')) {
		genderString = params.get('gender');
    	gender = new Gender(genderString);
	} else {
        gender = new Gender('all');
	}
	
	if(params.has('specialization')) {
		specializationString = params.get('specialization');
		specialization = new Specialization(specializationString);
	} else {
        specialization = new Specialization('0');
	}
	
	if(params.has('type_sort')) {
		typeSortString = params.get('type_sort');
		typeSort = new TypeSort(typeSortString);
	} else {
        typeSort = new TypeSort('new');
	}
	
	typeEmployment = new TypeEmployment();
}

class ServiceLocator {
	static serchURL =  "http://localhost/hh-clone/web/resume/?";
}

function serchCity() {
	//city.getNewSerchParams(idCitySerch);
	let elements = document.getElementsByClassName("nselect-1");
	idCitySerch = elements[0].value;
	if (city.getIdCity() != idCitySerch){
		let serchUrl = ServiceLocator.serchURL;
	    serchUrl += city.getNewSerchParams(idCitySerch);
		serchUrl += gender.getSerchParams();
		serchUrl += specialization.getSerchParams();
		serchUrl += typeSort.getSerchParams();
		serchUrl += typeEmployment.getSerchParams();
		window.location.href = serchUrl;
	}
	
}

function serchGender(genderName) {
	if(genderName != gender.getName()){
		let serchUrl = ServiceLocator.serchURL;
		serchUrl += city.getSerchParams();
		serchUrl += gender.getNewSerchParams(genderName);
		serchUrl += specialization.getSerchParams();
		serchUrl += typeSort.getSerchParams();
		serchUrl += typeEmployment.getSerchParams();
		window.location.href = serchUrl;
	}
}


function serchSpecialization() {
	let elements = document.getElementsByClassName("nselect-1");
	idSpecializationSerch = elements[1].value;
	if(idSpecializationSerch != specialization.getId()){
		let serchUrl = ServiceLocator.serchURL;
		serchUrl += city.getSerchParams();
		serchUrl += gender.getSerchParams();
		serchUrl += specialization.getNewSerchParams(idSpecializationSerch);
		serchUrl += typeSort.getSerchParams();
		serchUrl += typeEmployment.getSerchParams();
		window.location.href = serchUrl;
	}
}

function serchTypeSort(sortName) {
	if(sortName != typeSort.getName()){
		let serchUrl = ServiceLocator.serchURL;
		serchUrl += city.getSerchParams();
		serchUrl += gender.getSerchParams();
		serchUrl += specialization.getSerchParams();
		serchUrl += typeSort.getNewSerchParams(sortName);
		serchUrl += typeEmployment.getSerchParams();
		window.location.href = serchUrl;
	}
}

function SerchTypeEmployment() {
	//type=checkbox[name='type_employment']
	//let elements = document.querySelectorAll("input:checked")
	
	/*let elements = document.getElementsByName("type_employment");
	let str = '';
	for(i=0; i<elements.length; i++) {
		if(elements[i].checked == true) {
			str += elements[i].value + ' ';
		}
	}*/
	let serchUrl = ServiceLocator.serchURL;
	serchUrl += city.getSerchParams();
	serchUrl += gender.getSerchParams();
	serchUrl += specialization.getSerchParams();
	serchUrl += typeSort.getSerchParams();
	serchUrl += typeEmployment.getSerchParams();
	window.location.href = serchUrl;
	//alert(str);
}













