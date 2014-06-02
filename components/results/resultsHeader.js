mindBlitzApp.controller('resultsHeader', ['$scope','$state','$http','facebook','resultsData', function ($scope,$state,$http,facebook,resultsData) {
    
    $scope.share=function(){
		resultsData.getResults()
			.then(function (data) {
				facebook.share({
					name: 'mind blitz.',
					link: 'http://mind-blitz.cambium-team.com/#/results/'+data.key,
					picture: 'http://mind-blitz.cambium-team.com/img/logo_small.png',
					caption:"",
					description: '',
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