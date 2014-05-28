mindBlitzApp.controller('resultsHeader', ['$scope','$state', function ($scope,$state) {
    
    $scope.share=function(){
        //To do: create a picture and share on fb
    }

    
    $scope.back = function () {
        $state.go("scales");
    }

} ]);