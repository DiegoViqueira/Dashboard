
<div  layout="row" layout-xs="column" style="min-height:100%;" layout-align="center stretch" id="popupContainer"   >
  <div flex="10"></div>
  <div flex="auto"> 
	<md-content  ng-controller="AdminUsersEmpresaCtrl" layout-padding layout-margin  layout-align="center center"  >
     
	
			  
			  
		
		<md-toolbar class="md-table-toolbar md-default"  md-colors="{background: 'primary-500'}" layout-align="center end" >
		  <div class="md-toolbar-tools" >
			<span>Administracion de Usuarios</span>
			<span flex></span>
					<md-button class="md-primary" ng-href="#/new_user" md-colors="{background: 'primary-100'}"  >Nuevo Usuario <div class="md-ripple-container"></div></md-button>
				 <md-input-container md-no-float class="md-block md-errors-spacer" >
					<md-icon  class="material-icons">search</md-icon>
					<input type="text" ng-model="searchFish" ng-model-options="filter.options" placeholder="Ingrese Busqueda" class="ng-pristine ng-valid ng-touched" aria-invalid="false" style=""></input>
				  </md-input-container>
			
		  </div>
		  
		</md-toolbar>	  
		

		<!-- exact table from live demo -->
		<md-table-container>
		  <table md-table  md-row-select="true" multiple="false" ng-model="selected" md-progress="promise">
			<thead md-head md-order="query.order" >
			  <tr md-row>
				<th md-column md-order-by="name"><span>Nombre</span></th>
				<th md-column md-order-by="lastname"><span>Apellido</span></th>
				<th md-column ><span>Email</span></th>
				<th md-column ><span>Estado</span></th>
				<th md-column ><span>Fecha Alta</span></th>
				<th md-column >Desactivar</th>
				
			  </tr>
			</thead>
			<tbody md-body>
			  <tr md-row md-select="item"  md-on-select="logItem()"  md-auto-select ng-repeat="item in Usuarios.data | orderBy: query.order | filter: searchFish | limitTo: query.limit : (query.page -1) * query.limit ">
				<td md-cell>{{item.name}}</td>
				<td md-cell>{{item.lastname}}</td>
				<td md-cell>{{item.email}}</td>
				<td md-cell>{{item.state == 1 ? 'INACTIVO' : 'ACTIVO'}}</td>
				<td md-cell>{{item.fecha}}</td>
				<td md-cell>
				<button class="md-icon-button md-button md-ink-ripple" ng-click="inactive($event,item)" type="button" ><md-icon  class="material-icons">verified_user</md-icon></button>
				</td>
			  </tr>
			</tbody>
		  </table>
		</md-table-container>

		<md-table-pagination md-limit="query.limit" md-limit-options="[10,20,30]" md-page="query.page" md-total="{{Usuarios.count}}" md-on-paginate="getDesserts" md-page-select></md-table-pagination>
		
		
				
	 
	</md-content>
  </div>
  
</div>


