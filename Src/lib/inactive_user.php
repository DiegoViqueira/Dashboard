<?php

	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include "../clases/db.class.php";
	
	const DEBUG = false;
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	else
	{
		$data['id']=2;
	}
	
	
	$db = new MySQL();
	
		
		if ($db->connected())
		{
				
				$strSql="UPDATE CLIENT_USERS set state = " . $data->id_estado . " where id = " . $data->id_usuario ;
				
				if ($data=$db->executeSQL($strSql))
				{
					$response['STATUS']=1;
					$response['MENSAJE']="Estado del Usuario Modificado OK.";						
					
				}
				else
				{
					$response['STATUS']=0;
					$response['MENSAJE']="No se pudo Modificar el Estado del Usuario.";						
				}
				
				if(DEBUG) 
				{
					print_r($response);
				}
				else
				{
					echo json_encode($response); //this will go back under "data" of angular call.
				}
				
				$db->closeConnection();
		}
	

?>