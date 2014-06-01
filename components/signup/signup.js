mindBlitzApp.controller('signup', ['$scope', '$state', 'facebook','resultsData', function ($scope, $state, facebook,resultsData) {
    /*$scope.data = {};
    $scope.localStorge = localStorage.getItem('dataData');
    if ($scope.localStorge) {
        $scope.data = JSON.parse(localStorage.getItem('dataData'));
        $scope.$apply();
    }
    localStorage.setItem("dataScales", null);*/
	$scope.data = resultsData.getResults();
	$scope.data.then(function(data){
		$scope.data=data;
		if ($scope.data.key!=null){
			$state.go("results");
		}
	})
	//console.log($scope.data);
    $scope.signup = function () {
        //console.log($scope.data.data);
		
        if ($scope.data.age && $scope.data.gender && $scope.data.profession && $scope.data.study) {
            //localStorage.setItem('dataData', JSON.stringify($scope.data));
            //console.log(JSON.parse(localStorage.getItem('dataData')));
			resultsData.setResults($scope.data);
			
            $state.go("scales");
        }
    }

    $scope.signupWithFb = function () {
        facebook.login();
    }

} ]);