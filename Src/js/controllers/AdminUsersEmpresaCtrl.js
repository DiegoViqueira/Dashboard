myapp.controller('AdminUsersEmpresaCtrl',  ['$scope','$cookies','$http','$rootScope','$mdDialog','$mdToast', function($scope,$cookies,$http,$rootScope, $mdDialog,$mdToast) {

	   console.log("AdminUsersEmpresaCtrl reporting for duty.");
	   $scope.Usuarios=[];
	   $scope.searchFish   = '';

					var request = $http({ method: "post",url: "lib/get_users_empresa.php", data:{id_empresa:$rootScope.User.id }});
					/* Check whether the HTTP Request is successful or not. */
					request.success(function (data) 
					{ 
							
								var result = eval(data);
							    
								if ( result.ERROR == "1" )
								{
									
									
										 if ( Array.isArray(result.DATA))
										 {
											  $scope.Usuarios['count']=result.DATA.length;
											  $scope.Usuarios['data']= result.DATA;
										 }
										 else
										 {
											  $scope.Usuarios['count']=1;
											  $scope.Usuarios['data']=[];
											  $scope.Usuarios['data'].push(result.DATA);
											  
										 }
									
										 
									
								}
								else if ( result.ERROR == "0" )
								{
									$mdToast.show(
									  $mdToast.simple()
										.textContent('No existen usuarios.')
										.position('bottom' )
										.hideDelay(3000)
									);
									
								}
								else
								{
									$mdToast.show(
									  $mdToast.simple()
										.textContent("ERROR DESONOCIDO!")
										.position('bottom' )
										.hideDelay(3000)
									);
									
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

    $scope.logItem = function (item) 
	{
			
		    
    };
  
	$scope.inactive = function ($event,item) 
	{
				
						
						 
						 var parentEl = angular.element(document.body);
						 $mdDialog.show({
						 parent: parentEl,
						 targetEvent: $event,
						 template:
						   '<md-dialog aria-label="List dialog" flex-gt-xs="80">' +
						   '  <md-dialog-content>'+
						   '<md-toolbar>' +
						   '<div class="md-toolbar-tools">' +
						   '<h2> Cambiar Estado de Usuario </h2>' +
						   '<span flex></span>' +
						   '</div>' +
						   '</md-toolbar>' +
						   '<md-content   layout-padding flex="auto" >' + 
						    '<form name="gestionInactiveForm " ng-submit="procesar(Status_nuevo)" >' +
							'		<md-input-container class="md-block">' +
							'			<label>Respuesta</label>' +
							'<md-select required ng-model="Status_nuevo" placeholder="Seleccionar Estado">' +
							'<md-option ng-value="1">Inactivo</md-option>' +
							'<md-option ng-value="0">Activo</md-option>' +
							'</md-select>' +
							'<div ng-messages="gestionInactiveForm.Status_nuevo.$error" role="alert">' +
							'  <div ng-message-exp="[\'required\']">' +
							'	Por Favor ingrese un estado valido.' +
							'  </div>' +
							'</div>' +
							'		</md-input-container>' +
							'	<div layout="row" layout-sm="column"  layout-align="space-around">' +
							'		  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>' +
							'	</div>' +
							'	<div layout-gt-sm="row" layout-align="center center">' +
							'	<md-button type="submit" ng-disabled="gestionInactiveForm.$invalid" class="md-raised md-primary" >Procesar</md-button>' +
							'	</div>' +
							'</form>' +
							'</md-content>' +
						   '  </md-dialog-content>' +
						   '  <md-dialog-actions>' +
						   '    <md-button ng-click="closeDialog()" class="md-primary">' +
						   '      Cerrar Ventana' +
						   '    </md-button>' +
						   '  </md-dialog-actions>' +
						   '</md-dialog>' ,
						 locals: {
						   
						   id_cliente:item.id
						 },
						 controller: 'DialogControllerAdmUsr'
						 
						   }).then(function(answer,status_nuevo) 
						   {
							    if (answer == "OK")
									item.state= status_nuevo;
						   });
						   
						   
						   
					
						 
						 
				
				
				

	};
	
	 
	
	
}]);

myapp.controller( 'DialogControllerAdmUsr',[ '$scope','$rootScope', '$mdDialog', 'id_cliente' ,'$http','$mdToast',function ($scope,$rootScope, $mdDialog, id_cliente ,$http,$mdToast) {
        
		$scope.id_cliente = id_cliente;
		$scope.spinner=false;
		
        $scope.closeDialog = function() {
          $mdDialog.hide();
        }
		
		$scope.procesar = function(status_nuevo) {
			$scope.spinner=true;
			
				
				var request = $http({ method: "post",url: "lib/inactive_user.php", data:{id_usuario: $scope.id_cliente ,id_estado: status_nuevo }});
			
				/* Check whether the HTTP Request is successful or not. */
				request.success(function (data) 
				{ 
									
									var ret=eval(data);
									
									
									if (ret.STATUS == 1 )
									{
										$mdToast.show(
										$mdToast.simple()
										.textContent(ret.MENSAJE)
										.position('bottom' )
										.hideDelay(3000)
										);
										$mdDialog.hide("OK",status_nuevo);
									}
									else
									{
										$mdToast.show(
										$mdToast.simple()
										.textContent(ret.MENSAJE)
										.position('bottom' )
										.hideDelay(3000)
										);
										
										
									}
				});
			    
				$scope.spinner=false;
		
        }
}]);
