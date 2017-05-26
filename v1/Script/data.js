(function(){
	var myApp = angular.module('LifeDash',[]);

	myApp.controller('DataController', ['$http','$scope','$interval',"$window",function($http,$scope,$interval,$window){
		var object = this;

		this.weatherInfo = [];
		this.scheduleInfo = [];
		this.newsInfo = [];

		$scope.reload = function(){
			$http.get("api/Schedule").success(function(data){
				object.scheduleInfo = data;
			});
			$http.get("api/Weather").success(function(data){
				object.weatherInfo = data;
			});
			$http.get("api/News").success(function(data){
				object.newsInfo = data;
			});
		};

		this.goTo = function(url){
				$window.open(url);
		}

		$scope.reload();
		$interval($scope.reload, 1080000);
	}]);

	myApp.controller("PanelController", function(){
		this.tab = 1;

		this.selectTab = function(setTab){
			this.tab = setTab;
		};

		this.isSelected = function(checkTab){
			return this.tab === checkTab;
		}
	});

	myApp.controller("InnerPanelController", ['$scope',function($scope){
		this.tab = 0;
		this.idCurrentSeance = 0;
		this.idCurrentExercice = 0;
		this.idNote;

		this.selectTab = function(setTab){
			this.tab = setTab;
		};

		this.isSelected = function(checkTab){
			return this.tab === checkTab;
		}

		this.setSeance = function(idseance){
			this.idCurrentSeance = idseance;
		}

		this.getSeance = function(){
			return this.idCurrentSeance;
		}

		this.setExercice = function(idexo){
			this.idCurrentExercice = idexo;
		}

		this.getExercice = function(){
			return this.idCurrentExercice;
		}

		this.setNote = function(idNote){
			this.idNote = idNote;
		}

		this.getNote = function(){
			return this.idNote;
		}

		this.isSeanceSelected = function(id) {
			return id === this.idCurrentSeance;
		}

	}]);

	myApp.controller("AuthController",['$http','$scope',function($http,$scope){

		var object = this;
		this.mdp;

		this.valid = false;

		$scope.checkAuth = function(){
			$http.get("Api/Auth.php",{
				params: {
					mdp : object.mdp,
				}
			}).then(function(data){
				object.valid = data["data"] == "true";
			},function(){
				console.log("error");
			});
		}

		this.check = function(){
			$scope.checkAuth();
		}

	}]);

	myApp.controller("SeanceController", ['$http','$scope','$timeout','$window',function($http,$scope,$timeout,$window){
		var object = this;

		this.seanceInfo = [];

		$scope.reload = function(){
			$http.get("api/Seance"
     ).then(function(data){
				object.seanceInfo = data;
			},function(){
				alert("Can't load Seance !");
			});
		};

		this.addSeance = function(titre,objectif){
			$http.post("api/Seance/"+titre+"/"+objectif).then(function(data){
			 	object.refresh();
			},function(){
				alert("Can't add Seance !");
			});
		};

		this.delete = function(ids){
			$http.delete("api/Seance/"+ids).then(function(data){
			 	$scope.reload();
			},function(){
				alert("Can't delete Seance !");
			});
		};

		this.update = function(ids,titre,objectif){
			$http.put("api/Seance/"+ids+"/"+titre+"/"+objectif).then(function(data){
				$scope.reload();
			},function(){
				alert("Can't update Seance !");
			});
		};

		this.getSeanceById = function(ids){
			if(this.seanceInfo['data'] != undefined){
				for (var i = 0; i < this.seanceInfo['data'].length; i++) {
					if(this.seanceInfo['data'][i]['IdSeance'] == ids){
						return this.seanceInfo['data'][i];
					}
				}
			}
		}

		this.refresh = function(){
			$scope.reload();
		}

		$scope.reload();
	}]);

	myApp.controller("AffiliationsController", ['$http','$scope','$interval','$timeout',function($http,$scope,$interval,$timeout){
		var object = this;

		this.affiliations = [];

		$scope.reload = function(){
			$http.get("api/AffiliationSeanceExercice"
     ).then(function(data){
				object.affiliations = data;
			},function(){
				console.log("Error");
			});
		};

		this.delete = function(idseance, idexercice){
			$http.delete("api/AffiliationSeanceExercice/"+idseance+"/"+idexercice).then(function(data){
				$scope.reload();
			},function(){
				console.log("Error");
			});
		};

		this.addAffiliation = function(idseance, idexercice){
			$http.post("api/AffiliationSeanceExercice/"+idseance+"/"+idexercice).then(function(data){
			 	object.refresh();
			},function(){
				console.log("Error");
			});
		};

		$scope.reload();
		this.refresh = function(){
			$scope.reload();
		}
	}]);

	myApp.controller("ExerciceController", ['$http','$scope',function($http,$scope){
		var object = this;

		this.exercices = [];
		this.typeExercice = [];

		$scope.reload = function(){
			$http.get("api/Exercices").then(function(data){
				object.exercices = data;
			},function(){
				alert("Can't load Exercice !");
			});

			$http.get("api/TypeExercices").then(function(data){
				object.typeExercice = data;
			},function(){
				alert("Can't load TypeExercices !");
			});
		};

		this.addTimePerf = function(ide,temps,ids){
			if(ids != undefined){
				var uri = "api/Performance/temps/"+ide+"/"+temps+"/"+ids;
			}
			else{
				var uri = "api/Performance/temps/"+ide+"/"+temps;
			}
			$http.post(uri).then(function(data){

			},function(){
				alert("Can't add Performance !");
			});
		}

		this.addChargePerf = function(ide,series,repetition,charge,ids){
			if(ids != undefined){
				var uri = "api/Performance/charge/"+ide+"/"+series+"/"+repetition+"/"+charge+"/"+ids;
			}
			else{
				var uri = "api/Performance/charge/"+ide+"/"+series+"/"+repetition+"/"+charge;
			}
			$http.post(uri).then(function(data){

			},function(){
				alert("Can't add Performance !");
			});
		}

		this.isCharge = function(idt){
			if(this.typeExercice['data'] != undefined){
				for (var i = 0; i < this.typeExercice['data'].length; i++) {
					if(this.typeExercice['data'][i]['IdType'] == idt && this.typeExercice['data'][i]['type'] == "charge"){
						return true;
					}
				}
			}
			return false;
		}

		this.isTemps = function(ide){
			if(this.typeExercice['data'] != undefined){
				for (var i = 0; i < this.typeExercice['data'].length; i++) {
						if(this.typeExercice['data'][i]['IdType'] == ide && this.typeExercice['data'][i]['type'] == "temps"){
								return true;
					}
				}
			}
			return false;
		}

		this.add = function(titre,description,type){
			$http.post("api/Exercices/"+titre+"/"+description+"/"+type).then(function(data){
					$scope.reload();
			},function(){
				alert("Can't add Exercices !");
			});
		};

		this.delete = function(ide){
			$http.delete("api/Exercices/"+ide).then(function(data){
			 	$scope.reload();
			},function(){
				alert("Can't delete Exercice !");
			});
		};

		this.refresh = function(){
			$scope.reload();
		}

		this.update = function(ide,titre,description){
			$http.put("api/Exercices/"+ide+"/"+titre+"/"+description).then(function(data){
				$scope.reload();
			},function(){
				alert("Can't update Exercices !");
			});
		};

		this.getExerciceById = function(ids){
			if(this.exercices['data'] != undefined){
				for (var i = 0; i < this.exercices['data'].length; i++) {
					if(this.exercices['data'][i]['IdExercice'] == ids){
						return this.exercices['data'][i];
					}
				}
			}
		}

		$scope.reload();
	}]);

	myApp.controller("PerformanceController", ['$http','$scope',function($http,$scope){
		var object = this;

		this.performances = [];
		this.performanceCharge = [];
		this.performanceTemps = [];
		this.affiliationsPerfSeance = [];

		$scope.reload = function(){
			$http.get("api/Performance").then(function(data){
				object.performanceCharge = data["data"]["charge"];
				object.performanceTemps = data["data"]["temps"];
				object.performances = data["data"]["perf"];
			},function(){
				alert("Can't load Performance !");
			});

			$http.get("api/AffiliationSeancePerformance").then(function(data){
				object.affiliationsPerfSeance = data["data"];
				console.log(object.affiliationsPerfSeance);
			},function(){
				console.log("Error");
			});

		};

		this.getIdPerf = function(idSeance){
			result = [];
			for (var i = 0; i < object.affiliationsPerfSeance.length; i++) {
				if(object.affiliationsPerfSeance[i]['IdSeance'] == idSeance){
					result.push(object.affiliationsPerfSeance[i]["IdPerformance"]);
				}
			}
			return result;
		}

		this.getIdPerfExercice = function(idExercice){
			result = [];
			for (var i = 0; i < object.performances.length; i++) {
				if(object.performances[i]['IdExercice'] == idExercice){
					result.push(object.performances[i]["IdPerformance"]);
				}
			}
			return result;
		}

		this.getPerfIfCharge = function(idPerf){
			for (var i = 0; i < object.performanceCharge.length; i++) {
				if(object.performanceCharge[i]["IdPerformance"] ==  idPerf){
					return object.performanceCharge[i];
				}
			}
		}

		this.getPerfIfTemps = function(idPerf){
			for (var i = 0; i < object.performanceTemps.length; i++) {
				if(object.performanceTemps[i]["IdPerformance"] ==  idPerf){
					return object.performanceTemps[i];
				}
			}
		}

		this.getExercice = function(idp){
			for (var i = 0; i < object.performances.length; i++) {
				if(object.performances[i]["IdPerformance"] == idp){
					return object.performances[i];
				}
			}
		}

		this.refresh = function(){
			$scope.reload();
		}

		$scope.reload();
	}]);

	myApp.controller("NoteJourController", ['$http','$scope','$filter',function($http,$scope,$filter){
		var object = this;

		this.note = [];

		$scope.reload = function(){
			$http.get("api/NoteJour").then(function(data){
				object.note = data;
			},function(){
				alert("Can't load Note !");
			})
		}

		this.add = function(jour,note,comm){
			$http.post("api/NoteJour/"+jour+"/"+note+"/"+comm).then(function(data){

			},function(){
				alert("Can't add Note !");
			});
		}

		this.delete = function(jour){
			$http.delete("api/NoteJour/"+jour).then(function(data){
				$scope.reload();
			},function(){
				alert("Can't delete Note !");
			});
		};

		this.refresh = function(){
			$scope.reload();
		}

		this.update = function(jour,note,comm){
			$http.put("api/NoteJour/"+jour+"/"+note+"/"+comm).then(function(data){
				$scope.reload();
			},function(){
				alert("Can't update Note !");
			});
		};

		this.convertDate = function(date){
			return $filter('date')(new Date(date), "yyyy-MM-dd")
		}

		this.getNote = function(jour){
			if(object.note["data"] != undefined){
				for (var i = 0; i < object.note["data"].length; i++) {
					if(object.note["data"][i]["Jour"] === jour){
						return object.note["data"][i];
					}
				}
			}
		}

		$scope.reload();
	}]);

})();
