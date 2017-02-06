myapp.controller('HeaderCtrl',['$scope', '$location', '$cookies', '$rootScope' , '$mdSidenav','$facebook', function($scope,$location,$cookies,$rootScope,$mdSidenav,$facebook) {

	console.log("HeaderCtrl reporting for duty.");
 
	
	$rootScope.signed=$cookies.get('signed');
	$rootScope.User=$cookies.getObject('User');
	$rootScope.AsideTables=$cookies.getObject('Tables');
	$rootScope.Companies=$cookies.getObject('Companies');
	$rootScope.Status=$cookies.getObject('Status');
	$rootScope.UnreadMessages=$cookies.getObject('UnreadMessages');
	$rootScope.DefaultPage=$cookies.get('DefaultPage');
	

    
	$scope.checkqtty = function (module)
	{
		if ( module == 'Cerrados')
		{
			if ($rootScope.UnreadMessages.cant != '0' )
			{
				return ' CERRADOS (' + $rootScope.UnreadMessages.cant + ')';
			}
			else
			{
				return module;
			}
		}	
		else
			return module;
	}
	

 
   $rootScope.get_company_name = function ( id )
   {
	    var Companie=$cookies.getObject('Companies');
		if (Array.isArray(Companie))
		{
			
			for (var i=0; i< Companie.length ; i++ )
			{
				if (Companie[i]['id'] == id)
					return Companie[i]['display'];
			}
			
			return "";
			
		}	
		else
			return "";
	};

	$rootScope.get_status_name = function (id )
   {
	    var Status = $cookies.getObject('Status');
		
			
			
		if (Array.isArray(Status))
		{
			
			for (var i=0; i< Status.length ; i++ )
			{
				if (Status[i]['id'] == id)
					return Status[i]['description'];
			}
			
			return "";
			
		}	
		else
			return "";
			
	};
 
 
	
	$scope.process = function(val) {
      	  var pathresult='/'+val;
		  
		  $location.path(pathresult);
		  $scope.closeSideNavPanel();
   
	};
	

	

	
	$scope.signout = function() {
		console.log("signout reporting for duty.");
		$cookies.remove('signed');
		$cookies.remove('User');
		$cookies.remove('Tables');
		$cookies.remove('Companies');
		$cookies.remove('Status');
		$cookies.remove('UnreadMessages');
		$cookies.remove('DefaultPage');
		
		$rootScope.signed=$cookies.get('signed');
		$rootScope.User=$cookies.getObject('User');
		$rootScope.AsideTables=$cookies.getObject('Tables');
		$rootScope.Companies=$cookies.getObject('Companies');
		$rootScope.Status=$cookies.getObject('Status');
		$rootScope.UnreadMessages=$cookies.getObject('UnreadMessages');
		$rootScope.DefaultPage=$cookies.get('DefaultPage');
		
		$location.path('/home');
		if ($facebook.isConnected())
			$facebook.logout();
		
      };
	  
	    $scope.openSideNavPanel = function() {
        $mdSidenav('left').open();
    };
    $scope.closeSideNavPanel = function() {
        $mdSidenav('left').close();
    };
	
	$scope.view = [];

	$scope.toggle = function (index) 
	{
				$scope.view[index]  = !$scope.view[index];
	}
	

}]);

