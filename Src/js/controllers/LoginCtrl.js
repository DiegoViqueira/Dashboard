myapp.controller('LoginCtrl', ['$scope','$location','$cookies','$http','$window','$mdToast','$rootScope','$facebook', function( $scope,$location,$cookies,$http,$window, $mdToast,$rootScope, $facebook) {

		console.log("LoginCtrl reporting for duty.");
		
		//FACEBOOK
			  
			  $scope.$on('fb.auth.authResponseChange', function() {
			  $scope.status = $facebook.isConnected();
			  if($scope.status) {
				$facebook.api('/me',  {
						fields: 'email,first_name,last_name,birthday,gender'
					}).then(function(user) {
					
				   var request = $http({ method: "post",url: "lib/login_fb.php",data:eval(user)});	
				
						$scope.spinner = true;
				
				function typeOf (obj) 
				{
					return {}.toString.call(obj).split(' ')[1].slice(0, -1).toLowerCase();
				}
				
				request.success(function (data) 
				{
					var response=eval(data);
					
					if ( typeOf(response) == 'string')
					{	
						
						$scope.spinner = false;
						
						$mdToast.show(
						  $mdToast.simple()
							.textContent('! '+ response)
							.position('bottom' )
							.hideDelay(3000)
						);
						
					}
					else
					{ 	
						$mdToast.show(
						  $mdToast.simple()
							.textContent('Bienvenido a Rec!amos On-Line !!!')
							.position('bottom' )
							.hideDelay(3000)
						);
						
						
						response['User'].notify= Boolean(response['User'].notify);
						$cookies.put('signed', true);
						$cookies.putObject('User', response['User']);
						$cookies.putObject('Tables', decode_tables(response['Tables']));
						$cookies.putObject('UnreadMessages', response['unreadmessages']);
						$cookies.put('DefaultPage',response['DefaultPage']['file']);
					
						$rootScope.signed=$cookies.get('signed');
						$rootScope.User=$cookies.getObject('User');
						$rootScope.AsideTables=$cookies.getObject('Tables');
						$rootScope.UnreadMessages=$cookies.getObject('UnreadMessages');
						$rootScope.DefaultPage=$cookies.get('DefaultPage');
						
						
						
						$location.path('/' + $rootScope.DefaultPage );
						
						var request2 = $http({ method: "post",url: "lib/get_companys.php"});
				
						
						request2.success(function (data) 
						{
							
							var res=eval(data);
							if ( Array.isArray(res))
							 {	
								$rootScope.Companies=res;
							 }
							 else
							 {
								$rootScope.Companies=[];
								$rootScope.Companies.push(res);
							   
							 }

							 
							$cookies.putObject('Companies', $rootScope.Companies);
							 
							 
						});
						
						var request3 = $http({ method: "post",url: "lib/get_status.php"});
				
						
						request3.success(function (data) 
						{
							$rootScope.Status=eval(data);
							$cookies.putObject('Status', $rootScope.Status);
							 
							 
						});
						
						
						
					
						$scope.spinner = false;
					}
					
				});
				
				  
				  
				  
				});
				
				
			  }
			});

			$scope.login_fb = function() {
			
			  if($scope.status) {
				$facebook.logout();
			  } else {
				$facebook.login();
			  }
			};
		//FACEBOOK
 	
	 
		if ($cookies.get('signed'))
		{ 
						$mdToast.show(
						  $mdToast.simple()
							.textContent('Ya estas conectado al sistema !!')
							.position('bottom' )
							.hideDelay(3000)
						);
			$location.path('/home');
	   } 
		
		$scope.spinner = false;
        
		$scope.login = function() 
		{
			
				var session_id= getPHPSessId();
				
				$scope.vm.password=CryptoJS.AES.encrypt(JSON.stringify($scope.vm.password), session_id.toString(), {format: CryptoJSAesJson}).toString();
	
				var request = $http({ method: "post",url: "lib/login.php",data:eval($scope.vm)});
				
				$scope.spinner = true;
				
				function typeOf (obj) 
				{
					return {}.toString.call(obj).split(' ')[1].slice(0, -1).toLowerCase();
				}
				
				request.success(function (data) 
				{
					var response=eval(data);
					
					if ( typeOf(response) == 'string')
					{	
						
						$scope.spinner = false;
						
						$mdToast.show(
						  $mdToast.simple()
							.textContent('! '+ response)
							.position('bottom' )
							.hideDelay(3000)
						);
						$scope.vm.password='';
					}
					else
					{ 	
						$mdToast.show(
						  $mdToast.simple()
							.textContent('Bienvenido a Rec!amos On-Line !!!')
							.position('bottom' )
							.hideDelay(3000)
						);
						
						response['User'].notify= Boolean(response['User'].notify);
						$cookies.put('signed', true);
						$cookies.putObject('User', response['User']);
						$cookies.putObject('Tables', decode_tables(response['Tables']));
						$cookies.putObject('UnreadMessages', response['unreadmessages']);
						$cookies.put('DefaultPage',response['DefaultPage']['file']);
					
						$rootScope.signed=$cookies.get('signed');
						$rootScope.User=$cookies.getObject('User');
						$rootScope.AsideTables=$cookies.getObject('Tables');
						$rootScope.UnreadMessages=$cookies.getObject('UnreadMessages');
						$rootScope.DefaultPage=$cookies.get('DefaultPage');
						
						
						$location.path('/' + $rootScope.DefaultPage );
						
						var request2 = $http({ method: "post",url: "lib/get_companys.php"});
				
						
						request2.success(function (data) 
						{
							
							var res=eval(data);
							if ( Array.isArray(res))
							 {	
								$rootScope.Companies=res;
							 }
							 else
							 {
								$rootScope.Companies=[];
								$rootScope.Companies.push(res);
							   
							 }

							 
							$cookies.putObject('Companies', $rootScope.Companies);
							 
							 
						});
						
						var request3 = $http({ method: "post",url: "lib/get_status.php"});
				
						
						request3.success(function (data) 
						{
							$rootScope.Status=eval(data);
							$cookies.putObject('Status', $rootScope.Status);
							 
							 
						});
						
						
						
					
						$scope.spinner = false;
					}
					
				});
       
	   
				
	   };

		

}]);

