myapp.controller('SearchClaimCtrl', ['$scope','$location','$cookies','$http','$rootScope','$mdSidenav', '$mdDialog','$mdToast', function($scope,$location,$cookies,$http,$rootScope,$mdSidenav, $mdDialog,$mdToast) {

	   console.log("SearchClaimCtrl reporting for duty.");
	   $scope.reclamos=[];
	   $scope.spinner=false;
	   $scope.Buscar = function(){
		   
				$scope.spinner=true;
				var request = $http({ method: "post",url: "lib/get_reclamos_search.php", data:{id:$scope.nroreclamo, id_empresa: $rootScope.User.id_empresa }});
			
				/* Check whether the HTTP Request is successful or not. */
				request.success(function (data) 
				{ 
					   $scope.spinner=true;

						 var result=eval(data);
						 if ( Array.isArray(result))
						 {	
							
							$scope.reclamos['count']=result.length;
							$scope.reclamos['data']=result;
							if (result.length == 0)
							{
								
										$mdToast.show(
										$mdToast.simple()
										.textContent('No se encontraron registros para la Busqueda!!')
										.position('bottom' )
										.hideDelay(3000)
										);
							
							}
							$scope.spinner=false;
						 }
						 else
						 {
							 $scope.reclamos['data']=[];
							 $scope.reclamos['count']= 1;
							 $scope.reclamos['data'].push(result);
							 
							 
							 $scope.spinner=false;
						   
						 }
						 
						 $scope.spinner=false;
						 
						 
				});
				
				
	   }
	 
	 $scope.selected = [];
	 $scope.detail=[];
  	 
	  $scope.filter = {
		options: {
		  debounce: 500
		}
	  };	
  
	$scope.filter.show = false;
  
    $scope.removeFilter = function () {
    $scope.filter.show = false;
    $scope.query.filter = '';
    
    if($scope.filter.form.$dirty) {
      $scope.filter.form.$setPristine();
    }
  };
  
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
						 controller: 'DialogControllerSrch'
						   });
					
						 
						 
				});
				
				

	};
	
	
	
}]);

myapp.controller( 'DialogControllerSrch',['$scope', '$mdDialog', 'mensajes' ,function($scope, $mdDialog, mensajes ) {
        $scope.registros = mensajes;
		
        $scope.closeDialog = function() {
          $mdDialog.hide();
        }
}]);
