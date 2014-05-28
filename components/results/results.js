mindBlitzApp.controller('results', ['$scope', 'resultsData', function ($scope, resultsData) {
    $scope.data = resultsData.getResults();
    //To do: get from server the data
   

} ]);