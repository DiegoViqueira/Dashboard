myapp.controller('oldClaimCtrl', ['$scope','$location','$cookies','$http','$rootScope','$mdSidenav', '$mdDialog','$mdToast', function($scope,$location,$cookies,$http,$rootScope,$mdSidenav, $mdDialog,$mdToast) {

	   console.log("oldClaimCtrl reporting for duty.");
	   $scope.reclamos=[];
   	   $scope.searchFish   = '';

	   
				var request = $http({ method: "post",url: "lib/get_reclamos_old.php", data:{id_cliente:$rootScope.User.id}});
			
				
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
  	 
  $scope.filter = {
    options: {
      debounce: 500
    }
  };	
  
  
  $scope.limitOptions=5;  
  $scope.query = {
    order: 'id',
    limit: 10,
    page: 1
  };

    $scope.printisread = function(val)
	{
		if ( val == 1)
		{
			return '<i class="fa fa-check" aria-hidden="true"></i>';
		}
		else
		{
			return '<i class="fa fa-times fa-unread"  aria-hidden="true"></i>';
		}
	}
    $scope.logItem = function (item) 
	{
			
		    
    };
  
	$scope.showAlert = function ($event,item) 
	{
				var request = $http({ method: "post",url: "lib/get_item_detail_old.php", data:{id:item.id}});
				
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
						 
						 if ($scope.mensajes.length > 0)
						 {
							 if (item.isread == 0)
								item.isread=1;
						 }
						 
						 if ( $rootScope.UnreadMessages.cant > 0)
						 {
							 $rootScope.UnreadMessages.cant = $rootScope.UnreadMessages.cant -1;
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
						   '      <md-list-item class="md-3-line" ng-repeat="reg in registros">'+
						   ' <div class="md-list-item-text" layout="column"> ' +
						   '       <h4> Fecha: {{reg.fecha}}</h4>' +
						   '       <p> Mensaje: {{reg.description}}</p>' +
						   '</div>' +
						   '      '+
						   '    </md-list-item>	  <md-divider ng-repeat-end ></md-divider></md-list>'+
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
						 controller: 'DialogControllerOld'
						   });
					
						 
						 
				});
				
				

	};
	

}]);


myapp.controller( 'DialogControllerOld',['$scope','$mdDialog','mensajes', function($scope, $mdDialog, mensajes ) {
        $scope.registros = mensajes;
		
        $scope.closeDialog = function() {
          $mdDialog.hide();
        }
}]);