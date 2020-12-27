
serchURL =  "http://localhost/hh-clone/web/resume/?";
city = '';
gender = '';
specialization = '';
typeSort = '';

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
    
    addSerchParams(idCitySerch) {
		city = new City(idCitySerch);
		serchURL += "city="+idCitySerch;
    }

	setParams() {
		serchURL += "city="+this.getIdCity();
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
	addSerchParams(genderName) {
		gender = new Gender(genderName);
		serchURL += "&gender="+genderName;
    }
	setParams() {
		serchURL += "&gender="+this.getName();
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
    
    addSerchParams(id) {
		specialization = new Specialization(id)
		serchURL += "&specialization="+id;
    }

	setParams() {
		serchURL += "&specialization="+this.getId();
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
	addSerchParams(sortName) {
		typeSort = new TypeSort(sortName);
		serchURL += "&type_sort="+sortName;
    }
	setParams() {
		serchURL += "&type_sort="+this.getName();
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
	
}

function serchCity() {
	//city.addSerchParams(idCitySerch);
	elements = document.getElementsByClassName("nselect-1");
	idCitySerch = elements[0].value;
	if (city.getIdCity() != idCitySerch){
	    city.addSerchParams(idCitySerch);
		gender.setParams();
		specialization.setParams();
		typeSort.setParams();
		window.location.href = serchURL;
	}
	
}

function serchGender(genderName) {
	if(genderName != gender.getName()){
		city.setParams();
		gender.addSerchParams(genderName);
		specialization.setParams();
		typeSort.setParams();
		window.location.href = serchURL;
	}
}


function serchSpecialization() {
	elements = document.getElementsByClassName("nselect-1");
	idSpecializationSerch = elements[1].value;
	if(idSpecializationSerch != specialization.getId()){
		city.setParams();
		gender.setParams();
		specialization.addSerchParams(idSpecializationSerch);
		typeSort.setParams();
		window.location.href = serchURL;
	}
}

function serchTypeSort(sortName) {
	if(sortName != typeSort.getName()){
		city.setParams();
		gender.setParams();
		specialization.setParams();
		typeSort.addSerchParams(sortName);
		window.location.href = serchURL;
	}
}

function SerchTypeEmployment(htmlElement) {
	//type=checkbox[name='type_employment']
	//let elements = document.querySelectorAll("input:checked");
	let elements = document.querySelectorAll("type=[input]");
	let str = '';
	for(i=0; i<elements.length; i++) {
		str += elements[i].id + ' ';
	}
	alert(str);
}













