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
		
		
			
		$db = new MySQL();
	
		
		if ($db->connected())
		{
			    $noty= $data->User->notify ? 1 : 0 ;
				
			   $strSql = "update CLIENT_USERS set name = '" . $data->User->name . "' , lastname = '" . $data->User->lastname . "' , gender = " . $data->User->gender . " , email = '". $data->User->email ."' , bday=STR_TO_DATE('". $data->User->bday ."', '%d/%m/%Y') , phone='". $data->User->phone ."' , notify= ". $noty ."   where id =" . $data->User->id ;
			   if ($db->executeSQL($strSql))
			   {
				   $response['ERROR']= 1;
				   $response['MESSAGE']= "Datos Actualizados con EXITO"; 
			   }
			   else
			   {
				   $response['ERROR']= 4;
				   $response['MESSAGE']= "No se pudieron actualizar Datos DB " ; 
			   }
		}
		else
		{
				$response['ERROR']= 5;
				$response['MESSAGE']= "No se pudieron actualizar Datos DB " ; 
		}
	
		
		
		echo json_encode($response); //this will go back under "data" of angular call.

	

?>