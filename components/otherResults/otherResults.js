mindBlitzApp.controller('otherResults', ['$stateParams','$scope', 'resultsData', '$state', function ($stateParams,$scope, resultsData, $state) {
	//$scope.data = resultsData.getResults();
    resultsData.getDataByKey($stateParams.key)
		.then(function (data) {
			$scope.data = data;
			if ($scope.data.key==null){
				$state.go("signup");
			}
		})

} ]);