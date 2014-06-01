mindBlitzApp.controller('results', ['$scope', 'resultsData', '$state', function ($scope, resultsData, $state) {
    //$scope.data = resultsData.getResults();
    $scope.getData = resultsData.getResults();
    $scope.getData.then(function (data) {
        $scope.data = data;
    })
    $scope.x = 3;
    //To do: get from server the data
    $scope.logout = function () {
        resultsData.logout();
        $state.go("signup");
    }

} ]);