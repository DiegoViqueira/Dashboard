<div  layout="row" layout-xs="column" style="min-height:100%;" layout-align="center stretch" id="popupContainer"   >
  <div flex="10"></div>
  <div flex="auto"> 
	<md-content  ng-controller="ManageClaimCtrl" layout-padding layout-margin  layout-align="center center"  >
     
	
			  
			  
			  
		
		<md-toolbar class="md-table-toolbar md-default"  md-colors="{background: 'primary-500'}"  >
		  <div class="md-toolbar-tools">
			<span>Gestion de reclamos</span>
			<div flex ></div>
			<md-button class="md-primary md-raised"  >
												Pendientes: {{qtty_reclamos}}
			</md-button>
			<button class="md-icon-button md-button md-ink-ripple" ng-click="getOne()" type="button" md-colors="{background: 'primary-100'}" aria-label="filter_list" >
			<md-icon  class="material-icons">cached</md-icon>
			
			
			
			<div class="md-ripple-container"></div></button>
		  </div>
		  
		</md-toolbar>

		<!-- exact table from live demo -->
		<md-table-container>
		  <table md-table  md-row-select="true" multiple="false" ng-model="selected" md-progress="promise">
			<thead md-head md-order="query.order" >
			  <tr md-row>
				<th md-column md-order-by="id"><span>Nro de Reclamo</span></th>
				<th md-column ><span>Empresa</span></th>
				<th md-column ><span>Categoria</span></th>
				<th md-column ><span>Estado</span></th>
				<th md-column >Identificador</th>
				<th md-column >Fecha</th>
				<th md-column >Gestionar</th>
				
			  </tr>
			</thead>
			<tbody md-body>
			  <tr md-row md-select="item"  md-on-select="logItem()"  md-auto-select ng-repeat="item in reclamos.data | orderBy: query.order | limitTo: query.limit : (query.page -1) * query.limit ">
				<td md-cell>{{item.id}}</td>
				<td md-cell ng-bind="get_company_name(item.id_empresa)"></td>
				<td md-cell>{{item.categoria}}</td>
				<td md-cell ng-bind="get_status_name(item.status)"></td>
				<td md-cell>{{item.identificador}}</td>
				<td md-cell>{{item.fecha}}</td>
				<td md-cell>
				<button class="md-icon-button md-button md-ink-ripple" ng-click="showAlert($event,item)" type="button" ><md-icon  class="material-icons">description</md-icon></button>
				</td>
			  </tr>
			</tbody>
		  </table>
		</md-table-container>

		<md-table-pagination md-limit="query.limit" md-limit-options="[10,20,30]" md-page="query.page" md-total="{{reclamos.count}}" md-on-paginate="getDesserts" md-page-select></md-table-pagination>
		
		
				
	 
	</md-content>
  </div>
</div>


