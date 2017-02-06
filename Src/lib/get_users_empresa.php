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
		$data['id_empresa']=2;
	}
	
	
	$db = new MySQL();
	
		
		if ($db->connected())
		{
				
				$strSql="SELECT * from CLIENT_USERS where id_empresa = " . $data->id_empresa ;
				
				if ($data=$db->executeSQL($strSql))
				{
					$response['DATA']=array();
					$response['DATA']=$data;
					$response['ERROR']=1;						
					
				}
				else
				{
					$response['DATA'] = array();
					$response['ERROR'] = 0;
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