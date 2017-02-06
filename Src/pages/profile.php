<div  layout-align="center stretch" >
<div  layout="row" >
  <div flex-gt-xs="10"></div>
  <div flex="auto"> 
	<md-content  ng-controller="ProfileController" layout-padding layout-margin  layout-align="center center" >
     <section layout-padding  class="md-whiteframe-4dp"  >
		 
		 
			  <md-toolbar md-colors="{background: 'primary-500'}" class="md-whiteframe-4dp" >
				<div class="md-toolbar-tools"  layout-margin >
				  <h3 class="panel-widget-tittle">Perfil del Usuario</h3>
				  <span ></span>
				 
				</div>
			  </md-toolbar>
			  
			  <!--  IMAGEN -->
				<md-card md-colors="{background: 'primary-500'}" flex-gt-xs="30" >
					<md-card-header  md-component-id="md-card-header-page" >
						
						<md-card-title>
						  <md-card-title-media flex="auto" >
								<img  class="md-media-sm md-user-avatar rounded" src="{{User.picture}}"/>
						  </md-card-title-media>
						  
						</md-card-title>
						<md-card-header-text layout-align="center center" flex="auto" >
						  <md-button ng-click="showOptions = !showOptions" class="md-fab  md-primary md-hue-1" aria-label="Show options">
								<i class="material-icons">attach_file</i>
						 </md-button>
						 
				
						 
					  </md-card-header-text>
					</md-card-header>
				 </md-card>
				 
				 

				 <md-card  ng-show="showOptions" class="card-0dp"  layout-align="center center" flex-gt-xs="30" >
					
				     
							<div ngf-drop ngf-select flex="auto"  ngf-max-size="1MB" ng-model="file" class="drop-box" 
						ngf-drag-over-class="'dragover'" ngf-multiple="false" ngf-allow-dir="true"
						accept="image/*,application/pdf" 
						 ngf-model-invalid="MyError"
						ngf-pattern="'image/*'">Drop or click para subir las imagenes / Tamaño maximo 1 1MB </div>
						<div ngf-no-file-drop>File Drag/Drop is not supported for this browser</div>
						<span ng-if="MyError.$error"  ng-init="invalidFile('EXCEDE ELTAMAÑO PERMITIDO 1 MB')" > </span>
					
				</md-card>
				<span  > </span>
				<form name="UserForm" ng-submit="submit()" >

					<!-- NAME - LAST NAME INPUTS-->
					<div layout-gt-sm="row">
						<md-input-container class="md-block" flex >
							<label>Nombre</label>
							<input required ng-disabled="!Editable" type="nombre" name="nombre" ng-model="User.name"/>

							<div ng-messages="UserForm.nombre.$error" role="alert">
							  <div ng-message-exp="['required']">
								Por Favor ingrese un Nombre
							  </div>
							</div>
						</md-input-container>
						
						<md-input-container class="md-block"  flex >
							<label>Apellido</label>
							<input required  ng-disabled="!Editable" type="apellido" name="apellido" ng-value="User.lastname"/>

							<div ng-messages="UserForm.apellido.$error" role="alert">
							  <div ng-message-exp="['required']">
								Por Favor ingrese un Apellido
							  </div>
							</div>
						</md-input-container>

					 </div>
					 <!-- MAIL - FECHA DE NACIMIENTO-->
					<div layout-gt-sm="row">
						  <md-input-container class="md-block"  flex >
							<label>Email</label>
							<input required ng-disabled="!Editable" type="email" name="email" ng-model="User.email"
								   minlength="10" maxlength="100" ng-pattern="/^.+@.+\..+$/" />

							<div ng-messages="UserForm.email.$error" role="alert">
							  <div ng-message-exp="['required', 'minlength', 'maxlength', 'pattern']">
								Por Favor ingrese un formato de Email Valido
							  </div>
							</div>
						  </md-input-container>
						  <md-input-container class="md-block" flex >
							<label>Fecha de Nacimiento</label>
							<input required ng-disabled="!Editable" type="bday" name="bday" ng-model="User.bday"
								   ng-pattern="/^[0-9]{2}/[0-9]{2}/[0-9]{4}$/" placeholder="dd/mm/yyyy" />
							
							
							<div ng-messages="UserForm.bday.$error" role="alert">
							  <div ng-message-exp="['required', 'pattern']">
								Por Favor ingrese de Fecha de Nacimiento Valida
							  </div>
							</div>
						  </md-input-container>
					
					</div>
					<!-- SEXO - Numero de Telefono-->
					<div layout-gt-sm="row">
					
						  <md-input-container class="md-block"  flex >
							<label>Telefono</label>
							<input required ng-disabled="!Editable" type="telefono" name="telefono" ng-model="User.phone"
								   ng-pattern="/^[0-9]{2}-[0-9]{4}-[0-9]{4}$/" placeholder="15-1111-0000" />
							
							
							<div ng-messages="UserForm.telefono.$error" role="alert">
							  <div ng-message-exp="['required', 'pattern']">
								Por Favor ingrese numero de Telefono Valido
							  </div>
							</div>
						  </md-input-container>
						  <md-input-container class="md-block" flex >
							<label>Sexo</label>
							<md-select ng-disabled="!Editable"  ng-model="User.gender" name="sexo" required >
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
				
					<!-- Notificaciones -->
					<div layout-gt-sm="row">
					
						  <md-input-container class="md-block"  flex >
							  <md-switch ng-disabled="!Editable" ng-model="User.notify"  aria-label="Switch notify">
									Recibir notificaciones por Email?
							  </md-switch>
						  </md-input-container>
					
					</div>

					<div layout="row" layout-sm="column"  layout-align="space-around">
						  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>
					</div>
					
					<div layout-gt-sm="row" layout-align="center center">
					<md-button type="submit" ng-disabled="UserForm.$invalid || !Editable " class="md-raised md-primary" >Actualizar</md-button>
					<md-button  ng-disabled="Editable" ng-click="Editable = !Editable" class="md-raised md-primary" >Editar</md-button>
					
					</div>
				  
				  

				</form>
				
				
			  <!-- CAMBIO DE PASSWORD -->
			  <md-toolbar md-colors="{background: 'primary-500'}" class="md-whiteframe-4dp" >
				<div class="md-toolbar-tools"  layout-margin >
				  <h3 class="panel-widget-tittle">Cambio de Password</h3>
				  <span ></span>
				 
				</div>
			  </md-toolbar>
			  
			  	<form name="ChangePasswordForm" ng-submit="ChangePassword()" >

					<!-- NAME - LAST NAME INPUTS-->
					<div layout-gt-sm="row">
						<md-input-container class="md-block" flex >
							<label>Nuevo Password</label>
							<input ng-disabled="!Editable1" required type="password" name="password" ng-model="User.password" minlength="6"  />
							<div ng-messages="ChangePasswordForm.password.$error" role="alert">
							  <div ng-message-exp="['required', 'minlength', 'maxlength', 'pattern']">
									Tu password no debe ser menor a 6 Digitos
							  </div>
							</div>
						</md-input-container>
						
						<md-input-container class="md-block"  flex >
							<label>Repetir Password</label>
							<input required ng-disabled="!Editable1" type="password" name="password2" ng-model="User.password2" minlength="6"  ng-pattern="User.password" />
							<div ng-messages="ChangePasswordForm.password2.$error " role="alert" multiple md-auto-hide="true">
							  <div ng-message-exp="['required', 'minlength']">
									Tu password no debe ser menor a 6 Digitos
							  </div>
							
								<div  ng-message="pattern" role="alert">
							  
									Los Passwords no coinciden
								</div>
							</div>
						</md-input-container>

					 </div>
				
					<div layout="row" layout-sm="column"  layout-align="space-around">
						  <md-progress-circular md-mode="indeterminate" ng-show="spinner1"></md-progress-circular>
					</div>
					
					<div layout-gt-sm="row" layout-align="center center">
					<md-button type="submit" ng-disabled="ChangePasswordForm.$invalid || !Editable1 " class="md-raised md-primary" >Actualizar</md-button>
					<md-button  ng-disabled="Editable" ng-click="Editable1 = !Editable1" class="md-raised md-primary" >Editar</md-button>
					
					</div>
				  
				  

				</form>
				
				

			  		
		</section>
		
		</md-content>
  </div>
  <div flex-gt-sm="10"></div>
</div>


