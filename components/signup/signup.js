mindBlitzApp.controller('signup', ['$scope', '$state', 'facebook', function ($scope, $state, facebook) {
    $scope.user = {};
    $scope.localStorge = localStorage.getItem('userData');
    if ($scope.localStorge) {
        $scope.user = JSON.parse(localStorage.getItem('userData'));
        $scope.$apply();
    }
    localStorage.setItem("userScales", null);
    $scope.signup = function () {
        //console.log($scope.data.user);
        if ($scope.user.age && $scope.user.gender && $scope.user.profession && $scope.user.study) {
            localStorage.setItem('userData', JSON.stringify($scope.user));
            console.log(JSON.parse(localStorage.getItem('userData')));
            $state.go("scales");
        }
    }

    $scope.signupWithFb = function () {
        facebook.login();
    }

} ]);