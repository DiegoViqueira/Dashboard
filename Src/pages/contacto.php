<div layout="row" layout-padding  layout-align="center center" ng-cloak>

 <md-content layout="column" layout-align="center center" >
		<md-card layout-padding  class="md-whiteframe-10dp"  flex="auto" layout-align="center center" >
			
				<div class="md-toolbar-tools" flex="auto" layout-margin  md-colors="{background: 'primary-500'}"  layout-align="center center" >
				  <h3 class="panel-widget-tittle">Contacto Empresas</h3>
				
				</div>
       	    
			<md-card-content  layout="column" layout-padding flex="auto" >
				<div ng-controller="ContactoCtrl as vm" layout="column" >

				 
					<form name="ContactForm" ng-submit="sendMail()" layout="column" >

					
					    <md-input-container class="md-block" >
							<label>Empresa</label>
							<input required type="empresa" name="empresa" ng-model="vm.empresa"/>

							<div ng-messages="ContactForm.empresa.$error" role="alert">
							  <div ng-message-exp="['required']">
								Por Favor ingrese una Empresa
							  </div>
							</div>
						</md-input-container>
					  
					  <md-input-container class="md-block">
						<label>Email</label>
						<input required type="email" name="email" ng-model="vm.email"
							   minlength="10" maxlength="100" ng-pattern="/^.+@.+\..+$/" />

						<div ng-messages="ContactForm.email.$error" role="alert">
						  <div ng-message-exp="['required', 'minlength', 'maxlength', 'pattern']">
							Por Favor ingrese un formato de Email Valido
						  </div>
						</div>
					  </md-input-container>
					  
					  
					  
					<md-input-container class="md-block">
						<label>Mensaje</label>
						<textarea ng-model="vm.mensaje" required  name="mensaje" md-maxlength="500" rows="5" md-select-on-focus></textarea>
						<div ng-messages="ContactForm.mensaje.$error" role="alert">
						  <div ng-message-exp="['required']">
							Por Favor ingrese un Mensaje Valido.
						  </div>
						</div>
					</md-input-container>
	  
						
						<div class="text-center"  >
							<div layout="row"  layout-align="space-around">
							  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>
							</div>
						</div>
						<div class="text-center"   flex >
						<md-button type="submit" ng-disabled="ContactForm.$invalid" class="md-raised md-primary" >Enviar</md-button>
						
						</div>
						  

					</form>
					

				</div>
					
			</md-card-content>
		</md-md-card>
</md-content>	

</div>
<BR>
<BR>