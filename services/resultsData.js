mindBlitzApp.factory('resultsData', ['$http','$q',function ($http,$q) {
    var results = null;

    return {
	    getResults:function(data){
			var deferred = $q.defer();
			if (!results){
				var key= localStorage.getItem('key');
				results = {
						key: null,
						facebookid: null,
						name: "",
						age: "",
						gender: "",
						profession: "",
						study: "",
						visualtextual: 5,
						independentsocial: 5,
						bouncylinear: 5,
						activepassive: 5,
						autodidacticframed: 5,
						gamesserious: 5,
						subjectinterdisciplinary: 5
					}
				if (key){
					a=this.getData(key);
					a.then(function(data){
						if(data!="null")
							results=data;
						deferred.resolve(results);
					})
				}
				else{
					deferred.resolve(results);
				}
			}
			else{
				deferred.resolve(results);
			}

			//return results;
			return deferred.promise;
		},
		setResults:function(data){
			results=data;
		},
		publishResults:function (){
			$http.post('/data/data.php?type=set', results).success(function(data){
				if (data && data.key) {
					results.key=data.key;
					localStorage.setItem('key', data.key);
				}
			});
		},
		logout:function(){
			results = null;
			localStorage.setItem('key', null);
		},
		getData:function(key){
			var deferred = $q.defer();
			$http.post('/data/data.php?type=get', {key:key}).success(function(data){deferred.resolve(data);});
			return deferred.promise;
		}
		
    }
} ]);