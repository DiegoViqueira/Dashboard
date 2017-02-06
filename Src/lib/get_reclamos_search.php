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
	   $data['id']=8;
	}
	
	
	
	$db = new MySQL();
	
		
		if ($db->connected())
		{
				$strSql="(SELECT a.id , a.identificador , a.fecha , b.name , b.picture , c.description AS status ,g.name AS categoria FROM RECLAMOS_ACTIVOS a ,  CLIENT_USERS b , ESTADOS_RECLAMOS c , CATEGORIES g where a.id = " . $data->id ."  and a.id_empresa = b.id  and a.id_empresa =". $data->id_empresa. " and a.status = c.id and a.id_categoria = g.id ) UNION
						 (SELECT d.id , d.identificador , d.fecha , e.name , e.picture , f.description AS status ,h.name AS categoria FROM RECLAMOS_CERRADOS d ,  CLIENT_USERS e , ESTADOS_RECLAMOS f , CATEGORIES h where d.id = " . $data->id ."  and d.id_empresa = e.id and d.id_empresa =". $data->id_empresa. " and d.status = f.id and d.id_categoria = h.id )";
				
	
				
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