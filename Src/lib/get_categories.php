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
	
	
	$db = new MySQL();
	
		
		if ($db->connected())
		{
				$strSql="SELECT id ,name from CATEGORIES where id_empresa= " . $data->id_empresa ;
				if ($data=$db->executeSQL($strSql))
				{
					$response=$data;	
					
				}
				else
				{
					$response = array();
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