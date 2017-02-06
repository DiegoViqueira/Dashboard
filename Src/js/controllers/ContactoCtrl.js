myapp.controller('ContactoCtrl',  ['$scope','$location','$cookies','$http','$rootScope','$mdSidenav', '$mdDialog','$mdToast', function($scope,$location,$cookies,$http,$rootScope,$mdSidenav, $mdDialog,$mdToast) {

	console.log("ContactoCtrl reporting for duty.");
	
	$scope.sendMail = function()
	{
		 var request = $http({ method: "post",url: "lib/send_mail.php",data:eval($scope.vm)});
		 
		request.success(function (data) 
		{
					var resp = eval(data);
					
					if (resp.ERROR == 1)
					{
						$mdToast.show(
						  $mdToast.simple()
							.textContent(data.MENSAJE)
							.position('bottom' )
							.hideDelay(3000)
						);
						
										 $scope.vm.mensaje=null;
										 $scope.vm.email=null;
										 $scope.vm.empresa=null;
 										 $scope.ContactForm.mensaje.$error={};
										 $scope.ContactForm.email.$error={};
										 $scope.ContactForm.empresa.$error={};
										 $scope.ContactForm.$invalid=true;
										 $scope.ContactForm.$setUntouched();
										 $scope.ContactForm.$setPristine();
										 $scope.ContactForm.$submitted = false;


					}
					else
					{
						$mdToast.show(
						  $mdToast.simple()
							.textContent(data.MENSAJE)
							.position('bottom' )
							.hideDelay(3000)
						);
						
					}
		});
	}
	   
	   

 
}]);

