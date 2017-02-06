<?php
	if(!isset($_SESSION)) { session_start(); } 
	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	
	/*Global Classes*/
	include "../clases/user.class.php";
	include "crypto/cryptojs-aes.php";
	
	const DEBUG = false;
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	
	
	$Usuario = new User();
	
	
	if(DEBUG) 
	{
	
		if ($Usuario->load_user('pablo@pablo.com','lalala'))	
		{	
			$response=array();
			$response['User'] = $Usuario->get_data();
			$response['Tables'] = $Usuario->get_tables();
			$response['unreadmessages'] = $Usuario->get_unreadmessages();
			$response['DefaultPage'] = $Usuario->getDefaultPage();
			print_r($response);
		}
		else
			$response= "Usuario / Password Incorrectos."; 
	}
	else
	{	
		$ses_id =(string)session_id(); 
		
		$decripted_passw = cryptoJsAesDecrypt( $ses_id ,$data->password );
		if ($Usuario->load_user($data->email,$decripted_passw))
		{	
			
			$Usr=$Usuario->get_data();
			if ( ($Usr['profile'] == '3' && $Usr['state'] == '0' ) || ($Usr['profile'] != '3') ) 
			{
				$response=array();
				$response['User'] = $Usr;
				$response['Tables'] = $Usuario->get_tables();
				$response['unreadmessages'] = $Usuario->get_unreadmessages();
				$response['DefaultPage'] = $Usuario->getDefaultPage();
			}
			else
			{
				$response= "Usuario Inactivo."; 
			}
			
			
		}
		else
			$response= "Usuario / Password Incorrectos."; 
		
		echo json_encode($response); //this will go back under "data" of angular call.
	}
	

?>