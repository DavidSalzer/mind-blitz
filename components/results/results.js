mindBlitzApp.controller('results', ['$scope', 'resultsData', '$state',  function ($scope, resultsData,$state) {
    //$scope.data = resultsData.getResults();
	$scope.data = resultsData.getResults();
	$scope.data.then(function(data){
		$scope.data=data;
	})
    //To do: get from server the data
    $scope.logout=function(){
		resultsData.logout();
		$state.go("signup");
	}

} ]);