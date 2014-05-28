mindBlitzApp.controller('scales', ['$scope','$state', 'resultsData',function ($scope,$state,resultsData) {

    $scope.data = resultsData.getResults();
    

    $scope.send = function () {
        console.log($scope.data);
        localStorage.setItem('userScales', JSON.stringify($scope.data));
        //To do: send to function

        $state.go("results");
    }


} ]);