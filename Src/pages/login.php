<div layout="row" layout-wrap layout-padding  layout-align="center center" ng-cloak>

 <md-content layout="column" layout-align="center center" >
		<md-card layout-padding  class="md-whiteframe-10dp"  flex="auto" layout-align="center center" >
			
				<div class="md-toolbar-tools" flex="auto" layout-margin  md-colors="{background: 'primary-500'}"  layout-align="center center" >
				  <h3 class="panel-widget-tittle">Ingreso al Sistema</h3>
				
				</div>
       	    
			<md-card-content  layout="column" layout-padding flex="auto" >
				<div ng-controller="LoginCtrl as vm" layout="column" >

				 
					<form name="LoginForm" ng-submit="login()" layout="column" >

					  
					  <md-input-container class="md-block">
						<label>Email</label>
						<input required type="email" name="email" ng-model="vm.email"
							   minlength="10" maxlength="100" ng-pattern="/^.+@.+\..+$/" />

						<div ng-messages="LoginForm.email.$error" role="alert">
						  <div ng-message-exp="['required', 'minlength', 'maxlength', 'pattern']">
							Por Favor ingrese un formato de Email Valido
						  </div>
						</div>
					  </md-input-container>

					  <md-input-container class="md-block">
						<label>Password</label>
						<input required type="password" name="password" ng-model="vm.password"
							   minlength="6" maxlength="100"  />

						<div ng-messages="LoginForm.password.$error" role="alert" md-auto-hide="false" >
						  <div ng-message-exp="['required', 'minlength']" >
							Tu password no puede ser menor a 6 Digitos
						  </div>
						</div>
					  </md-input-container>
					  
						  
						
						<div class="text-center"  >
							<div layout="row"  layout-align="space-around">
							  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>
							</div>
						</div>
						<div class="text-center"   flex >
						<md-button type="submit" ng-disabled="LoginForm.$invalid" class="md-raised md-primary" >Login</md-button>
						<md-button md-no-ink href="#/new_user" class="md-warn" >Registrate</md-button>
						<md-button md-no-ink href="#/recover_password" class="md-warn" >Recuperar Password</md-button>
						</div>
						<BR>
						<md-divider ></md-divider>
						<BR>
					    <div class="text-center"   flex >
						<md-button class="md-raised" ng-click="login_fb()" ><i style="color:#3b5998;"  class="fa fa-facebook" aria-hidden="true"></i> Inicia Sesion Usando Facebook</md-button>
						
						</div>
					      

					</form>
					

				</div>
					
			</md-card-content>
		</md-md-card>
</md-content>	

</div>
<BR>
<BR>