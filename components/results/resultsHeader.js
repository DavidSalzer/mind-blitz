mindBlitzApp.controller('resultsHeader', ['$scope','$state','$http','facebook','resultsData','Data', function ($scope,$state,$http,facebook,resultsData,Data) {
    
    $scope.share=function(){
		resultsData.getResults()
			.then(function (data) {
				facebook.share({
					name: "I've been mind blitzed",

					//link: 'http://mindblitz.mindcet.org/#/results/'+data.key,
					link: 'http://mindblitz.mindcet.org/share.php?key='+data.key,
					picture: 'http://mindblitz.mindcet.org/shareimage/'+data.key+'.png?v='+Date.now(),
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
	$scope.Data=Data;


    
    $scope.back = function () {
        $state.go("scales");
    }

} ]);