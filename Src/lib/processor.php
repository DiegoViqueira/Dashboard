<?php

	/*  ---------------------------------------------------------
					Login USER 
                       release :1.0.0.0
					   Autor: Diego Viqueira
					   Date: 24-08-2016
	---------------------------------------------------------*/	
	if(!isset($_SESSION)) {session_start(); } 
	/*Global Classes*/
	include "../clases/processor.class.php";

	
	const DEBUG = false;
	
	
	
	if(!DEBUG) 
	{
		$postdata = file_get_contents("php://input");
		$data = json_decode($postdata);
	}
	
	
	$app = new Processor();
	
	$response['ERROR']=0;
	
	
	if(DEBUG) 
	{
	
		if ($app->pop(4,2)	)
		{	
			$app->data['status']=2;
			$response['DATA'] = $app->data;
			$response['ERROR'] = 1;
		}
		else
		{
			if ( $app->errorNro == -5 && $app->lasterror == "" )
				$response['ERROR'] = 0;
			else
				$response['ERROR']= $app->errorNro;
		}
		
		echo json_encode($response); //this will go back under "data" of angular call.
		
	}
	else
	{	

		if ($app->pop($data->id_usuario,$data->id_empresa))
		{	
			$response['DATA']=array();
			$app->data['status']=2;
			array_push($response['DATA'] , $app->data);
		
			$response['ERROR'] = 1;
		}
		else
		{
			if ( $app->errorNro == -5 && $app->lasterror == "" )
			{
				$response['ERROR'] = 0;
				$response['DATA'] = "No hay Reclamos Activos para Procesar.";
			}	
			else
				$response['ERROR']= $app->errorNro;
				$response['DATA'] = $app->lasterror;
				
		}
		
		echo json_encode($response); //this will go back under "data" of angular call.
	}
	

?>