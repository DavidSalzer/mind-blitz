mindBlitzApp.controller('scales', ['$scope','$state', function ($scope,$state) {

    $scope.data = {
        "visualTextual": "5",
        "independentSocial": "5",
        "bouncyLinear": "5",
        "activePassive": "5",
        "autodidacticFramed": "5",
        "gamesSerious": "5",
        "subjectInterdisciplinary": "5"
    }

    $scope.send = function () {
        console.log($scope.data);
        localStorage.setItem('userScales', JSON.stringify($scope.data));
        //To do: send to function

        $state.go("results");
    }


} ]);