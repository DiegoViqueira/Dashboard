myapp.controller('ManageClaimCtrl', ['$scope','$cookies','$http','$rootScope','$mdDialog','$mdToast', '$interval','$timeout', function($scope,$cookies,$http,$rootScope, $mdDialog,$mdToast,$interval,$timeout) {

	   console.log("ManageClaimCtrl reporting for duty.");
	   $scope.reclamos=[];
	   $scope.searchFish   = '';
	   $scope.qtty_reclamos =0;
	   
	   
	   $scope.control = function()
	   {
		    //console.log('Actualizando Cant de Reclamos');
		   	var request = $http({ method: "post",url: "lib/get_qtty_claim.php", data:{id_empresa: $rootScope.User.id_empresa }});
			/* Check whether the HTTP Request is successful or not. */
			request.success(function (data) 
			{ 
			
				var resp =eval(data);
				if (Array.isArray(resp))
				{
					if ( resp.length > 0 )
					{
						$scope.qtty_reclamos=resp.cant;
					}
				}
				else
				{
					if (resp.cant)
					{
						$scope.qtty_reclamos=resp.cant;
					}
					else
					{
						$scope.qtty_reclamos =0;
					}
				}
				
				//console.log('Cantidad de Reclamos:' + $scope.qtty_reclamos );
			});
		   
		   
	   }
	   
	   
	    
	   
	    var stopTime = $interval(function(){$scope.control();},5000);
		
		
		// listen on DOM destroy (removal) event, and cancel the next UI update
          // to prevent updating time after the DOM element was removed.
          $scope.$on('$destroy', function() {
			console.log('Destroy interval');
            $interval.cancel(stopTime);
          });
	    
		$scope.getOne = function()
		{
					$mdToast.show(
									  $mdToast.simple()
										.textContent('Obteniendo Reclamo!')
										.position('bottom' )
										.hideDelay(3000)
					);
					
					var request = $http({ method: "post",url: "lib/processor.php", data:{id_usuario:$rootScope.User.id , id_empresa: $rootScope.User.id_empresa }});
					/* Check whether the HTTP Request is successful or not. */
					request.success(function (data) 
					{ 
							
								var result=eval(data);
								
								if ( result.ERROR == "1" )
								{
									$scope.reclamos['count']=result.length;
									
									$scope.reclamos['data']=result.DATA;
									//$scope.reclamos['data'].push(result.DATA);
								}
								else if ( result.ERROR == "0" )
								{
									$mdToast.show(
									  $mdToast.simple()
										.textContent('No Hay Reclamos pendientes para Procesar.')
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
									console.log(JSON.stringify($scope.reclamos.data));
								}
							 
							 
							 
					});
		};
	   
				
			
				
		
	$scope.selected = [];
	$scope.detail=[];
  	 
	
  
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
						   '<md-dialog aria-label="List dialog" flex-gt-xs="80">' +
						   '  <md-dialog-content>'+
						   '<md-toolbar>' +
						   '<div class="md-toolbar-tools">' +
						   '<h2>Detalle del Reclamo </h2>' +
						   '<span flex></span>' +
						   '</div>' +
						   '</md-toolbar>' +
						   '    <md-list>'+
						   '      <md-list-item  class="md-3-line"  ng-repeat="reg in registros">'+
						   ' <div class="md-list-item-text" layout="column"> ' +
						   '       <h4>Fecha: {{reg.fecha}}</h4>' +
						   '       <p>Mensaje: {{reg.description}}</p>' +
						   '</div>' +
						   '      '+
						   '    </md-list-item>	  <md-divider ng-repeat-end ></md-divider></md-list>'+
						   '      '+
						   '<md-toolbar>' +
						   '<div class="md-toolbar-tools">' +
						   '<h2>Detalle de la Gestion Actual </h2>' +
						   '<span flex></span>' +
						   '</div>' +
						   '</md-toolbar>' +
						   '<md-content   layout-padding flex="auto" >' + 
						    '<form name="gestionClaimForm " ng-submit="procesar(detalle_a_enviar)" >' +
							'		<md-input-container class="md-block">' +
							'			<label>Respuesta</label>' +
							'			<textarea ng-model="detalle_a_enviar" required  name="referencia" md-maxlength="500" rows="5" md-select-on-focus></textarea>' +
							'			<div ng-messages="gestionClaimForm.referencia.$error" role="alert">' +
							'			  <div ng-message-exp="[\'required\']">' +
							'				Por Favor ingrese una Detalle.' +
							'			  </div>' +
							'			</div>' +
							'		</md-input-container>' +
							'	<div layout="row" layout-sm="column"  layout-align="space-around">' +
							'		  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>' +
							'	</div>' +
							'	<div layout-gt-sm="row" layout-align="center center">' +
							'	<md-button type="submit" ng-disabled="gestionClaimForm.$invalid" class="md-raised md-primary" >Procesar</md-button>' +
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
						   mensajes: $scope.mensajes ,
						   id_claim:item.id ,
						   id_client : item.id_cliente 
						 },
						 controller: 'DialogControllerMng'
						 
						   }).then(function(answer) 
						   {
								if (answer == 'OK'){ $scope.reclamos=[];}
								});
						   
						   
						   
					
						 
						 
				});
				
				

	};
	
	 
	
	
}]);

myapp.controller('DialogControllerMng',['$scope','$rootScope', '$mdDialog', 'mensajes' ,'$http','id_claim','id_client','$mdToast' ,function($scope,$rootScope, $mdDialog, mensajes ,$http,id_claim,id_client,$mdToast) {
        $scope.registros = mensajes;
		$scope.id_claim = id_claim;
		$scope.id_client = id_client;
		$scope.spinner=false;
		
        $scope.closeDialog = function() {
          $mdDialog.hide();
        }
		
		$scope.procesar = function(detalle) {
			$scope.spinner=true;
			
				
				var request = $http({ method: "post",url: "lib/processor_update.php", data:{id_usuario:$rootScope.User.id ,id_reclamo: $scope.id_claim , mensaje:detalle , id_cliente:id_client}});
			
				/* Check whether the HTTP Request is successful or not. */
				request.success(function (data) 
				{ 
									var ret=eval(data);
									
									
									if (ret['STATUS'] == 1 )
									{
										$mdToast.show(
										$mdToast.simple()
										.textContent("Reclamo Procesado OK")
										.position('bottom' )
										.hideDelay(3000)
										);
										$mdDialog.hide('OK');
									}
									else
									{
										$mdToast.show(
										$mdToast.simple()
										.textContent('No Se Pudo Procesar el Reclamo ERROR['+ ret.MESAJE +']')
										.position('bottom' )
										.hideDelay(3000)
										);
										
										
									}
				});
			    
				$scope.spinner=false;
		
        }
}]);