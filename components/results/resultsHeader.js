mindBlitzApp.controller('resultsHeader', ['$scope','$state','$http', function ($scope,$state,$http) {
    
    $scope.share=function(){
		html2canvas(document.body, {
		  onrendered: function(canvas) {
			var dataURL = canvas.toDataURL();
			//console.log({imgBase64: dataURL});
			$http.post("/data/getImage.php", {"imgBase64": dataURL}).success(function(data){
			  console.log(data);
			});
		  }
		});
    }

    
    $scope.back = function () {
        $state.go("scales");
    }

} ]);