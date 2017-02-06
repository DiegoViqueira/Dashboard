<div  layout-align="center center" ng-controller="DasboardCtrl"  >

<div  layout="row" >

  <!-- MERGEN IZQUIERDO  -->
  <div flex-gt-sm="10"></div>
  
  <!-- CONTENIDO  -->
  
  <div  layout-padding  layout-align="center center" layout="row" layout-xs="column" flex="auto" > 
		<!-- CARDS DESCRIPTIVAS  -->
		<div layout="column" class="md-whiteframe-4dp" >
			<md-content layout-padding>
			<div layout="row" class="md-toolbar-tools" layout-margin  md-colors="{background: 'primary-500'}"  layout-align="center center" >
					  <h3 class="panel-widget-tittle">Resumen del Cliente</h3>
					
			</div>
			
			
			<div layout="row" layout-xs="column"  layout-margin layout-align="center center"  >
				
			
			
			
				<!-- CARDS 1  -->
				<div  layout-xs="row"  flex="auto"  >
					<md-card  flex="auto"  layout-align="center center" layout-padding class="md-whiteframe-4dp" md-theme="alt" >
						<md-card-header md-colors="{color: 'blue-grey'}" >
							<md-card-header-text>
								<span class="md-title text-center">Avatar</span>
							
							</md-card-header-text>
						</md-card-header>
						<md-card-title layout-padding >
							  <md-card-title-media flex="auto" >
									<img  class="md-media-lg md-user-avatar rounded" src="{{User.picture}}"/>
							  </md-card-title-media>
							  
						</md-card-title>
					</md-card>
				</div>
			
				<!-- CARDS 2  -->
				<div layout-xs="row" flex="auto"   >
					<md-card  flex="auto"  layout-align="center center" layout-padding class="md-whiteframe-4dp" md-theme="alt" >
						<md-card-header md-colors="{color: 'blue-grey'}" >
							<md-card-header-text>
								<span class="md-title text-center">Periodo actual</span>
							
							</md-card-header-text>
						</md-card-header>
						<md-card-content layout-padding >
							<div style="width:150px;height:150px">
								<pie-chart   data="gauge_data" options="gauge_options"></pie-chart>
							</div>
								
						</md-card-content>
					</md-card>
				</div>
				<!-- CARDS 3  -->
				<div  layout-xs="row" flex="auto"  >
					<md-card  flex="auto"  layout-align="center stretch" layout-padding  class="md-whiteframe-4dp" md-theme="alt" >
						<md-card-header md-colors="{color: 'blue-grey'}" >
							<md-card-header-text>
								<span class="md-title text-center">Perido actual x Estado</span>
							
							</md-card-header-text>
						</md-card-header>
							<md-card-content class="secondary-button-padding"  >
							
									  <md-list-item  ng-repeat="y in totales" class="secondary-button-padding"   >
										<md-button class="md-primary md-raised" flex >
												{{y.status}} : {{y.cant}}
										</md-button>
									  </md-list-item>
							
							</md-card-content>
					</md-card>
				</div>
			
			
			
			</div>
			<!-- FIN CARDS DESCRIPTIVAS  -->
			</md-content>
		</div>
	</div>
  <!-- FIN CONTENIDO  -->
  <!-- MERGEN DERECHO  -->
  <div flex-gt-sm="10"></div>
</div>

<div  layout="row" >

  <!-- MERGEN IZQUIERDO  -->
  <div flex-gt-sm="20"></div>
  
  <!-- CONTENIDO  -->
  <div  layout-padding layout-align="center center" layout="row" layout-xs="column" flex="auto"> 
		
		<!-- CARDS DESCRIPTIVAS  -->
	
		<div layout="column" flex="auto" class="md-whiteframe-4dp" >
			<md-content layout-padding>
			<div layout="row" class="md-toolbar-tools" layout-margin  md-colors="{background: 'primary-500'}"  layout-align="center center" >
					  <h3 class="panel-widget-tittle">Grafico de Actividad</h3>
					
			</div>
	
		
			<div layout="row" layout-xs="column"  layout-align="center center" flex="auto">
				
				<div layout-xs="row" flex="100"  >
					<md-card  flex="auto" layout-padding class="md-whiteframe-4dp" >
						<md-card-header md-colors="{color: 'blue-grey'}" >
							<md-card-header-text>
								<span class="md-title text-center">Actividad Anual del Cliente en Rec!lamos On-Line </span>
							
							</md-card-header-text>
						</md-card-header>
						<md-card-content layout-padding >
							<div google-chart chart="myChartObject" style="height:70%; width:90%;" flex ></div>
						</md-card-content>
					</md-card>
				</div>
			
				
			</div>
			<!-- FIN CARDS DESCRIPTIVAS  -->
			</md-content>
		</div>
	</div>
  <!-- FIN CONTENIDO  -->
  <!-- MERGEN DERECHO  -->
  <div flex-gt-sm="20"></div>

  </div>


</div>

