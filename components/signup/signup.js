mindBlitzApp.controller('signup', ['$scope', '$state', 'facebook', function ($scope, $state, facebook) {
    //  $scope.user = {};

    $scope.signup = function () {
        //console.log($scope.data.user);
        localStorage.setItem('userData', JSON.stringify($scope.user));
        console.log(JSON.parse(localStorage.getItem('userData')));
        $state.go("scales");
    }

    $scope.signupWithFb = function () {
        facebook.login();
    }

} ]);