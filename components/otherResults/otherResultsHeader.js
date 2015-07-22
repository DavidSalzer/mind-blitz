mindBlitzApp.controller('otherResultsHeader', ['$stateParams','$scope','$state','$http','facebook','resultsData', function ($stateParams,$scope,$state,$http,facebook,resultsData) {
    
    $scope.share=function(){
		resultsData.getResults()
			.then(function (data) {
				facebook.share({
					name: 'mind blitz.',
					//link: 'http://mindblitz.mindcet.org/#/results/'+$stateParams.key,
					//picture: 'http://mindblitz.mindcet.org/img/logo_small.png',
					link: 'http://mindblitz.mindcet.org/share.php?key='+$stateParams.key,
					picture: 'http://mindblitz.mindcet.org/shareimage/'+$stateParams.key+'.png?v='+Date.now(),
					caption:"",
					caption:"",
					description: '',
				})
			})
    }

    
    $scope.signup = function () {
        $state.go("signup");
    }

} ]);