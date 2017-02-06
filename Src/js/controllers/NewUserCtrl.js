myapp.controller('NewUserCtrl',['$scope','$location','$cookies','$rootScope','$http','$mdToast',function($scope,$location,$cookies,$rootScope,$http, $mdToast) {

	console.log("NewUserCtrl reporting for duty.");
	$scope.spinner = false;
    $scope.sexos=[{id:'1',nombre:'FEMENINO'},{id:'2',nombre:'MASCULINO'}];
	
	
	
			$scope.submit = function(){
				
				var session_id= getPHPSessId();
				$scope.vm.password=CryptoJS.AES.encrypt(JSON.stringify($scope.vm.password), session_id.toString(), {format: CryptoJSAesJson}).toString();
				$scope.vm.password2=$scope.vm.password;

				if ($rootScope.User)
				{
					if ($rootScope.User.profile == 2)
					{
						$scope.vm.id_empresa=$rootScope.User.id;
					}
					else
					{
						$scope.vm.id_empresa=0;
					}
				}
				else
				{
					$scope.vm.id_empresa=0;
				}
				
				var request = $http({ method: "post",url: "lib/register_user.php",data:eval($scope.vm)});
			
				/* Check whether the HTTP Request is successful or not. */
				request.success(function (data) 
				{ 
						$scope.spinner = true;
						
						 var result=eval(data);
						 if (result.STATUS == 1) 
						 {
									$mdToast.show(
									  $mdToast.simple()
										.textContent(result.ERROR)
										.position('bottom' )
										.hideDelay(3000)
									);
								
								
										 $scope.vm.password=null;
										 $scope.vm.password2=null;
										 $scope.vm.nombre=null;
										 $scope.vm.apellido=null;
										 $scope.vm.email=null;
										 $scope.vm.bday=null;
										 $scope.vm.telefono=null;
										 $scope.vm.sexo=null;
										 $scope.vm.aceptaterminos=null;
										 
										 $scope.UserForm.nombre.$error={};
										 $scope.UserForm.apellido.$error={};
										 $scope.UserForm.email.$error={};
										 $scope.UserForm.bday.$error={};
										 $scope.UserForm.telefono.$error={};
										 $scope.UserForm.sexo.$error={};
										 $scope.UserForm.password.$error={};
										 $scope.UserForm.password2.$error={};
										 
										 $scope.UserForm.$setValidity();
										 $scope.UserForm.$setUntouched();
										 $scope.UserForm.$setPristine();
										 $scope.UserForm.$submitted = false;
								
								
								
						 }
						 else 
						 {
									$mdToast.show(
									  $mdToast.simple()
										.textContent(result.ERROR)
										.position('bottom' )
										.hideDelay(3000)
									);
									
									$scope.vm.password='';
									$scope.vm.password2='';
						 }
				
						
						$scope.spinner = false;
				});
			
			};


}]);


