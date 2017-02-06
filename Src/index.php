<?php if(!isset($_SESSION)) { session_start(); } ?>
<html lang="en" >
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta charset="UTF-8">
  
  <title>Reclamo On-Line </title>
  <!-- Favicon -->
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" href="images/rct.png ">
  <!-- Angular Material style sheet -->
  <link rel="stylesheet" href="css/angular-material.min.css">
  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,400italic">
  <link href="https://fonts.googleapis.com/css?family=Caveat" rel="stylesheet">
  <!-- Font Awesome-->
  <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
  <!-- Aplication Stylesheet -->
  <link rel="stylesheet" href="css/style.css">
  <!-- MD table Stylesheet -->
  <link rel="stylesheet" href="css/md-data-table.min.css">
  <!-- Custom Icons -->
  <link rel="stylesheet" href="icons/css/unitex.css">
  
</head>
<body ng-app="MainAplication" ng-cloak>

	<!-- WEBSITE CONTENT -->
	<div ng-include='"templates/header.html"'></div>
	<div ng-view ></div>
	<div ng-include='"templates/footer.html"'></div>
  
  
	<!-- Angular  Libraries -->
	<script src="js/angular/angular.min.js"></script>
	<script src="js/angular/angular-animate.min.js"></script>
	<script src="js/angular/angular-touch.min.js"></script>
	<script src="js/angular/angular-route.min.js"></script>
	<script src="js/angular/angular-resource.min.js"></script>
	<script src="js/angular/angular-aria.min.js"></script>
	<script src="js/angular/angular-messages.min.js"></script>
	<script src="js/angular/angular-sanitize.min.js"></script>
	<script src="js/angular/angular-cookies.min.js"></script>
	
	<!-- Angular Material Library -->
    <script src="js/angular/angular-material.min.js"></script>
  
	<!-- Aplication bootstrap  -->
	<script src="js/ReclamoOnline.min.js"></script>
	<script src="js/resources/ui-bootstrap-tpls.min.js"></script>
  
	<!-- Aplication Resources  -->
	<script src="js/resources/pie-chart.min.js"></script>
	<script src="js/resources/d3.v3.min.js"></script>
	<script src="js/resources/ng-file-upload.min.js"></script>
	<script src="js/resources/ng-file-upload-shim.min.js"></script>
	<script src="js/resources/md-data-table.min.js"></script>
	<script src="js/crypto/aes-json-format.js"></script>
	<script src="js/crypto/aes.js"></script>
	<script src="js/resources/ngFacebook.js"></script>

	<!-- Google Charts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-google-chart/0.1.0/ng-google-chart.min.js" type="text/javascript"></script>
  
  
</body>
</html>