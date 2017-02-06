<div  layout-align="center center" >
<div  layout="row"  >
  <div flex-gt-sm="20"></div>
  <div flex="auto"> 

  <md-content  ng-controller="RecoverCtrl as vm" layout-padding layout-margin  layout-align="center center" >
     <section layout-padding  class="md-whiteframe-4dp"  >
	
			  <md-toolbar md-colors="{background: 'primary-500'}" class="md-whiteframe-4dp" >
				<div class="md-toolbar-tools"  layout-margin >
				  <h3 class="panel-widget-tittle">Recuperar Password</h3>
				  <span ></span>
				 
				</div>
			  </md-toolbar>
				<BR>
				<BR>			
	<form name="LoginForm" ng-submit="recover()" >

      
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
	      

		<div layout="row" layout-sm="column"  layout-align="space-around">
			  <md-progress-circular md-mode="indeterminate" ng-show="spinner"></md-progress-circular>

		</div>
        <md-button type="submit" ng-disabled="LoginForm.$invalid" class="md-raised md-primary" >Recuperar Password</md-button>
		
      </div> 
	  

    </form>
		
	 </section>
	</md-content>
	
  <div flex-gt-sm="20"  ></div>
  
</div>
<BR>
<BR>
<BR>
<BR>

</div>

