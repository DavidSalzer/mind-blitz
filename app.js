var mindBlitzApp = angular.module('mindBlitzApp', ['ui.router']);

mindBlitzApp.factory('Data', function () {
    return { query: 'me' };
});

mindBlitzApp.config(function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/signup');

    $stateProvider
		.state('signup', {
		    url: "/signup",
		    views: {
		        "main": {
		            templateUrl: "components/signup/signup.html",
		            controller: "signup"
		        },
                "header": {
		            templateUrl: "components/signup/signupHeader.html"
		           
		        }
		    }
		})
        .state('scales', {
		    url: "/scales",
		    views: {
		        "main": {
		            templateUrl: "components/scales/scales.html",
		            controller: "scales"
		        },
                "header": {
		            templateUrl: "components/scales/scalesHeader.html"
		        }
		    }
		})
        .state('results', {
		    url: "/results",
		    views: {
		        "main": {
		            templateUrl: "components/results/results.html",
		            controller: "results"
		        },
                "header": {
		            templateUrl: "components/results/resultsHeader.html",
		            controller: "resultsHeader"
		        }
		    }
		})
		.state('otherResults', {
		    url: "/results/:key",
		    views: {
		        "main": {
		            templateUrl: "components/otherResults/otherResults.html",
		            controller: "otherResults"
		        },
                "header": {
		            templateUrl: "components/otherResults/otherResultsHeader.html",
		            controller: "otherResultsHeader"
		        }
		    }
		})
});