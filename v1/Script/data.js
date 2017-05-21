(function(){
	var myApp = angular.module('LifeDash', []);

	myApp.controller('DataController', ['$http','$scope','$interval',function($http,$scope,$interval){
		var object = this;

		this.weatherInfo = [];
		this.scheduleInfo = [];
		this.newsInfo = [];

		$scope.reload = function(){
			$http.get("Api/Schedule.php").success(function(data){
				object.scheduleInfo = data;
			});
			$http.get("Api/Weather.php").success(function(data){
				object.weatherInfo = data;
			});
			$http.get("Api/News.php").success(function(data){
				object.newsInfo = data;
			});
		};
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

	myApp.controller("InnerPanelController", function(){
		this.tab = 0;
		this.idCurrentSeance = 0;
		this.idCurrentExercice = 0;

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

		this.isSeanceSelected = function(id) {
			return id === this.idCurrentSeance;
		}

		this.addSeance = function(){

		}
	});


	myApp.controller("SeanceController", ['$http','$scope','$interval','$timeout',function($http,$scope,$interval,$timeout){
		var object = this;

		this.seanceInfo = [];

		$scope.reload = function(){
			$http.get("Api/Seance.php",{
        params: {
            action: "all",
        }
     }).then(function(data){
				object.seanceInfo = data;
			},function(){
				console.log("Error");
			});
		};

		this.addSeance = function(titre,objectif){
			$http.get("Api/Seance.php",{
        params: {
            action: "add",
						titre: titre,
						objectif: objectif,
        }
     }).then(function(data){
				$scope.reload();
			},function(){
				console.log("Error");
			});
		};

		this.delete = function(ids){
			$http.get("Api/Seance.php",{
        params: {
            action: "delete",
						ids: ids,
        }
     }).then(function(data){
			 	$scope.reload();
			},function(){
				console.log("Error");
			});
		};

		this.update = function(ids,titre,objectif){
			$http.get("Api/Seance.php",{
				params: {
						action: "update",
						ids: ids,
						titre: titre,
						objectif: objectif,
				}
		 }).then(function(data){
				$scope.reload();
			},function(){
				console.log("Error");
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
			$http.get("Api/AffiliationsSeanceExercice.php",{
				params: {
						action: "all",
				}
		 }).then(function(data){
				  object.affiliations = data;
			},function(){
				console.log("Error");
			});
		};

		this.delete = function(idseance, idexercice){
			$http.get("Api/AffiliationsSeanceExercice.php",{
				params: {
						action: "delete",
						ids : idseance,
						ide : idexercice,
				}
		 }).then(function(data){
				$scope.reload();
			},function(){
				console.log("Error");
			});
		};

		this.addAffiliation = function(idseance, idexercice){
			$http.get("Api/AffiliationsSeanceExercice.php",{
				params: {
						action: "add",
						ids : idseance,
						ide : idexercice,
				}
		 }).then(function(data){
			 	$timeout(function() {
					$scope.reload();
				});
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
			$http.get("Api/Exercices.php",{
				params: {
						action: "all",
				}
		 }).then(function(data){
				object.exercices = data;
			},function(){
				console.log("Error");
			});

			$http.get("Api/TypeExercices.php",{
				params: {
						action: "all",
				}
		 }).then(function(data){
				object.typeExercice = data;
			},function(){
				console.log("Error");
			});
		};

		this.addTimePerf = function(ide,temps,ids){
			if(ids != undefined){
				var toadd = {
						action: "add",
						type: "temps",
						ide : ide,
						temps:temps,
						seance: ids,
				}
			}
			else{
				var toadd = {
						action: "add",
						type: "temps",
						ide : ide,
						temps:temps,
				}
			}
			console.log(toadd);
			$http.get("Api/Performance.php",{
				params: toadd
		 }).then(function(data){

			},function(){
				console.log("Error");
			});
		}

		this.addChargePerf = function(ide,series,repetition,charge,ids){
			if(ids != undefined){
				var toadd = {
						action: "add",
						type: "charge",
						ide : ide,
						serie: series,
						repetition:repetition,
						charge: charge,
						seance: ids,
				}
			}
			else{
				var toadd = {
						action: "add",
						type: "charge",
						ide : ide,
						serie: series,
						repetition:repetition,
						charge: charge,
				}
			}
			console.log(toadd);
			$http.get("Api/Performance.php",{
				params: toadd
		 }).then(function(data){

			},function(){
				console.log("Error");
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
			$http.get("Api/Exercices.php",{
				params: {
						action: "add",
						titre : titre,
						description : description,
						type : type,
				}
		 }).then(function(data){
					$scope.reload();
			},function(){
				console.log("Error");
			});
		};

		this.delete = function(ide){
			$http.get("Api/Exercices.php",{
        params: {
            action: "delete",
						ide: ide,
        }
     }).then(function(data){
			 	$scope.reload();
			},function(){
				console.log("Error");
			});
		};

		this.refresh = function(){
			$scope.reload();
		}

		this.update = function(ide,titre,description){
			$http.get("Api/Exercices.php",{
				params: {
						action: "update",
						ide: ide,
						titre: titre,
						description: description,
				}
		 }).then(function(data){
				$scope.reload();
			},function(){
				console.log("Error");
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
})();
