var mindBlitzApp = angular.module('mindBlitzApp', ['ui.router']);

mindBlitzApp.config(function ($stateProvider, $urlRouterProvider) {
    //$urlRouterProvider.otherwise('/signup');

    $stateProvider
		.state('signup', {
		    url: "/signup",
		    views: {
		        "main": {
		            templateUrl: "components/signup/signup.html",
		            controller: "signup"
		        },
                "header": {
		            templateUrl: "components/signup/signupHeader.html",
		            controller: "signup"
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
		            templateUrl: "components/scales/scalesHeader.html",
		            controller: "scales"
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
		            controller: "results"
		        }
		    }
		})
});