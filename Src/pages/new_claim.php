<div  layout-align="center stretch"   ng-cloak>
<div  layout="row">
  <div flex="10"></div>
  <div flex="auto"> 
	<md-content  ng-controller="newClaimController as ctrl" layout-padding layout-margin  layout-align="center center" >
     <section layout-padding  class="md-whiteframe-4dp"  >
	
			  <md-toolbar md-colors="{background: 'primary-500'}" class="md-whiteframe-4dp" >
				<div class="md-toolbar-tools"  layout-margin >
				  <h3 class="panel-widget-tittle">Gestionar Nuevo Reclamo </h3>
				  <span ></span>
				 
				</div>
			  </md-toolbar>
			  
			  	<form name="NewClaimForm" ng-submit="altaReclamo()" >

						<md-autocomplete flex required
							md-input-name="autocompleteField"
							md-no-cache="ctrl.noCache"
							md-selected-item="ctrl.selectedItem"
							md-search-text="ctrl.searchText"
							md-items="item in ctrl.querySearch(ctrl.searchText)"
							md-item-text="item.display"
							md-min-length="0"
							md-require-match
							md-floating-label="Empresa">
						  <md-item-template>
							<span md-highlight-text="ctrl.searchText">{{item.display}}</span>
						  </md-item-template>
						  <div ng-messages="NewClaimForm.autocompleteField.$error" ng-if="NewClaimForm.autocompleteField.$touched">
							<div ng-message="required">Debes seleccionar una empresa.</div>
							<div ng-message="md-require-match">Selecciona una empresa existente.</div>
						
						  </div>
						</md-autocomplete>
						
						<md-input-container class="md-block" >
									<label>Categoria</label>
									
								   <md-select ng-disabled="!ctrl.selectedItem" required placeholder="Selecione una categoria" ng-model="ctrl.categoria" name="ctrl.categoria" md-on-open="LoadCategories()" style="min-width: 200px;">
									  <md-option ng-value="category.id" ng-repeat="category in categories">{{category.name}}</md-option>
									</md-select>
									<div ng-messages="NewClaimForm.categoria.$error" role="alert">
									  <div ng-message-exp="['required']">
										Por Favor ingrese una categoria valido.
									  </div>
									</div>
						</md-input-container>
						
						
						<md-input-container class="md-block" >
									<label>Identificador</label>
									<input required ng-disabled="!ctrl.categoria" placeholder="{{ctrl.selectedItem.regexp_description}}" type="referencia" name="referencia" ng-model="ctrl.identificador"/>

									<div ng-messages="NewClaimForm.referencia.$error" role="alert">
									  <div ng-message-exp="['required']">
										Por Favor ingrese un Identificador valido.
									  </div>
									</div>
						</md-input-container>

						<md-input-container class="md-block">
							<label>Detalle</label>
							<textarea ng-model="ctrl.detalle" required ng-disabled="!ctrl.identificador" name="detalle" md-maxlength="500" rows="5" md-select-on-focus></textarea>
							
							<div ng-messages="NewClaimForm.detalle.$error" role="alert">
							  <div ng-message-exp="['required']">
								Por Favor ingrese una Detalle.
							  </div>
							</div>
						</md-input-container>
			
					<div layout="row" layout-sm="column"  layout-align="space-around">
						  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>
					</div>
					
					<div layout-gt-sm="row" layout-align="center center">
					<md-button type="submit" ng-disabled="NewClaimForm.$invalid" class="md-raised md-primary" >Generar Nuevo Reclamo</md-button>
					
					
					</div>
				  
				  

				</form>
			
			  	
		
	 </section>
	</md-content>
  </div>
  <div flex="10"></div>
</div>


