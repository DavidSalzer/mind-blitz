mindBlitzApp.controller('otherResultsHeader', ['$stateParams','$scope','$state','$http','facebook','resultsData', function ($stateParams,$scope,$state,$http,facebook,resultsData) {
    
    $scope.share=function(){
		resultsData.getResults()
			.then(function (data) {
				facebook.share({
					name: 'mind blitz.',
					link: 'http://mind-blitz.cambium-team.com/#/results/'+$stateParams.key,
					picture: 'http://mind-blitz.cambium-team.com/img/logo_small.png',
					caption:"",
					description: '',
				})
			})
    }

    
    $scope.signup = function () {
        $state.go("signup");
    }

} ]);