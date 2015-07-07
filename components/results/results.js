mindBlitzApp.controller('results', ['$scope', 'resultsData', '$state', '$http', function ($scope, resultsData, $state, $http) {
    //$scope.data = resultsData.getResults();
    $scope.getData = resultsData.getResults();
	$scope.data=[];
    $scope.getData.then(function (data) {
        $scope.data["me"] = data;
		console.log(data);
		if (data.startAns==false)
			$state.go("signup");
    })
	$scope.query="me";
	$http.post('/data/data.php?type=getAvrage', {}).success(function(data){
		for (var key in data) {
			$scope.data[key]=data[key];
		}
		console.log($scope.data);
	});
    $scope.x = 3;
    //To do: get from server the data
    $scope.logout = function () {
        resultsData.logout();
        $state.go("signup");
    }

} ]);