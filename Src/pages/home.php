<div  layout-align="center center" >
<div layout="row" id="background" >
	<img  class="stretch"  src="images/slider/slider.jpg" >
</div>
<div  layout="row" >

  <!-- MERGEN IZQUIERDO  -->
  <div flex-gt-sm="10"></div>
  
  <!-- CONTENIDO  -->
  <div  layout-margin layout-align="center center" layout="row" layout-xs="column" > 
		
		<!-- CARDS DESCRIPTIVAS  -->
		<div layout="column" flex-gt-xs="70">
			<!-- CARDS 1  -->
			<div layout-xs="row" flex="auto" md-colors="{background: 'blue-grey'}" >
				<md-card  flex="auto" layout-padding class="md-whiteframe-4dp" >
					<md-card-header md-colors="{color: 'blue-grey'}" >
						<md-card-header-text>
							<span class="md-title text-center">Rec!amo On-Line nueva plataforma de gestion de reclamos.</span>
						
						</md-card-header-text>
					</md-card-header>
					<md-card-content layout-padding >
						<p class="text-center" >Mediante nuestra plataforma podras realizar los reclamos a todas 
						las empresas registradas.
						<BR>
						Olvidate de tener diferentes cuentas para cada compania, una sola cuenta para
						   gestionar tus consultas o reclamos a las diferentes empresas.</p>
							
					</md-card-content>
				</md-card>
			</div>
			<!-- CARDS 2  -->
			<div  layout-xs="row" flex="auto" md-colors="{background: 'blue-grey'}" >
				<md-card  flex="auto"  layout-padding class="md-whiteframe-4dp" >
					<md-card-header md-colors="{color: 'blue-grey'}" >
						<md-card-header-text>
							<span class="md-title text-center">Empresas que ya se sumaron a Rec!amo On-Line</span>
						
						</md-card-header-text>
					</md-card-header>
					<md-card-content layout-padding class="text-center" >
						<i class="icon-unitex fa-2x" aria-hidden="true" ><md-tooltip md-direction="bottom">Unitex</md-tooltip></i>
						<i class="icon-insucom fa-2x" aria-hidden="true"><md-tooltip md-direction="bottom">Insucom</md-tooltip></i>
						<!--i class="fa fa-css3 fa-2x" aria-hidden="true"></i>
						<i class="fa fa-facebook-square fa-2x" aria-hidden="true"></i>
						<i class="fa fa-firefox fa-2x" aria-hidden="true"></i>
						<i class="fa fa-google fa-2x" aria-hidden="true"></i-->
							
					</md-card-content>
				</md-card>
			</div>
			<!-- CARDS 3  -->
			<div  layout-xs="row" flex="auto" md-colors="{background: 'blue-grey'}" >
				<md-card  flex="auto"  layout-padding class="md-whiteframe-4dp" >
					<md-card-header md-colors="{color: 'blue-grey'}" >
						<md-card-header-text>
							<span class="md-title text-center">Inovador sistema con las mejores Tecnologias de Desarrollo.</span>
							
							
						</md-card-header-text>
						
					</md-card-header>
					<md-card-content layout-padding class="text-center" >
					<span class="md-body-2 text-center">Full Responsive</span>
						<BR>
						<md-button class="md-fab " ng-disabled="true" aria-label="Seguridad">
						<i class="fa fa-desktop fa-2x" aria-hidden="true"></i>
						</md-button>
						<md-button class="md-fab " ng-disabled="true" aria-label="Seguridad">
						<i class="fa fa-tablet fa-2x " aria-hidden="true"></i>
						</md-button>
						<md-button class="md-fab " ng-disabled="true"  aria-label="Seguridad">
						<i class="fa fa-mobile fa-2x " aria-hidden="true"></i>
						</md-button>
						
						<md-button class="md-fab"  ng-disabled="true" aria-label="Seguridad">
						<i class="fa fa-laptop fa-2x " aria-hidden="true"></i>
						</md-button>
					</md-card-content>
				
					
				</md-card>
			</div>
		</div>
		<!-- FIN CARDS DESCRIPTIVAS  -->
		<!-- FORMULARIO DE INGRESO  -->
		<div layout-gt-xs="column" layout-xs="row"  flex="auto" >
			<md-card  layout="column" layout-align="center center" layout-padding class="md-whiteframe-4dp" >
				<!-- TOOLBAR  -->
				<md-toolbar md-colors="{background: 'primary-500'}" >
					<div class="md-toolbar-tools" flex layout-margin  layout-align="center center" >
					  <h3 class="panel-widget-tittle">Ingreso al Sistema</h3>
					
					</div>
				</md-toolbar>
				<!-- FIN TOOLBAR  -->
				<!-- FORMULARIO  -->
				<md-card-content layout-padding >
					<div ng-controller="LoginCtrl as vm" layout="column" ng-cloak>

					  <md-content layout-padding>
						<form name="LoginForm" ng-submit="login()" >

						  
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
						  
							  
							<div class="text-center">
								<div layout="row" layout-sm="column"  layout-align="space-around">
								  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>
								</div>
							</div>
							<div class="text-center">
							<md-button type="submit" ng-disabled="LoginForm.$invalid" class="md-raised md-primary" >Login</md-button>
							<md-button md-no-ink href="#/new_user" class="md-warn" >Registrate</md-button>
							<md-button md-no-ink href="#/recover_password" class="md-warn" >Recuperar Password</md-button>
							</div>
							
								<BR>
							<md-divider ></md-divider>
							<BR>
							<div class="text-center " >
							<md-button class="md-raised" style=" font-size: 11px;" ng-click="login_fb()" ><i style="color:#3b5998;"  class="fa fa-facebook" aria-hidden="true"></i> Inicia Session usando Facebook</md-button>
							
							</div>
						</form>
					  </md-content>
					</div>
				</md-card-content>
				<!-- FIN FORMULARIO  -->
			</md-card>
			
		</div>
		<!-- FIN FORMULARIO DE INGRESO  -->
		
  </div>
  <!-- FIN CONTENIDO  -->
  <!-- MERGEN DERECHO  -->
  <div flex-gt-sm="10"></div>
</div>

<div layout="row" >
		<!-- MERGEN DERECHO  -->
		<div flex-gt-sm="15"></div>
		<!-- CONTENIDO  -->
		<div  layout-margin layout-align="center center" layout="row" layout-xs="column" > 
	    
			<div layout-xs="row" flex="auto" >
			<md-card  flex="auto" layout-align="center center" >
				<md-card-header md-colors="{color: 'blue-grey'}" >
					<md-card-header-text>
						<span class="md-title text-center">Seguridad y Proteccion de datos</span>
							
					</md-card-header-text>
				</md-card-header>
				<md-card-content layout-padding class="text-center" >
					 <md-button class="md-fab md-primary" aria-label="Seguridad">
						<md-tooltip md-direction="bottom">Seguro</md-tooltip>
						<md-icon  class="material-icons md-mybutton" >security</md-icon>
					</md-button>		
					<md-button class="md-fab md-primary" aria-label="Seguridad">
						<md-tooltip md-direction="bottom">Bloqueado</md-tooltip>
						<md-icon  class="material-icons md-mybutton" >lock</md-icon>
					</md-button>
					<md-button class="md-fab md-primary" aria-label="Seguridad">
						<md-tooltip md-direction="bottom">Control de Acceso</md-tooltip>
						<md-icon  class="material-icons md-mybutton" >verified_user</md-icon>
					</md-button>				
					<p>Todos nuestros accesos se encuentran protegidos, securizados
					   y nuestro mayor compromiso con el cliente es la confidencialidad de toda tu informacion.
					</p>
				</md-card-content>
			</md-card>
			</div>
			
			<div layout-xs="row" flex="auto" >
			<md-card flex="auto" layout-align="center center" >
				<md-card-header md-colors="{color: 'blue-grey'}" >
					<md-card-header-text>
						<span class="md-title text-center">Gestion simple y notificacones por e-mail.</span>
							
					</md-card-header-text>
				</md-card-header>
				<md-card-content layout-padding class="text-center" >
					 <md-button class="md-fab md-primary" aria-label="Accesible">
						<md-tooltip md-direction="bottom">Accesible</md-tooltip>
						<md-icon  class="material-icons md-mybutton" >accessibility</md-icon>
					</md-button>		
					<md-button class="md-fab md-primary" aria-label="Comunicacion">
						<md-tooltip md-direction="bottom">Comunicacion por mail</md-tooltip>
						<md-icon  class="material-icons md-mybutton" >mail</md-icon>
					</md-button>
					<md-button class="md-fab md-primary" aria-label="Disponibilidad">
						<md-tooltip md-direction="bottom">Disponible 24 HS</md-tooltip>
						<md-icon  class="material-icons md-mybutton" >av_timer</md-icon>
					</md-button>				
					
						<p>Dentro de nuestra plataforma te aseguramos una facil gestion en tus reclamos,
						   te mantenemos comunicado por mail en cada paso de tu gestion y nuestra
						   plataforma se encuentra 99% disponible,los 365 dias del anio.</p>
				</md-card-content>
			</md-card>
			</div>

		</div>
		<!-- MERGEN DERECHO  -->
		<div flex-gt-sm="15"></div>
</div>
</div>

