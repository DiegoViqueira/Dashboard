<div  layout="row" layout-padding >
<!-- MERGEN IZQUIERDO  -->
<div flex-gt-xs="10"></div>
<div ng-controller="NewUserCtrl" class="md-whiteframe-10dp" layout="column"  flex="auto" ng-cloak>

  <md-content layout-padding>
  
     <md-toolbar md-colors="{background: 'primary-500'}"    >
		<div class="md-toolbar-tools" flex layout-margin  layout-align="center center" >
		<h3 class="panel-widget-tittle">Formulario de Registro de Ususario</h3>
	
		</div>
	</md-toolbar>
    <form name="UserForm" ng-submit="submit()" >

    

      <div layout-gt-xs="row">
        <md-input-container flex-gt-xs="50">
				<label>Nombre</label>
				<input required type="nombre" name="nombre" ng-model="vm.nombre"/>

				<div ng-messages="UserForm.nombre.$error" role="alert">
				  <div ng-message-exp="['required']">
					Por Favor ingrese un Nombre
				  </div>
				</div>
        </md-input-container>

        <md-input-container flex-gt-xs="50">
				<label>Apellido</label>
				<input required type="apellido" name="apellido" ng-model="vm.apellido"/>

				<div ng-messages="UserForm.apellido.$error" role="alert">
				  <div ng-message-exp="['required']">
					Por Favor ingrese un Apellido
				  </div>
				</div>
        </md-input-container>
      </div>

	  <div layout-gt-xs="row">
        <md-input-container flex-gt-xs="50">
				<label>Email</label>
				<input required type="email" name="email" ng-model="vm.email"
					   minlength="10" maxlength="100" ng-pattern="/^.+@.+\..+$/" />

				<div ng-messages="UserForm.email.$error" role="alert">
				  <div ng-message-exp="['required', 'minlength', 'maxlength', 'pattern']">
					Por Favor ingrese un formato de Email Valido
				  </div>
				</div>
        </md-input-container>

        <md-input-container flex-gt-xs="50">
				<label>Fecha de Nacimiento</label>
				<input required type="bday" name="bday" ng-model="vm.bday"
					   ng-pattern="/^[0-9]{2}/[0-9]{2}/[0-9]{4}$/" placeholder="dd/mm/yyyy" />
				
				
				<div ng-messages="UserForm.bday.$error" role="alert">
				  <div ng-message-exp="['required', 'pattern']">
					Por Favor ingrese de Fecha de Nacimiento Valida
				  </div>
				</div>
        </md-input-container>
      </div>
	  
	  <div layout-gt-xs="row">
        <md-input-container flex-gt-xs="50">
				<label>Telefono</label>
				<input required type="telefono" name="telefono" ng-model="vm.telefono"
					   ng-pattern="/^[0-9]{2}-[0-9]{4}-[0-9]{4}$/" placeholder="15-1111-0000" />
				
				
				<div ng-messages="UserForm.telefono.$error" role="alert">
				  <div ng-message-exp="['required', 'pattern']">
					Por Favor ingrese numero de Telefono Valido
				  </div>
				</div>
        </md-input-container>

        <md-input-container flex-gt-xs="50">
				<label>Sexo</label>
				<md-select ng-model="vm.sexo" name="sexo" required >
					<md-option ng-repeat="sexo in sexos" ng-value="sexo.id">
						{{sexo.nombre}}
					</md-option>
				</md-select>
				<div ng-messages="UserForm.sexo.$error" role="alert">
				  <div ng-message-exp="['required']">
					Por Favor ingrese Sexo Valido
				  </div>
				</div>
        </md-input-container>
      </div>
	    <div layout-gt-xs="row">
        <md-input-container flex-gt-xs="50">
				<label>Password</label>
				<input required type="password" name="password" ng-model="vm.password" minlength="6"  />
				<div ng-messages="UserForm.password.$error" role="alert">
				  <div ng-message-exp="['required', 'minlength', 'maxlength', 'pattern']">
						Tu password no debe ser menor a 6 Digitos
				  </div>
				</div>
        </md-input-container>

        <md-input-container flex-gt-xs="50">
				<label>Repetir Password</label>
				<input required type="password" name="password2" ng-model="vm.password2" minlength="6"  ng-pattern="vm.password" />
				<div ng-messages="UserForm.password2.$error " role="alert" multiple md-auto-hide="true">
				  <div ng-message-exp="['required', 'minlength']">
						Tu password no debe ser menor a 6 Digitos
				  </div>
				
					<div  ng-message="pattern" role="alert">
				  
						Los Passwords no coinciden
					</div>
				</div>
        </md-input-container>
      </div>
	
	  <div layout="row" layout-align="center center" >
			<md-input-container class="md-block" >
				   <span class="text-center md-body-1" ><a href="doc/Terminos y Condiciones.pdf" target="_blank">Terminos y Condiciones de Rec!amo On-Line</a></span>
				   <BR>
				   <BR>
				   <md-checkbox ng-model="vm.aceptaterminos" aria-label="Checkbox 1">
						Acepta Terminos y Condiciones ?
				   </md-checkbox>
			</md-input-container>
	  </div>
	  
		<div layout="row"   layout-align="space-around">
			  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>
		</div>
  
		<div layout-gt-sm="row" class="text-center" layout-align="center center">
        <md-button type="submit" ng-disabled="UserForm.$invalid || !vm.aceptaterminos " class="md-raised md-primary" >Registrarse</md-button>
		<md-button md-no-ink href="#/login" class="md-warn" >Login</md-button>
		</div>
      
    </form>
  </md-content>

</div>
<div flex-gt-xs="10"></div>
</div>