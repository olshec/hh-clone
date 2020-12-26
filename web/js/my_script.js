
serchURL =  "http://localhost/hh-clone/web/resume/?";
city = '';
gender = '';
specialization = '';

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


function afterPageLoad() {
	let params = (new URL(document.location)).searchParams; 
	if(params.has('city')){
		idCity = params.get('city');
        city = new City(idCity);
	} else {
        city = new City('0');
	}
	
	if(params.has('gender')){
		genderString = params.get('gender');
    	gender = new Gender(genderString);
	} else {
        gender = new Gender('all');
	}
	
	if(params.has('specialization')){
	specializationString = params.get('specialization');
	specialization = new Specialization(specializationString);
	} else {
        specialization = new Specialization('all');
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
		window.location.href = serchURL;
	}
	
}

function serchGender(genderName) {
	if(genderName != gender.getName()){
		city.setParams();
		gender.addSerchParams(genderName);
		specialization.setParams();
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
		window.location.href = serchURL;
	}
}















