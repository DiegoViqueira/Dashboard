myapp.controller('RecoverCtrl', ['$scope','$location','$cookies','$rootScope','$http','$mdSidenav','$mdToast', function($scope,$location,$cookies,$rootScope,$http,$mdSidenav,$mdToast) {

	   console.log("RecoverCtrl reporting for duty.");
	   
	   	$scope.recover = function(){
			
				var request = $http({ method: "post",url: "lib/recover_passwd.php",data:eval($scope.vm)});
			
				/* Check whether the HTTP Request is successful or not. */
				request.success(function (data) 
				{ 
						$scope.spinner = true;
						
						 var result=eval(data);
						 if (result) 
						 {
									$mdToast.show(
									  $mdToast.simple()
										.textContent(result)
										.position('bottom' )
										.hideDelay(3000)
									);
								
								
						 }
						 else 
						 {
									$mdToast.show(
									  $mdToast.simple()
										.textContent(result)
										.position('bottom' )
										.hideDelay(3000)
									);
						 }
				
						
						$scope.spinner = false;
				});
			
			};


	
}]);


