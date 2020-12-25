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
    
    serchIdCity(idCitySerch) {
        if (this.idCity != idCitySerch) {
            window.location.href = "http://localhost/hh-clone/web/resume/?"+"gender="+gender.getName()+"&city="+idCitySerch;
        }
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
    elements = document.getElementsByClassName("nselect-1");
    idCitySerch = elements[0].value;
    city.serchIdCity(idCitySerch);
}





















