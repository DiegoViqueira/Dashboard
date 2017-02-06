myapp.controller('newClaimController', ['$scope','$location','$http','$cookies','$rootScope','$mdSidenav','$timeout','$q','$mdToast', function($scope,$location,$http,$cookies,$rootScope,$mdSidenav,$timeout, $q ,$mdToast) {

	console.log("newClaimController reporting for duty.");
	
	var self = this;

    // list of `state` value/display objects

	
    self.selectedItem  = null;
    self.searchText    = null;
    self.querySearch   = querySearch;
	self.simulateQuery = false;
	self.categories=[];
	
	$scope.LoadCategories =function()
	{
		
		var request = $http({ method: "post",url: "lib/get_categories.php", data:{id_empresa: $scope.ctrl.selectedItem.id } });
		request.success(function (data) 
				{
					var response=eval(data);
					
					if ( Array.isArray(response))
						 {	
								$scope.categories=response;
						 }
						 else
						 {
							$scope.categories=[];
							$scope.categories.push(response);
						   
						 }
					
					
					
					
				})
				
				 
	}

	$scope.altaReclamo=function()
	{
	
		 
				var request = $http({ method: "post",url: "lib/new_reclamo.php", data:{empresa: $scope.ctrl.selectedItem.id ,identificador: $scope.ctrl.identificador, detalle: $scope.ctrl.detalle , cliente: $rootScope.User.id , categoria:$scope.ctrl.categoria } });
				
				
				request.success(function (data) 
				{
					var response=eval(data);
					
						if (response['error'] == 0 )
						{
							
							$location.path('/pend_claim');
						}
						else
						{
							
						}
						
						$mdToast.show(
									  $mdToast.simple()
										.textContent(response['mensaje'])
										.position('bottom' )
										.hideDelay(3000)
									);
					 
				     
				});
	}
	
	function querySearch (query) {
        var results = query ? $rootScope.Companies.filter( createFilterFor(query) ) : $rootScope.Companies,
          deferred;
		  if (self.simulateQuery) {
			deferred = $q.defer();
			$timeout(function () { deferred.resolve( results ); }, Math.random() * 1000, false);
			return deferred.promise;
		  } else {
			return results;
		  }
    };
	
			function typeOf (obj) 
			{
					return {}.toString.call(obj).split(' ')[1].slice(0, -1).toLowerCase();
			}
	
	
	 function createFilterFor(query) {
      var lowercaseQuery = angular.lowercase(query);

      return function filterFn(state) {
        return (state.value.indexOf(lowercaseQuery) === 0);
      };

    }

	
}]);



