class City {
    //#idCity = 0;
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
            window.location.href = "http://localhost/hh-clone/web/resume/?city="+idCitySerch;
        }
    }
}

function afterPageLoad() {
	let params = (new URL(document.location)).searchParams; 
	if(params.has("city")){
		idCity = params.get("city");
        city = new City(idCity);
	} else {
        city = new City('1');
	}
}

function serchCity() {
    elements = document.getElementsByClassName("nselect-1");
    idCitySerch = elements[0].value;
    city.serchIdCity(idCitySerch);
}





















