mindBlitzApp.controller('scales', ['$scope', '$state', 'resultsData', function ($scope, $state, resultsData) {

    $scope.data = resultsData.getResults();
    $scope.data.then(function (data) {
        $scope.data = data;
        console.log(data);
		if (data.startAns==false)
			$state.go("signup");
        //$scope.data.visualTextual = 3;
    })
    //console.log( $scope.data);


    $scope.send = function () {
        resultsData.setResults($scope.data);
        resultsData.publishResults();
        /*console.log($scope.data);
        localStorage.setItem('userScales', JSON.stringify($scope.data));
        //To do: send to function
        */
        $state.go("results");
    }


} ]);