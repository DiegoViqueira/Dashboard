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
	
		$response=array();
	
		$db = new MySQL();
		
		if ($db->connected())
		{
	
			
				$strSql="insert into RECLAMOS_ACTIVOS (id,id_cliente,id_empresa,identificador,id_categoria) values (null,".$data->cliente.",".$data->empresa.",'".$data->identificador. "'," . $data->categoria . ")";
				if ($db->executeSQL($strSql))
				{
					$last_id=$db->lastInsertID();
					$strSql="insert into RECLAMOS_MENSAJES (id_reclamo,description) values (".$last_id.",'". $data->detalle ."')";
					if ($db->executeSQL($strSql))
					{
						$response['mensaje']="Reclamo generado con EXITO.";
						$response['error']=0;
					}
					else
					{
						  $strSql="delete from RECLAMOS_ACTIVOS where id=". $last_id ;
						 if ($db->executeSQL($strSql))
						 {
							$response['mensaje']="No se pudo generar el reclamo REINTENTE "  ;
							$response['error']=1;
						 }
						 else
						 {
							 $response['mensaje']="No se pudo generar el reclamo REINTENTE";
							 $response['error']=2;
						 }
					}
				}
				else
				{
					$response['mensaje']="No se pudo generar el reclamo REINTENTE.";
					$response['error']=3;
				}
				$db->closeConnection();
		}
		else
		{
			$response['mensaje']="No se pudo generar el reclamo REINTENTE.";
			$response['error']=4;
		}
		
		
		echo json_encode($response); //this will go back under "data" of angular call.
	
	

?>