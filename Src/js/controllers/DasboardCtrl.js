myapp.controller('DasboardCtrl',['$scope','$location','$cookies','$http','$rootScope','$mdSidenav','$timeout','$mdDialog', function($scope,$location,$cookies, $http,$rootScope,$mdSidenav,$timeout,$mdDialog) {

	console.log("DasboardCtrl reporting for duty.");
	
	
	

      $scope.hidden = false;
      $scope.isOpen = false;
      $scope.hover = false;

      // On opening, add a delayed property which shows tooltips after the speed dial has opened
      // so that they have the proper position; if closing, immediately hide the tooltips
      $scope.$watch('isOpen', function(isOpen) {
		 
        if (isOpen) {
          $timeout(function() {
            $scope.tooltipVisible = $scope.isOpen;
          }, 600);
        } else {
          $scope.tooltipVisible = $scope.isOpen;
        }
      });

      $scope.items = [
        { name: "Nuevo Reclamo", icon:"note_add", direction: "bottom" },
		{ name: "Menu", icon:"list", direction: "bottom" }
        
      ];

      $scope.openDialog = function($event, item) {
		  
		  if (item.name == "Nuevo Reclamo")
		  {$location.path('/new_claim');}
		  else if (item.name == "Menu")
		  {$mdSidenav('left').open();}
       }
    
	
							$scope.goto_ref = function(where)
							{
								if (where == 'PENDIENTE')
								{$location.path('/pend_claim');}
								else if (where == 'CERRADO')
								{$location.path('/old_claim');}
								else 
								{$location.path('/new_claim');}
								
							}

	
	
							var request4 = $http({ method: "post",url: "lib/get_estadisticas.php",data:$rootScope.User });
							
							/* Check whether the HTTP Request is successful or not. */
							request4.success(function (data) 
							{ 
									
									
									 var result=eval(data);
									 
									
									$scope.meses=result.MONTH;
									
									if(!Array.isArray(result.TOTAL))
									{
										$scope.totales=[];
										$scope.totales.push(result.TOTAL);
									}
									else
									{
										$scope.totales=result.TOTAL; 
									}
									
									var dateObj = new Date();
									var month = dateObj.getUTCMonth() ; //months from 1-12
									
									$scope.gauge_options = {thickness: 5, mode: "gauge", total: $scope.meses[Number(month)].cant + ( $scope.meses[Number(month)].cant * 0.01) };
									$scope.gauge_data = [
										{label: "Cant", value: $scope.meses[Number(month)].cant, suffix: "", color: "steelblue"}
									];
									 
										
									 $scope.myChartObject = {};
									
									$scope.myChartObject.type = "ColumnChart";
									
									
									$scope.myChartObject.data = {"cols": [
										{id: "t", label: "Topping", type: "string"},
										{id: "s", label: "cant", type: "number"}
									], "rows": 
									[
										{c: [
											{v: "E"},
											{v: $scope.meses[0].cant},
										]},
										{c: [
											{v: "F"},
											{v: $scope.meses[1].cant}
										]},
										{c: [
											{v: "M"},
											{v: $scope.meses[2].cant},
										]},
										{c: [
											{v: "A"},
											{v: $scope.meses[3].cant},
										]},
										{c: [
											{v: "M"},
											{v: $scope.meses[4].cant},
										]},
										{c: [
											{v: "J"},
											{v: $scope.meses[5].cant},
										]},
										{c: [
											{v: "J"},
											{v: $scope.meses[6].cant},
										]},
										{c: [
											{v: "A"},
											{v: $scope.meses[7].cant},
										]},
										{c: [
											{v: "S"},
											{v: $scope.meses[8].cant},
										]},
										{c: [
											{v: "O"},
											{v: $scope.meses[9].cant},
										]},
										{c: [
											{v: "N"},
											{v: $scope.meses[10].cant},
										]},
										{c: [
											{v: "D"},
											{v: $scope.meses[11].cant},
										]},
									]};

									
									
							
								

								
							});
	
	
}]);


