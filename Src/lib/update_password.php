<?php
	if(!isset($_SESSION)) { session_start(); } 
	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	
	/*Global Classes*/
	include "crypto/cryptojs-aes.php";
	include "../clases/db.class.php";
	
	const DEBUG = false;
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	
		$response=array();
		
		$ses_id =(string)session_id(); 
		
		$decripted_passw = cryptoJsAesDecrypt( $ses_id ,$data->new_password );
		
			
		$db = new MySQL();
	
		
		if ($db->connected())
		{
			  $strSql = "update CLIENT_USERS set passwd = '" . $decripted_passw . "' where id =" . $data->id ;
			   if ($db->executeSQL($strSql))
			   {
				   $response['ERROR']= 1;
				   $response['MESSAGE']= "Password Actualizado con EXITO"; 
			   }
			   else
			   {
				   $response['ERROR']= 4;
				   $response['MESSAGE']= "No se pudo actualizar el Password. DB "; 
			   }
		}
		else
		{
				$response['ERROR']= 5;
				$response['MESSAGE']= "No se pudo actualizar el Password. DB "; 
		}
	
		
		
		echo json_encode($response); //this will go back under "data" of angular call.

	

?>