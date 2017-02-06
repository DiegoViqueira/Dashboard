/*  ---------------------------------------------------------
					 Main Angular Controller
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
(function(){
    'use strict';

function decode_tables(array)
{
	if (array)
	{
			var arrayLength = array.length;
			var aux_table_name = '';
			var result=[];
			var items=[];
			
			for (var i = 0; i < arrayLength; i++) 
			{
				if ( array[i]['grupo'] != aux_table_name )
				{
					if (items.length > 0 )
					{
						result.push({grupo:aux_table_name,tables:items});
					}	
					items=[];
					aux_table_name=array[i]['grupo'];
					items.push({modulo: array[i]['modulo'] , archivo: array[i]['archivo'], icono: array[i]['icono']});
					
					
					
				}
				else
				{
					items.push({modulo: array[i]['modulo'] , archivo: array[i]['archivo'], icono: array[i]['icono']});
					
				}
				
			}
			
			if (items.length > 0 )
			{
				result.push({grupo:aux_table_name,tables:items});
			}
			
			
			return result;
		
	}
};


function getPHPSessId() {
    var phpSessionId = document.cookie.match(/PHPSESSID=[^;]+/);

    if(phpSessionId == null) 
        return '';

    if(typeof(phpSessionId) == 'undefined')
        return '';

    if(phpSessionId.length <= 0)
        return '';

    phpSessionId = phpSessionId[0];

    var end = phpSessionId.lastIndexOf(';');
    if(end == -1) end = phpSessionId.length;

    return phpSessionId.substring(10, end);
};


var myapp= angular.module('MainAplication', ['ngMaterial','ngRoute','ngMessages','ngAnimate','ngSanitize','ngCookies','n3-pie-chart','ngFileUpload','md.data.table','googlechart','ngFacebook']);

myapp.config(['$mdThemingProvider', '$facebookProvider' ,function($mdThemingProvider,$facebookProvider) {
    $mdThemingProvider.theme('default')
    .primaryPalette('teal', {
      'default': '400', // by default use shade 400 from the pink palette for primary intentions
      'hue-1': '100', // use shade 100 for the <code>md-hue-1</code> class
      'hue-2': '600', // use shade 600 for the <code>md-hue-2</code> class
      'hue-3': 'A100' // use shade A100 for the <code>md-hue-3</code> class
    });
	
	$mdThemingProvider.theme('alt')
    .primaryPalette('teal', {
      'default': '400', // by default use shade 400 from the pink palette for primary intentions
      'hue-1': '100', // use shade 100 for the <code>md-hue-1</code> class
      'hue-2': '600', // use shade 600 for the <code>md-hue-2</code> class
      'hue-3': 'A100' // use shade A100 for the <code>md-hue-3</code> class
    }).dark();
	
	$facebookProvider.setAppId('184422655328299').setPermissions(['email','public_profile']);
}]);

myapp.run(['$rootScope', '$window' , function($rootScope, $window) {
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    $rootScope.$on('fb.load', function() {
      $window.dispatchEvent(new Event('fb.load'));
    });
  }]);

myapp.config(['$routeProvider', function ($routeProvider, $routeParams) {
   console.log("routeProvider reporting for duty. page required.");
  
  $routeProvider
    // Pages
	.when("/", {templateUrl: "pages/home.php", controller: "MainController"})
	.when("/:name", {  templateUrl: function(urlattr){
                return 'pages/' + urlattr.name + '.php';
            },controller: "MainController"})
	.otherwise("/404",{templateUrl: "pages/404.php", controller: "MainController"})
		
}]);


myapp.directive('panelWidget', ['$rootScope', function($rootScope) {
    return {
      restrict: 'E',
      replace: true,
      transclude: true,
      scope: { title: '@', template: '@', options: '@' },
      template: '' +
                '<section layout-margin class="panel-widget" flex >' +
                '  <md-toolbar layout-padding class="md-hue-1 panel-widget-toolbar" >' +
                '    <div class="md-toolbar-tools" flex >' +
                '      <h3 class="panel-widget-tittle">{{title}}</h3>' +
                '      <span flex></span>' +
                '      <md-button ng-show="options" ng-click="$showOptions = !$showOptions" class="md-icon-button" aria-label="Show options">' +
                '        <i class="material-icons">more_vert</i>' +
                '      </md-button>' +
                '    </div>' +
                '  </md-toolbar>' +
                '  <div ng-include="template"/>' +
                '</section>',
      compile: function(element, attrs, linker) {
        return function(scope, element) {
          linker(scope, function(clone) {
            element.append(clone);
          });
        };
      }
    };
	
}]);










