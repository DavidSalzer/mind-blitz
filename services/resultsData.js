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
						key: null,
						facebookid: null,
						name: "",
						age: "",
						gender: "",
						profession: "",
						study: "",
						visualtextual: "5",
						independentsocial: "5",
						bouncylinear: "5",
						activepassive:"5",
						autodidacticframed: "5",
						gamesserious: "5",
						subjectinterdisciplinary: "5"
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
			$http.post('/data/data.php?type=get', {key:key}).success(function(data){deferred.resolve(data);});
			return deferred.promise;
		}
		
    }
} ]);