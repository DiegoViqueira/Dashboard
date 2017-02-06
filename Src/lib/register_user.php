<?php
/*  ---------------------------------------------------------
					Register USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include "./LibBase.php";
	include "crypto/cryptojs-aes.php";

	$postdata = file_get_contents("php://input");
	$data = json_decode($postdata);

	$ses_id =(string)session_id(); 
	$decripted_passw = cryptoJsAesDecrypt( $ses_id ,$data->password );
	
	$result=add_user($data->nombre,$data->apellido,$data->sexo,$data->bday,$data->email,$decripted_passw,$data->telefono,$data->id_empresa);
	
	
	
	if ( $result == 1 )
	{
		$response['STATUS'] = $result;
		$response['ERROR'] = "Usuario[".$data->nombre."] Registrado con Exito";
	}
	else if ($result == 8 )
	{
		$response['STATUS'] = $result;
		$response['ERROR'] =  "Usuario existente";
		
	}
	else
	{
		$response['STATUS'] = $result;
		$response['ERROR'] =  "No se pudo registrar el Usuario";
		
	}
	
	
	echo json_encode($response); //this will go back under "data" of angular call.
	
?>