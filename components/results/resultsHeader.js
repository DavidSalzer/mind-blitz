mindBlitzApp.controller('resultsHeader', ['$scope','$state','$http','facebook','resultsData', function ($scope,$state,$http,facebook,resultsData) {
    
    $scope.share=function(){
		resultsData.getResults()
			.then(function (data) {
				facebook.share({
					name: "I've been mind blitzed",

					link: 'http://mind-blitz.bookso.co.il/#/results/'+data.key,
					picture: 'http://mind-blitz.bookso.co.il/img/logo_small.png',
					caption:"",
					description: '',
                    message: ""
				})
			})
		/*html2canvas(document.body, {
		  onrendered: function(canvas) {
			var dataURL = canvas.toDataURL();
			console.log(dataURL);
			//console.log({imgBase64: dataURL});
			$http.post("/data/getImage.php", {"imgBase64": dataURL}).success(function(data){
			  console.log(data);
			});
		  }
		});*/
    }

    
    $scope.back = function () {
        $state.go("scales");
    }

} ]);