myapp.controller('ProfileController', ['$scope','Upload','$location','$http','$cookies','$rootScope','$mdSidenav','$timeout','$mdToast',function($scope,Upload,$location,$http,$cookies,$rootScope,$mdSidenav,$timeout,$mdToast) {

	console.log("ProfileController reporting for duty.");
	$scope.sexos=[{id:'1',nombre:'FEMENINO'},{id:'2',nombre:'MASCULINO'}];
	
	$scope.showOptions=false;
	$scope.Editable=false;
	$scope.Editable1=false;
	$scope.invalidFiles = [];
	$scope.spinner1 = false;	
	$scope.spinner = false;
	
	$scope.$watch('files', function () {
        $scope.upload($scope.files);
    });
    $scope.$watch('file', function () {
		
        if ($scope.file != null) {
            $scope.files = [$scope.file]; 
        }
    });
    
	$scope.submit = function()
	{
					$scope.spinner = true;
					
					var request = $http({ method: "post",url: "lib/update_profiile.php",data:{ User: $rootScope.User }});
					
					request.success(function (data) 
					{ 
								 var result=eval(data);
								if (result.ERROR == 1)
								{
										 $scope.Editable=false;
										 
										 $cookies.putObject('User',  $rootScope.User );
						
								}
								
									 $mdToast.show(
									  $mdToast.simple()
										.textContent(result.MESSAGE)
										.position('bottom' )
										.hideDelay(3000)
									);
								
								 $scope.spinner = false;
					});				
 
					
					
					
					
					
	}
					
	
	
	$scope.ChangePassword = function()
	{
				$scope.spinner1 = true;
				var session_id= getPHPSessId();
				
				var NewPassword=CryptoJS.AES.encrypt(JSON.stringify($scope.User.password), session_id.toString(), {format: CryptoJSAesJson}).toString();
	
				var request = $http({ method: "post",url: "lib/update_password.php",data:{ new_password: NewPassword , id: $rootScope.User.id }});
				/* Check whether the HTTP Request is successful or not. */
							request.success(function (data) 
							{ 
									
 
									 var result=eval(data);
									 if (result.ERROR == 1)
									 {
										 $scope.Editable1=false;
										 $scope.User.password=null;
										 $scope.User.password2=null;
										 
										 
										 $scope.ChangePasswordForm.password.$error={};
										 $scope.ChangePasswordForm.password2.$error={};
										 
										 $scope.ChangePasswordForm.$setValidity();
										 $scope.ChangePasswordForm.$setUntouched();
										 $scope.ChangePasswordForm.$setPristine();
										 $scope.ChangePasswordForm.$submitted = false;
									 }
									 
									 $mdToast.show(
									  $mdToast.simple()
										.textContent(result.MESSAGE)
										.position('bottom' )
										.hideDelay(3000)
									);
									 
									 $scope.spinner1 = false;
							})
				
		
		
	}

	$scope.invalidFile= function(value){$mdToast.show(
							$mdToast.simple()
							.textContent(value)
							.position('bottom' )
							.hideDelay(3000)
							);};
    $scope.upload = function (files) {
		
		$scope.log = '';
		
        if (files && files.length) {
            for (var i = 0; i < files.length; i++) {
              var file = files[i];
			  
              if (!file.$error) {
                Upload.upload({
                    url: 'lib/load_file.php',
                    data: {
                      mail: $rootScope.User.email ,
                      file: file  
                    }
                }).then(function (resp) {
                    $timeout(function() {
                        $scope.log = 'file: ' +
                        resp.config.data.file.name +
                        ', Response: ' + JSON.stringify(resp.data) +
                        '\n' + $scope.log;
						console.log("Log: " + $scope.log );
						
							var find_response=JSON.stringify(resp.data).search("OK");
							var my_control='';
							if ( find_response > 0 )
							{
								my_control = "Procesado con Exito [" + resp.config.data.file.name +"]";
								$scope.showOptions=false;
								$rootScope.User.picture='images/usersfotos/' + resp.config.data.file.name;
								$cookies.putObject('User', $rootScope.User);
							}
							else
								my_control = JSON.stringify(resp.data);
								
							$mdToast.show(
							$mdToast.simple()
							.textContent(my_control)
							.position('bottom' )
							.hideDelay(3000)
							);
                    });
                }, null, function (evt) {
                    var progressPercentage = parseInt(100.0 *
                    		evt.loaded / evt.total);
                    $scope.log = 'progress: ' + progressPercentage + 
                    	'% ' + evt.config.data.file.name + '\n' + 
                      $scope.log;
					  console.log("Log: " + $scope.log );
                });
              }
              else
			  {
				  		$mdToast.show(
							$mdToast.simple()
							.textContent(file.$error)
							.position('bottom' )
							.hideDelay(3000)
							);
			  }
			}
        }
		
    };

	
	
}]);


