
sercherUrl =  "http://localhost/hh-clone/web/resume/?";
city = '';
gender = '';

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
		sercherUrl += "city="+idCitySerch;
        //window.location.href = "http://localhost/hh-clone/web/resume/?"+"gender="+gender.getName()+"&city="+idCitySerch;
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
		sercherUrl += "&gender="+genderName;
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
}

function serchCity() {
	//city.addSerchParams(idCitySerch);
	elements = document.getElementsByClassName("nselect-1");
	idCitySerch = elements[0].value;
	if (city.getIdCity() != idCitySerch){
	    city.addSerchParams(idCitySerch);
		gender.addSerchParams(gender.getName());
		window.location.href = sercherUrl;
	}
	
}

function addCityParams() {
	elements = document.getElementsByClassName("nselect-1");
	idCitySerch = elements[0].value;
	sercherUrl += "city="+idCitySerch;
}

function serchGender(genderName) {
	if(genderName != gender.getName()){
		addCityParams();
		gender.addSerchParams(genderName);
		window.location.href = sercherUrl;
	}
	
}


















