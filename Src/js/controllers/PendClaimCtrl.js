myapp.controller('PendClaimCtrl', ['$scope','$location','$cookies','$http','$rootScope','$mdSidenav','$timeout','$q','$mdDialog','$mdToast',function($scope,$location,$cookies,$http,$rootScope,$mdSidenav, $timeout, $q , $mdDialog,$mdToast) {

	   console.log("PendClaimCtrl reporting for duty.");
	   $scope.reclamos=[];
	   $scope.searchFish   = '';
	   
				var request = $http({ method: "post",url: "lib/get_reclamos_pendientes.php", data:{id_cliente:$rootScope.User.id}});
			
				/* Check whether the HTTP Request is successful or not. */
				request.success(function (data) 
				{ 
						
						 var result=eval(data);
						 if ( Array.isArray(result))
						 {	
							
							$scope.reclamos['count']=result.length;
							$scope.reclamos['data']=result;
						 }
						 else
						 {
							 $scope.reclamos['data']=[];
							 $scope.reclamos['count']= 1;
							 $scope.reclamos['data'].push(result);
						   
						 }
						 
				});
		
		 $scope.selected = [];
		 $scope.detail=[];
  	// FILTRO 

	
	$scope.filter = 
	{
		options: {
      debounce: 500
    }
   };	
  

  //END FILTER
  
  $scope.limitOptions=5;  
  $scope.query = {
    order: 'id',
    limit: 10,
    page: 1
  };

    $scope.logItem = function (item) 
	{
			
		    
    };
  
	$scope.showAlert = function ($event,item) 
	{
				var request = $http({ method: "post",url: "lib/get_item_detail.php", data:{id:item.id}});
				
				/* Check whether the HTTP Request is successful or not. */
				request.success(function (data) 
				{ 
						
						 var result=eval(data);
						
						 if ( Array.isArray(result))
						 {
							  $scope.mensajes=result;
						 }
						 else
						 {
							  $scope.mensajes=[];
							  $scope.mensajes.push(result);
						 }
						 
						 
						 var parentEl = angular.element(document.body);
						   $mdDialog.show({
								  parent: parentEl,
						 targetEvent: $event,
						 template:
						   '<md-dialog aria-label="List dialog" flex-gt-xs="80" >' +
						   '<md-toolbar>' +
						   '<div class="md-toolbar-tools">' +
						   '<h2>Detalle del Reclamo </h2>' +
						   '<span flex></span>' +
						   '</div>' +
						   '</md-toolbar>' +
						   '  <md-dialog-content>'+
						   '    <md-list>'+
						   '      <md-list-item  class="md-3-line" ng-repeat="reg in registros">'+
						   ' <div class="md-list-item-text" layout="column"> ' +
						   '       <h4>Fecha: {{reg.fecha}}</h4>' +
						   '       <p>Mensaje: {{reg.description}}</p>' +
						   '</div>' +
						   '      '+
						   '    </md-list-item><md-divider ng-repeat-end ></md-divider></md-list>'+
						   '  </md-dialog-content>' +
						   '  <md-dialog-actions>' +
						   '    <md-button ng-click="closeDialog()" class="md-primary">' +
						   '      Cerrar Ventana' +
						   '    </md-button>' +
						   '  </md-dialog-actions>' +
						   '</md-dialog>',
						 locals: {
						   mensajes: $scope.mensajes
						 },
						 controller: 'DialogControllerPend'
						   });
					
						 
						 
				});
				
				

	};
	
	 
	
}]);

myapp.controller ( 'DialogControllerPend',['$scope','$mdDialog','mensajes',function ($scope, $mdDialog, mensajes ) {
        $scope.registros = mensajes;
		
        $scope.closeDialog = function() {
          $mdDialog.hide();
        }
}]);