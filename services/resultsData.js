mindBlitzApp.factory('resultsData', ['$http','$q',function ($http,$q) {
    var results = null;

    return {
	    getResults:function(){
			var deferred = $q.defer();
			if (!results){
				var results= JSON.parse(localStorage.getItem('data'));
			}
			if (!results){
				results = {
						key: "t."+Date.now()+"r."+Math.random(),
						facebookId: null,
						name: "",
						age: "",
						gender: "",
						profession: "",
						study: "",
						email: "",
						visualTextual: "5",
						independentSocial: "5",
						bouncyLinear: "5",
						activePassive:"5",
						autodidacticFramed: "5",
						gamesSerious: "5",
						subjectInterdisciplinary: "5",
						startAns:false,
					}
			}
			deferred.resolve(results);
			/*if (key){
					a=this.getData(key);
					a.then(function(data){
						if(data!="null")
							results=data;
						deferred.resolve(results);
					})
				}*/
			//return results;
			return deferred.promise;
		},
		setResults:function(data){
			results=data;
			results.startAns=true;
			localStorage.setItem('data', JSON.stringify(results));
		},
		publishResults:function (){
			$http.post('/data/data.php?type=set', results).success(function(data){
				console.log(data);
				if (data && data.key) {
					results.key=data.key;
					localStorage.setItem('data', JSON.stringify(results));
				}
			});
		},
		logout:function(){
			results = null;
			localStorage.removeItem('data');
		},
		getDataByKey:function(key){
			var deferred = $q.defer();
			$http.post('/data/data.php?type=get', {key:key}).success(function(data){
				results=data;
				results.startAns=true;
				deferred.resolve(results);
			});
			return deferred.promise;
		}
		
    }
} ]);